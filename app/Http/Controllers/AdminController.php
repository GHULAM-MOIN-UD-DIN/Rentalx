<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Appointment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard()
    {
        $now   = Carbon::now();
        $month = $now->month;
        $year  = $now->year;

        // ── Core KPIs ────────────────────────────────────────────────
        $productsCount   = Product::count();
        $usersCount      = User::count();
        $ordersCount     = Order::count();
        $totalRevenue    = Order::where('status', 'completed')->sum('total_amount');
        $pendingOrders   = Order::where('status', 'pending')->count();
        $processingOrders= Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        // ── This-month revenue vs last-month ──────────────────────────
        $thisMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('total_amount');

        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->sum('total_amount');

        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;

        // ── New users this month ──────────────────────────────────────
        $newUsersThisMonth = User::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();

        // ── Reviews ──────────────────────────────────────────────────
        $pendingReviewsCount = Review::where('status', 'pending')->count();
        $approvedReviews = Review::where('status', 'approved')->count();
        $avgRating       = round(Review::where('status', 'approved')->avg('rating') ?? 0, 1);

        // ── Appointments ─────────────────────────────────────────────
        $appointmentsCount    = Appointment::count();
        $pendingAppointments  = Appointment::where('status', 'pending')->count();
        $confirmedAppointments= Appointment::where('status', 'confirmed')->count();
        $todayAppointments    = Appointment::whereDate('pickup_date', $now->toDateString())->count();

        $recentAppointments = Appointment::with('user:id,name')->latest()->take(5)->get();

        // ── Live Chat Inbox (unread messages sent to admin) ───────────
        $adminId = Auth::id();

        // Optimized query to get users with unread messages
        $liveChatUsers = User::whereIn('id', function($query) use ($adminId) {
                $query->select('sender_id')->from('messages')->where('receiver_id', $adminId)->whereNull('read_at')->distinct();
            })
            ->with(['messagesSent' => function($q) use ($adminId) {
                $q->where('receiver_id', $adminId)->whereNull('read_at')->latest();
            }])
            ->take(5)->get();

        $totalUnreadMessages = Message::where('receiver_id', $adminId)->whereNull('read_at')->count();

        $liveChatUsers = $liveChatUsers->map(function ($u) {
            $last = $u->messagesSent->first();
            return [
                'id'       => $u->id,
                'name'     => $u->name,
                'unread'   => $u->messagesSent->count(),
                'message'  => $last?->body ?? '📎 Attachment',
                'time'     => $last?->created_at->diffForHumans() ?? '',
                'is_online'=> $u->is_online ?? false,
            ];
        })->sortByDesc('unread')->values();

        // ── Low stock products ────────────────────────────────────────
        $lowStockProducts = Product::where('stock', '>', 0)->where('stock', '<=', 10)->orderBy('stock')->take(5)->get(['id', 'name', 'stock', 'category']);
        $outOfStockCount  = Product::where('stock', 0)->count();

        // ── Recent 6 orders ───────────────────────────────────────────
        $recentOrders = Order::with('user:id,name')->latest()->take(6)->get();

        // ── Recent pending reviews ────────────────────────────────────
        $recentReviews = Review::with(['user:id,name', 'product:id,name'])->where('status', 'pending')->latest()->take(4)->get();

        // ── Top 5 Products by sold_count ──────────────────────────────
        $topProducts = Product::orderByDesc('sold_count')
            ->take(5)
            ->get(['id', 'name', 'sold_count', 'price', 'category']);

        // ── Monthly revenue last 6 months (for mini-chart) ───────────
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $d = $now->copy()->subMonths($i);
            $monthlyRevenue[] = [
                'label'  => $d->format('M'),
                'amount' => (float) Order::where('status', 'completed')
                    ->whereMonth('created_at', $d->month)
                    ->whereYear('created_at', $d->year)
                    ->sum('total_amount'),
            ];
        }

        return view("Admin.dashboard", compact(
            'productsCount', 'usersCount', 'ordersCount', 'totalRevenue',
            'pendingOrders', 'processingOrders', 'completedOrders', 'cancelledOrders',
            'thisMonthRevenue', 'revenueGrowth', 'newUsersThisMonth',
            'pendingReviewsCount', 'approvedReviews', 'avgRating',
            'appointmentsCount', 'pendingAppointments', 'confirmedAppointments',
            'todayAppointments', 'recentAppointments',
            'totalUnreadMessages', 'liveChatUsers',
            'lowStockProducts', 'outOfStockCount',
            'recentOrders', 'recentReviews', 'topProducts', 'monthlyRevenue'
        ));
    }

    /* ================= USERS LIST ================= */
    public function users()
    {
        // Latest users with pagination
        $users = User::latest()->paginate(10);

        return view("Admin.users", compact("users"));
    }
    
    /* ================= ORDERS LIST ================= */
    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('Admin.order', compact('orders'));
    }

    /* ================= UPDATE ORDER STATUS ================= */
    public function updateStatus(Request $request, Order $order)
    {
        // Validate incoming status
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $currentStatus = $order->status;
        $newStatus = $request->status;

        // Define allowed status transitions
        $allowedTransitions = [
            'pending' => ['processing', 'cancelled'],
            'processing' => ['completed', 'cancelled'],
            'completed' => [], // Cannot change from completed
            'cancelled' => []  // Cannot change from cancelled
        ];

        // Check if transition is allowed
        if (!isset($allowedTransitions[$currentStatus]) || 
            !in_array($newStatus, $allowedTransitions[$currentStatus])) {
            return redirect()->back()->with('error', 'Invalid status transition! Cannot change from ' . ucfirst($currentStatus) . ' to ' . ucfirst($newStatus));
        }

        // Update status
        $order->status = $newStatus;
        $order->updated_at = now();
        $order->save();

        // Success messages based on new status
        $messages = [
            'processing' => 'Order #' . $order->id . ' moved to processing successfully!',
            'completed' => 'Order #' . $order->id . ' completed successfully!',
            'cancelled' => 'Order #' . $order->id . ' cancelled successfully!'
        ];

        return redirect()->back()->with('success', $messages[$newStatus] ?? 'Order status updated successfully!');
    }

    /* ================= DELETE ORDER ================= */
    public function deleteOrder(Order $order)
    {
        try {
            $orderId = $order->id;
            
            // Delete order items first (due to foreign key constraint)
            $order->items()->delete();
            
            // Delete the order
            $order->delete();

            return redirect()->back()->with('success', 'Order #' . $orderId . ' deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order. Error: ' . $e->getMessage());
        }
    }


    /* ================= SETTINGS ================= */
    public function settings()
    {
        return view("Admin.settings");
    }
}