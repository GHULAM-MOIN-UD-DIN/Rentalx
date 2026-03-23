@auth
    @php
        $cartItems = \App\Models\Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();
    @endphp
    
    @if($cartItems->count() > 0)
        @foreach($cartItems as $item)
        <div class="premium-cart-item" id="cart-item-{{ $item->id }}">
            <div class="item-image">
                @if($item->product && $item->product->image && file_exists(public_path('products/' . $item->product->image)))
                    <img src="{{ asset('products/' . $item->product->image) }}" alt="">
                @else
                    <i class="fa-solid fa-box-open text-2xl text-gray-600"></i>
                @endif
            </div>
            <div class="item-details">
                <h4 class="item-title">{{ $item->product->name ?? 'Product' }}</h4>
                <div class="item-meta">
                    <span class="item-quantity">Qty: {{ $item->quantity }}</span>
                    <span><i class="fa-regular fa-clock"></i> In Stock</span>
                </div>
                <div class="item-price">Rs {{ number_format($item->product->price ?? 0) }}</div>
            </div>
            <button onclick="removeFromCart({{ $item->id }})" class="remove-btn" title="Remove">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
        @endforeach
        
        <a href="/cart" class="view-all">
            View all items <i class="fa-solid fa-arrow-right"></i>
        </a>
    @else
        <div class="premium-empty text-center py-8">
            <i class="fa-solid fa-cart-shopping text-4xl text-gray-600 mb-4 opacity-30"></i>
            <h3 class="text-xl font-bold">Your cart is empty</h3>
            <p class="text-sm text-gray-400 mb-6">Looks like you haven't added anything yet</p>
            <a href="/products" class="btn bg-red-600 px-6 py-2 rounded-full text-sm font-bold">Shop Now</a>
        </div>
    @endif
@else
    <div class="premium-empty text-center py-8">
        <i class="fa-regular fa-user text-4xl text-gray-600 mb-4 opacity-30"></i>
        <h3>Please login</h3>
        <p>Login to view your cart items</p>
        <a href="/login" class="btn bg-red-600 px-6 py-2 rounded-full text-sm font-bold">Login</a>
    </div>
@endauth

{{-- Update JS variable for footer if items exist --}}
@auth
    @if(isset($cartItems) && $cartItems->count() > 0)
        <div id="cartSidebarFooterData" class="hidden">
            <div class="total-row">
                <span class="total-label">Subtotal:</span>
                <span class="total-value">Rs {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; })) }}</span>
            </div>
            <a href="order/checkout" class="checkout-btn">
                PROCEED TO CHECKOUT <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    @endif
@endauth
