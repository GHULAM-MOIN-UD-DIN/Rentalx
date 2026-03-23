<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, AdminController, ProductController, PageController, 
    CartController, OrderController, WishlistController, AboutController, 
    ServiceController, ContactController, RentacarController, 
    AppointmentController, ProfileController, ReviewController,
    ChatController, AdminChatController, NotificationController,
    SocialAuthController
};

/* ===============================
    PUBLIC PAGES (No Login Required)
================================ */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/service', [ServiceController::class, 'service'])->name('service');
Route::get('/rentacar', [RentacarController::class, 'rentacar'])->name('rentacar.page');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact.page');


/* ===== PRODUCT PUBLIC ROUTES ===== */
Route::prefix('product')->name('product.')->group(function () {
    Route::get('/', [PageController::class, 'product'])->name('list');
    Route::get('/search', [PageController::class, 'searchSuggestions'])->name('search');
    Route::get('/featured', [PageController::class, 'featuredProducts'])->name('featured');
    Route::get('/{id}', [PageController::class, 'productDetails'])->name('details')->where('id', '[0-9]+');
    Route::get('/{id}/reviews', [ReviewController::class, 'getProductReviews'])->name('reviews_api');
});

/* ===============================
    AUTH ROUTES (Guest Only)
================================ */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/signup', [AuthController::class, 'signupForm'])->name('signup.form');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    
    // OTP & Password Reset
    Route::get('/verify-otp', [AuthController::class, 'otpForm'])->name('otp.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('/forgot-password', [AuthController::class, 'forgotForm'])->name('forgot.form');
    Route::post('/forgot-password', [AuthController::class, 'sendForgotOtp'])->name('forgot.send');
    Route::get('/reset-password', [AuthController::class, 'resetForm'])->name('reset.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');

    // Social Login
    Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.login');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');
});

Route::any('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/* ===============================
    PROTECTED ROUTES (Login Required)
================================ */
Route::middleware('auth')->group(function () {
    
    /* ===== CART ROUTES ===== */
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{cart}', [CartController::class, 'update'])->name('update');
        Route::post('/remove/{cart}', [CartController::class, 'remove'])->name('remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
        Route::get('/count', [CartController::class, 'getCount'])->name('count');
        Route::get('/sidebar-content', [CartController::class, 'getSidebarContent'])->name('sidebar.content');
    });
    
    /* ===== WISHLIST ROUTES ===== */
    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/add/{product}', [WishlistController::class, 'add'])->name('add');
        Route::delete('/remove/{id}', [WishlistController::class, 'remove'])->name('remove');
    });
    
    /* ===== ORDER ROUTES (User Side) ===== */
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/place', [OrderController::class, 'placeOrder'])->name('place');
        Route::get('/success/{id}', [OrderController::class, 'success'])->name('success');
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my-orders');
        Route::get('/view/{id}', [OrderController::class, 'viewOrder'])->name('view');
        Route::post('/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('cancel');
    });
    
    /* ===== CONTACT & APPOINTMENT ===== */
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
    
    Route::prefix('appointment')->name('appointment.')->group(function () {
        Route::get('/', [AppointmentController::class, 'create'])->name('create');
        Route::post('/', [AppointmentController::class, 'store'])->name('store');
        Route::get('/{id}/details', [AppointmentController::class, 'show'])->name('details');
        Route::post('/{id}/cancel', [AppointmentController::class, 'cancel'])->name('cancel');
    });

    /* ===== REVIEWS (User Side) ===== */
    Route::prefix('review')->name('review.')->group(function () {
        Route::get('/create/{product}', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ReviewController::class, 'update'])->name('update');
        Route::delete('/image/{id}', [ReviewController::class, 'deleteImage'])->name('delete-image');
        Route::post('/{id}/helpful', [ReviewController::class, 'markHelpful'])->name('helpful');
    });

    /* ===== CHAT ROUTES (User) ===== */
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('/messages', [ChatController::class, 'fetchMessages'])->name('messages');
        Route::post('/send', [ChatController::class, 'send'])->name('send');
        Route::post('/ping', [ChatController::class, 'ping'])->name('ping');
        Route::post('/offline', [ChatController::class, 'goOffline'])->name('offline');
        Route::get('/unread', [ChatController::class, 'unreadCount'])->name('unread');
    });

    /* ===== PROFILE ROUTES ===== */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('upload.photo');
        Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/appointments', [ProfileController::class, 'appointments'])->name('appointments');
        Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('wishlist');
    });

    /* ===== NOTIFICATION ROUTES ===== */
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
    });
});

