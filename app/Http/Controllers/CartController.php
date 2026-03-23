<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $carts = Cart::where('user_id', Auth::id())
                     ->with('product')
                     ->get();

        return view('Pages.cart', compact('carts'));
    }

    public function add(Request $request, Product $product)
    {
        // 1. Login Check for AJAX and Normal
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Please login to add items!'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        // 2. Quantity Logic
        $qty = $request->input('quantity', 1);

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity', $qty);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $qty
            ]);
        }

        // 3. AJAX Response (No Redirect)
        if ($request->ajax()) {
            $totalCount = Cart::where('user_id', Auth::id())->sum('quantity');
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cartCount' => $totalCount
            ]);
        }

        // 4. Normal Redirect Fallback
        return redirect()->route('cart.index')->with('success', 'Product Added To Cart Successfully');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id != Auth::id()) { abort(403); }
        $request->validate(['quantity' => 'required|integer|min:1|max:100']);
        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart Updated');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id != Auth::id()) { abort(403); }
        $cart->delete();

        if (request()->ajax()) {
            $totalCount = Cart::where('user_id', Auth::id())->sum('quantity');
            return response()->json([
                'success' => true,
                'cartCount' => $totalCount
            ]);
        }
        return back()->with('success', 'Item Removed From Cart');
    }

    public function getSidebarContent(Request $request)
    {
        $html = view('partials.cart-sidebar-items')->render();
        return response()->json(['html' => $html]);
    }
}