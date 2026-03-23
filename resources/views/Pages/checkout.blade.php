@extends('layouts.app')

@section('content')


<style>
/* ================================================
   RENTALX PREMIUM CHECKOUT PAGE - COMPLETELY FIXED
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --secondary: #f97316;
    --dark: #030712;
    --darker: #000000;
    --glass: rgba(255, 255, 255, 0.02);
    --glass-hover: rgba(255, 255, 255, 0.05);
    --border: rgba(255, 255, 255, 0.08);
    --border-hover: rgba(239, 68, 68, 0.3);
    --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    --shadow-hover: 0 30px 60px -15px rgba(239, 68, 68, 0.3);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #0a0a0a;
    color: white;
    font-family: 'Inter', sans-serif;
    overflow-x: hidden;
}

/* ===== CONTAINER FIX ===== */
.container-custom {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
    width: 100%;
}

/* ===== GRID FIXES ===== */
.grid {
    display: grid !important;
    gap: 2rem;
}

.lg\:grid-cols-12 {
    grid-template-columns: repeat(12, minmax(0, 1fr)) !important;
}

.lg\:col-span-7 {
    grid-column: span 7 / span 7 !important;
}

.lg\:col-span-5 {
    grid-column: span 5 / span 5 !important;
}

/* ===== SPACING FIXES ===== */
.space-y-6 > * + * {
    margin-top: 1.5rem !important;
}

.space-y-5 > * + * {
    margin-top: 1.25rem !important;
}

.space-y-2 > * + * {
    margin-top: 0.5rem !important;
}

.space-y-1 > * + * {
    margin-top: 0.25rem !important;
}

/* ===== MARGIN FIXES ===== */
.mb-6 {
    margin-bottom: 1.5rem !important;
}

.mb-4 {
    margin-bottom: 1rem !important;
}

.mt-4 {
    margin-top: 1rem !important;
}

.mt-6 {
    margin-top: 1.5rem !important;
}

.mt-8 {
    margin-top: 2rem !important;
}

/* ===== PADDING FIXES ===== */
.p-4 {
    padding: 1rem !important;
}

.p-6 {
    padding: 1.5rem !important;
}

.p-8 {
    padding: 2rem !important;
}

.px-4 {
    padding-left: 1rem !important;
    padding-right: 1rem !important;
}

.py-4 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

/* ===== VISIBILITY FIXES ===== */
.checkout-card,
.order-summary-card,
.premium-breadcrumb,
.page-header,
.payment-method-card,
.security-badge {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* ===== CUSTOM SCROLLBAR ===== */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
}

::-webkit-scrollbar-thumb {
    background: rgba(239, 68, 68, 0.3);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(239, 68, 68, 0.5);
}

