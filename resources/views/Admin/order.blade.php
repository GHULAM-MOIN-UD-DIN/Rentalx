@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX ORDERS MANAGEMENT - ULTRA-PREMIUM STYLES
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --primary-light: #f87171;
    --accent: #f97316;
    --dark: #030712;
    --darker: #000000;
    --card-bg: rgba(17, 24, 39, 0.7);
    --border: rgba(255, 255, 255, 0.05);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
}

/* ===== ANIMATIONS ===== */
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* ===== PAGE CONTAINER ===== */
.page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* ===== PAGE HEADER ===== */
.page-header {
    margin-bottom: 2rem;
    animation: slideInUp 0.6s ease-out;
}

.page-header h1 {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.5rem;
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1.25rem;
    transition: all 0.3s;
    animation: slideInUp 0.5s ease-out;
    animation-fill-mode: both;
    position: relative;
    overflow: hidden;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.2s; }
.stat-card:nth-child(5) { animation-delay: 0.25s; }

.stat-card:hover {
    border-color: var(--border-hover);
    transform: translateY(-3px);
    box-shadow: 0 20px 30px -10px rgba(239, 68, 68, 0.2);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, rgba(239,68,68,0.1), transparent);
    border-radius: 50%;
    transform: translate(20px, -20px);
}

.stat-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stat-trend {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 0.6rem;
    padding: 0.2rem 0.5rem;
    border-radius: 1rem;
}

/* ===== FILTER BAR ===== */
.filter-bar {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1.25rem;
    margin-bottom: 2rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-select {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 2rem 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    cursor: pointer;
    min-width: 140px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-search {
    position: relative;
}

.filter-search input {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: white;
    font-size: 0.875rem;
    width: 250px;
}

.filter-search input:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-search i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
}

/* ===== TABLE CARD ===== */
.table-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    overflow: hidden;
    animation: scaleIn 0.6s ease-out;
}

.table-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-header h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-header h3 i {
    color: var(--primary);
}

.table-header .badge {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--primary);
    padding: 0.35rem 1rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 700;
}

/* ===== TABLE ===== */
.table-responsive {
    overflow-x: auto;
}

.premium-table {
    width: 100%;
    border-collapse: collapse;
}

.premium-table thead tr {
    background: rgba(0, 0, 0, 0.2);
    border-bottom: 1px solid var(--border);
}

.premium-table th {
    padding: 1rem 1.5rem;
    font-size: 0.65rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-align: left;
}

.premium-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: all 0.3s;
}

.premium-table tbody tr:hover {
    background: rgba(239, 68, 68, 0.05);
}

.premium-table td {
    padding: 1rem 1.5rem;
    color: var(--text-primary);
    font-size: 0.875rem;
}

/* Order Info */
.order-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.order-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.order-number {
    font-weight: 700;
    color: white;
    margin-bottom: 0.25rem;
}

.order-items {
    font-size: 0.7rem;
    color: var(--text-muted);
}

/* Customer Info */
.customer-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.customer-avatar {
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 0.6rem;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
}

.customer-name {
    font-weight: 700;
    color: white;
    font-size: 0.875rem;
    margin-bottom: 0.15rem;
}

.customer-email {
    font-size: 0.65rem;
    color: var(--text-muted);
}

/* Product Preview */
.product-preview {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.product-item {
    font-size: 0.75rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.product-item i {
    color: var(--primary);
    font-size: 0.5rem;
}

.more-badge {
    font-size: 0.6rem;
    color: var(--text-muted);
    background: rgba(255,255,255,0.03);
    padding: 0.15rem 0.5rem;
    border-radius: 1rem;
    display: inline-block;
    margin-top: 0.15rem;
}

/* Price */
.price-value {
    font-weight: 900;
    color: white;
    font-size: 1rem;
}

.price-breakdown {
    font-size: 0.6rem;
    color: var(--text-muted);
    margin-top: 0.15rem;
}

/* Payment Badge */
.payment-badge {
    display: inline-block;
    padding: 0.35rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
}

.payment-badge.paid {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: var(--success);
}

.payment-badge.pending {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    color: var(--warning);
}

.payment-badge.failed {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--danger);
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    color: var(--warning);
}

.status-badge.processing {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    color: var(--info);
}

.status-badge.completed {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: var(--success);
}

.status-badge.cancelled {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--danger);
}

/* Date Column */
.date-column {
    display: flex;
    flex-direction: column;
}

.date-main {
    font-weight: 700;
    color: white;
    font-size: 0.8rem;
}

.date-time {
    font-size: 0.65rem;
    color: var(--text-muted);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.action-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    color: var(--text-secondary);
    font-size: 0.7rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.action-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
    transform: translateY(-2px);
}

