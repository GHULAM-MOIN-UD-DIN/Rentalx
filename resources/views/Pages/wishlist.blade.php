@extends('layouts.app')

@section('content')


<!-- ===== PREMIUM WISHLIST HERO ===== -->
<section class="wishlist-hero relative overflow-hidden">
    <!-- Animated Background -->
    <div class="hero-bg"></div>
    <div class="hero-particles"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="min-h-[50vh] flex items-center justify-center text-center">
            <div class="max-w-3xl hero-content">
                <!-- Premium Badge -->
                <div class="inline-flex items-center gap-2 bg-white/5 backdrop-blur-xl border border-white/10 rounded-full px-4 py-2 mb-6">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-xs tracking-widest text-gray-300">YOUR PERSONAL COLLECTION</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-6xl sm:text-7xl md:text-8xl font-black italic leading-[0.9]">
                    <span class="text-white">THE</span>
                    <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-600">DREAM LIST</span>
                </h1>
                
                <!-- Description -->
                <p class="text-gray-400 text-lg sm:text-xl mt-6 max-w-2xl mx-auto leading-relaxed">
                    Your most desired vehicles, curated in one beautiful space. Ready when you are.
                </p>
                
                <!-- Stats -->
                <div class="flex items-center justify-center gap-4 mt-8">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-heart text-red-500"></i>
                        <span class="text-sm text-gray-400">
                            <span class="text-white font-bold">{{ $wishlists->count() }}</span> items saved
                        </span>
                    </div>
                    <div class="w-1 h-1 bg-gray-600 rounded-full"></div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-clock text-red-400"></i>
                        <span class="text-sm text-gray-400">Last updated today</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
        <span class="text-xs text-gray-600 tracking-widest">SCROLL</span>
        <div class="w-5 h-10 border-2 border-white/20 rounded-full flex justify-center">
            <div class="w-1 h-2 bg-red-500 rounded-full mt-2 animate-scroll"></div>
        </div>
    </div>
</section>