/* ===============================
    ADMIN ROUTES (Auth + IsAdmin)
================================ */
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('index');
        Route::get('/{id}', [AdminController::class, 'userDetails'])->name('show');
        Route::post('/{id}/status', [AdminController::class, 'updateUserStatus'])->name('status');
        Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('delete');
    });
    
    // Products (Resource covers index, create, store, show, edit, update, destroy)
    Route::resource('products', ProductController::class);
    Route::post('/products/{id}/update-ratings', [ProductController::class, 'updateAllRatings'])->name('products.update-ratings');
    
    // Orders Management (Pointed to OrderController admin methods)
  // Orders Management (ADMIN ROUTES ke andar ye line replace karo)
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');  // admin.orders.index
    Route::get('/{id}', [OrderController::class, 'show'])->name('show'); // admin.orders.show
    Route::post('/{id}/status', [OrderController::class, 'updateStatus'])->name('status'); // admin.orders.status
    Route::delete('/{id}/delete', [OrderController::class, 'deleteOrder'])->name('delete'); // admin.orders.delete
});
    
    // Rent a Car
    Route::prefix('rentacar')->name('rentacar.')->group(function () {
        Route::get('/', [RentacarController::class, 'index'])->name('index');
        Route::get('/create', [RentacarController::class, 'create'])->name('create');
        Route::post('/store', [RentacarController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RentacarController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [RentacarController::class, 'update'])->name('update');
        Route::delete('/{id}', [RentacarController::class, 'destroy'])->name('delete');
    });
    
    // ============================================
    // CONTACT ROUTES - ADMIN (FIXED POSITION)
    // ============================================
 // Contact Routes - Admin
Route::prefix('contacts')->name('contacts.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');  // contactlist ki jagah index
    Route::get('/{id}', [ContactController::class, 'show'])->name('show');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('delete');
    Route::post('/{id}/reply', [ContactController::class, 'reply'])->name('reply');
});
    
    // Appointments
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AppointmentController::class, 'adminIndex'])->name('index');
        Route::get('/{id}', [AppointmentController::class, 'adminShow'])->name('show');
        Route::patch('/{id}/status', [AppointmentController::class, 'updateStatus'])->name('status');
        Route::delete('/{id}', [AppointmentController::class, 'destroy'])->name('delete');
        Route::get('/export/csv', [AppointmentController::class, 'export'])->name('export');
    });
    
    // Reviews
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'adminIndex'])->name('index');
        Route::get('/pending', [ReviewController::class, 'pendingReviews'])->name('pending');
        Route::post('/{id}/approve', [ReviewController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [ReviewController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('delete');
        Route::post('/bulk-action', [ReviewController::class, 'bulkAction'])->name('bulk');
    });
    
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings/update', [AdminController::class, 'updateSettings'])->name('settings.update');

    /* ===== ADMIN CHAT ROUTES ===== */
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [AdminChatController::class, 'index'])->name('index');
        Route::post('/ping', [AdminChatController::class, 'ping'])->name('ping');
        Route::post('/offline', [AdminChatController::class, 'goOffline'])->name('offline');
        Route::get('/unread-count', [AdminChatController::class, 'totalUnread'])->name('unread');
        Route::get('/{userId}/messages', [AdminChatController::class, 'fetchMessages'])->name('messages');
        Route::post('/{userId}/send', [AdminChatController::class, 'send'])->name('send');
    });
});

/* ===============================
    FALLBACK ROUTE
================================ */
Route::fallback(function () {
    return redirect()->route('home');
});