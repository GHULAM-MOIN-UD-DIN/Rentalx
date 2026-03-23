<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\ReviewHelpful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Store a new review - SQL Server Compatible
     */
    public function store(Request $request)
    {
        Log::info('Review store request received', [
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'has_files' => $request->hasFile('images')
        ]);

        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:products,id',
                'rating' => 'required|integer|min:1|max:5',
                'title' => 'nullable|string|max:255|regex:/^[\pL\pN\s\-\_\.\,\!\?]+$/u',
                'comment' => 'required|string|min:5|max:5000|regex:/^[\pL\pN\s\-\_\.\,\!\?\(\)\[\]\@\#\$\%\&\*]+$/u',
                'pros' => 'nullable|array|max:5',
                'pros.*' => 'nullable|string|max:100|regex:/^[\pL\pN\s\-\_\.]+$/u',
                'cons' => 'nullable|array|max:5',
                'cons.*' => 'nullable|string|max:100|regex:/^[\pL\pN\s\-\_\.]+$/u',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'title.regex' => 'Title contains invalid characters',
                'comment.regex' => 'Review contains invalid characters',
                'pros.*.regex' => 'Pros contain invalid characters',
                'cons.*.regex' => 'Cons contain invalid characters',
                'images.*.max' => 'Each image must be less than 2MB',
                'images.*.mimes' => 'Only JPEG, PNG, JPG, GIF images are allowed'
            ]);

            if ($validator->fails()) {
                Log::warning('Review validation failed', ['errors' => $validator->errors()->toArray()]);
                
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed: ' . $validator->errors()->first()
                ], 422);
            }

            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to submit a review'
                ], 401);
            }

            DB::beginTransaction();

            $existingReview = Review::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingReview) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reviewed this product'
                ], 400);
            }

            $verifiedPurchase = false;
            try {
                $verifiedPurchase = Order::where('user_id', Auth::id())
                    ->whereIn('status', ['completed', 'delivered', 'approved', 'paid'])
                    ->whereHas('items', function($query) use ($request) {
                        $query->where('product_id', $request->product_id);
                    })->exists();
            } catch (\Exception $e) {
                Log::warning('Verified purchase check failed: ' . $e->getMessage());
            }

            $images = [];
            if ($request->hasFile('images')) {
                $uploadPath = public_path('uploads/reviews');
                
                if (!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }

                $uploadedCount = 0;
                foreach ($request->file('images') as $image) {
                    if ($uploadedCount >= 5) break;
                    
                    if ($image->isValid()) {
                        $extension = strtolower($image->getClientOriginalExtension());
                        $imageName = time() . '_' . uniqid() . '.' . $extension;
                        $imageName = preg_replace('/[^a-zA-Z0-9\.\-\_]/', '', $imageName);
                        
                        try {
                            $image->move($uploadPath, $imageName);
                            $images[] = $imageName;
                            $uploadedCount++;
                        } catch (\Exception $e) {
                            Log::error('Image upload failed: ' . $e->getMessage());
                        }
                    }
                }
            }

            $pros = [];
            if ($request->has('pros') && is_array($request->pros)) {
                $pros = array_values(array_filter($request->pros, function($value) {
                    return !empty(trim($value));
                }));
            }
            
            $cons = [];
            if ($request->has('cons') && is_array($request->cons)) {
                $cons = array_values(array_filter($request->cons, function($value) {
                    return !empty(trim($value));
                }));
            }

            // SQL Server compatibility
            $pros = empty($pros) ? null : json_encode($pros);
            $cons = empty($cons) ? null : json_encode($cons);
            $images = empty($images) ? null : json_encode($images);

            $review = new Review();
            $review->user_id = Auth::id();
            $review->product_id = $request->product_id;
            $review->rating = $request->rating;
            $review->title = $request->title;
            $review->comment = $request->comment;
            $review->pros = $pros;
            $review->cons = $cons;
            $review->images = $images;
            $review->verified_purchase = $verifiedPurchase;
            $review->status = 'pending';
            
            $review->save();

            DB::commit();

            Log::info('Review created successfully', ['review_id' => $review->id]);

            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully! It will be published after approval.',
                'review' => $review->fresh()
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Log::error('SQL Server Error: ' . $e->getMessage());
            Log::error('SQL Code: ' . $e->getCode());
            
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred. Please try again later.'
            ], 500);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Review creation error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Admin: Get all reviews with filters and stats
     */
    public function adminIndex(Request $request)
    {
        $query = Review::with(['user', 'product']);

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('rating') && is_numeric($request->rating)) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('verified')) {
            $query->where('verified_purchase', true);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('product', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $reviews = $query->paginate(20);

        $stats = [
            'total' => Review::count(),
            'pending' => Review::where('status', 'pending')->count(),
            'approved' => Review::where('status', 'approved')->count(),
            'rejected' => Review::where('status', 'rejected')->count()
        ];

        $pendingReviewsCount = $stats['pending'];

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'reviews' => $reviews,
                'stats' => $stats
            ]);
        }

        return view('admin.reviews.index', compact('reviews', 'stats', 'pendingReviewsCount'));
    }

    /**
     * Admin: Get pending reviews only
     */
    public function pendingReviews(Request $request)
    {
        $query = Review::with(['user', 'product'])
            ->where('status', 'pending');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);

        $stats = [
            'total' => Review::count(),
            'pending' => Review::where('status', 'pending')->count(),
            'approved' => Review::where('status', 'approved')->count(),
            'rejected' => Review::where('status', 'rejected')->count()
        ];

        $pendingReviewsCount = $stats['pending'];

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'reviews' => $reviews
            ]);
        }

        return view('admin.reviews.pending', compact('reviews', 'stats', 'pendingReviewsCount'));
    }

    /**
     * Admin: Approve a review - FIXED
     */
    public function approve(Request $request, $id)
    {
        try {
            $review = Review::findOrFail($id);
            
            if ($review->status === 'approved') {
                $message = 'Review is already approved';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 400);
                }
                return redirect()->route('admin.reviews.index')->with('error', $message);
            }

            $review->status = 'approved';
            $review->approved_at = now();
            $review->approved_by = Auth::id();
            $review->save();

            $this->updateProductRating($review->product_id);

            $message = 'Review approved successfully';

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->route('admin.reviews.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error approving review: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $errorMessage = 'Error approving review: ' . $e->getMessage();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $errorMessage], 500);
            }
            
            return redirect()->route('admin.reviews.index')->with('error', $errorMessage);
        }
    }

    /**
     * Admin: Reject a review - FIXED
     */
    public function reject(Request $request, $id)
    {
        try {
            $review = Review::findOrFail($id);
            
            if ($review->status === 'rejected') {
                $message = 'Review is already rejected';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 400);
                }
                return redirect()->route('admin.reviews.index')->with('error', $message);
            }

            $review->status = 'rejected';
            $review->rejected_at = now();
            $review->rejected_by = Auth::id();
            $review->rejection_reason = $request->input('reason');
            $review->save();

            $message = 'Review rejected successfully';

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->route('admin.reviews.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error rejecting review: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $errorMessage = 'Error rejecting review: ' . $e->getMessage();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $errorMessage], 500);
            }
            
            return redirect()->route('admin.reviews.index')->with('error', $errorMessage);
        }
    }

    /**
     * Admin: Delete a review permanently - FIXED
     */
    public function destroy(Request $request, $id)
    {
        try {
            $review = Review::findOrFail($id);
            $productId = $review->product_id;

            if (!empty($review->images)) {
                $images = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                
                if (is_array($images)) {
                    $uploadPath = public_path('uploads/reviews');
                    foreach ($images as $image) {
                        if (empty($image)) continue;
                        
                        $imagePath = $uploadPath . '/' . $image;
                        if (File::exists($imagePath)) {
                            File::delete($imagePath);
                            Log::info('Deleted review image: ' . $imagePath);
                        }
                    }
                }
            }

            $review->delete();
            
            $this->updateProductRating($productId);

            $message = 'Review deleted successfully';

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->route('admin.reviews.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error deleting review: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $errorMessage = 'Error deleting review: ' . $e->getMessage();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $errorMessage], 500);
            }
            
            return redirect()->route('admin.reviews.index')->with('error', $errorMessage);
        }
    }

    /**
     * Admin: Bulk actions on multiple reviews
     */
    public function bulkAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:reviews,id',
            'action' => 'required|in:approve,reject,delete'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            return redirect()->route('admin.reviews.index')->with('error', 'Invalid request data');
        }

        $ids = $request->ids;
        $action = $request->action;
        $processed = 0;
        $failed = 0;

        try {
            DB::beginTransaction();

            foreach ($ids as $id) {
                try {
                    $review = Review::find($id);
                    
                    if (!$review) {
                        $failed++;
                        continue;
                    }

                    switch ($action) {
                        case 'approve':
                            if ($review->status !== 'approved') {
                                $review->status = 'approved';
                                $review->approved_at = now();
                                $review->approved_by = Auth::id();
                                $review->save();
                                $this->updateProductRating($review->product_id);
                            }
                            break;

                        case 'reject':
                            if ($review->status !== 'rejected') {
                                $review->status = 'rejected';
                                $review->rejected_at = now();
                                $review->rejected_by = Auth::id();
                                $review->save();
                            }
                            break;

                        case 'delete':
                            $productId = $review->product_id;
                            
                            if (!empty($review->images)) {
                                $images = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                                
                                if (is_array($images)) {
                                    $uploadPath = public_path('uploads/reviews');
                                    foreach ($images as $image) {
                                        if (empty($image)) continue;
                                        
                                        $imagePath = $uploadPath . '/' . $image;
                                        if (File::exists($imagePath)) {
                                            File::delete($imagePath);
                                        }
                                    }
                                }
                            }
                            
                            $review->delete();
                            $this->updateProductRating($productId);
                            break;
                    }
                    
                    $processed++;

                } catch (\Exception $e) {
                    Log::error("Bulk action error for review {$id}: " . $e->getMessage());
                    $failed++;
                }
            }

            DB::commit();

            $message = "{$processed} reviews " . ($action === 'delete' ? 'deleted' : ($action === 'approve' ? 'approved' : 'rejected')) . " successfully";
            if ($failed > 0) {
                $message .= ". {$failed} failed.";
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'processed' => $processed,
                    'failed' => $failed
                ]);
            }

            return redirect()->route('admin.reviews.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk action error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error performing bulk action'
                ], 500);
            }
            
            return redirect()->route('admin.reviews.index')->with('error', 'Error performing bulk action');
        }
    }

    /**
     * Helper: Update product average rating
     */
    private function updateProductRating($productId)
    {
        try {
            $avgRating = Review::where('product_id', $productId)
                ->where('status', 'approved')
                ->avg('rating');

            $reviewCount = Review::where('product_id', $productId)
                ->where('status', 'approved')
                ->count();

            $product = Product::find($productId);
            if ($product) {
                $product->average_rating = round($avgRating ?? 0, 2);
                $product->reviews_count = $reviewCount;
                $product->save();
                
                Log::info('Updated product rating', [
                    'product_id' => $productId,
                    'avg_rating' => $product->average_rating,
                    'count' => $reviewCount
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error updating product rating: ' . $e->getMessage());
        }
    }

    /**
     * Get reviews for a product (Frontend API)
     */
    public function getProductReviews($productId, Request $request)
    {
        $query = Review::with('user')
            ->where('product_id', $productId)
            ->where('status', 'approved');

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->has('verified')) {
            $query->where('verified_purchase', true);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
            case 'helpful':
                $query->withCount('helpfulVotes')->orderBy('helpful_votes_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $reviews = $query->paginate(10);

        $ratingStats = Review::where('product_id', $productId)
            ->where('status', 'approved')
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingStats[$i])) {
                $ratingStats[$i] = 0;
            }
        }

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'rating_stats' => $ratingStats,
            'average_rating' => round(Review::where('product_id', $productId)
                ->where('status', 'approved')
                ->avg('rating') ?? 0, 2),
            'total_reviews' => Review::where('product_id', $productId)
                ->where('status', 'approved')
                ->count()
        ]);
    }

    /**
     * Mark review as helpful (toggle)
     */
    public function markHelpful($reviewId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to mark review as helpful'
            ], 401);
        }

        try {
            $review = Review::findOrFail($reviewId);
            
            $existing = ReviewHelpful::where('review_id', $reviewId)
                ->where('user_id', Auth::id())
                ->first();

            if ($existing) {
                $existing->delete();
                $message = 'Removed helpful mark';
            } else {
                ReviewHelpful::create([
                    'review_id' => $reviewId,
                    'user_id' => Auth::id()
                ]);
                $message = 'Marked as helpful';
            }

            $count = ReviewHelpful::where('review_id', $reviewId)->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'helpful_count' => $count
            ]);

        } catch (\Exception $e) {
            Log::error('Error marking review helpful: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error processing request'
            ], 500);
        }
    }
}