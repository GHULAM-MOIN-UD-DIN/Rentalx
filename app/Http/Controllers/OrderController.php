<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Mail\OrderCompleted;

class OrderController extends Controller
{
    // =============================
    // ADMIN SIDE METHODS
    // =============================

    public function index(Request $request)
    {
        $query = Order::with('user', 'items'); // Items bhi load karo
            
        // Filters apply karo
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('payment') && !empty($request->payment)) {
            $query->where('payment_status', $request->payment);
        }
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                                ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Date filters
        if ($request->has('date') && !empty($request->date)) {
            $now = now();
            switch($request->date) {
                case 'today':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', $now->month)
                          ->whereYear('created_at', $now->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', $now->year);
                    break;
            }
        }
        
        $orders = $query->latest()->paginate(10);

        // YAHAN CHANGE KARO - View ka path sahi karo
        // Tumhare folder structure mein Admin/order.blade.php hai
        return view('Admin.order', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'items')->findOrFail($id);
        return view('Admin.order-show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::with('user', 'items')->findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // Send email if order is marked as completed
        if ($order->status === 'completed' && $oldStatus !== 'completed') {
            try {
                Mail::to($order->user->email)->send(new OrderCompleted($order));
            } catch (\Exception $e) {
                Log::error('Order Completion Email Error: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Order status updated successfully.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        
        // Pehle order items delete karo
        OrderItem::where('order_id', $id)->delete();
        
        // Phir order delete karo
        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }

    public function exportOrders()
    {
        $orders = Order::with('user')->get();

        $csvFileName = 'orders_export.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Order ID', 'User', 'Total', 'Status', 'Payment Status']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->user->name ?? 'N/A',
                    $order->total_amount,
                    $order->status,
                    $order->payment_status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =============================
    // USER SIDE METHODS
    // =============================

    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route('product.list')->with('error', 'Your cart is empty!');
        }
        return view('Pages.checkout', compact('carts'));
    }

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:500',
            'city'      => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Please fill all required fields.']);
        }

        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty!']);
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($carts as $cart) {
                $total += $cart->product->price * $cart->quantity;
            }

            $order = Order::create([
                'user_id'          => Auth::id(),
                'total_amount'     => $total,
                'subtotal'         => $total,
                'status'           => 'pending',
                'payment_status'   => 'pending',
                'payment_method'   => 'COD',
                'shipping_address' => json_encode([
                    'full_name' => $request->full_name,
                    'phone'     => $request->phone,
                    'address'   => $request->address,
                    'city'      => $request->city,
                ]),
                'notes'            => $request->notes,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $cart->product->id,
                    'quantity'     => $cart->quantity,
                    'price'        => $cart->product->price,
                    'total'        => $cart->product->price * $cart->quantity,
                    'product_name' => $cart->product->name,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();
            DB::commit();

            // Send Order Confirmation Email
            try {
                Mail::to(Auth::user()->email)->send(new OrderPlaced($order->load('items', 'user')));
            } catch (\Exception $e) {
                Log::error('Order Confirmation Email Error: ' . $e->getMessage());
            }

            return response()->json([
                'success'  => true,
                'order_id' => $order->order_number,
                'message'  => 'Order placed successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Placement Error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Database Error: ' . $e->getMessage()
            ]);
        }
    }

    public function success($id)
    {
        $order = Order::where('order_number', $id)->firstOrFail();
        return view('Pages.order-success', compact('order'));
    }

    public function myOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('items.product')->latest()->paginate(10);
        return view('pages.profile-orders', compact('orders', 'user'));
    }

    public function viewOrder($id)
    {
        $user = Auth::user();
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('pages.order-details', compact('order', 'user'));
    }

    public function cancelOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Order cancelled successfully.');
    }
}