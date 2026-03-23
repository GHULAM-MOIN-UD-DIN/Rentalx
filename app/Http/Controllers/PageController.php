<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function home()
    {
        try {
            $featuredProducts = Product::where('featured', true)
                ->latest()
                ->limit(8)
                ->get();
                
            $newProducts = Product::latest()
                ->limit(8)
                ->get();
                
            return view('Pages.home', compact('featuredProducts', 'newProducts'));
        } catch (\Exception $e) {
            Log::error('Home error: ' . $e->getMessage());
            return view('Pages.home', [
                'featuredProducts' => collect([]),
                'newProducts' => collect([])
            ]);
        }
    }

    public function product(Request $request)
    {
        Log::info('Product list page accessed');
        
        try {
            $query = Product::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('category', 'LIKE', "%{$search}%");
                });
            }

            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            $sort = $request->get('sort', 'latest');
            switch($sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
            }

            $products = $query->paginate(12)->withQueryString();

            $categories = Product::select('category')
                ->distinct()
                ->whereNotNull('category')
                ->get();

            return view('Pages.product', compact('products', 'categories'));
            
        } catch (\Exception $e) {
            Log::error('Product list error: ' . $e->getMessage());
            
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]), 0, 12, 1, ['path' => $request->url()]
            );
            $categories = collect([]);
            
            return view('Pages.product', compact('products', 'categories'));
        }
    }

    /**
     * PRODUCT DETAILS PAGE - FIXED VERSION
     */
    public function productDetails($id)
    {
        Log::info('Product details accessed for ID: ' . $id);
        
        try {
            // Load product with approved reviews
            $product = Product::with(['reviews' => function($query) {
                $query->where('status', 'approved')
                      ->with('user')
                      ->latest();
            }])->findOrFail($id);
            
            // Get related products
            $relatedProducts = Product::where('category', $product->category)
                ->where('id', '!=', $product->id)
                ->limit(4)
                ->get();
            
            // Calculate rating distribution
            $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
            
            foreach($product->reviews as $review) {
                if(isset($ratingCounts[$review->rating])) {
                    $ratingCounts[$review->rating]++;
                }
            }
            
            // Check if user has purchased this product
            $userPurchased = false;
            $userReview = null;
            $wishlistItems = [];
            
            if (auth()->check()) {
                try {
                    $userPurchased = Order::where('user_id', auth()->id())
                        ->where('status', 'completed')
                        ->whereHas('items', function($query) use ($id) {
                            $query->where('product_id', $id);
                        })->exists();
                } catch (\Exception $e) {
                    $userPurchased = false;
                }
                
                try {
                    $userReview = Review::where('user_id', auth()->id())
                        ->where('product_id', $id)
                        ->first();
                } catch (\Exception $e) {
                    $userReview = null;
                }
                
                try {
                    $wishlistItems = Wishlist::where('user_id', auth()->id())
                        ->pluck('product_id')
                        ->toArray();
                } catch (\Exception $e) {
                    $wishlistItems = [];
                }
            }
            
            return view('Pages.product-details', compact(
                'product', 
                'relatedProducts', 
                'userPurchased', 
                'userReview',
                'ratingCounts',
                'wishlistItems'
            ));
            
        } catch (\Exception $e) {
            Log::error('Product details error: ' . $e->getMessage());
            return redirect()->route('product.list')->with('error', 'Product not found');
        }
    }

    public function searchSuggestions(Request $request)
    {
        try {
            $term = $request->get('term');
            
            if (empty($term)) {
                return response()->json([]);
            }
            
            $products = Product::where('name', 'LIKE', "%{$term}%")
                ->orWhere('category', 'LIKE', "%{$term}%")
                ->limit(5)
                ->get(['id', 'name', 'price', 'image']);
                
            return response()->json($products);
            
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }

    public function featuredProducts()
    {
        try {
            $products = Product::where('featured', true)
                ->latest()
                ->limit(8)
                ->get();
                
            return response()->json($products);
            
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }
}   