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
        return view("admin.product_list", compact("products"));
    }

    /* ================= CREATE PAGE ================= */
    public function create()
    {
        return view("admin.create");
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
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            // Handle Main Image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);

            // Handle Gallery Images
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $image) {
                    $galleryName = time() . '_' . $index . '.' . $image->extension();
                    $image->move(public_path('products/gallery'), $galleryName);
                    $galleryImages[] = 'gallery/' . $galleryName;
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

            // Create Notification and Send Email to all users
            $users = User::all();
            foreach ($users as $user) {
                // Custom Database Notification
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'New Product Launched!',
                    'message' => 'Check out our newly added product: ' . $product->name,
                    'link' => route('product.details', $product->id),
                    'type' => 'product'
                ]);

                // Email Notification
                try {
                    $user->notify(new NewProductNotification($product));
                } catch (\Exception $e) {
                    Log::error("Failed to send email to {$user->email}: " . $e->getMessage());
                }
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
        return view("admin.edit", compact("product"));
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
                'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
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

            // Image Update Logic
            if ($request->hasFile('image')) {
                if ($product->image && File::exists(public_path('products/' . $product->image))) {
                    File::delete(public_path('products/' . $product->image));
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('products'), $imageName);
                $data['image'] = $imageName;
            }

            // Gallery Update Logic
            if ($request->hasFile('gallery_images')) {
                // Delete old gallery
                if ($product->gallery_images) {
                    foreach ($product->gallery_images as $oldImage) {
                        File::delete(public_path('products/' . $oldImage));
                    }
                }
                $galleryImages = [];
                foreach ($request->file('gallery_images') as $index => $image) {
                    $galleryName = time() . '_' . $index . '.' . $image->extension();
                    $image->move(public_path('products/gallery'), $galleryName);
                    $galleryImages[] = 'gallery/' . $galleryName;
                }
                $data['gallery_images'] = $galleryImages;
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

            // Delete Main Image
            if ($product->image && File::exists(public_path('products/' . $product->image))) {
                File::delete(public_path('products/' . $product->image));
            }

            // Delete Gallery Images
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $image) {
                    File::delete(public_path('products/' . $image));
                }
            }

            $product->delete();
            return back()->with("success", "Product Deleted Successfully");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting product.');
        }
    }
}