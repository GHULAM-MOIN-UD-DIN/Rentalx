@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="relative h-48 md:h-64 overflow-hidden">
    <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8 container mx-auto">
        <h1 class="text-3xl md:text-4xl font-black flex items-center gap-3">
            <i class="fa-solid fa-box-open text-red-500"></i>
            My Orders
        </h1>
        <p class="text-gray-300 mt-2">Manage and track your product orders</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 sticky top-24">
                <div class="flex items-center gap-4 mb-8">
                    <img src="{{ $user->profile->profile_photo_url }}" alt="Profile" class="w-12 h-12 rounded-xl object-cover border-2 border-red-500/50">
                    <div>
                        <h3 class="font-bold text-sm">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-regular fa-user w-5"></i>
                        Profile Overview
                    </a>
                    <a href="{{ route('profile.orders') }}" class="flex items-center gap-3 p-3 rounded-xl bg-red-600/10 text-red-500 border border-red-500/20 font-bold transition">
                        <i class="fa-solid fa-cart-shopping w-5"></i>
                        My Orders
                    </a>
                    <a href="{{ route('profile.appointments') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-regular fa-calendar-check w-5"></i>
                        Appointments
                    </a>
                    <a href="{{ route('profile.wishlist') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-regular fa-heart w-5"></i>
                        Wishlist
                    </a>
                    <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-solid fa-gear w-5"></i>
                        Settings
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Orders Content -->
        <div class="lg:col-span-3 space-y-6">
            @if($orders->isEmpty())
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-16 text-center">
                <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-bag-shopping text-4xl text-red-500"></i>
                </div>
                <h2 class="text-2xl font-black mb-2">No Orders Found</h2>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">Looks like you haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="{{ route('product.list') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-bold transition inline-flex items-center gap-2">
                    Go Shopping
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            @else
                @foreach($orders as $order)
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden hover:border-red-500/30 transition group">
                    <!-- Order Header -->
                    <div class="p-4 md:p-6 bg-white/5 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap items-center gap-4 md:gap-8">
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Order Number</p>
                                <p class="font-black text-sm text-red-400">{{ $order->order_number }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Placed On</p>
                                <p class="font-bold text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Total Amount</p>
                                <p class="font-black text-sm text-white">Rs. {{ number_format($order->total_amount) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider
                                @if($order->status == 'pending') bg-yellow-500/20 text-yellow-500 border border-yellow-500/20
                                @elseif($order->status == 'processing') bg-blue-500/20 text-blue-500 border border-blue-500/20
                                @elseif($order->status == 'shipped') bg-purple-500/20 text-purple-500 border border-purple-500/20
                                @elseif($order->status == 'delivered') bg-green-500/20 text-green-500 border border-green-500/20
                                @else bg-red-500/20 text-red-500 border border-red-500/20 @endif">
                                {{ $order->status }}
                            </span>
                            <a href="{{ route('order.view', $order->id) }}" class="p-2 bg-white/10 hover:bg-red-600 hover:text-white rounded-lg transition text-gray-400">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Order Items Preview -->
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($order->items->take(2) as $item)
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-white/5 border border-white/10 overflow-hidden flex-shrink-0">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-width-0">
                                    <h4 class="font-bold text-sm truncate">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-400">Qty: {{ $item->quantity }} • Rs. {{ number_format($item->price) }} each</p>
                                </div>
                                @if($order->status == 'delivered')
                                <a href="{{ route('review.create', $item->product->id) }}" class="text-[10px] font-black text-red-400 hover:text-red-300 uppercase tracking-wider">Write Review</a>
                                @endif
                            </div>
                            @endforeach
                            
                            @if($order->items->count() > 2)
                            <p class="text-xs text-gray-500 pl-20">+ {{ $order->items->count() - 2 }} more items</p>
                            @endif
                        </div>
                    </div>

                    <!-- Order Footer -->
                    <div class="px-6 py-4 bg-white/5 border-t border-white/5 flex items-center justify-between">
                        <p class="text-xs text-gray-400">Payment Status: <span class="font-bold {{ $order->payment_status == 'paid' ? 'text-green-500' : 'text-orange-500' }}">{{ ucfirst($order->payment_status) }}</span></p>
                        <div class="flex gap-2">
                            @if($order->status == 'pending')
                            <button onclick="cancelOrder({{ $order->id }})" class="text-xs font-bold text-gray-500 hover:text-red-500 transition">Cancel Order</button>
                            @endif
                            <a href="{{ route('order.view', $order->id) }}" class="text-xs font-bold text-red-400 hover:text-red-300 transition flex items-center gap-1">
                                View Details
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function cancelOrder(orderId) {
    Swal.fire({
        title: 'Cancel Order?',
        text: "Are you sure you want to cancel this order? This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#374151',
        confirmButtonText: 'Yes, cancel it!',
        background: '#111',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/order/cancel/${orderId}`;
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }
    })
}
</script>

<style>
/* Custom Pagination Styles */
.pagination {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}
.page-item .page-link {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #9ca3af;
    padding: 0.5rem 1rem;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}
.page-item.active .page-link {
    background: #ef4444;
    border-color: #ef4444;
    color: white;
}
.page-item:hover .page-link {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.5);
    color: #ef4444;
}
</style>
@endsection
