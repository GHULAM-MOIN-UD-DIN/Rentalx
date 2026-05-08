<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (Render is behind a reverse proxy)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // ═══════════════════════════════════════
        // PERFORMANCE: Share sidebar data once per request
        // Instead of 8+ individual queries in Blade views
        // ═══════════════════════════════════════
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                
                // Single batch of queries instead of 8 scattered ones
                $cartCount = \App\Models\Cart::where('user_id', $userId)->count();
                $orderCount = \App\Models\Order::where('user_id', $userId)->count();
                $pendingOrderCount = \App\Models\Order::where('user_id', $userId)->where('status', 'pending')->count();
                $apptCount = \App\Models\Appointment::where('user_id', $userId)->count();
                $pendingApptCount = \App\Models\Appointment::where('user_id', $userId)->where('status', 'pending')->count();
                $wishlistCount = \App\Models\Wishlist::where('user_id', $userId)->count();
                $unreadNotifs = \App\Models\Notification::where('user_id', $userId)->whereNull('read_at')->count();
                $cartItems = \App\Models\Cart::with('product')->where('user_id', $userId)->latest()->take(3)->get();
                
                // Recent appointments for sidebar
                $recentAppointments = \App\Models\Appointment::where('user_id', $userId)
                    ->latest()
                    ->take(5)
                    ->get();
                
                // Recent orders for sidebar
                $recentOrders = \App\Models\Order::with(['items.product'])
                    ->where('user_id', $userId)
                    ->latest()
                    ->take(5)
                    ->get();
                
                $notifBadgeCount = $pendingOrderCount + $pendingApptCount + $unreadNotifs;
                
                $view->with(compact(
                    'cartCount', 'orderCount', 'pendingOrderCount',
                    'apptCount', 'pendingApptCount', 'wishlistCount',
                    'unreadNotifs', 'cartItems', 'notifBadgeCount',
                    'recentAppointments', 'recentOrders'
                ));
            } else {
                $view->with([
                    'cartCount' => 0, 'orderCount' => 0, 'pendingOrderCount' => 0,
                    'apptCount' => 0, 'pendingApptCount' => 0, 'wishlistCount' => 0,
                    'unreadNotifs' => 0, 'cartItems' => collect([]), 'notifBadgeCount' => 0,
                    'recentAppointments' => collect([]), 'recentOrders' => collect([]),
                ]);
            }
        });
    }
}
