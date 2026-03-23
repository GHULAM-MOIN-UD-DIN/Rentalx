{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'RENTALX') | elite automotive · fully loaded + responsive</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,600;14..32,800;14..32,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body { background: #0a0a0a; overflow-x: hidden; margin: 0; padding: 0; }

        /* ═══════════════════════════════════════
           NAV BASE
           ═══════════════════════════════════════ */
        nav {
            background: transparent;
            transition: background 0.3s, backdrop-filter 0.3s;
        }
        nav.scrolled {
            background: rgba(0,0,0,0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(239,68,68,0.18);
        }

        /* ── Nav Link ── */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
            white-space: nowrap;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: -5px; left: 0;
            background: linear-gradient(90deg, #ef4444, #f97316);
            transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: #ef4444; }
        .nav-link.active { color: #ef4444; }
        .nav-link.active::after { width: 100%; }

        /* ── Nav Icon buttons ── */
        .nav-icon {
            position: relative;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 50%;
            transition: all 0.3s;
            cursor: pointer;
            flex-shrink: 0;
        }
        .nav-icon:hover {
            border-color: #ef4444;
            background: rgba(239,68,68,0.1);
            transform: translateY(-2px);
        }

        /* Mobile nav icon — slightly smaller */
        @media (max-width: 767px) {
            .nav-icon { width: 36px; height: 36px; font-size: 13px; }
        }

        .nav-icon .badge {
            position: absolute;
            top: -5px; right: -5px;
            background: #ef4444;
            color: white;
            font-size: 9px; font-weight: 800;
            width: 17px; height: 17px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid #0a0a0a;
            line-height: 1;
        }

        /* ═══════════════════════════════════════
           HAMBURGER
           ═══════════════════════════════════════ */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 50%;
            width: 40px; height: 40px;
            align-items: center; justify-content: center;
            transition: border-color 0.3s;
            z-index: 1100;
            position: relative;
            flex-shrink: 0;
        }
        .hamburger span {
            display: block;
            width: 18px; height: 2px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s;
        }
        .hamburger.active span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.active span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .hamburger:hover { border-color: #ef4444; }

        @media (max-width: 767px) {
            .hamburger { display: flex; }
            .desktop-nav-links { display: none !important; }
        }
        @media (min-width: 768px) {
            .hamburger { display: none; }
        }


        /* ═══════════════════════════════════════
           SIDEBARS
           ═══════════════════════════════════════ */
        .sidebar {
            position: fixed; top: 0; right: 0;
            height: 100vh;
            width: min(380px, 92vw);
            background: rgba(8,8,8,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255,255,255,0.05);
            transform: translateX(110%);
            transition: transform 0.48s cubic-bezier(0.4,0,0.2,1);
            z-index: 1050;
            padding: 2rem 1.5rem;
            overflow-y: auto;
            box-shadow: -12px 0 40px -10px rgba(239,68,68,0.2);
        }
        .sidebar-open { transform: translateX(0) !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { scrollbar-width: none; }

        .cart-sidebar {
            position: fixed; top: 0; right: 0;
            height: 100vh;
            width: min(420px, 94vw);
            background: rgba(8,8,8,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255,255,255,0.05);
            transform: translateX(110%);
            transition: transform 0.48s cubic-bezier(0.4,0,0.2,1);
            z-index: 1051;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }
        .cart-sidebar.open { transform: translateX(0); }

        .appointment-sidebar {
            position: fixed; top: 0; right: 0;
            height: 100vh;
            width: min(420px, 94vw);
            background: rgba(8,8,8,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255,255,255,0.05);
            transform: translateX(110%);
            transition: transform 0.48s cubic-bezier(0.4,0,0.2,1);
            z-index: 1052;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }
        .appointment-sidebar.open { transform: translateX(0); }

        .orders-sidebar {
            position: fixed; top: 0; right: 0;
            height: 100vh;
            width: min(420px, 94vw);
            background: rgba(8,8,8,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255,255,255,0.05);
            transform: translateX(110%);
            transition: transform 0.48s cubic-bezier(0.4,0,0.2,1);
            z-index: 1053;
            padding: 2rem 1.5rem;
            overflow-y: auto;
        }
        .orders-sidebar.open { transform: translateX(0); }

        /* ── Sidebar Backdrop ── */
        .sidebar-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.72);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 1040;
            opacity: 0; pointer-events: none;
            transition: opacity 0.3s;
        }
        .sidebar-backdrop.active { opacity: 1; pointer-events: all; }

        /* ── Overlay ── */
        .overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 800;
            opacity: 0; pointer-events: none;
            transition: opacity 0.3s;
        }
        .overlay.active { opacity: 1; pointer-events: all; }

        /* ═══════════════════════════════════════
           PREMIUM SIDEBAR COMPONENTS
           ═══════════════════════════════════════ */
        .premium-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid;
            border-image: linear-gradient(90deg,#ef4444,transparent) 1;
        }
        .premium-header h2 {
            font-size: 1.6rem;
            font-weight: 900;
            font-style: italic;
            background: linear-gradient(135deg,#fff,#ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .premium-close {
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 50%;
            color: #ef4444;
            cursor: pointer;
            transition: all 0.3s;
            flex-shrink: 0;
        }
        .premium-close:hover {
            background: #ef4444; color: white;
            transform: rotate(90deg);
        }

        .premium-cart-item {
            display: flex; gap: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg,rgba(255,255,255,0.02),rgba(239,68,68,0.02));
            border: 1px solid rgba(239,68,68,0.1);
            border-radius: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
            position: relative; overflow: hidden;
        }
        .premium-cart-item:hover {
            border-color: #ef4444;
            transform: translateX(-5px);
            box-shadow: 0 10px 20px -10px #ef4444;
        }
        .premium-cart-item .item-image {
            width: 68px; height: 68px;
            border-radius: 0.75rem;
            background: #1a1a1a;
            overflow: hidden;
            border: 1px solid rgba(239,68,68,0.2);
            flex-shrink: 0;
        }
        .premium-cart-item .item-image img { width:100%;height:100%;object-fit:cover; }
        .premium-cart-item .item-title { font-weight:700;font-size:.95rem;color:white;margin-bottom:.25rem; }
        .premium-cart-item .item-price { color:#ef4444;font-weight:800;font-size:1.05rem; }
        .premium-cart-item .remove-btn {
            position:absolute;top:.5rem;right:.5rem;
            width:26px;height:26px;
            background:rgba(239,68,68,0.1);
            border:1px solid rgba(239,68,68,0.2);
            border-radius:50%;color:#ef4444;
            display:flex;align-items:center;justify-content:center;
            font-size:.75rem;cursor:pointer;
            opacity:0;transition:all .3s;
        }
        .premium-cart-item:hover .remove-btn { opacity:1; }
        .premium-cart-item .remove-btn:hover { background:#ef4444;color:white;transform:scale(1.1); }

        .premium-appointment-item, .premium-order-item {
            padding:1rem;
            background:linear-gradient(135deg,rgba(255,255,255,0.02),rgba(239,68,68,0.02));
            border:1px solid rgba(239,68,68,0.1);
            border-radius:1rem;margin-bottom:1rem;transition:all .3s;
        }
        .premium-appointment-item:hover, .premium-order-item:hover {
            border-color:#ef4444;transform:translateY(-3px);
            box-shadow:0 10px 20px -10px #ef4444;
        }

        /* Status pills */
        .appt-status {
            padding:.2rem .6rem;border-radius:1rem;
            font-size:.65rem;font-weight:700;text-transform:uppercase;
        }
        .status-pending   { background:rgba(234,179,8,.15);color:#fbbf24;border:1px solid rgba(234,179,8,.3); }
        .status-confirmed { background:rgba(34,197,94,.15);color:#4ade80;border:1px solid rgba(34,197,94,.3); }
        .status-completed { background:rgba(59,130,246,.15);color:#60a5fa;border:1px solid rgba(59,130,246,.3); }
        .status-cancelled { background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.3); }

        .premium-empty {
            text-align:center;padding:3rem 1rem;
        }
        .premium-empty i { font-size:3.5rem;color:rgba(239,68,68,.18);margin-bottom:1rem;display:block; }
        .premium-empty h3 { font-size:1.25rem;font-weight:800;color:white;margin-bottom:.5rem; }
        .premium-empty p  { color:#666;font-size:.875rem;margin-bottom:1.5rem; }
        .premium-empty .btn {
            display:inline-block;padding:.7rem 2rem;
            background:linear-gradient(135deg,#ef4444,#dc2626);
            border-radius:2rem;color:white;font-weight:600;font-size:.875rem;
            transition:all .3s;
        }
        .premium-empty .btn:hover { transform:scale(1.05);box-shadow:0 10px 20px -5px #ef4444; }

        .premium-footer {
            margin-top:1.5rem;padding-top:1rem;
            border-top:1px solid rgba(239,68,68,.18);
        }
        .premium-footer .total-row { display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem; }
        .premium-footer .total-value { color:#ef4444;font-size:1.2rem;font-weight:800; }
        .premium-footer .checkout-btn {
            display:block;width:100%;padding:1rem;
            background:linear-gradient(135deg,#ef4444,#dc2626);
            border:none;border-radius:.75rem;
            color:white;font-weight:700;text-align:center;cursor:pointer;transition:all .3s;
        }
        .premium-footer .checkout-btn:hover { transform:translateY(-2px);box-shadow:0 10px 20px -5px #ef4444; }
        .view-all {
            display:block;text-align:center;margin-top:1rem;
            color:#ef4444;font-size:.875rem;transition:all .3s;
        }
        .view-all:hover { color:#f97316;transform:translateX(5px); }

        /* ═══════════════════════════════════════
           FOOTER
           ═══════════════════════════════════════ */
        .footer-image-bg {
            background: linear-gradient(0deg,rgba(0,0,0,0.88),rgba(0,0,0,0.72)),
                        url('{{ asset('images/car.png') }}') no-repeat center center/cover;
            background-attachment: fixed;
            border-top: 1px solid rgba(239,68,68,0.18);
        }
        @media (max-width: 768px) {
            .footer-image-bg { background-attachment: scroll; }
        }
        .footer-link { transition:all .2s;display:inline-block; }
        .footer-link:hover { color:#f97316;transform:translateX(5px); }

        /* ═══════════════════════════════════════
           SCROLL TO TOP
           ═══════════════════════════════════════ */
        .scroll-top {
            position: fixed;
            bottom: 1.5rem; right: 1.5rem;
            width: 42px; height: 42px;
            background: #ef4444;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 600;
            opacity: 0; transform: translateY(20px);
            transition: opacity .3s, transform .3s;
        }
        .scroll-top.show { opacity:1;transform:translateY(0); }
        .scroll-top:hover { background:#dc2626;transform:translateY(-3px) !important; }

        .main-content { min-height: calc(100vh - 360px); }
        .container { width:100%;max-width:1280px;margin:0 auto; }

        /* ═══════════════════════════════════════
           GLOBAL RESPONSIVE FIXES
           ═══════════════════════════════════════ */

        /* Prevent horizontal scroll on all pages */
        html, body { overflow-x: hidden; max-width: 100vw; }
        img, video, canvas, iframe { max-width: 100%; }

        /* Very small screens (< 360px) */
        @media (max-width: 360px) {
            nav { padding-left: 12px; padding-right: 12px; }
            .premium-header h2 { font-size: 1.2rem; }
            .sidebar, .cart-sidebar, .appointment-sidebar, .orders-sidebar {
                padding: 1rem;
                width: 100vw;
            }
        }

        /* Phone screens */
        @media (max-width: 480px) {
            /* Footer stacks to 1 column on tiny phones */
            footer .grid { grid-template-columns: 1fr !important; }
            .mobile-menu-link { font-size: clamp(1.3rem, 6vw, 1.8rem); padding: 11px 0; }
        }

        /* Make tables horizontally scrollable (for admin/data-heavy pages) */
        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 0.75rem;
        }
        table { min-width: 600px; }
        @media (max-width: 640px) {
            table { min-width: 500px; }
        }

        /* Section padding – tighter on mobile */
        @media (max-width: 640px) {
            section { padding-left: 1rem; padding-right: 1rem; }
        }

        /* Ensure page content doesn't go behind navbar */
        .main-content { padding-top: 0; }

        /* Product/card grids collapse cleanly */
        @media (max-width: 480px) {
            .grid-cols-2 { grid-template-columns: repeat(2, minmax(0,1fr)); }
        }

        /* Prevent text overflow in cards */
        .truncate-mobile {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ═══════════════════════════════════════
           MOBILE MENU — Full screen overlay (GLOBAL)
           ═══════════════════════════════════════ */
        .mobile-menu {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100vh;
            background: rgba(5,5,5,0.98);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            z-index: 2000 !important;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto;
            overflow-x: hidden;
            gap: 0;
            transform: translateX(-100%);
            transition: transform 0.45s cubic-bezier(0.4,0,0.2,1);
            padding: 70px 24px 40px;
        }
        .mobile-menu.open { transform: translateX(0); }

        /* Close (X) button inside menu */
        .mobile-menu > button:first-child {
            position: absolute !important;
            top: 16px !important; right: 16px !important;
            width: 40px !important; height: 40px !important;
            border: 1px solid rgba(255,255,255,0.15) !important;
            border-radius: 50% !important;
            background: rgba(239,68,68,0.08) !important;
            color: white !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 15px !important;
            transition: all 0.3s !important;
            z-index: 10 !important;
            flex-shrink: 0 !important;
        }
        .mobile-menu > button:first-child:hover {
            background: rgba(239,68,68,0.25) !important;
            transform: rotate(90deg) !important;
        }

        /* Nav links */
        .mobile-menu-link {
            font-size: clamp(1.4rem, 6.5vw, 2.2rem);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            color: white;
            text-decoration: none;
            letter-spacing: 0.07em;
            padding: 10px 0;
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: color 0.25s ease, letter-spacing 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-shrink: 0;
        }
        .mobile-menu-link:hover,
        .mobile-menu-link.mm-active { color: #ef4444; letter-spacing: 0.1em; }

        /* Bottom icons strip */
        .mm-icon-strip {
            display: flex;
            gap: 16px;
            margin-top: 24px;
            padding-bottom: 16px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .mm-icon-strip .nav-icon {
            width: 46px; height: 46px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        .mm-icon-strip .nav-icon:hover {
            background: rgba(239,68,68,0.15);
            border-color: #ef4444;
            color: #ef4444;
            transform: translateY(-4px);
        }

        /* Very small screens (iPhone SE etc) */
        @media (max-height: 680px) {
            .mobile-menu { padding: 60px 20px 20px; }
            .mobile-menu-link { font-size: clamp(1.1rem, 5.5vw, 1.6rem); padding: 8px 0; }
            .mm-icon-strip { margin-top: 16px; }
            .mm-icon-strip .nav-icon { width: 40px; height: 40px; font-size: 0.9rem; }
        }

        /* Responsive typography helpers */
        @media (max-width: 640px) {
            h1 { font-size: clamp(2rem, 10vw, 5rem); }
            h2 { font-size: clamp(1.5rem, 7vw, 3rem); }
        }

        /* Nav gap shrinks on medium screens */
        @media (min-width: 768px) and (max-width: 1024px) {
            .desktop-nav-links { gap: 1rem; font-size: 0.75rem; }
            nav { padding-left: 1.5rem; padding-right: 1.5rem; }
        }
    </style>
    
    @stack('styles')
</head>
<body class="text-white">

    {{-- OVERLAY --}}
    <div class="overlay" id="overlay"></div>

    {{-- SCROLL TO TOP --}}
    <div class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fa-solid fa-chevron-up text-sm"></i>
    </div>

    {{-- SIDEBAR BACKDROP --}}
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    {{-- ════════════════════════════════════════════
         MOBILE FULL-SCREEN MENU
         ════════════════════════════════════════════ --}}
    <div class="mobile-menu" id="mobileMenu">

        {{-- Close X inside menu --}}
        <button onclick="closeMobileMenu()"
                style="position:absolute;top:18px;right:18px;width:42px;height:42px;
                       border:1px solid rgba(255,255,255,0.15);border-radius:50%;
                       background:rgba(239,68,68,0.08);color:white;cursor:pointer;
                       display:flex;align-items:center;justify-content:center;font-size:16px;
                       transition:all 0.3s;">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <a href="{{ route('home') }}"        onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('/') ? 'mm-active':'' }}">HOME</a>
        <a href="{{ route('about') }}"       onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('about') ? 'mm-active':'' }}">ABOUT</a>
        <a href="{{ route('rentacar.page') }}"onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('fleet') ? 'mm-active':'' }}">FLEET</a>
        <a href="{{ route('service') }}"     onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('services') ? 'mm-active':'' }}">SERVICES</a>
        <a href="{{ route('product.list') }}"onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('product') ? 'mm-active':'' }}">PRODUCTS</a>
        <a href="{{ route('contact.page') }}"onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->is('contact') ? 'mm-active':'' }}">CONTACT</a>
        <a href="{{ route('chat.index') }}"  onclick="closeMobileMenu()" class="mobile-menu-link {{ request()->routeIs('chat.*') ? 'mm-active':'' }}">
            <i class="fa-regular fa-comments text-red-400 mr-2" style="-webkit-text-fill-color:#ef4444;"></i>LIVE CHAT
        </a>

        {{-- Mobile menu bottom icon strip --}}
        <div class="mm-icon-strip">
            <button onclick="closeMobileMenu();openCartSidebar()" class="nav-icon" style="background:rgba(255,255,255,0.04);">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="mobileCartBadge" class="badge {{ (\App\Models\Cart::where('user_id', Auth::id())->count() > 0) ? '' : 'hidden' }}">
                    {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                </span>
            </button>
            <button onclick="closeMobileMenu();openAppointmentSidebar()" class="nav-icon" style="background:rgba(255,255,255,0.04);">
                <i class="fa-regular fa-calendar-check"></i>
            </button>
            <button onclick="closeMobileMenu();openOrdersSidebar()" class="nav-icon" style="background:rgba(255,255,255,0.04);">
                <i class="fa-solid fa-box"></i>
            </button>
            <button onclick="closeMobileMenu();openUserSidebar()" class="nav-icon" style="background:rgba(255,255,255,0.04);">
                @auth
                    @if(Auth::user()->profile->profile_photo)
                        <img src="{{ Auth::user()->profile->profile_photo_url }}"
                             class="w-full h-full object-cover rounded-full" alt="">
                    @else
                        <i class="fa-regular fa-user"></i>
                    @endif
                    @php 
                        $notifCount = \App\Models\Order::where('user_id', Auth::id())->where('status','pending')->count()
                            + \App\Models\Appointment::where('user_id', Auth::id())->where('status','pending')->count()
                            + \App\Models\Notification::where('user_id', Auth::id())->whereNull('read_at')->count();
                    @endphp
                    @if($notifCount > 0)
                        <span class="badge">{{ $notifCount }}</span>
                    @endif
                @else
                    <i class="fa-regular fa-user"></i>
                @endauth
            </button>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
         USER SIDEBAR
         ════════════════════════════════════════════ --}}
    <aside id="userSidebar" class="sidebar no-scrollbar">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black italic"><span class="text-red-500">⚡ USER</span> panel</h2>
            <button id="closeSidebar" class="premium-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        
        @auth
            <div class="bg-white/5 p-5 rounded-2xl mb-7 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0 border-2 border-red-500/50 bg-white/5">
                    @if(Auth::user()->profile->profile_photo)
                        <img src="{{ Auth::user()->profile->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-base truncate">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    <div class="mt-1">
                        @if(Auth::user()->role == 'admin')
                            <span class="text-red-400 text-xs bg-red-400/10 px-2 py-0.5 rounded-full">Administrator</span>
                        @else
                            <span class="text-yellow-400 text-xs bg-yellow-400/10 px-2 py-0.5 rounded-full">Member since {{ Auth::user()->created_at->format('Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="space-y-2">
                <a href="{{ route('profile.index') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-user w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">My Profile</span>
                </a>
                <a href="{{ route('profile.orders') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-clipboard w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">My Orders</span>
                    @php $orderCount = \App\Models\Order::where('user_id', Auth::id())->count(); @endphp
                    @if($orderCount > 0)
                        <span class="ml-auto bg-red-600 text-xs px-2 py-0.5 rounded-full">{{ $orderCount }}</span>
                    @endif
                </a>
                <a href="{{ route('profile.appointments') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-calendar w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">Appointments</span>
                    @php $apptCount = \App\Models\Appointment::where('user_id', Auth::id())->count(); @endphp
                    @if($apptCount > 0)
                        <span class="ml-auto bg-blue-600 text-xs px-2 py-0.5 rounded-full">{{ $apptCount }}</span>
                    @endif
                </a>
                <a href="{{ route('profile.wishlist') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-heart w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">Wishlist</span>
                    @php $wishlistCount = \App\Models\Wishlist::where('user_id', Auth::id())->count(); @endphp
                    @if($wishlistCount > 0)
                        <span class="ml-auto bg-pink-600 text-xs px-2 py-0.5 rounded-full">{{ $wishlistCount }}</span>
                    @endif
                </a>
                <a href="/cart" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-solid fa-cart-shopping w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">Cart</span>
                    @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count(); @endphp
                    <span id="sidebarCartBadge" class="ml-auto bg-green-600 text-xs px-2 py-0.5 rounded-full {{ $cartCount > 0 ? '' : 'hidden' }}">{{ $cartCount }}</span>
                </a>
                <a href="{{ route('chat.index') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-comments w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">Support Chat</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition">
                    <i class="fa-regular fa-bell w-5 text-red-400 text-center"></i>
                    <span class="font-medium text-sm">Notifications</span>
                    @php $unreadNotifs = \App\Models\Notification::where('user_id', Auth::id())->whereNull('read_at')->count(); @endphp
                    @if($unreadNotifs > 0)
                        <span class="ml-auto bg-red-600 text-xs px-2 py-0.5 rounded-full animate-pulse">{{ $unreadNotifs }}</span>
                    @endif
                </a>
            </div>

            @if(Auth::user()->role == 'admin')
            <div class="mt-5 p-4 bg-gradient-to-br from-red-600/20 to-red-700/20 rounded-xl border border-red-500/30">
                <a href="/admin/dashboard" class="flex items-center justify-between">
                    <span class="font-bold text-sm"><i class="fa-solid fa-crown mr-2 text-yellow-400"></i>Admin Dashboard</span>
                    <i class="fa-solid fa-arrow-right text-red-400"></i>
                </a>
            </div>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="mt-5">
                @csrf
                <button type="submit" class="w-full border border-red-500/30 text-red-400 hover:bg-red-600 hover:text-white py-3 rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-sign-out-alt"></i> LOGOUT
                </button>
            </form>
        @else
            <div class="text-center py-10">
                <div class="w-20 h-20 mx-auto bg-white/5 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-regular fa-user text-3xl text-gray-500"></i>
                </div>
                <h3 class="font-black text-xl mb-2">Welcome Guest!</h3>
                <p class="text-sm text-gray-400 mb-6">Login to access your account and manage bookings.</p>
                <div class="space-y-3">
                    <a href="/login" class="block w-full border border-white/20 hover:border-red-500 hover:text-red-400 py-3 rounded-xl text-sm font-bold transition text-center">
                        <i class="fa-regular fa-user mr-2"></i>LOGIN
                    </a>
                    <a href="/signup" class="block w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 py-3 rounded-xl text-sm font-bold transition shadow-lg shadow-red-600/30 text-center">
                        <i class="fa-solid fa-user-plus mr-2"></i>SIGN UP
                    </a>
                </div>
            </div>
        @endauth
    </aside>

    {{-- ════════════════════════════════════════════
         CART SIDEBAR
         ════════════════════════════════════════════ --}}
    <aside id="cartSidebar" class="cart-sidebar no-scrollbar">
        <div class="premium-header">
            <h2><i class="fa-solid fa-cart-shopping mr-2" style="-webkit-text-fill-color:#ef4444;"></i>CART</h2>
            <button onclick="closeCartSidebar()" class="premium-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div id="cartSidebarContent" class="space-y-3">
            @include('partials.cart-sidebar-items')
        </div>
        <div id="cartSidebarFooter" class="premium-footer {{ (\App\Models\Cart::where('user_id', Auth::id())->count() > 0) ? '' : 'hidden' }}">
            @auth
                @php
                    $cartItems = \App\Models\Cart::with('product')->where('user_id', Auth::id())->latest()->take(3)->get();
                @endphp
                @if($cartItems->count() > 0)
                    <div class="total-row">
                        <span class="text-gray-400 text-sm">Subtotal:</span>
                        <span class="total-value">Rs {{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity)) }}</span>
                    </div>
                    <a href="order/checkout" class="checkout-btn">
                        PROCEED TO CHECKOUT <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                @endif
            @endauth
        </div>
    </aside>

    {{-- ════════════════════════════════════════════
         APPOINTMENT SIDEBAR
         ════════════════════════════════════════════ --}}
    <aside id="appointmentSidebar" class="appointment-sidebar no-scrollbar">
        <div class="premium-header">
            <h2><i class="fa-regular fa-calendar-check mr-2" style="-webkit-text-fill-color:#ef4444;"></i>BOOKINGS</h2>
            <button onclick="closeAppointmentSidebar()" class="premium-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="space-y-3">
            @auth
                @php $appointments = \App\Models\Appointment::where('user_id', Auth::id())->latest()->take(3)->get(); @endphp
                @if($appointments->count() > 0)
                    @foreach($appointments as $app)
                    <div class="premium-appointment-item">
                        <div class="flex justify-between items-start mb-3">
                            <span class="font-bold text-white text-sm">{{ $app->car_name }}</span>
                            <span class="appt-status status-{{ $app->status }}">{{ strtoupper($app->status) }}</span>
                        </div>
                        <div class="flex gap-4 text-xs text-gray-400 mb-3">
                            <span><i class="fa-regular fa-calendar text-red-400 mr-1"></i>{{ date('d M', strtotime($app->pickup_date)) }}</span>
                            <span><i class="fa-regular fa-calendar-check text-red-400 mr-1"></i>{{ date('d M', strtotime($app->return_date)) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-white/5">
                            <span class="text-xs text-gray-500"><i class="fa-solid fa-location-dot mr-1"></i>{{ $app->delivery_location }}</span>
                            <span class="text-red-400 font-bold text-sm">Rs {{ number_format($app->total_price) }}</span>
                        </div>
                    </div>
                    @endforeach
                    <a href="{{ route('profile.appointments') }}" class="view-all">View all appointments <i class="fa-solid fa-arrow-right"></i></a>
                @else
                    <div class="premium-empty">
                        <i class="fa-regular fa-calendar"></i>
                        <h3>No appointments yet</h3>
                        <p>Book your first ride today</p>
                        <a href="/fleet" class="btn">Browse Fleet</a>
                    </div>
                @endif
            @else
                <div class="premium-empty">
                    <i class="fa-regular fa-user"></i>
                    <h3>Please login</h3>
                    <p>Login to view your appointments</p>
                    <a href="/login" class="btn">Login</a>
                </div>
            @endauth
        </div>
    </aside>

    {{-- ════════════════════════════════════════════
         ORDERS SIDEBAR
         ════════════════════════════════════════════ --}}
    <aside id="ordersSidebar" class="orders-sidebar no-scrollbar">
        <div class="premium-header">
            <h2><i class="fa-solid fa-box mr-2" style="-webkit-text-fill-color:#ef4444;"></i>ORDERS</h2>
            <button onclick="closeOrdersSidebar()" class="premium-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="space-y-3">
            @auth
                @php $orders = \App\Models\Order::with('items.product')->where('user_id', Auth::id())->latest()->take(3)->get(); @endphp
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                    <div class="premium-order-item">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-red-400 font-bold text-xs">#{{ $order->order_number ?? $order->id }}</span>
                            <span class="appt-status status-{{ $order->status }}">{{ strtoupper($order->status) }}</span>
                        </div>
                        <div class="flex gap-1 my-2">
                            @foreach($order->items->take(3) as $item)
                            <div class="w-8 h-8 rounded border border-red-500/20 bg-gray-900 overflow-hidden">
                                @if($item->product && $item->product->image && file_exists(public_path('products/'.$item->product->image)))
                                    <img src="{{ asset('products/'.$item->product->image) }}" class="w-full h-full object-cover" alt="">
                                @endif
                            </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <span class="text-xs text-gray-500 self-center ml-1">+{{ $order->items->count()-3 }}</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-white/5">
                            <span class="text-xs text-gray-500"><i class="fa-regular fa-calendar mr-1"></i>{{ $order->created_at->format('d M Y') }}</span>
                            <span class="text-red-400 font-bold text-sm">Rs {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                    @endforeach
                    <a href="{{ route('profile.orders') }}" class="view-all">View all orders <i class="fa-solid fa-arrow-right"></i></a>
                @else
                    <div class="premium-empty">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>No orders yet</h3>
                        <p>Start shopping today</p>
                        <a href="/products" class="btn">Shop Now</a>
                    </div>
                @endif
            @else
                <div class="premium-empty">
                    <i class="fa-regular fa-user"></i>
                    <h3>Please login</h3>
                    <p>Login to view your orders</p>
                    <a href="/login" class="btn">Login</a>
                </div>
            @endauth
        </div>
    </aside>

    {{-- ════════════════════════════════════════════
         NAVIGATION BAR
         Full responsive: logo (home link) + desktop
         links center + icons right + hamburger mobile
         ════════════════════════════════════════════ --}}
    <nav class="flex justify-between items-center px-4 sm:px-6 md:px-10 lg:px-14 py-4 fixed top-0 w-full z-40 gap-3" id="mainNav">

        {{-- ── LOGO (Always visible, links to home) ── --}}
        <a href="{{ route('home') }}"
           class="flex items-center gap-2 z-50 flex-shrink-0 no-underline group"
           style="text-decoration:none;">
            <i class="fa-solid fa-gem text-red-500 text-2xl sm:text-3xl
                       transition-transform duration-300 group-hover:scale-110 group-hover:rotate-12"></i>
            <span class="text-white text-2xl sm:text-3xl font-black tracking-tight leading-none">
                RENTAL<span class="text-red-500">X</span>
            </span>
        </a>

        {{-- ── DESKTOP CENTER NAV LINKS ── --}}
        <div class="desktop-nav-links hidden md:flex items-center gap-6 lg:gap-8 text-sm font-semibold flex-1 justify-center">
            <a href="{{ route('home') }}"         class="nav-link {{ request()->is('/') ? 'active' : '' }}">HOME</a>
            <a href="{{ route('about') }}"        class="nav-link {{ request()->is('about') ? 'active' : '' }}">ABOUT</a>
            <a href="{{ route('rentacar.page') }}" class="nav-link {{ request()->is('fleet') ? 'active' : '' }}">FLEET</a>
            <a href="{{ route('service') }}"      class="nav-link {{ request()->is('services') ? 'active' : '' }}">SERVICES</a>
            <a href="{{ route('product.list') }}" class="nav-link {{ request()->is('product') ? 'active' : '' }}">PRODUCTS</a>
            <a href="{{ route('contact.page') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">CONTACT</a>
            <a href="{{ route('chat.index') }}"   class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">LIVE CHAT</a>
        </div>

        {{-- ── RIGHT SIDE: Icons + Hamburger ── --}}
        <div class="flex items-center gap-2 z-50 flex-shrink-0">

            {{-- Desktop icons (hidden on mobile) --}}
            <div class="hidden md:flex items-center gap-2">
                {{-- Cart --}}
                <button onclick="openCartSidebar()" class="nav-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    @auth
                        @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count(); @endphp
                        <span id="desktopCartBadge" class="badge {{ $cartCount > 0 ? '' : 'hidden' }}">{{ $cartCount }}</span>
                    @endauth
                </button>
                {{-- Appointments --}}
                <button onclick="openAppointmentSidebar()" class="nav-icon">
                    <i class="fa-regular fa-calendar-check"></i>
                    @auth
                        @php $apptCount = \App\Models\Appointment::where('user_id', Auth::id())->where('status','pending')->count(); @endphp
                        @if($apptCount > 0)<span class="badge">{{ $apptCount }}</span>@endif
                    @endauth
                </button>
                {{-- Orders --}}
                <button onclick="openOrdersSidebar()" class="nav-icon">
                    <i class="fa-solid fa-box"></i>
                    @auth
                        @php $orderCount = \App\Models\Order::where('user_id', Auth::id())->where('status','pending')->count(); @endphp
                        @if($orderCount > 0)<span class="badge">{{ $orderCount }}</span>@endif
                    @endauth
                </button>
                {{-- User --}}
                <button id="sidebarToggle" class="nav-icon overflow-hidden">
                    @auth
                        @if(Auth::user()->profile->profile_photo)
                            <img src="{{ Auth::user()->profile->profile_photo_url }}" class="w-full h-full object-cover rounded-full" alt="">
                        @else
                            <i class="fa-regular fa-user"></i>
                        @endif
                        @php
                            $totalNotifications =
                                \App\Models\Order::where('user_id',Auth::id())->where('status','pending')->count()
                              + \App\Models\Appointment::where('user_id',Auth::id())->where('status','pending')->count()
                              + \App\Models\Notification::where('user_id',Auth::id())->whereNull('read_at')->count();
                        @endphp
                        @if($totalNotifications > 0)<span class="badge">{{ $totalNotifications }}</span>@endif
                    @else
                        <i class="fa-regular fa-user"></i>
                    @endauth
                </button>
            </div>

            {{-- ── MOBILE: compact icon row ── --}}
            {{-- Show cart + user icon + hamburger on mobile --}}
            <div class="flex md:hidden items-center gap-2">
                {{-- Cart icon (mobile) --}}
                <button onclick="openCartSidebar()" class="nav-icon">
                    <i class="fa-solid fa-cart-shopping" style="font-size:12px;"></i>
                    @auth
                        <span id="mobileNavCartBadge" class="badge {{ (\App\Models\Cart::where('user_id',Auth::id())->count() > 0) ? '' : 'hidden' }}">
                            {{ \App\Models\Cart::where('user_id',Auth::id())->count() }}
                        </span>
                    @endauth
                </button>
                {{-- User icon (mobile) --}}
                <button onclick="openUserSidebar()" class="nav-icon overflow-hidden">
                    @auth
                        @if(Auth::user()->profile->profile_photo)
                            <img src="{{ Auth::user()->profile->profile_photo_url }}" class="w-full h-full object-cover rounded-full" alt="">
                        @else
                            <i class="fa-regular fa-user" style="font-size:12px;"></i>
                        @endif
                        @if($totalNotifications > 0)<span class="badge">{{ $totalNotifications }}</span>@endif
                    @else
                        <i class="fa-regular fa-user" style="font-size:12px;"></i>
                    @endauth
                </button>
                {{-- Hamburger --}}
                <div class="hamburger" id="hamburgerBtn">
                    <span></span><span></span><span></span>
                </div>
            </div>

        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-image-bg pt-14 sm:pt-20 pb-8 px-4 sm:px-6 md:px-12">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8 lg:gap-10">
                <div class="sm:col-span-2 lg:col-span-2 footerAnim">
                    <a href="{{ route('home') }}" class="text-3xl sm:text-4xl font-black flex items-center gap-2 no-underline" style="text-decoration:none;">
                        <i class="fa-solid fa-gem text-red-500"></i>
                        <span class="text-white">RENTAL<span class="text-red-500">X</span></span>
                    </a>
                    <p class="text-sm text-gray-300 mt-4 sm:mt-5 leading-relaxed">Not just a rental — it's an experience. Premium vehicles, curated for those who demand thrill.</p>
                    <div class="flex gap-3 sm:gap-4 mt-5 sm:mt-6 flex-wrap">
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition-all hover:scale-110"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition-all hover:scale-110"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition-all hover:scale-110"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition-all hover:scale-110"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition-all hover:scale-110"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="footerAnim">
                    <h4 class="text-base sm:text-lg font-bold mb-4">FLEET</h4>
                    <ul class="space-y-2 sm:space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('rentacar.page') }}" class="footer-link">All Vehicles</a></li>
                        <li><a href="{{ route('product.list') }}" class="footer-link">Buy Parts</a></li>
                        <li><a href="{{ route('rentacar.page') }}" class="footer-link">Premium Rental</a></li>
                    </ul>
                </div>
                <div class="footerAnim">
                    <h4 class="text-base sm:text-lg font-bold mb-4">EXPERIENCE</h4>
                    <ul class="space-y-2 sm:space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('appointment.create') }}" class="footer-link">Book Now</a></li>
                        <li><a href="{{ route('chat.index') }}" class="footer-link">Live Chat</a></li>
                        <li><a href="{{ route('home') }}" class="footer-link">Featured</a></li>
                    </ul>
                </div>
                <div class="footerAnim">
                    <h4 class="text-base sm:text-lg font-bold mb-4">SUPPORT</h4>
                    <ul class="space-y-2 sm:space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('contact.page') }}" class="footer-link">Contact Us</a></li>
                        <li><a href="{{ route('profile.index') }}" class="footer-link">My Profile</a></li>
                        <li><a href="{{ route('notifications.index') }}" class="footer-link">Notifications</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-10 sm:mt-14 pt-6 sm:pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400 footerAnim gap-3">
                <span class="text-center sm:text-left">© {{ date('Y') }} RENTALX — engineered for enthusiasts. all rights reserved.</span>
                <div class="flex gap-4 sm:gap-5">
                    <span><i class="fa-regular fa-credit-card mr-1"></i> Visa · Mastercard</span>
                    <span><i class="fa-regular fa-clock mr-1"></i> 24/7 concierge</span>
                </div>
            </div>
            <p class="text-center text-[10px] text-gray-500 mt-5 sm:mt-6 tracking-widest footerAnim">#RENTALX · DRIVEN BY PERFECTION</p>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script>
    (function () {
        gsap.registerPlugin(ScrollTrigger);

        /* ── Nav scroll ── */
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav?.classList.toggle('scrolled', window.scrollY > 50);
        });

        /* ── Sidebar system ── */
        const backdrop = document.getElementById('sidebarBackdrop');
        const userSidebar  = document.getElementById('userSidebar');
        const cartSidebar  = document.getElementById('cartSidebar');
        const apptSidebar  = document.getElementById('appointmentSidebar');
        const ordSidebar   = document.getElementById('ordersSidebar');

        function closeAllSidebars() {
            userSidebar?.classList.remove('sidebar-open');
            cartSidebar?.classList.remove('open');
            apptSidebar?.classList.remove('open');
            ordSidebar?.classList.remove('open');
            backdrop?.classList.remove('active');
            document.body.style.overflow = '';
        }

        function openSidebar(el, cls) {
            closeAllSidebars();
            el?.classList.add(cls);
            backdrop?.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        window.openUserSidebar        = () => openSidebar(userSidebar, 'sidebar-open');
        window.openCartSidebar        = () => openSidebar(cartSidebar, 'open');
        window.openAppointmentSidebar = () => openSidebar(apptSidebar, 'open');
        window.openOrdersSidebar      = () => openSidebar(ordSidebar,  'open');
        window.closeCartSidebar        = closeAllSidebars;
        window.closeAppointmentSidebar = closeAllSidebars;
        window.closeOrdersSidebar      = closeAllSidebars;

        document.getElementById('sidebarToggle')?.addEventListener('click', (e) => {
            e.stopPropagation();
            window.openUserSidebar();
        });
        document.getElementById('closeSidebar')?.addEventListener('click', closeAllSidebars);
        backdrop?.addEventListener('click', () => { closeAllSidebars(); closeMobileMenu(); });

        /* ── Mobile menu ── */
        const hamburger  = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay    = document.getElementById('overlay');

        function closeMobileMenu() {
            mobileMenu?.classList.remove('open');
            hamburger?.classList.remove('active');
            overlay?.classList.remove('active');
            document.body.style.overflow = '';
        }
        window.closeMobileMenu = closeMobileMenu;

        hamburger?.addEventListener('click', (e) => {
            e.stopPropagation();
            if (mobileMenu?.classList.contains('open')) {
                closeMobileMenu();
            } else {
                closeAllSidebars();
                mobileMenu?.classList.add('open');
                hamburger?.classList.add('active');
                overlay?.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
        overlay?.addEventListener('click', () => { closeMobileMenu(); closeAllSidebars(); });

        /* ── Scroll to top ── */
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollTopBtn?.classList.toggle('show', window.scrollY > 400);
        });

        /* ── GSAP Animations ── */
        window.addEventListener('load', () => {
            gsap.from('nav', { y: -40, opacity: 0, duration: 1.1, clearProps: 'all' });
            const footerEls = document.querySelectorAll('.footerAnim');
            if (footerEls.length) {
                gsap.from(footerEls, {
                    scrollTrigger: { trigger: footerEls[0], start: 'top 85%' },
                    y: 30, opacity: 0, duration: 0.8, stagger: 0.1, clearProps: 'all'
                });
            }
        });
        /* Fallback visibility */
        setTimeout(() => {
            document.querySelectorAll('section, nav, footer').forEach(el => {
                el.style.opacity = '1'; el.style.visibility = 'visible';
            });
        }, 2500);

        /* ── Cart badge updater ── */
        window.updateAllCartBadges = function(count) {
            ['sidebarCartBadge','mobileCartBadge','desktopCartBadge','mobileNavCartBadge'].forEach(id => {
                const badge = document.getElementById(id);
                if (!badge) return;
                badge.innerText = count;
                if (count > 0) {
                    badge.classList.remove('hidden');
                    gsap.fromTo(badge, { scale:0.5, opacity:0 }, { scale:1.2, opacity:1, duration:0.2, yoyo:true, repeat:1, ease:'back.out(2)' });
                } else {
                    badge.classList.add('hidden');
                }
            });
            fetch('{{ route("cart.sidebar.content") }}')
                .then(r => r.json())
                .then(data => {
                    if (data.html) {
                        document.getElementById('cartSidebarContent').innerHTML = data.html;
                        gsap.fromTo('#cartSidebarContent', { opacity:0.7 }, { opacity:1, duration:0.3 });
                        const fd = document.getElementById('cartSidebarFooterData');
                        const footer = document.getElementById('cartSidebarFooter');
                        if (fd && footer) { footer.innerHTML = fd.innerHTML; footer.classList.remove('hidden'); }
                        else if (footer) footer.classList.add('hidden');
                    }
                });
        };

    })();

    /* ── Remove from cart ── */
    function removeFromCart(cartId) {
        Swal.fire({
            title: 'Remove Item?',
            text: 'Remove this item from your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, remove it!',
            background: '#111', color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                const item = document.getElementById(`cart-item-${cartId}`);
                if (item) { item.style.transition='all .3s'; item.style.opacity='0'; item.style.transform='translateX(100px)'; }
                fetch(`/cart/remove/${cartId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        updateAllCartBadges(data.cartCount);
                        Swal.fire({ icon:'success', title:'Removed!', text:'Item removed from cart.', toast:true, position:'top-end', showConfirmButton:false, timer:2000, background:'#1f2937', color:'#fff' });
                    }
                });
            }
        });
    }
    </script>
    
    @stack('scripts')
</body>
</html>