<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show Wishlist
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('pages.wishlist', compact('wishlists'));
    }

    // Add to Wishlist
    public function add($productId)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);

        return back()->with('success', 'Product added to wishlist');
    }

    // Remove from Wishlist
    public function remove($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $wishlist->delete();

        return back()->with('success', 'Removed from wishlist');
    }
}