.action-btn.delete:hover {
    border-color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
}

/* Pagination */
.pagination-wrapper {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: center;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .premium-table {
        min-width: 1000px;
    }
}

@media (max-width: 768px) {
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-search input {
        width: 100%;
    }
    
    .table-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- PAGE CONTAINER -->
<div class="page-container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1>ORDERS <span>MANAGEMENT</span></h1>
        <p>Track, manage and analyze all customer orders in one place</p>
    </div>

    <!-- STATS CARDS -->
    @php
        $totalOrders = $orders->total();
        $pendingCount = $orders->where('status', 'pending')->count();
        $processingCount = $orders->where('status', 'processing')->count();
        $completedCount = $orders->where('status', 'completed')->count();
        $cancelledCount = $orders->where('status', 'cancelled')->count();
        $totalRevenue = $orders->where('status', 'completed')->sum('total_amount');
    @endphp
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: var(--primary);">
                <i class="fa-regular fa-cart-shopping"></i>
            </div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
            <span class="stat-trend" style="background: rgba(239,68,68,0.1); color: var(--primary);">All Time</span>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: var(--warning);">
                <i class="fa-regular fa-clock"></i>
            </div>
            <div class="stat-value">{{ $pendingCount }}</div>
            <div class="stat-label">Pending</div>
            <span class="stat-trend" style="background: rgba(245,158,11,0.1); color: var(--warning);">Awaiting</span>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1); color: var(--info);">
                <i class="fa-regular fa-spinner"></i>
            </div>
            <div class="stat-value">{{ $processingCount }}</div>
            <div class="stat-label">Processing</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: var(--success);">
                <i class="fa-regular fa-circle-check"></i>
            </div>
            <div class="stat-value">{{ $completedCount }}</div>
            <div class="stat-label">Completed</div>
            <span class="stat-trend" style="background: rgba(16,185,129,0.1); color: var(--success);">Rs {{ number_format($totalRevenue) }}</span>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: var(--danger);">
                <i class="fa-regular fa-ban"></i>
            </div>
            <div class="stat-value">{{ $cancelledCount }}</div>
            <div class="stat-label">Cancelled</div>
        </div>
    </div>

    <!-- SUCCESS/ERROR ALERTS -->
    @if(session('success'))
    <div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); border-radius: 1rem; padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem; color: var(--success);">
        <i class="fa-regular fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); border-radius: 1rem; padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem; color: var(--danger);">
        <i class="fa-regular fa-circle-exclamation"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="filter-group">
            <select class="filter-select" id="statusFilter" onchange="filterOrders()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            
            <select class="filter-select" id="paymentFilter" onchange="filterOrders()">
                <option value="">All Payments</option>
                <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="pending" {{ request('payment') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ request('payment') == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
            
            <select class="filter-select" id="dateFilter" onchange="filterOrders()">
                <option value="">All Time</option>
                <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('date') == 'year' ? 'selected' : '' }}>This Year</option>
            </select>
        </div>
        
        <div class="filter-search">
            <i class="fa-regular fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Search order or customer..." value="{{ request('search') }}" onkeyup="if(event.keyCode==13) filterOrders()">
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-header">
            <h3>
                <i class="fa-regular fa-box-open"></i>
                Recent Orders
            </h3>
            <span class="badge">{{ $orders->total() }} Total</span>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Order Details</th>
                        <th>Customer</th>
                        <th>Products</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <div class="order-info">
                                <div class="order-icon">
                                    <i class="fa-regular fa-receipt"></i>
                                </div>
                                <div>
                                    <div class="order-number">{{ $order->order_number ?? 'ORD-'.str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    <div class="order-items">{{ $order->items->count() }} items</div>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="customer-info">
                                <div class="customer-avatar">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="customer-name">{{ $order->user->name }}</div>
                                    <div class="customer-email">{{ $order->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="product-preview">
                                @foreach($order->items->take(2) as $item)
                                    <div class="product-item">
                                        <i class="fa-regular fa-circle"></i>
                                        <span>{{ $item->product_name ?? 'Product' }} x{{ $item->quantity }}</span>
                                    </div>
                                @endforeach
                                @if($order->items->count() > 2)
                                    <span class="more-badge">+{{ $order->items->count() - 2 }} more</span>
                                @endif
                            </div>
                        </td>
                        
                        <td>
                            <div class="price-value">Rs {{ number_format($order->total_amount) }}</div>
                            <div class="price-breakdown">
                                @if($order->discount > 0)
                                    <span>-{{ $order->discount }}%</span>
                                @endif
                            </div>
                        </td>
                        
                        <td>
                            @php
                                $paymentClasses = [
                                    'paid' => 'paid',
                                    'pending' => 'pending',
                                    'failed' => 'failed',
                                ];
                                $paymentClass = $paymentClasses[$order->payment_status] ?? 'pending';
                            @endphp
                            <span class="payment-badge {{ $paymentClass }}">
                                {{ ucfirst($order->payment_status ?? 'pending') }}
                            </span>
                        </td>
                        
                        <td>
                            @php
                                $statusClasses = [
                                    'pending' => 'pending',
                                    'processing' => 'processing',
                                    'completed' => 'completed',
                                    'cancelled' => 'cancelled',
                                ];
                                $statusIcons = [
                                    'pending' => 'fa-clock',
                                    'processing' => 'fa-spinner',
                                    'completed' => 'fa-check-circle',
                                    'cancelled' => 'fa-ban',
                                ];
                                $statusClass = $statusClasses[$order->status] ?? 'pending';
                                $statusIcon = $statusIcons[$order->status] ?? 'fa-clock';
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fa-regular {{ $statusIcon }}"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        
                        <td>
                            <div class="date-column">
                                <span class="date-main">{{ $order->created_at->format('d M Y') }}</span>
                                <span class="date-time">{{ $order->created_at->format('h:i A') }}</span>
                            </div>
                        </td>
                        
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action-btn">
                                    <i class="fa-regular fa-eye"></i>
                                    View
                                </a>
                                
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" class="action-btn">
                                            <i class="fa-regular fa-spinner"></i>
                                            Process
                                        </button>
                                    </form>
                                @endif
                                
                                @if($order->status === 'processing')
                                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="action-btn">
                                            <i class="fa-regular fa-check-circle"></i>
                                            Complete
                                        </button>
                                    </form>
                                @endif
                                
                                @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="action-btn delete" onclick="return confirm('Cancel this order?')">
                                            <i class="fa-regular fa-ban"></i>
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" onclick="return confirm('Delete this order?')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 4rem; text-align: center;">
                            <i class="fa-regular fa-box-open" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                            <h3 style="color: white; font-size: 1.25rem; margin-bottom: 0.5rem;">No Orders Found</h3>
                            <p style="color: var(--text-secondary);">Orders will appear here once customers start purchasing</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- PAGINATION -->
        @if($orders->hasPages())
        <div class="pagination-wrapper">
            {{ $orders->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- EXPORT FUNCTION -->
<script>
function filterOrders() {
    const status = document.getElementById('statusFilter').value;
    const payment = document.getElementById('paymentFilter').value;
    const date = document.getElementById('dateFilter').value;
    const search = document.getElementById('searchInput').value;
    
    let url = new URL(window.location.href);
    
    if(status) url.searchParams.set('status', status);
    else url.searchParams.delete('status');
    
    if(payment) url.searchParams.set('payment', payment);
    else url.searchParams.delete('payment');
    
    if(date) url.searchParams.set('date', date);
    else url.searchParams.delete('date');
    
    if(search) url.searchParams.set('search', search);
    else url.searchParams.delete('search');
    
    window.location.href = url.toString();
}

// Export to CSV
function exportOrders() {
    const rows = document.querySelectorAll('.premium-table tbody tr');
    const headers = ['Order', 'Customer', 'Items', 'Total', 'Payment', 'Status', 'Date'];
    
    let csv = headers.join(',') + '\n';
    
    rows.forEach(row => {
        if (row.cells.length < 8) return;
        
        const rowData = [];
        
        // Order number
        const orderNum = row.cells[0]?.querySelector('.order-number')?.textContent || '';
        rowData.push(`"${orderNum}"`);
        
        // Customer
        const customer = row.cells[1]?.querySelector('.customer-name')?.textContent || '';
        rowData.push(`"${customer}"`);
        
        // Items count
        const items = row.cells[0]?.querySelector('.order-items')?.textContent || '';
        rowData.push(`"${items}"`);
        
        // Total
        const total = row.cells[3]?.querySelector('.price-value')?.textContent || '';
        rowData.push(`"${total}"`);
        
        // Payment
        const payment = row.cells[4]?.querySelector('.payment-badge')?.textContent || '';
        rowData.push(`"${payment.trim()}"`);
        
        // Status
        const status = row.cells[5]?.querySelector('.status-badge')?.textContent?.trim() || '';
        rowData.push(`"${status}"`);
        
        // Date
        const date = row.cells[6]?.querySelector('.date-main')?.textContent || '';
        rowData.push(`"${date}"`);
        
        csv += rowData.join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'orders_export.csv';
    a.click();
}

// Enter key for search
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        filterOrders();
    }
});

// Auto-hide alerts
setTimeout(() => {
    document.querySelectorAll('[style*="rgba(16,185,129,0.1)"]').forEach(el => {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 5000);
</script>
@endsection