<!-- ===== MAIN WISHLIST SECTION ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-b from-black to-[#070707]">
    <div class="container mx-auto">
        
        @if($wishlists->count() > 0)
            <!-- Results Info -->
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center gap-4">
                    <div class="premium-pulse"></div>
                    <div>
                        <span class="text-sm text-gray-400">Showing</span>
                        <span class="text-2xl font-black text-white mx-2">{{ $wishlists->count() }}</span>
                        <span class="text-sm text-gray-400">saved vehicles</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <button onclick="clearAllWishlist()" class="text-sm text-gray-400 hover:text-red-400 transition flex items-center gap-2">
                        <i class="fa-regular fa-trash-can"></i>
                        Clear all
                    </button>
                    <div class="w-px h-4 bg-white/10"></div>
                    <button class="text-sm text-gray-400 hover:text-red-400 transition flex items-center gap-2">
                        <i class="fa-regular fa-share-from-square"></i>
                        Share list
                    </button>
                </div>
            </div>
            
            <!-- Premium Wishlist Grid -->
            <div class="wishlist-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($wishlists as $item)
                <div class="wishlist-card group" data-id="{{ $item->id }}">
                    <div class="premium-card relative">
                        
                        <!-- Image Container -->
                        <div class="relative h-64 overflow-hidden rounded-t-2xl bg-gradient-to-br from-gray-800 to-gray-900">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.2"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                            </div>
                            
                            <!-- Product Image -->
                            <div class="absolute inset-0 flex items-center justify-center p-6">
                                @if($item->product->image && file_exists(public_path('products/' . $item->product->image)))
                                    <img src="{{ asset('products/' . $item->product->image) }}" alt="{{ $item->product->name }}" 
                                         class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <i class="fa-solid fa-car-side text-7xl text-gray-700"></i>
                                @endif
                            </div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-red-700 rounded-lg text-[10px] font-bold shadow-lg shadow-red-600/30 flex items-center gap-1">
                                    <i class="fa-solid fa-heart text-[8px]"></i>
                                    WISHLIST
                                </span>
                            </div>
                            
                            <!-- Remove Button -->
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="absolute top-4 right-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn w-10 h-10 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-red-600 transition border border-white/10" onclick="return confirmRemove(event)">
                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                </button>
                            </form>
                            
                            <!-- Quick View -->
                            <button onclick="quickView({{ $item->product->id }})" class="absolute bottom-4 right-4 w-10 h-10 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-red-600 transition border border-white/10 opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="p-6">
                            <!-- Category -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-red-400 bg-red-400/10 px-3 py-1 rounded-full">
                                    {{ $item->product->category ?? 'Premium Vehicle' }}
                                </span>
                                <span class="flex items-center gap-1 text-xs text-green-400">
                                    <i class="fa-regular fa-circle-check"></i>
                                    In Stock
                                </span>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="font-black text-xl mb-2 line-clamp-2 group-hover:text-red-400 transition">
                                {{ $item->product->name }}
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-sm text-gray-400 mb-4 line-clamp-2">
                                {{ $item->product->description ?? 'Premium quality vehicle with exceptional performance and luxury features.' }}
                            </p>
                            
                            <!-- Rating -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex gap-0.5">
                                    <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                    <i class="fa-solid fa-star-half-alt text-yellow-500 text-xs"></i>
                                </div>
                                <span class="text-sm font-bold">4.8</span>
                                <span class="text-xs text-gray-500">(128 reviews)</span>
                            </div>
                            
                            <!-- Price -->
                            <div class="flex items-end justify-between mt-auto pt-4 border-t border-white/5">
                                <div>
                                    <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">
                                        Rs {{ number_format($item->product->price) }}
                                    </span>
                                </div>
                                
                                <!-- Add to Cart Form -->
                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="add-to-cart-btn w-12 h-12 rounded-xl bg-gradient-to-r from-red-600 to-red-700 flex items-center justify-center hover:from-red-700 hover:to-red-800 transition shadow-lg shadow-red-600/30">
                                        <i class="fa-solid fa-cart-plus text-sm"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-3 mt-4">
                                <a href="{{ route('product.details', $item->product->id) }}" 
                                   class="flex items-center justify-center gap-2 bg-white/5 border border-white/10 hover:border-red-500 hover:bg-red-500/10 py-3 rounded-xl text-xs font-bold transition">
                                    <i class="fa-regular fa-eye"></i>
                                    VIEW DETAILS
                                </a>
                                <button onclick="shareProduct({{ $item->product->id }})" 
                                        class="flex items-center justify-center gap-2 bg-white/5 border border-white/10 hover:border-red-500 hover:bg-red-500/10 py-3 rounded-xl text-xs font-bold transition">
                                    <i class="fa-regular fa-share-from-square"></i>
                                    SHARE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        @else
            <!-- Premium Empty State -->
            <div class="premium-empty-state text-center py-20 max-w-2xl mx-auto">
                <div class="relative inline-block mb-8">
                    <div class="w-40 h-40 mx-auto bg-gradient-to-br from-red-500/20 to-red-600/20 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-heart text-6xl text-red-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-xl font-bold animate-bounce">0</div>
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-24 h-24 bg-red-500/10 rounded-full blur-2xl"></div>
                </div>
                
                <h2 class="text-4xl sm:text-5xl font-black italic mb-4">
                    YOUR LIST IS <span class="text-red-500">EMPTY</span>
                </h2>
                
                <p class="text-gray-400 text-lg mb-8 max-w-md mx-auto">
                    It looks like you haven't added any vehicles to your wishlist yet. Start exploring our collection and save your favorites!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('product.list') }}" class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 px-8 py-4 rounded-xl text-sm font-bold transition-all shadow-xl shadow-red-600/30">
                        <i class="fa-solid fa-car"></i>
                        EXPLORE FLEET
                    </a>
                    
                    <a href="/fleet" class="inline-flex items-center justify-center gap-3 bg-white/5 border border-white/10 hover:border-red-500 px-8 py-4 rounded-xl text-sm font-bold transition-all">
                        <i class="fa-regular fa-compass"></i>
                        BROWSE CATEGORIES
                    </a>
                </div>
                
                <!-- Featured Suggestion -->
                <div class="mt-16">
                    <p class="text-sm text-gray-500 mb-4">POPULAR CHOICES</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <span class="px-4 py-2 bg-white/5 rounded-full text-xs hover:bg-red-600/20 hover:text-red-400 transition cursor-pointer">Sports Cars</span>
                        <span class="px-4 py-2 bg-white/5 rounded-full text-xs hover:bg-red-600/20 hover:text-red-400 transition cursor-pointer">Luxury SUVs</span>
                        <span class="px-4 py-2 bg-white/5 rounded-full text-xs hover:bg-red-600/20 hover:text-red-400 transition cursor-pointer">Electric Vehicles</span>
                        <span class="px-4 py-2 bg-white/5 rounded-full text-xs hover:bg-red-600/20 hover:text-red-400 transition cursor-pointer">Classic Cars</span>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Recommended Section (Shown only if wishlist has items) -->
        @if($wishlists->count() > 0)
        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-black italic">
                    YOU MAY <span class="text-red-500">ALSO LIKE</span>
                </h2>
                <a href="{{ route('product.list') }}" class="text-sm text-gray-400 hover:text-red-400 transition flex items-center gap-2">
                    View all
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                    $recommended = \App\Models\Product::inRandomOrder()->limit(4)->get();
                @endphp
                
                @foreach($recommended as $rec)
                <div class="recommend-card group">
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden hover:border-red-500/50 transition">
                        <div class="h-40 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center p-4">
                            @if($rec->image)
                                <img src="{{ asset('products/' . $rec->image) }}" alt="" class="max-h-full max-w-full object-contain group-hover:scale-110 transition">
                            @else
                                <i class="fa-solid fa-car-side text-4xl text-gray-700"></i>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-sm mb-1 line-clamp-1">{{ $rec->name }}</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-red-400 font-black text-sm">Rs {{ number_format($rec->price) }}</span>
                                <a href="{{ route('product.details', $rec->id) }}" class="text-xs text-gray-400 hover:text-red-400">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- ===== FEATURES SECTION ===== -->
<section class="py-16 bg-black border-y border-white/5">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="feature-card text-center p-6 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-12 h-12 mx-auto bg-red-600/20 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-heart text-red-500 text-xl"></i>
                </div>
                <h4 class="font-black text-sm mb-1">SAVE FAVORITES</h4>
                <p class="text-xs text-gray-400">Create your dream collection</p>
            </div>
            
            <div class="feature-card text-center p-6 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-12 h-12 mx-auto bg-red-600/20 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-bell text-red-500 text-xl"></i>
                </div>
                <h4 class="font-black text-sm mb-1">PRICE ALERTS</h4>
                <p class="text-xs text-gray-400">Get notified on price drops</p>
            </div>
            
            <div class="feature-card text-center p-6 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-12 h-12 mx-auto bg-red-600/20 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-share-nodes text-red-500 text-xl"></i>
                </div>
                <h4 class="font-black text-sm mb-1">SHARE LIST</h4>
                <p class="text-xs text-gray-400">Share with friends & family</p>
            </div>
            
            <div class="feature-card text-center p-6 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-12 h-12 mx-auto bg-red-600/20 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-clock text-red-500 text-xl"></i>
                </div>
                <h4 class="font-black text-sm mb-1">SYNC ACROSS</h4>
                <p class="text-xs text-gray-400">Access on all devices</p>
            </div>
            
        </div>
    </div>
</section>

<!-- ===== MARQUEE ===== -->
<section class="py-10 overflow-hidden bg-gradient-to-r from-red-600/10 to-transparent border-y border-white/5">
    <div class="marquee-container">
        <div class="marquee-content text-4xl sm:text-6xl font-black italic">
            <span>✦ DREAM IT</span>
            <span>✦ WANT IT</span>
            <span>✦ SAVE IT</span>
            <span>✦ GET IT</span>
            <span>✦ DREAM IT</span>
            <span>✦ WANT IT</span>
            <span>✦ SAVE IT</span>
            <span>✦ GET IT</span>
        </div>
    </div>
</section>

<style>
/* ===== PREMIUM WISHLIST STYLES ===== */
* { font-family: 'Inter', sans-serif; }
body { color: white; overflow-x: hidden; }

/* Hero Section */
.wishlist-hero {
    position: relative;
    min-height: 50vh;
    background: linear-gradient(135deg, #000000 0%, #0a0a0a 100%);
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
    opacity: 0.15;
    filter: grayscale(100%);
}

.hero-particles {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(239,68,68,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(239,68,68,0.1) 0%, transparent 50%);
}

.hero-content {
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Scroll Animation */
@keyframes scroll {
    0% { transform: translateY(0); opacity: 1; }
    75% { transform: translateY(15px); opacity: 0; }
    100% { transform: translateY(0); opacity: 0; }
}

.animate-scroll {
    animation: scroll 2s ease-in-out infinite;
}

/* Premium Pulse */
.premium-pulse {
    width: 12px;
    height: 12px;
    background: #10b981;
    border-radius: 50%;
    position: relative;
    box-shadow: 0 0 20px #10b981;
}

.premium-pulse::before {
    content: '';
    position: absolute;
    inset: -4px;
    border: 2px solid rgba(16,185,129,0.5);
    border-radius: 50%;
    animation: premiumPulse 2s ease-out infinite;
}

@keyframes premiumPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0.4; }
}

/* Premium Cards */
.premium-card {
    background: rgba(17, 24, 39, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 2rem;
    transition: all 0.5s;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.premium-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(239,68,68,0.1), transparent 70%);
    opacity: 0;
    transition: opacity 0.5s;
}

.premium-card:hover {
    border-color: rgba(239,68,68,0.3);
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 30px 60px -15px rgba(239,68,68,0.3);
}

.premium-card:hover::before {
    opacity: 1;
}

/* Remove Button */
.remove-btn {
    transition: all 0.3s;
}
.remove-btn:hover {
    transform: scale(1.1) rotate(90deg);
}

/* Add to Cart Button */
.add-to-cart-btn {
    transition: all 0.3s;
}
.add-to-cart-btn:hover {
    transform: scale(1.1) rotate(360deg);
}

/* Premium Empty State */
.premium-empty-state {
    background: rgba(17, 24, 39, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 3rem;
    padding: 4rem 2rem;
}

/* Marquee */
.marquee-container {
    overflow: hidden;
    mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent);
}

.marquee-content {
    display: inline-flex;
    gap: 2rem;
    white-space: nowrap;
    animation: marqueeScroll 30s linear infinite;
    color: rgba(239,68,68,0.15);
}

@keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Scroll Top */
.scroll-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 100;
    opacity: 0;
    transition: all 0.3s;
    transform: translateY(20px);
    box-shadow: 0 10px 30px -5px rgba(239,68,68,0.5);
    border: 1px solid rgba(255,255,255,0.1);
}

