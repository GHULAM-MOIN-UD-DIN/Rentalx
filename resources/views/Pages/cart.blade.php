@extends('layouts.app')

@section('content')


<style>
/* ================================================
   RENTALX PREMIUM CART PAGE - ULTIMATE RESPONSIVE
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --secondary: #f97316;
    --dark: #030712;
    --darker: #000000;
    --bg: #0a0a0a;
    --card-bg: rgba(17, 24, 39, 0.7);
    --card-bg-hover: rgba(17, 24, 39, 0.9);
    --border: rgba(255, 255, 255, 0.08);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --accent: #ef4444;
    --accent-dark: #dc2626;
    --success: #10b981;
    --danger: #ef4444;
    --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    --shadow-hover: 0 30px 60px -15px rgba(239, 68, 68, 0.3);
    --nav-height: 80px;
}

/* ===== CONTAINER ===== */
.container-custom {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 clamp(1rem, 5vw, 2rem);
    width: 100%;
}

/* ===== CART HERO SECTION - PREMIUM BACKGROUND UPGRADE ===== */
.cart-hero {
    position: relative;
    min-height: auto;
    background: linear-gradient(135deg, #000000 0%, #0a0a0a 100%);
    overflow: hidden;
    padding: calc(var(--nav-height) + 2rem) 0 4rem;
    width: 100%;
}

.cart-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
    opacity: 0.1;
    filter: grayscale(100%);
    pointer-events: none;
}

.cart-hero::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(239,68,68,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(239,68,68,0.1) 0%, transparent 50%);
    pointer-events: none;
}

