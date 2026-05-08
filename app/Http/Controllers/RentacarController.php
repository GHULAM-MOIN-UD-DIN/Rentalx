<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Log;

class RentacarController extends Controller
{
    // Front Page - Show all cars
    public function rentacar()
    {
        $cars = Car::all(); // Collection - OK for front page
        return view('Pages.rentacar', compact('cars'));
    }

    // Admin List - WITH PAGINATION
    public function index()
    {
        // ✅ FIXED: Use paginate() instead of all()
        $cars = Car::orderBy('created_at', 'desc')->paginate(12);
        return view('Admin.rentacarlist', compact('cars'));
    }

    // Create Form
    public function create()
    {
        return view('Admin.rentacarcreate');
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'horsepower' => 'nullable|integer|min:0',
            'acceleration' => 'nullable|string|max:50',
            'top_speed' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'description' => 'nullable|string',
            'is_available' => 'nullable|in:0,1'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            // Upload to Cloudinary
            $cloudinaryResponse = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'rentalx/car_images'
            ]);
            $imageName = $cloudinaryResponse->getSecurePath();
        }

        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day,
            'horsepower' => $request->horsepower,
            'acceleration' => $request->acceleration,
            'top_speed' => $request->top_speed,
            'image' => $imageName,
            'description' => $request->description,
            'is_available' => $request->is_available ?? 1
        ]);

        return redirect()->route('admin.rentacar.index')
            ->with('success', 'Car Added Successfully');
    }

    // Edit
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('Admin.rentacarupdate', compact('car'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'horsepower' => 'nullable|integer|min:0',
            'acceleration' => 'nullable|string|max:50',
            'top_speed' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'description' => 'nullable|string',
            'is_available' => 'nullable|in:0,1'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image from Cloudinary if exists
            if ($car->image && str_starts_with($car->image, 'http')) {
                try {
                    $publicId = $this->extractCloudinaryPublicId($car->image);
                    if ($publicId) {
                        cloudinary()->destroy($publicId);
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to delete old car image: ' . $e->getMessage());
                }
            }
            
            // Upload new image to Cloudinary
            $cloudinaryResponse = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'rentalx/car_images'
            ]);
            $car->image = $cloudinaryResponse->getSecurePath();
        }

        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day,
            'horsepower' => $request->horsepower,
            'acceleration' => $request->acceleration,
            'top_speed' => $request->top_speed,
            'description' => $request->description,
            'is_available' => $request->is_available
        ]);

        return redirect()->route('admin.rentacar.index')
            ->with('success', 'Car Updated Successfully');
    }

    // Delete
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        
        // Delete image from Cloudinary if exists
        if ($car->image && str_starts_with($car->image, 'http')) {
            try {
                $publicId = $this->extractCloudinaryPublicId($car->image);
                if ($publicId) {
                    cloudinary()->destroy($publicId);
                }
            } catch (\Exception $e) {
                Log::warning('Failed to delete car image from Cloudinary: ' . $e->getMessage());
            }
        }
        
        $car->delete();

        return redirect()->route('admin.rentacar.index')
            ->with('success', 'Car Deleted Successfully');
    }

    /**
     * Extract Cloudinary public_id from a full URL.
     */
    private function extractCloudinaryPublicId(string $url): ?string
    {
        try {
            if (preg_match('/\/upload\/v\d+\/(.+)\.[a-zA-Z]+$/', $url, $matches)) {
                return $matches[1];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}