.scroll-top.show {
    opacity: 1;
    transform: translateY(0);
}

.scroll-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px -5px rgba(239,68,68,0.6);
}

/* Responsive */
@media (max-width: 768px) {
    .wishlist-hero {
        min-height: 40vh;
    }
    
    .premium-empty-state {
        border-radius: 2rem;
        padding: 3rem 1rem;
    }
}

.container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
}
</style>

<script>
// GSAP Animations
document.addEventListener('DOMContentLoaded', function() {
    // Hero animations
    gsap.from('.hero-content > *', {
        y: 50,
        opacity: 0,
        duration: 1,
        stagger: 0.2,
        ease: 'power3.out'
    });
    
    // Cards animation
    gsap.from('.wishlist-card', {
        scrollTrigger: {
            trigger: '.wishlist-grid',
            start: 'top 90%'
        },
        y: 40,
        opacity: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.out'
    });
    
    // Features animation
    gsap.from('.feature-card', {
        scrollTrigger: {
            trigger: '.feature-card',
            start: 'top 85%'
        },
        y: 40,
        opacity: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power3.out'
    });
});

// Confirm remove with SweetAlert
function confirmRemove(event) {
    event.preventDefault();
    const form = event.target.closest('form');
    
    Swal.fire({
        title: 'Remove from Wishlist?',
        text: 'This item will be removed from your saved list.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, remove it',
        cancelButtonText: 'Cancel',
        background: '#1f2937',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
}

// Quick View
function quickView(productId) {
    Swal.fire({
        title: 'Quick View',
        html: 'Loading product details...',
        showConfirmButton: false,
        background: '#1f2937',
        color: '#fff',
        didOpen: () => {
            Swal.showLoading();
            // Fetch product details via AJAX
            setTimeout(() => {
                Swal.fire({
                    title: 'Coming Soon',
                    text: 'Quick view feature coming soon!',
                    icon: 'info',
                    confirmButtonColor: '#ef4444',
                    background: '#1f2937',
                    color: '#fff'
                });
            }, 1500);
        }
    });
}

// Share Product
function shareProduct(productId) {
    if (navigator.share) {
        navigator.share({
            title: 'Check out this vehicle',
            text: 'Take a look at this amazing car!',
            url: window.location.origin + '/products/' + productId
        }).catch(console.error);
    } else {
        // Fallback
        navigator.clipboard.writeText(window.location.origin + '/products/' + productId).then(() => {
            Swal.fire({
                title: 'Link Copied!',
                text: 'Product link copied to clipboard',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                background: '#1f2937',
                color: '#fff'
            });
        });
    }
}

// Clear all wishlist
function clearAllWishlist() {
    Swal.fire({
        title: 'Clear Wishlist?',
        text: 'Are you sure you want to remove all items?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, clear all',
        background: '#1f2937',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add your clear all logic here
            Swal.fire({
                title: 'Coming Soon!',
                text: 'This feature will be available soon.',
                icon: 'info',
                confirmButtonColor: '#ef4444',
                background: '#1f2937',
                color: '#fff'
            });
        }
    });
}

// Scroll to top
const scrollTopBtn = document.getElementById('scrollTop');
if(scrollTopBtn) {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });
}
</script>

@endsection