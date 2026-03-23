@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center pt-32 pb-16 px-4 bg-gradient-to-b from-black to-red-900/10">
    <div class="container mx-auto max-w-2xl">
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[40px] p-8 md:p-12 text-center shadow-2xl relative overflow-hidden group">
            <!-- Decorative Elements -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-red-600/10 rounded-full blur-3xl group-hover:bg-red-600/20 transition-all duration-700"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-red-600/10 rounded-full blur-3xl group-hover:bg-red-600/20 transition-all duration-700"></div>

            <!-- Success Icon -->
            <div class="relative inline-block mb-8">
                <div class="w-32 h-32 bg-green-500/10 rounded-full flex items-center justify-center animate-pulse">
                    <i class="fa-solid fa-circle-check text-7xl text-green-500"></i>
                </div>
                <!-- Sparkles -->
                <i class="fa-solid fa-star absolute -top-2 -right-2 text-yellow-400 animate-bounce text-xl"></i>
                <i class="fa-solid fa-star absolute bottom-0 -left-4 text-yellow-400 animate-bounce text-sm" style="animation-delay: 0.5s"></i>
            </div>

            <h1 class="text-4xl md:text-5xl font-black mb-4 bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">
                Order Placed!
            </h1>
            <p class="text-gray-400 text-lg mb-8">
                Thank you for your purchase. Your order <span class="text-red-500 font-black">#{{ $order->order_number }}</span> has been received and is being processed.
            </p>

            <!-- Order Quick Details -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 mb-10 flex flex-wrap justify-around gap-6 text-left">
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Total Paid</p>
                    <p class="text-xl font-black text-white">Rs. {{ number_format($order->total_amount) }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Payment</p>
                    <p class="text-xl font-black text-white">{{ strtoupper($order->payment_method) }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Status</p>
                    <p class="text-xl font-black text-orange-500">{{ strtoupper($order->status) }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('order.view', $order->id) }}" class="flex-1 bg-white/10 hover:bg-white/20 border border-white/10 px-8 py-4 rounded-2xl font-black transition flex items-center justify-center gap-3">
                    <i class="fa-regular fa-file-lines"></i>
                    VIEW DETAILS
                </a>
                <a href="{{ route('product.list') }}" class="flex-1 bg-red-600 hover:bg-red-700 shadow-lg shadow-red-600/20 px-8 py-4 rounded-2xl font-black text-white transition flex items-center justify-center gap-3">
                    CONTINUE SHOPPING
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <p class="mt-10 text-sm text-gray-500">
                A confirmation email has been sent to {{ Auth::user()->email }}.
            </p>
        </div>
    </div>
</section>
@endsection
