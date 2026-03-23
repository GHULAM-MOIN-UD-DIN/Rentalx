@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="relative h-48 md:h-64 overflow-hidden">
    <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8 container mx-auto">
        <h1 class="text-3xl md:text-4xl font-black flex items-center gap-3">
            <i class="fa-solid fa-receipt text-red-500"></i>
            Order Details
        </h1>
        <p class="text-gray-300 mt-2">Order #{{ $order->order_number }} • Details and Tracking</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Left Side: Order Items and Tracking -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Tracking Stepper -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-8 flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-red-500"></i>
                    Track Order
                </h3>
                
                <div class="relative">
                    @php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                    @endphp
                    
                    <div class="flex justify-between items-start">
                        @foreach($statuses as $index => $status)
                        <div class="flex flex-col items-center flex-1 relative">
                            <!-- Progress Line -->
                            @if($index < count($statuses) - 1)
                            <div class="absolute top-5 left-1/2 w-full h-[2px] 
                                @if($currentIndex > $index) bg-red-600 @else bg-white/10 @endif"></div>
                            @endif
                            
                            <!-- Icon -->
                            <div class="w-10 h-10 rounded-full flex items-center justify-center z-10 
                                @if($currentIndex >= $index) bg-red-600 text-white shadow-[0_0_20px_rgba(239,68,68,0.5)] 
                                @else bg-white/10 text-gray-500 border border-white/10 @endif">
                                @if($status == 'pending') <i class="fa-solid fa-clock-rotate-left"></i>
                                @elseif($status == 'processing') <i class="fa-solid fa-gears"></i>
                                @elseif($status == 'shipped') <i class="fa-solid fa-truck"></i>
                                @elseif($status == 'delivered') <i class="fa-solid fa-house-circle-check"></i> @endif
                            </div>
                            
                            <p class="mt-4 text-[10px] font-black uppercase tracking-wider 
                                @if($currentIndex >= $index) text-white @else text-gray-500 @endif">
                                {{ ucfirst($status) }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <h3 class="font-black flex items-center gap-2">
                        <i class="fa-solid fa-list-ul text-red-500"></i>
                        Order Items
                    </h3>
                </div>
                <div class="divide-y divide-white/10">
                    @foreach($order->items as $item)
                    <div class="p-6 flex items-center gap-6">
                        <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 overflow-hidden flex-shrink-0">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-width-0">
                            <h4 class="font-black text-lg text-white mb-1">{{ $item->product->name }}</h4>
                            <p class="text-xs text-gray-500 mb-2">Category: {{ $item->product->category->name ?? 'N/A' }}</p>
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1 bg-white/5 rounded-lg text-xs text-gray-300">Qty: {{ $item->quantity }}</span>
                                <span class="font-black text-red-500">Rs. {{ number_format($item->price) }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                            <p class="font-black text-white">Rs. {{ number_format($item->price * $item->quantity) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Side: Order Summary and Billing -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Summary Card -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar text-red-500"></i>
                    Order Summary
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="font-bold">Rs. {{ number_format($order->subtotal) }}</span>
                    </div>
                    @if($order->tax > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Tax</span>
                        <span class="font-bold">Rs. {{ number_format($order->tax) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Shipping</span>
                        <span class="font-bold text-green-500">Free</span>
                    </div>
                    @if($order->discount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Discount</span>
                        <span class="font-bold text-red-500">- Rs. {{ number_format($order->discount) }}</span>
                    </div>
                    @endif
                    <div class="pt-4 border-t border-white/10 flex justify-between">
                        <span class="font-black text-lg">Total</span>
                        <span class="font-black text-lg text-red-500">Rs. {{ number_format($order->total_amount) }}</span>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-white/5 rounded-xl border border-white/10">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-credit-card text-red-400"></i>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Payment Method</span>
                    </div>
                    <p class="font-black">{{ strtoupper($order->payment_method) }}</p>
                    <p class="text-xs mt-1 font-bold @if($order->payment_status == 'paid') text-green-500 @else text-orange-500 @endif">
                        {{ strtoupper($order->payment_status) }}
                    </p>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-red-500"></i>
                    Shipping To
                </h3>
                @php $address = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true); @endphp
                <div class="space-y-2">
                    <p class="font-bold text-white">{{ $address['full_name'] ?? $user->name }}</p>
                    <p class="text-sm text-gray-400 leading-relaxed">{{ $address['address'] ?? 'N/A' }}, {{ $address['city'] ?? '' }}</p>
                    <p class="text-sm text-gray-400">{{ $address['phone'] ?? $user->profile->phone }}</p>
                </div>
            </div>

            @if($order->status == 'pending')
            <button onclick="cancelOrder({{ $order->id }})" class="w-full bg-white/5 hover:bg-red-600/20 border border-white/10 hover:border-red-500/50 text-gray-400 hover:text-red-500 py-4 rounded-2xl font-black transition">
                CANCEL ORDER
            </button>
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
@endsection
