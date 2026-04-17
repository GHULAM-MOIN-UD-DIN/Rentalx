<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'is_available' => 'nullable|in:0,1'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('car_images'), $imageName);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'is_available' => 'nullable|in:0,1'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image && file_exists(public_path('car_images/' . $car->image))) {
                unlink(public_path('car_images/' . $car->image));
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('car_images'), $imageName);
            $car->image = $imageName;
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
        
        // Delete image if exists
        if ($car->image && file_exists(public_path('car_images/' . $car->image))) {
            unlink(public_path('car_images/' . $car->image));
        }
        
        $car->delete();

        return redirect()->route('admin.rentacar.index')
            ->with('success', 'Car Deleted Successfully');
    }
}