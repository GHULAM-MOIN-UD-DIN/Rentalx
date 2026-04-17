<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display profile page.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Create profile if not exists
        if (!$user->profile) {
            $profile = new Profile(['user_id' => $user->id]);
            $user->profile()->save($profile);
            $user->load('profile');
        }
        
        return view('Pages.profile', compact('user'));
    }

    /**
     * Show edit profile form.
     */
    public function edit()
    {
        $user = Auth::user();
        
        if (!$user->profile) {
            $profile = new Profile(['user_id' => $user->id]);
            $user->profile()->save($profile);
            $user->load('profile');
        }
        
        return view('Pages.profile-edit', compact('user'));
    }

    /**
     * Update profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'phone' => ['nullable', 'string', 'max:20'],
            'alternate_phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other', 'prefer_not_to_say'])],
            'address_line1' => ['nullable', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:500'],
            'occupation' => ['nullable', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_twitter' => ['nullable', 'url', 'max:255'],
            'social_instagram' => ['nullable', 'url', 'max:255'],
            'social_linkedin' => ['nullable', 'url', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below.');
        }

        try {
            // Update user name
            $user->name = $request->name;
            $user->save();

            // Save profile
            if (!$profile->exists) {
                $profile->user_id = $user->id;
            }
            
            $profile->fill($request->except(['name', '_token', '_method']));
            $profile->save();

            return redirect()->route('profile.index')
                ->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update profile. ' . $e->getMessage());
        }
    }

    /**
     * Upload profile photo
     */
    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'type' => ['required', Rule::in(['profile', 'cover'])]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
            
            $type = $request->type;
            $field = $type == 'profile' ? 'profile_photo' : 'cover_photo';
            $folder = $type == 'profile' ? 'profiles' : 'covers';
            
            // Create folders if they don't exist
            $publicPath = public_path($folder);
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            
            // Delete old photo if exists
            if ($profile->$field) {
                $oldFilePath = public_path($folder . '/' . $profile->$field);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            
            // Upload new photo
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $type . '_' . time() . '_' . Str::random(10) . '.' . $extension;
            
            $file->move(public_path($folder), $filename);
            
            if (!$profile->exists) {
                $profile->user_id = $user->id;
            }
            
            $profile->$field = $filename;
            $profile->save();
            
            return response()->json([
                'success' => true,
                'message' => ucfirst($type) . ' photo updated successfully!',
                'photo_url' => asset($folder . '/' . $filename)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show account settings.
     */
    public function settings()
    {
        $user = Auth::user()->load('profile');
        // return view('Pages.profile-settings', compact('user'));
        return view('Pages.profile-edit', compact('user'));

    }

    /**
     * Display orders.
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->latest()->paginate(10);
        return view('Pages.profile-orders', compact('user', 'orders'));
    }

    /**
     * Display appointments.
     */
    public function appointments()
    {
        $user = Auth::user();
        $appointments = $user->appointments()->with('car')->latest()->paginate(10);
        return view('Pages.profile-appointments', compact('user', 'appointments'));
    }

    /**
     * Display wishlist.
     */
    public function wishlist()
    {
        $user = Auth::user();
        $wishlists = $user->wishlists()->with('product')->latest()->paginate(12);
        return view('Pages.wishlist', compact('user', 'wishlists'));
    }
}