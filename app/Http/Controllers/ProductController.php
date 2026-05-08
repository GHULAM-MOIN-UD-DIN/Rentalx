<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Notification;
use App\Notifications\NewProductNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class ProductController extends Controller
{
    /* ================= LIST PRODUCTS (ADMIN) ================= */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view("Admin.product_list", compact("products"));
    }

    /* ================= CREATE PAGE ================= */
    public function create()
    {
        return view("Admin.create");
    }

    /* ================= STORE PRODUCT ================= */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z0-9\s\-]+$/|max:100',
                'category' => 'required|string|max:50',
                'price' => 'required|numeric|min:1',
                'old_price' => 'nullable|numeric|min:1',
                'description' => 'required|min:10',
                'stock' => 'required|integer|min:0',
                'brand' => 'nullable|string|max:50',
                'model' => 'nullable|string|max:50',
                'material' => 'nullable|string|max:100',
                'weight' => 'nullable|string|max:50',
                'manufacturer' => 'nullable|string|max:100',
                'origin' => 'nullable|string|max:50',
                'featured' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:200',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:500',
                'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:10240',
                'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240'
            ]);

            // Handle Main Image - Upload to Cloudinary
            $cloudinaryResponse = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'rentalx/products'
            ]);
            $imageName = $cloudinaryResponse ? $cloudinaryResponse->getSecurePath() : null;
            
            if (!$imageName) {
                return back()->with('error', 'Failed to upload main image to Cloudinary.')->withInput();
            }

            // Handle Gallery Images - Upload to Cloudinary
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $image) {
                    try {
                        $galleryResponse = cloudinary()->upload($image->getRealPath(), [
                            'folder' => 'rentalx/products/gallery'
                        ]);
                        if ($galleryResponse && $galleryResponse->getSecurePath()) {
                            $galleryImages[] = $galleryResponse->getSecurePath();
                        }
                    } catch (\Exception $e) {
                        Log::warning("Gallery image {$index} upload failed: " . $e->getMessage());
                        // Continue with other images instead of failing completely
                    }
                }
            }

            $product = Product::create([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'description' => $request->description,
                'stock' => $request->stock,
                'brand' => $request->brand,
                'model' => $request->model,
                'material' => $request->material,
                'weight' => $request->weight,
                'manufacturer' => $request->manufacturer,
                'origin' => $request->origin,
                'featured' => $request->has('featured'),
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'image' => $imageName,
                'gallery_images' => $galleryImages,
                'status' => $request->stock > 0 ? 'active' : 'out_of_stock',
                'sold_count' => 0,
                'rating' => 0,
                'reviews_count' => 0
            ]);

            // Create Database Notifications + Email via Brevo HTTP API
            $users = User::all();
            foreach ($users as $user) {
                // In-app notification
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'New Product Launched!',
                    'message' => 'Check out our newly added product: ' . $product->name,
                    'link' => route('product.details', $product->id),
                    'type' => 'product'
                ]);

            /* 
            // Commented out to save Brevo Daily Quota (300 emails)
            // Email via Brevo HTTP API (not SMTP - port 587 blocked on Render)
            try {
                $emailHtml = view('emails.new-product-api', ['product' => $product])->render();
                send_brevo_email(
                    $user->email,
                    $user->name ?? 'Customer',
                    'New Product Launched: ' . $product->name,
                    $emailHtml
                );
            } catch (\Exception $e) {
                Log::warning("Brevo email to {$user->email} failed: " . $e->getMessage());
            }
            */
            }

            return redirect()->route("admin.products.index")->with("success", "Product Added Successfully");
                
        } catch (\Exception $e) {
            Log::error('Product creation error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $product = Product::findOrFail((int)$id);
        return view("Admin.edit", compact("product"));
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail((int)$id);

            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z0-9\s\-]+$/|max:100',
                'category' => 'required|string|max:50',
                'price' => 'required|numeric|min:1',
                'old_price' => 'nullable|numeric|min:1',
                'description' => 'required|min:10',
                'stock' => 'required|integer|min:0',
                'brand' => 'nullable|string|max:50',
                'model' => 'nullable|string|max:50',
                'material' => 'nullable|string|max:100',
                'weight' => 'nullable|string|max:50',
                'manufacturer' => 'nullable|string|max:100',
                'origin' => 'nullable|string|max:50',
                'featured' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:200',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:500',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240',
                'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10240'
            ]);

            $data = [
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'description' => $request->description,
                'stock' => $request->stock,
                'brand' => $request->brand,
                'model' => $request->model,
                'material' => $request->material,
                'weight' => $request->weight,
                'manufacturer' => $request->manufacturer,
                'origin' => $request->origin,
                'featured' => $request->has('featured'),
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => $request->stock > 0 ? 'active' : 'out_of_stock'
            ];

            // Image Update Logic - Upload to Cloudinary
            if ($request->hasFile('image')) {
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if ($product->image && str_starts_with($product->image, 'http')) {
                    try {
                        $publicId = $this->extractCloudinaryPublicId($product->image);
                        if ($publicId) {
                            cloudinary()->destroy($publicId);
                        }
                    } catch (\Exception $e) {
                        Log::warning('Failed to delete old Cloudinary image: ' . $e->getMessage());
                    }
                }

                $cloudinaryResponse = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => 'rentalx/products'
                ]);
                
                if ($cloudinaryResponse && $cloudinaryResponse->getSecurePath()) {
                    $data['image'] = $cloudinaryResponse->getSecurePath();
                } else {
                    Log::error('Cloudinary upload failed for main image in update');
                }
            }

            // Gallery Update Logic - Upload to Cloudinary
            if ($request->hasFile('gallery_images')) {
                // Delete old gallery from Cloudinary
                if ($product->gallery_images && is_array($product->gallery_images)) {
                    foreach ($product->gallery_images as $oldImage) {
                        if (is_string($oldImage) && str_starts_with($oldImage, 'http')) {
                            try {
                                $publicId = $this->extractCloudinaryPublicId($oldImage);
                                if ($publicId) {
                                    cloudinary()->destroy($publicId);
                                }
                            } catch (\Exception $e) {
                                Log::warning('Failed to delete old gallery image: ' . $e->getMessage());
                            }
                        }
                    }
                }
                
                $galleryImages = [];
                $files = $request->file('gallery_images');
                if (is_array($files)) {
                    foreach ($files as $index => $image) {
                        try {
                            $galleryResponse = cloudinary()->upload($image->getRealPath(), [
                                'folder' => 'rentalx/products/gallery'
                            ]);
                            if ($galleryResponse && $galleryResponse->getSecurePath()) {
                                $galleryImages[] = $galleryResponse->getSecurePath();
                            }
                        } catch (\Exception $e) {
                            Log::warning("Gallery image update failed at index $index: " . $e->getMessage());
                        }
                    }
                }
                
                if (!empty($galleryImages)) {
                    $data['gallery_images'] = $galleryImages;
                }
            }

            $product->update($data);

            return redirect()->route("admin.products.index")->with("success", "Product Updated Successfully");
                
        } catch (\Exception $e) {
            Log::error('Product update error: ' . $e->getMessage());
            return back()->with('error', 'Error updating product: ' . $e->getMessage())->withInput();
        }
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail((int)$id);

            // Delete Main Image from Cloudinary
            if ($product->image && str_starts_with($product->image, 'http')) {
                try {
                    $publicId = $this->extractCloudinaryPublicId($product->image);
                    if ($publicId) {
                        cloudinary()->destroy($publicId);
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to delete product image from Cloudinary: ' . $e->getMessage());
                }
            }

            // Delete Gallery Images from Cloudinary
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $image) {
                    if (str_starts_with($image, 'http')) {
                        try {
                            $publicId = $this->extractCloudinaryPublicId($image);
                            if ($publicId) {
                                cloudinary()->destroy($publicId);
                            }
                        } catch (\Exception $e) {
                            Log::warning('Failed to delete gallery image from Cloudinary: ' . $e->getMessage());
                        }
                    }
                }
            }

            $product->delete();
            return back()->with("success", "Product Deleted Successfully");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting product.');
        }
    }

    /**
     * Extract Cloudinary public_id from a full URL.
     * Example: https://res.cloudinary.com/xxx/image/upload/v123/rentalx/products/abc.jpg
     * Returns: rentalx/products/abc
     */
    private function extractCloudinaryPublicId(string $url): ?string
    {
        try {
            $matches = [];
            if (preg_match('/\/upload\/v\d+\/(.+)\.[a-zA-Z]+$/', $url, $matches)) {
                return isset($matches[1]) ? $matches[1] : null;
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}