/* ===== BREADCRUMB ===== */
.premium-breadcrumb {
    position: relative;
    z-index: 10;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 100px;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.premium-breadcrumb a {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.premium-breadcrumb a:hover {
    color: var(--primary);
}

.premium-breadcrumb i {
    font-size: 0.625rem;
    color: var(--text-muted);
}

.premium-breadcrumb span {
    color: var(--primary);
    font-weight: 600;
}

/* ===== PAGE HEADER ===== */
.page-header {
    position: relative;
    z-index: 10;
    margin-bottom: 3rem;
    text-align: left;
}

.page-header .page-subtitle {
    color: var(--primary);
    font-size: clamp(0.75rem, 2vw, 0.875rem);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4em;
    margin-bottom: 0.75rem;
    display: block;
}

.page-title {
    font-size: clamp(2rem, 8vw, 3.5rem);
    font-weight: 900;
    line-height: 1.1;
    letter-spacing: -0.02em;
    color: white;
}

.page-title span {
    background: linear-gradient(135deg, #ef4444, #f97316);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== GRID LAYOUT ===== */
.cart-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2.5rem;
    align-items: start;
    margin-top: 2rem;
}

@media (max-width: 1024px) {
    .cart-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

/* ===== CART ITEM CARD ===== */
.cart-item-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: clamp(1rem, 3vw, 2rem);
    padding: clamp(1rem, 2.5vw, 1.5rem);
    margin-bottom: 1rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.cart-item-card:hover {
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.cart-item-card .item-flex {
    display: flex;
    gap: clamp(1rem, 3vw, 1.5rem);
    align-items: center;
}

@media (max-width: 640px) {
    .cart-item-card .item-flex {
        flex-direction: column;
        align-items: flex-start;
    }
}

.cart-item-image {
    width: clamp(80px, 15vw, 120px);
    height: clamp(80px, 15vw, 120px);
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem;
    flex-shrink: 0;
}

.cart-item-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.item-info {
    flex: 1;
}

.item-name {
    font-size: clamp(1rem, 2.5vw, 1.25rem);
    font-weight: 800;
    color: white;
    margin-bottom: 0.25rem;
}

.item-category {
    font-size: 0.65rem;
    font-weight: 700;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(239, 68, 68, 0.1);
    padding: 0.2rem 0.6rem;
    border-radius: 100px;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.item-sku {
    font-size: 0.7rem;
    color: var(--text-muted);
    font-family: monospace;
}

/* Price & Quantity Area */
.item-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1rem;
}

@media (max-width: 640px) {
    .item-actions {
        flex-direction: row;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
        padding-top: 1rem;
    }
}

.price-current {
    font-size: clamp(1.25rem, 3vw, 1.5rem);
    font-weight: 900;
    color: var(--primary);
}

.price-old {
    font-size: 0.8rem;
    color: var(--text-muted);
    text-decoration: line-through;
}

/* ===== QUANTITY ===== */
.quantity-controls {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 100px;
    padding: 0.2rem;
}

.quantity-btn {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: white;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn:hover {
    background: var(--primary);
}

.quantity-value {
    min-width: 2.5rem;
    text-align: center;
    font-weight: 700;
    font-size: 0.9rem;
}

/* Action Tags */
.action-btn-group {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

.action-btn {
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 100px;
    padding: 0.4rem 0.9rem;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--text-secondary);
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.action-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

/* ===== ORDER SUMMARY ===== */
.order-summary-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 2rem;
    position: sticky;
    top: 100px;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.summary-total {
    border-top: 1px solid var(--border);
    padding-top: 1.5rem;
    margin-top: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.total-label {
    font-size: 1.1rem;
    font-weight: 800;
    color: white;
}

.total-value {
    font-size: 1.75rem;
    font-weight: 900;
    color: var(--primary);
}

/* Checkout Button */
.checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    border-radius: 100px;
    padding: 1.25rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 2rem;
    transition: all 0.3s;
    text-decoration: none;
}

.checkout-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(239, 68, 68, 0.3);
}

/* Bottom Actions */
.bottom-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
    gap: 1rem;
}

@media (max-width: 640px) {
    .bottom-actions {
        flex-direction: column;
    }
}

.back-link, .clear-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 100px;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s;
}

.back-link {
    background: rgba(255, 255, 255, 0.03);
    color: var(--text-secondary);
    border: 1px solid var(--border);
}

.back-link:hover {
    border-color: var(--primary);
    color: white;
}

.clear-btn {
    background: transparent;
    color: #6b7280;
    border: 1px solid transparent;
    cursor: pointer;
}

.clear-btn:hover {
    color: var(--primary);
}

/* ===== FEATURES ===== */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 6rem;
    padding: 4rem 0;
    border-top: 1px solid var(--border);
}

.feature-item {
    text-align: center;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 1rem;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.25rem;
}

.feature-title {
    font-weight: 800;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.feature-desc {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 6rem 0;
}

.empty-icon {
    font-size: 5rem;
    color: var(--primary);
    margin-bottom: 1.5rem;
}

.empty-title {
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 1rem;
}

.shop-now-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: var(--primary);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 100px;
    font-weight: 800;
    text-decoration: none;
    margin-top: 2rem;
    transition: all 0.3s;
}

.shop-now-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(239, 68, 68, 0.2);
}

/* Ensure navbar visibility */
nav#mainNav {
    background: rgba(0,0,0,0.85) !important;
    backdrop-filter: blur(15px) !important;
    -webkit-backdrop-filter: blur(15px) !important;
    border-bottom: 1px solid rgba(255,255,255,0.05) !important;
}
</style>

<!-- CART HERO SECTION -->
<section class="cart-hero">
    <div class="container-custom">
        
        <!-- Premium Breadcrumb -->
        <nav class="premium-breadcrumb">
            <a href="{{ route('home') }}">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Shopping Cart</span>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <span class="page-subtitle">YOUR COLLECTION</span>
            <h1 class="page-title">
                SHOPPING <span>CART</span>
            </h1>
            <p class="text-gray-400 mt-4 flex items-center gap-2">
                <i class="fa-regular fa-circle-check text-red-500"></i>
                You have <span class="text-white font-bold">{{ $carts->count() }}</span> items to review
            </p>
        </div>

        @if($carts->count() > 0)
        @php $grandTotal = 0; @endphp
        
        <div class="cart-grid">
            <!-- LEFT COLUMN: Cart Items -->
            <div class="cart-items-column">
                @foreach($carts as $cart)
                    @php
                        $total = $cart->product->price * $cart->quantity;
                        $grandTotal += $total;
                    @endphp
                    
                    <div class="cart-item-card" id="cart-item-{{ $cart->id }}">
                        <div class="item-flex">
                            <!-- Product Image -->
                            <div class="cart-item-image">
                                <img src="{{ asset('products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">
                            </div>

                            <!-- Product Details -->
                            <div class="item-info">
                                <span class="item-category">{{ $cart->product->category ?? 'PREMIUM' }}</span>
                                <h3 class="item-name">{{ $cart->product->name }}</h3>
                                <div class="item-sku">SKU: RTLX-{{ str_pad($cart->product->id, 5, '0', STR_PAD_LEFT) }}</div>
                                
                                <div class="action-btn-group">
                                    <button onclick="removeFromCart({{ $cart->id }})" class="action-btn">
                                        <i class="fa-regular fa-trash-can"></i>
                                        Remove
                                    </button>
                                    <form action="{{ route('wishlist.add', $cart->product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="action-btn">
                                            <i class="fa-regular fa-heart"></i>
                                            Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Price & Quantity -->
                            <div class="item-actions">
                                <div class="text-right sm:text-right">
                                    <div class="price-old">Rs {{ number_format($cart->product->price * 1.2) }}</div>
                                    <div class="price-current">Rs {{ number_format($cart->product->price) }}</div>
                                </div>

                                <form action="{{ route('cart.update', $cart->id) }}" method="POST" id="quantity-form-{{ $cart->id }}">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $cart->quantity }}" id="quantity-input-{{ $cart->id }}">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn" onclick="updateQuantity({{ $cart->id }}, -1)">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <span class="quantity-value" id="quantity-display-{{ $cart->id }}">{{ $cart->quantity }}</span>
                                        <button type="button" class="quantity-btn" onclick="updateQuantity({{ $cart->id }}, 1)">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="bottom-actions">
                    <a href="{{ route('product.list') }}" class="back-link">
                        <i class="fa-solid fa-arrow-left"></i>
                        Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="confirmClearCart(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="clear-btn">
                            <i class="fa-regular fa-trash-can"></i>
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary -->
            <div class="summary-column">
                <div class="order-summary-card">
                    <h2 class="summary-title">
                        <i class="fa-solid fa-receipt"></i>
                        Order Summary
                    </h2>
                    
                    <div class="summary-row">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="font-bold">Rs {{ number_format($grandTotal) }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="text-gray-400">Shipping</span>
                        <span class="text-green-500 font-bold">FREE</span>
                    </div>
                    
                    <div class="summary-total">
                        <span class="total-label">Total Amount</span>
                        <span class="total-value">Rs {{ number_format($grandTotal) }}</span>
                    </div>

                    <a href="{{ route('order.checkout') }}" class="checkout-btn">
                        Checkout Now
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <div class="mt-8 text-center">
                        <div class="flex justify-center gap-4 opacity-40 grayscale filter hover:grayscale-0 transition-all">
                            <i class="fa-brands fa-cc-visa text-2xl"></i>
                            <i class="fa-brands fa-cc-mastercard text-2xl"></i>
                            <i class="fa-brands fa-cc-paypal text-2xl"></i>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-4 uppercase tracking-widest">
                            <i class="fa-solid fa-lock mr-1"></i> Secure Encrypted Payment
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- EMPTY CART STATE -->
        <div class="empty-cart">
            <div class="empty-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <h2 class="empty-title">Your Cart is Empty</h2>
            <p class="text-gray-400 max-w-md mx-auto mb-8">
                Looks like you haven't added any luxury items to your collection yet.
            </p>
            <a href="{{ route('product.list') }}" class="shop-now-btn">
                Browse Collection
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        @endif

        <!-- FEATURES GRID -->
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <h4 class="feature-title">Fast Delivery</h4>
                <p class="feature-desc">Next day for select cities</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4 class="feature-title">Secure Payment</h4>
                <p class="feature-desc">100% secure checkout</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <h4 class="feature-title">Easy Returns</h4>
                <p class="feature-desc">30-day return policy</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fa-solid fa-gem"></i></div>
                <h4 class="feature-title">Authentic</h4>
                <p class="feature-desc">Guaranteed original items</p>
            </div>
        </div>

    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function updateQuantity(cartId, change) {
    const displayElement = document.getElementById(`quantity-display-${cartId}`);
    const inputElement = document.getElementById(`quantity-input-${cartId}`);
    const form = document.getElementById(`quantity-form-${cartId}`);
    
    let currentQty = parseInt(displayElement.innerText);
    let newQty = currentQty + change;
    
    // Min/Max validation
    if (newQty < 1 || newQty > 10) return;
    
    // Update display
    displayElement.innerText = newQty;
    inputElement.value = newQty;
    
    // Show loading state
    displayElement.style.opacity = '0.5';
    
    // Submit form
    form.submit();
}

// Remove single item with confirmation
function removeFromCart(cartId) {
    Swal.fire({
        title: 'Remove Item?',
        text: 'Are you sure you want to remove this from your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#1f2937',
        confirmButtonText: 'Yes, remove it',
        cancelButtonText: 'Cancel',
        background: '#0a0a0a',
        color: '#fff',
        backdrop: `rgba(0,0,0,0.8)`
    }).then((result) => {
        if (result.isConfirmed) {
            const row = document.getElementById(`cart-item-${cartId}`);
            if (row) {
                row.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                row.style.transform = 'translateX(50px)';
                row.style.opacity = '0';
            }
            
            // Create and submit a temporary form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/cart/remove/${cartId}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Confirm Clear Cart
function confirmClearCart(event) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: 'Clear All Items?',
        text: 'This will remove everything from your shopping cart.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#1f2937',
        confirmButtonText: 'Clear Everything',
        background: '#0a0a0a',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

// GSAP Animations
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined') {
        gsap.from('.cart-item-card', {
            y: 30,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: "power2.out"
        });
        
        gsap.from('.order-summary-card', {
            x: 30,
            opacity: 0,
            duration: 1,
            delay: 0.3,
            ease: "power2.out"
        });

        gsap.from('.feature-item', {
            y: 20,
            opacity: 0,
            duration: 0.6,
            stagger: 0.1,
            scrollTrigger: {
                trigger: '.features-grid',
                start: 'top 90%'
            }
        });
    }
});
</script>

<!-- SweetAlert Notifications -->
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000,
        background: '#1f2937',
        color: '#fff'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Notice',
        text: '{{ session('error') }}',
        background: '#1f2937',
        color: '#fff',
        confirmButtonColor: '#ef4444'
    });
</script>
@endif

@endsection