/* ===== ANIMATIONS ===== */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* ===== UTILITY CLASSES ===== */
.gradient-text {
    background: linear-gradient(135deg, #ef4444, #f97316);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.gradient-bg {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/* ===== CHECKOUT HERO SECTION ===== */
.checkout-hero {
    position: relative;
    min-height: auto;
    background: linear-gradient(135deg, #000000 0%, #0a0a0a 100%);
    overflow: hidden;
    padding: 8rem 0 3rem;
    width: 100%;
}

.checkout-hero::before {
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

.checkout-hero::after {
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

/* ===== PREMIUM BREADCRUMB ===== */
.premium-breadcrumb {
    position: relative;
    z-index: 10;
    display: inline-flex !important;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 100px;
    margin-bottom: 2rem;
}

.premium-breadcrumb a {
    color: #9ca3af;
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
    transform: translateX(-2px);
}

.premium-breadcrumb i {
    font-size: 0.625rem;
    color: #4b5563;
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
    width: 100%;
}

.page-header .page-subtitle {
    color: #ef4444;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3em;
    margin-bottom: 0.5rem;
    display: block;
}

.page-title {
    font-size: 3.5rem;
    font-weight: 900;
    line-height: 1.1;
    letter-spacing: -0.02em;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 1rem;
}

.page-title span {
    background: linear-gradient(135deg, #ef4444, #f97316);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== CHECKOUT CARD ===== */
.checkout-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.03);
    border-radius: 2.5rem;
    padding: 2rem;
    transition: all 0.3s ease;
    width: 100%;
}

.checkout-card:hover {
    border-color: #ef4444;
    box-shadow: 0 20px 30px -15px rgba(239,68,68,0.3);
}

/* Step Number */
.step-number {
    width: 3rem;
    height: 3rem;
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ef4444;
    font-weight: 900;
    font-size: 1rem;
    transition: all 0.3s;
    flex-shrink: 0;
}

.checkout-card:hover .step-number {
    background: rgba(239,68,68,0.2);
    transform: scale(1.1);
}

/* Form Inputs */
.form-input-premium {
    width: 100%;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 0.875rem;
    outline: none;
    transition: all 0.3s;
}

.form-input-premium:focus {
    border-color: #ef4444;
    background: rgba(239,68,68,0.04);
    box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
}

.form-input-premium::placeholder {
    color: #4b5563;
}

.form-label {
    display: block;
    font-size: 0.7rem;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
    margin-left: 0.5rem;
}

/* Grid for form inputs */
.grid-cols-2 {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 1rem !important;
}

/* Cart Item in Review */
.cart-review-item {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.03);
    border-radius: 1.5rem;
    padding: 1rem;
    margin-bottom: 0.75rem;
    transition: all 0.3s;
    width: 100%;
}

.cart-review-item:hover {
    border-color: #ef4444;
    background: rgba(239,68,68,0.02);
    transform: translateX(5px);
}

.cart-review-item .flex {
    display: flex !important;
    align-items: center;
    gap: 1rem;
}

.cart-review-item .item-image {
    width: 4rem;
    height: 4rem;
    background: linear-gradient(135deg, #1f2937, #111827);
    border-radius: 1rem;
    padding: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255,255,255,0.05);
    flex-shrink: 0;
}

.cart-review-item .item-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cart-review-item .flex-1 {
    flex: 1 1 0%;
}

.cart-review-item .item-name {
    font-weight: 700;
    color: white;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.cart-review-item .item-qty {
    font-size: 0.7rem;
    color: #9ca3af;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.cart-review-item .item-price {
    font-weight: 900;
    color: #ef4444;
    font-size: 1rem;
    white-space: nowrap;
}

/* ===== ORDER SUMMARY CARD ===== */
.order-summary-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.03);
    border-radius: 2.5rem;
    padding: 2rem;
    position: sticky;
    top: 6rem;
    width: 100%;
}

.order-summary-card:hover {
    border-color: #ef4444;
    box-shadow: 0 20px 30px -15px rgba(239,68,68,0.3);
}

.summary-title {
    font-size: 1.5rem;
    font-weight: 900;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
}

.summary-title span {
    background: rgba(239,68,68,0.1);
    color: #ef4444;
    font-size: 0.7rem;
    padding: 0.25rem 0.75rem;
    border-radius: 100px;
    font-weight: 600;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    width: 100%;
}

.summary-row:last-of-type {
    border-bottom: none;
}

.summary-label {
    color: #9ca3af;
    font-size: 0.95rem;
}

.summary-value {
    font-weight: 700;
    color: white;
}

.summary-value.total {
    font-size: 2rem;
    font-weight: 900;
    color: #ef4444;
}

.summary-value.green {
    color: #10b981;
}

/* Payment Method Card */
.payment-method-card {
    background: rgba(239,68,68,0.05);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 1.5rem;
    padding: 1.25rem;
    display: flex !important;
    align-items: center;
    gap: 1rem;
    margin: 1.5rem 0;
    width: 100%;
}

.payment-icon {
    width: 3rem;
    height: 3rem;
    background: rgba(239,68,68,0.1);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ef4444;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.payment-method-card .payment-title {
    font-weight: 700;
    color: white;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.payment-method-card .payment-desc {
    font-size: 0.7rem;
    color: #9ca3af;
}

/* Confirm Order Button */
.confirm-btn {
    width: 100%;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    border-radius: 100px;
    padding: 1.5rem;
    color: white;
    font-weight: 800;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.3s;
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    position: relative;
    overflow: hidden;
    margin-top: 1.5rem;
    box-shadow: 0 20px 30px -10px rgba(239,68,68,0.3);
}

.confirm-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.confirm-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 30px 40px -15px rgba(239,68,68,0.5);
}

.confirm-btn:hover::before {
    left: 100%;
}

.confirm-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Security Badge */
.security-badge {
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.7rem;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-top: 1.5rem;
    width: 100%;
}

.security-badge i {
    color: #10b981;
}

/* Custom Scrollbar for Cart Items */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.02);
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(239,68,68,0.3);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(239,68,68,0.5);
}

.max-h-[300px] {
    max-height: 300px !important;
    overflow-y: auto !important;
}

/* ===== EMPTY CART STATE ===== */
.empty-state {
    background: rgba(255,255,255,0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.03);
    border-radius: 3rem;
    padding: 5rem 2rem;
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    width: 100%;
}

.empty-state:hover {
    border-color: #ef4444;
}

.empty-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: rgba(239,68,68,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    animation: float 3s ease-in-out infinite;
}

.empty-icon i {
    font-size: 4rem;
    color: #ef4444;
}

.empty-icon::after {
    content: '';
    position: absolute;
    inset: -10px;
    border: 2px solid rgba(239,68,68,0.2);
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

.empty-title {
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, white, #9ca3af);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.empty-text {
    color: #9ca3af;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.shop-btn {
    display: inline-flex !important;
    align-items: center;
    gap: 1rem;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    border-radius: 100px;
    padding: 1.25rem 2.5rem;
    color: white;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 30px -10px rgba(239,68,68,0.3);
}

.shop-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.shop-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 30px 40px -15px rgba(239,68,68,0.5);
}

.shop-btn:hover::before {
    left: 100%;
}

/* ===== RESPONSIVE FIXES ===== */
@media (max-width: 1024px) {
    .lg\:grid-cols-12 {
        grid-template-columns: 1fr !important;
    }
    
    .lg\:col-span-7,
    .lg\:col-span-5 {
        grid-column: span 1 / span 1 !important;
    }
    
    .page-title {
        font-size: 2.5rem;
    }
    
    .order-summary-card {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .checkout-hero {
        padding: 6rem 0 2rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .grid-cols-2 {
        grid-template-columns: 1fr !important;
    }
    
    .summary-value.total {
        font-size: 1.5rem;
    }
    
    .checkout-card {
        padding: 1.5rem;
    }
    
    .order-summary-card {
        padding: 1.5rem;
    }
}

@media (max-width: 640px) {
    .premium-breadcrumb {
        font-size: 0.75rem;
        padding: 0.5rem 1rem;
        flex-wrap: wrap;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .empty-title {
        font-size: 1.5rem;
    }
    
    .cart-review-item .flex {
        flex-wrap: wrap;
    }
    
    .cart-review-item .item-price {
        margin-left: auto;
    }
}
</style>

<!-- CHECKOUT HERO SECTION -->
<section class="checkout-hero">
    <div class="container-custom">
        
        <!-- Premium Breadcrumb -->
        <nav class="premium-breadcrumb">
            <a href="{{ route('home') }}">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ route('cart.index') }}">
                <span>Cart</span>
            </a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="text-red-400">Checkout</span>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <span class="page-subtitle">SECURE CHECKOUT</span>
            <h1 class="page-title">
                COMPLETE <span>YOUR ORDER</span>
            </h1>
            <p class="text-gray-400 mt-4 flex items-center gap-2">
                <i class="fa-regular fa-circle-check text-red-400"></i>
                You're just one step away from your dream drive
            </p>
        </div>

        @if(isset($carts) && count($carts) > 0)
        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- LEFT: Checkout Forms -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Step 1: Review Items -->
                <div class="checkout-card">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="step-number">1</div>
                        <h3 class="text-xl font-bold text-white">Review Your Items</h3>
                    </div>

                    <div class="space-y-2 max-h-[300px] overflow-y-auto custom-scrollbar pr-2">
                        @php $subtotal = 0; @endphp
                        @foreach($carts as $cart)
                            @php 
                                $itemTotal = $cart->product->price * $cart->quantity;
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="cart-review-item">
                                <div class="flex items-center gap-4">
                                    <div class="item-image">
                                        <img src="{{ asset('products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="item-name">{{ $cart->product->name }}</h6>
                                        <p class="item-qty">Qty: {{ $cart->quantity }}</p>
                                    </div>
                                    <div class="item-price">
                                        Rs {{ number_format($itemTotal) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Step 2: Shipping Information -->
                <div class="checkout-card">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="step-number">2</div>
                        <h3 class="text-xl font-bold text-white">Shipping Information</h3>
                    </div>

                    <form id="checkoutForm" class="space-y-5">
                        @csrf
                        
                        <!-- Full Name -->
                        <div>
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-input-premium" placeholder="Muhammad Ali" required>
                        </div>

                        <!-- Phone & City Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Phone Number *</label>
                                <input type="text" name="phone" class="form-input-premium" placeholder="03XX-XXXXXXX" required>
                            </div>
                            <div>
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-input-premium" placeholder="Karachi" required>
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="form-label">Complete Address *</label>
                            <input type="text" name="address" class="form-input-premium" placeholder="House #, Street #, Area" required>
                        </div>

                        <!-- Order Notes -->
                        <div>
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-input-premium resize-none" rows="3" placeholder="Any special instructions for delivery..."></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT: Order Summary -->
            <div class="lg:col-span-5">
                <div class="order-summary-card">
                    <div class="summary-title">
                        Order Summary
                        <span>Verified</span>
                    </div>
                    
                    <div class="space-y-1">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">Rs {{ number_format($subtotal) }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Shipping Fee</span>
                            <span class="summary-value green">FREE</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Tax (Included)</span>
                            <span class="summary-value">Rs 0</span>
                        </div>
                        
                        <div class="summary-row pt-4 mt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <span class="summary-label text-base">Total Payable</span>
                            <span class="summary-value total">Rs {{ number_format($subtotal) }}</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="payment-method-card">
                        <div class="payment-icon">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <div class="payment-title">Cash on Delivery</div>
                            <div class="payment-desc">Pay when your order arrives</div>
                        </div>
                    </div>

                    <!-- Confirm Button -->
                    <button type="button" id="placeOrderBtn" class="confirm-btn">
                        <span id="btnText">CONFIRM ORDER</span>
                        <i class="fa-regular fa-lock"></i>
                    </button>

                    <!-- Security Badge -->
                    <div class="security-badge">
                        <i class="fa-regular fa-circle-check"></i>
                        SECURE CHECKOUT · ENCRYPTED
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- EMPTY CART STATE -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-regular fa-cart-shopping"></i>
            </div>
            <h2 class="empty-title">Your cart is empty</h2>
            <p class="empty-text">
                Please add some items to your cart before proceeding to checkout.
            </p>
            <a href="{{ route('product.list') }}" class="shop-btn">
                <i class="fa-regular fa-compass"></i>
                BROWSE PRODUCTS
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        @endif

    </div>
</section>

<!-- Checkout Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    
    if (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function () {
            const form = document.getElementById('checkoutForm');
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const btn = this;
            const btnText = document.getElementById('btnText');
            btn.disabled = true;
            btnText.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> PROCESSING...';

            const formData = new FormData(form);

            fetch('{{ route("order.place") }}', {
                method: 'POST',
                body: formData,
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(async res => {
                const data = await res.json();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Successful!',
                        html: `Your order <span class="font-bold text-red-400">#${data.order_id}</span> has been placed.`,
                        showCancelButton: true,
                        confirmButtonText: 'VIEW ORDERS',
                        cancelButtonText: 'SHOP MORE',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        background: '#1f2937',
                        color: '#fff',
                        customClass: {
                            popup: 'rounded-3xl',
                            confirmButton: 'rounded-xl px-6 py-3 font-bold',
                            cancelButton: 'rounded-xl px-6 py-3 font-bold'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("profile.orders") }}';
                        } else {
                            window.location.href = '{{ route("product.list") }}';
                        }
                    });
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message,
                    confirmButtonColor: '#ef4444',
                    background: '#1f2937',
                    color: '#fff',
                    customClass: { popup: 'rounded-3xl' }
                });
                btn.disabled = false;
                btnText.innerHTML = 'CONFIRM ORDER';
            });
        });
    }

    // Scroll to top
    const scrollTopBtn = document.getElementById('scrollTop');
    if(scrollTopBtn) {
        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('show', window.scrollY > 400);
        });
    }
});
</script>

<!-- SweetAlert for notifications -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        background: '#1f2937',
        color: '#fff',
        customClass: { popup: 'rounded-3xl' }
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false,
        background: '#1f2937',
        color: '#fff',
        customClass: { popup: 'rounded-3xl' }
    });
</script>
@endif

@endsection