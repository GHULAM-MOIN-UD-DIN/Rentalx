<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirectToProvider($provider)
    {
        if ($provider === 'facebook') {
            return Socialite::driver($provider)
                ->scopes(['public_profile']) // removed 'email' temporarily
                ->redirect();
        }
        
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle social provider callback
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Authentication failed or cancelled');
        }

        // Find or create user
        $user = User::where($provider . '_id', $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if ($user) {
            // Update existing user with social ID if missing
            if (!$user->{$provider . '_id'}) {
                $user->update([
                    $provider . '_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar()
                ]);
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Social User',
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(24)),
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'role' => 'user'
            ]);
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Logged in successfully with ' . ucfirst($provider));
    }
}
