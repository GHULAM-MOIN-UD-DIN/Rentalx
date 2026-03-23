<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RENTALX') · Elite Admin</title>
    
    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    
    <style>
        /* ================================================
           RENTALX ULTRA-PREMIUM ADMIN - CINEMATIC EDITION
           FULLY RESPONSIVE WITH COMPLETE LOADER & TOGGLES
           ================================================ */
        
        :root {
            --primary: #ef4444;
            --primary-dark: #dc2626;
            --primary-light: #f87171;
            --accent: #f97316;
            --dark: #030712;
            --darker: #000000;
            --card-bg: rgba(17, 24, 39, 0.7);
            --card-bg-hover: rgba(17, 24, 39, 0.8);
            --border: rgba(255, 255, 255, 0.05);
            --border-hover: rgba(239, 68, 68, 0.3);
            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-primary: 0 20px 30px -10px rgba(239, 68, 68, 0.3);
            --shadow-primary-lg: 0 25px 50px -12px rgba(239, 68, 68, 0.5);
            --glow: 0 0 20px rgba(239, 68, 68, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--darker);
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
        }

        /* ===== CINEMATIC VIDEO BACKGROUND ===== */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
            filter: brightness(0.4) saturate(1.2) contrast(1.1);
            animation: slowZoom 20s ease-in-out infinite alternate;
        }

        @keyframes slowZoom {
            0% { transform: translateX(-50%) translateY(-50%) scale(1); }
            100% { transform: translateX(-50%) translateY(-50%) scale(1.1); }
        }

        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 50%, rgba(0,0,0,0.5), rgba(0,0,0,0.8));
            z-index: -1;
            pointer-events: none;
        }

        .video-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(239, 68, 68, 0.03) 10px,
                rgba(239, 68, 68, 0.03) 20px
            );
            animation: moveStripes 20s linear infinite;
        }

        @keyframes moveStripes {
            0% { background-position: 0 0; }
            100% { background-position: 40px 40px; }
        }

        /* ===== PREMIUM LOADER WITH BACKGROUND IMAGE ===== */
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.8s;
        }

        .loader-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('public/car_images/1771525776.png') no-repeat center center/cover;
            filter: brightness(0.3) blur(5px);
            transform: scale(1.1);
            animation: slowZoom 20s ease-in-out infinite alternate;
        }

        .loader-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 50%, rgba(0,0,0,0.5), rgba(0,0,0,0.8));
            pointer-events: none;
        }

        .loader-wrapper.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .premium-loader {
            position: relative;
            width: 200px;
            height: 200px;
            z-index: 10;
        }

        @media (max-width: 640px) {
            .premium-loader {
                width: 150px;
                height: 150px;
            }
        }

        .loader-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            border-radius: 50%;
            animation: ringRotate 2s linear infinite;
        }

        .loader-ring:nth-child(1) {
            border-top-color: var(--primary);
            border-bottom-color: var(--accent);
            animation-duration: 2s;
        }

        .loader-ring:nth-child(2) {
            border-left-color: var(--primary);
            border-right-color: var(--accent);
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            animation-direction: reverse;
            animation-duration: 1.5s;
        }

        .loader-ring:nth-child(3) {
            border-top-color: white;
            border-bottom-color: var(--primary);
            width: 60%;
            height: 60%;
            top: 20%;
            left: 20%;
            animation-duration: 1s;
        }

        @keyframes ringRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
        }

        .loader-logo i {
            font-size: 3rem;
            color: var(--primary);
            filter: drop-shadow(0 0 20px var(--primary));
            animation: logoPulse 2s ease-in-out infinite;
        }

        @media (max-width: 640px) {
            .loader-logo i {
                font-size: 2rem;
            }
            
            .loader-logo h2 {
                font-size: 1.2rem;
            }
        }

        .loader-logo h2 {
            font-size: 1.5rem;
            font-weight: 900;
            margin-top: 0.5rem;
            background: linear-gradient(135deg, white, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
        }

        .loader-logo p {
            font-size: 0.6rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-top: 0.5rem;
            animation: textFade 2s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 20px var(--primary)); }
            50% { transform: scale(1.1); filter: drop-shadow(0 0 40px var(--primary)); }
        }

        @keyframes textFade {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .loader-progress {
            position: absolute;
            bottom: -40px;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .loader-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            animation: progressLoad 2.5s ease-out forwards;
        }

        @keyframes progressLoad {
            0% { width: 0%; }
            20% { width: 20%; }
            40% { width: 40%; }
            60% { width: 60%; }
            80% { width: 80%; }
            100% { width: 100%; }
        }

        .loader-count {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        @media (max-width: 640px) {
            .loader-count {
                font-size: 0.7rem;
                bottom: -50px;
            }
        }

        .loader-count span {
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: 900;
            margin-right: 2px;
        }

        /* ===== CUSTOM SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(239, 68, 68, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(239, 68, 68, 0.5);
        }

        /* ===== SIDEBAR ===== */
        .sidebar-premium {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(239, 68, 68, 0.2);
            box-shadow: 10px 0 30px -10px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100vh;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Sidebar Scrollbar */
        .sidebar-premium nav::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-premium nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-premium nav::-webkit-scrollbar-thumb {
            background: rgba(239, 68, 68, 0.1);
            border-radius: 10px;
        }

        .sidebar-premium:hover nav::-webkit-scrollbar-thumb {
            background: rgba(239, 68, 68, 0.3);
        }

        .sidebar-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 0% 0%, rgba(239, 68, 68, 0.15), transparent 70%);
            opacity: 0;
            transition: opacity 0.5s;
            pointer-events: none;
        }

        .sidebar-premium:hover::before {
            opacity: 1;
        }

        .sidebar-premium::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, var(--primary), var(--accent), var(--primary), transparent);
            animation: sidebarGlow 3s ease-in-out infinite;
        }

        @keyframes sidebarGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        /* Responsive Sidebar */
        @media (min-width: 1024px) {
            .sidebar-premium {
                position: relative;
                width: 320px;
            }
            
            .sidebar-premium.sidebar-collapsed {
                width: 100px !important;
            }
        }

        @media (max-width: 1023px) {
            .sidebar-premium {
                position: fixed;
                left: 0;
                top: 0;
                width: 280px;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
            }
            
            .sidebar-premium.mobile-sidebar-show {
                transform: translateX(0);
            }
        }

        @media (max-width: 480px) {
            .sidebar-premium {
                width: 260px;
            }
        }

        /* Collapse States */
        .sidebar-collapsed .nav-item span:not(.icon-only),
        .sidebar-collapsed .brand-text-wrapper,
        .sidebar-collapsed .user-info,
        .sidebar-collapsed .menu-label {
            display: none;
        }

        .sidebar-collapsed .nav-item {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar-collapsed .nav-item i {
            font-size: 1.25rem;
            margin: 0;
        }

        .sidebar-collapsed .p-8 {
            padding: 2rem 0.5rem;
        }

        .sidebar-collapsed .flex.items-center.gap-3 {
            justify-content: center;
        }

        /* ===== HEADER TOGGLE BUTTONS ===== */
        .header-toggle-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            color: #9ca3af;
            transition: all 0.3s;
            cursor: pointer;
        }

        .header-toggle-btn:hover {
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
            transform: scale(1.05);
        }

        .header-toggle-btn:active {
            transform: scale(0.95);
        }

        .sidebar-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 32px;
            height: 32px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            color: #ef4444;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 51;
        }

        .sidebar-close-btn:hover {
            background: #ef4444;
            color: white;
            transform: rotate(90deg);
        }

        @media (max-width: 1023px) {
            .sidebar-close-btn {
                display: flex;
            }
        }

        @media (min-width: 1024px) {
            .header-toggle-btn {
                display: none;
            }
        }

        /* ===== NAV ITEMS ===== */
        .nav-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--text-secondary);
            overflow: hidden;
            animation: slideInRight 0.5s ease-out;
            animation-fill-mode: both;
        }

        .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .nav-item:nth-child(2) { animation-delay: 0.15s; }
        .nav-item:nth-child(3) { animation-delay: 0.2s; }
        .nav-item:nth-child(4) { animation-delay: 0.25s; }
        .nav-item:nth-child(5) { animation-delay: 0.3s; }
        .nav-item:nth-child(6) { animation-delay: 0.35s; }
        .nav-item:nth-child(7) { animation-delay: 0.4s; }
        .nav-item:nth-child(8) { animation-delay: 0.45s; }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 3px;
            height: 0;
            background: var(--primary);
            transform: translateY(-50%);
            transition: height 0.3s;
            border-radius: 0 3px 3px 0;
        }

        .nav-item:hover::before {
            height: 60%;
        }

        .nav-item:hover {
            color: white;
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(5px);
        }

        .nav-item i {
            transition: all 0.3s;
        }

        .nav-item:hover i {
            color: var(--primary);
            transform: scale(1.1);
        }

        .nav-item.active-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white !important;
            box-shadow: var(--shadow-primary-lg);
            position: relative;
            overflow: hidden;
        }

        .nav-item.active-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        .nav-item.active-link i {
            color: white;
        }

        .nav-item.active-link::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shine 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* ===== LOGO ===== */
        .logo-container {
            position: relative;
            overflow: hidden;
        }

        .logo-container::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, var(--primary), transparent, var(--primary));
            border-radius: 12px;
            animation: rotate 4s linear infinite;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .logo-container:hover::before {
            opacity: 1;
        }

        .logo-icon {
            position: relative;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            transition: all 0.3s;
        }

        .logo-icon i {
            transition: all 0.3s;
        }

        .logo-container:hover .logo-icon i {
            transform: scale(1.1) rotate(360deg);
        }

        /* ===== GLASS HEADER ===== */
        .glass-nav {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(239, 68, 68, 0.2);
            position: sticky;
            top: 0;
            z-index: 40;
            height: 70px;
        }

        @media (min-width: 768px) {
            .glass-nav {
                height: 80px;
            }
        }

        .glass-nav::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), var(--accent), var(--primary), transparent);
            animation: borderGlow 3s linear infinite;
            background-size: 200% 100%;
        }

        @keyframes borderGlow {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* ===== SEARCH INPUT ===== */
        .search-input {
            background: rgba(17, 24, 39, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
            background: rgba(17, 24, 39, 0.8);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        @media (max-width: 768px) {
            .search-container {
                display: none;
            }
        }

        /* ===== NOTIFICATION BUTTON ===== */
        .notification-btn {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            color: #9ca3af;
            transition: all 0.3s;
            overflow: visible;
            cursor: pointer;
        }

        .notification-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: radial-gradient(circle at 30% 30%, rgba(239, 68, 68, 0.3), transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .notification-btn:hover::before { opacity: 1; }
        .notification-btn:hover {
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }
        .notification-btn:hover i { animation: bellShake 0.5s ease-in-out; }

        @keyframes bellShake {
            0%, 100% { transform: rotate(0); }
            20% { transform: rotate(15deg); }
            40% { transform: rotate(-15deg); }
            60% { transform: rotate(7deg); }
            80% { transform: rotate(-7deg); }
        }

        .notification-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 18px;
            height: 18px;
            background: #ef4444;
            border-radius: 100px;
            border: 2px solid #000;
            font-size: 8px;
            font-weight: 900;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
            animation: pulse 2s infinite;
            z-index: 10;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
        }

        /* ── Notification Dropdown ── */
        .notif-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: clamp(280px, 90vw, 360px);
            background: rgba(10,10,12,.98);
            border: 1px solid rgba(239,68,68,.2);
            border-radius: 24px;
            box-shadow: 0 30px 60px rgba(0,0,0,.8);
            backdrop-filter: blur(20px);
            z-index: 999;
            display: none;
            overflow: hidden;
        }
        .notif-dropdown.open { display: block; animation: fadeDropdown .25s ease-out; }
        @keyframes fadeDropdown {
            from { opacity:0; transform: translateY(-10px) scale(.97); }
            to   { opacity:1; transform: translateY(0) scale(1); }
        }
        .notif-hdr {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .notif-hdr-title { font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: .2em; color: #fff; }
        .notif-hdr-badge { font-size: 9px; font-weight: 900; background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.2); color: #ef4444; padding: 2px 8px; border-radius: 100px; }
        .notif-list { max-height: 320px; overflow-y: auto; padding: 8px; }
        .notif-list::-webkit-scrollbar { width: 3px; }
        .notif-list::-webkit-scrollbar-thumb { background: rgba(239,68,68,.3); border-radius: 3px; }
        .notif-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 12px 14px; border-radius: 16px;
            border: 1px solid transparent;
            transition: all .25s; text-decoration: none;
            margin-bottom: 4px;
        }
        .notif-item:hover { background: rgba(99,102,241,.07); border-color: rgba(99,102,241,.2); }
        .notif-avatar {
            width: 36px; height: 36px; flex-shrink: 0;
            border-radius: 12px; background: linear-gradient(135deg, #6366f1, #4f46e5);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 900; color: #fff; position: relative;
        }
        .notif-online {
            position: absolute; bottom: -2px; right: -2px;
            width: 9px; height: 9px; border-radius: 50%;
            background: #22c55e; border: 2px solid #000;
            box-shadow: 0 0 6px #22c55e;
        }
        .notif-name  { font-size: 12px; font-weight: 900; color: #e5e7eb; }
        .notif-msg   { font-size: 10px; color: #6b7280; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px; }
        .notif-time  { font-size: 9px; color: #4b5563; margin-top: 4px; }
        .notif-cnt {
            flex-shrink: 0; min-width: 20px; height: 20px; border-radius: 100px;
            background: #ef4444; color: #fff; font-size: 9px; font-weight: 900;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 10px rgba(239,68,68,.5);
        }
        .notif-ftr {
            border-top: 1px solid rgba(255,255,255,.05);
            padding: 12px 20px;
            text-align: center;
        }
        .notif-ftr a {
            font-size: 10px; font-weight: 900; letter-spacing: .2em; text-transform: uppercase;
            color: #6366f1; text-decoration: none;
            transition: color .2s;
        }
        .notif-ftr a:hover { color: #fff; }
        .notif-empty {
            padding: 32px 20px; text-align: center;
            font-size: 11px; font-weight: 700; color: #374151;
        }
        .notif-empty i { font-size: 32px; display: block; margin-bottom: 10px; color: #1f2937; }

        /* ===== USER PROFILE ===== */
        .user-profile {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .user-profile::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(239, 68, 68, 0.2), transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .user-profile:hover::before {
            opacity: 1;
        }

        .user-profile:hover {
            border-color: var(--primary) !important;
            transform: scale(1.02);
        }

        .user-avatar {
            position: relative;
            width: 40px;
            height: 40px;
        }

        @media (min-width: 768px) {
            .user-avatar {
                width: 48px;
                height: 48px;
            }
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 0.75rem;
            object-fit: cover;
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: -1;
        }

        .user-profile:hover .user-avatar::after {
            opacity: 1;
        }

        .online-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #10b981;
            border: 2px solid var(--darker);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        /* ===== CREATE BUTTON ===== */
        .create-btn {
            background: #ef4444;
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .create-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .create-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .create-btn:hover {
            background: #dc2626;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 20px 30px -10px rgba(239, 68, 68, 0.5);
        }

        .create-btn:active {
            transform: translateY(0) scale(0.95);
        }

        @media (max-width: 640px) {
            .create-btn span {
                display: none;
            }
            
            .create-btn {
                padding: 0.625rem;
            }
        }

        /* ===== COLLAPSE BUTTON ===== */
        .collapse-btn {
            position: absolute;
            right: -12px;
            top: 2rem;
            width: 24px;
            height: 24px;
            background: var(--darker);
            border: 2px solid rgba(239, 68, 68, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 50;
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
        }

        .collapse-btn:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
            transform: scale(1.1) rotate(180deg);
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.4);
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        /* ===== MOBILE OVERLAY ===== */
        #sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(4px);
            z-index: 45;
            transition: opacity 0.3s;
            display: none;
        }

        #sidebar-overlay.active {
            display: block;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb {
            display: none;
        }

        @media (min-width: 640px) {
            .breadcrumb {
                display: block;
            }
        }

        .breadcrumb-text {
            font-size: 8px;
            font-weight: 900;
            color: #ef4444;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            font-style: italic;
            margin-bottom: 0.25rem;
        }

        @media (min-width: 1024px) {
            .breadcrumb-text {
                font-size: 9px;
                letter-spacing: 0.4em;
            }
        }

        /* ===== MAIN CONTENT AREA ===== */
        .main-content {
            flex: 1;
            overflow-y: auto;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        .content-area {
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .content-area {
                padding: 1.5rem;
            }
        }

        @media (min-width: 1280px) {
            .content-area {
                padding: 2.5rem;
            }
        }

        /* ===== RESPONSIVE UTILITIES ===== */
        .hidden-mobile {
            display: none;
        }

        @media (min-width: 768px) {
            .hidden-mobile {
                display: block;
            }
        }

        .visible-mobile {
            display: block;
        }

        @media (min-width: 768px) {
            .visible-mobile {
                display: none;
            }
        }
    </style>

    @stack('styles')
    @yield('styles')
</head>
<body>

    {{-- PREMIUM LOADER WITH BACKGROUND IMAGE --}}
    <div id="loader-wrapper" class="loader-wrapper">
        <div class="premium-loader">
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <div class="loader-logo">
                <i class="fa-solid fa-gem"></i>
                <h2>RENTALX</h2>
                <p>ELITE ADMIN</p>
            </div>
            <div class="loader-progress">
                <div class="loader-progress-bar" id="loader-progress-bar"></div>
            </div>
            <div class="loader-count">
                <span id="loader-percentage">0</span>% LOADED
            </div>
        </div>
    </div>

    {{-- CINEMATIC VIDEO BACKGROUND --}}
    <div class="video-background">
        <video autoplay muted loop playsinline id="bg-video">
            <source src="{{ asset('videos/cars.mp4') }}" type="video/mp4">
            <source src="{{ url('/videos/cars.mp4') }}" type="video/mp4">
            <source src="/videos/cars.mp4" type="video/mp4">
            
            {{-- Premium Fallback Videos --}}
            <source src="https://videos.pexels.com/video-files/5605508/5605508-uhd_3840_2160_30fps.mp4" type="video/mp4">
            <source src="https://videos.pexels.com/video-files/3129818/3129818-uhd_3840_2160_30fps.mp4" type="video/mp4">
            
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="video-overlay"></div>

    <div class="flex h-screen overflow-hidden relative">
        
        {{-- SIDEBAR --}}
        <aside id="main-sidebar" class="sidebar-premium">
            
            {{-- Close Button for Mobile --}}
            <button id="sidebar-close-btn" class="sidebar-close-btn">
                <i class="fa-solid fa-times"></i>
            </button>
            
            {{-- Collapse Button (Desktop only) --}}
            <button id="collapse-btn" class="collapse-btn hidden lg:flex">
                <i class="fa-solid fa-chevron-left text-[8px] transition-transform duration-500" id="arrow-icon"></i>
            </button>

            {{-- Logo --}}
            <div class="p-6 lg:p-8">
                <div class="logo-container flex items-center gap-3 cursor-pointer group">
                    <div class="logo-icon h-10 w-10 lg:h-12 lg:w-12 flex-shrink-0 flex items-center justify-center">
                        <i class="fa-solid fa-gem text-white text-lg lg:text-xl"></i>
                    </div>
                    <div class="flex flex-col brand-text-wrapper">
                        <span class="text-xl lg:text-2xl font-black tracking-tight text-white">RENTAL<span class="text-red-500">X</span></span>
                        <span class="text-[8px] font-bold text-red-500/70 tracking-[0.3em] uppercase mt-0.5">ELITE ADMIN</span>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 lg:px-6 space-y-1 overflow-y-auto">
                <p class="menu-label text-[10px] font-black text-zinc-600 uppercase tracking-[0.2em] mb-4 px-4">MAIN</p>
                
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-chart-pie text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Dashboard</span>
                </a>

                {{-- Products --}}
                <a href="{{ route('admin.products.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.products*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-boxes-stacked text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Products</span>
                </a>

                {{-- Orders --}}
                <a href="{{ route('admin.orders.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.orders*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-cart-shopping text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Orders</span>
                </a>

                {{-- Users --}}
                <a href="{{ route('admin.users.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.users*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-users-gear text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Users</span>
                </a>

                {{-- Rent a Car --}}
                <a href="{{ route('admin.rentacar.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.rentacar*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-car-side text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Rent a Car</span>
                </a>

                {{-- Appointments --}}
                <a href="{{ route('admin.appointments.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.appointments*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-calendar-check text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Appointments</span>
                </a>

                {{-- Contacts --}}
                <a href="{{ route('admin.contacts.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.contacts*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-envelope-open-text text-base lg:text-lg w-5"></i>
                    <span class="font-bold text-xs lg:text-sm">Contacts</span>
                </a>

                {{-- Reviews --}}
                <a href="{{ route('admin.reviews.index') }}" 
                   class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.reviews*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-star-half-stroke text-base lg:text-lg w-5"></i>
                    <div class="flex items-center justify-between flex-1">
                        <span class="font-bold text-xs lg:text-sm">Reviews</span>
                        @if(isset($pendingReviewsCount) && $pendingReviewsCount > 0)
                            <span class="bg-red-600 text-white text-[9px] font-bold px-2 py-0.5 rounded-full ml-2 animate-pulse">{{ $pendingReviewsCount }}</span>
                        @endif
                    </div>
                </a>

                {{-- Chat Inbox (admin) --}}
                <a href="{{ route('admin.chat.index') }}"
                   id="chat-nav-link"
                   class="nav-item flex items-center justify-between gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.chat*') ? 'active-link' : '' }}">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-headset text-base lg:text-lg w-5"></i>
                        <span class="font-bold text-xs lg:text-sm">Live Chat</span>
                    </div>
                    <span id="nav-unread-badge" class="hidden text-[9px] font-black text-white bg-red-600 px-2 py-0.5 rounded-full animate-pulse"></span>
                </a>

                {{-- Divider --}}
                <div class="pt-6 lg:pt-8 mt-4 border-t border-white/5">
                    <p class="menu-label text-[10px] font-black text-zinc-600 uppercase tracking-[0.2em] mb-4 px-4">SYSTEM</p>
                    
                    {{-- Settings --}}
                    <a href="{{ route('admin.settings') }}" 
                       class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl {{ request()->routeIs('admin.settings') ? 'active-link' : '' }}">
                        <i class="fa-solid fa-sliders text-base lg:text-lg w-5"></i>
                        <span class="font-bold text-xs lg:text-sm">Settings</span>
                    </a>

                    {{-- Back to Home --}}
                    <a href="{{ route('home') }}" 
                       class="nav-item flex items-center gap-4 px-4 lg:px-5 py-3 lg:py-4 rounded-xl hover:bg-red-500/10 group">
                        <i class="fa-solid fa-house-chimney text-base lg:text-lg w-5 group-hover:text-red-500 transition-colors"></i>
                        <span class="font-bold text-xs lg:text-sm group-hover:text-white transition-colors">Back to Home</span>
                    </a>
                </div>
            </nav>

            {{-- User Profile --}}
            <div class="p-4 lg:p-6">
                <div class="user-profile">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="user-avatar">
                                <img src="{{ Auth::user()->profile->profile_photo_url }}" 
                                     alt="{{ Auth::user()->name ?? 'Admin' }}">
                                <span class="online-indicator"></span>
                            </div>
                            <div class="flex flex-col user-info">
                                <span class="text-xs lg:text-sm font-black text-white leading-tight">{{ Auth::user()->name ?? 'Admin User' }}</span>
                                <span class="text-[8px] lg:text-[10px] font-bold text-red-500 uppercase tracking-wider mt-0.5">{{ Auth::user()->role ?? 'Administrator' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('logout') }}" 
                           class="text-zinc-600 hover:text-red-500 transition-colors p-2 hover:bg-red-500/10 rounded-lg group/logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-power-off group-hover/logout:rotate-90 transition-transform"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
            
            {{-- HEADER WITH TOGGLE BUTTONS --}}
            <header class="glass-nav px-4 lg:px-6 flex items-center justify-between">
                
                {{-- Left Section with Toggle Button --}}
                <div class="flex items-center gap-3 lg:gap-4">
                    {{-- Open Toggle Button (Mobile) --}}
                    <button id="mobile-toggle" class="header-toggle-btn">
                        <i class="fa-solid fa-bars-staggered text-sm"></i>
                    </button>
                    
                    {{-- Breadcrumb --}}
                    <div class="breadcrumb">
                        <h2 class="breadcrumb-text">RENTALX OPS</h2>
                        <div class="flex items-center gap-2 text-zinc-500 text-[10px] lg:text-[11px] font-bold">
                            <i class="fa-solid fa-house-chimney text-[8px] lg:text-[9px]"></i>
                            <span>/</span>
                            <span class="text-zinc-300 capitalize truncate max-w-[150px] lg:max-w-none">{{ request()->segment(2) ?? 'Dashboard' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Right Section --}}
                <div class="flex items-center gap-2 lg:gap-4">
                    {{-- Search Container --}}
                    <div class="search-container">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500 text-xs group-focus-within:text-red-500 transition-colors"></i>
                        <input type="text" 
                               placeholder="Search anything..." 
                               class="search-input text-white placeholder-zinc-600">
                    </div>

                    {{-- Notifications Bell + Dropdown --}}
                    <div class="relative" id="notif-wrapper">
                        <button id="notif-btn" class="notification-btn" onclick="toggleNotif(event)">
                            <i class="fa-regular fa-bell text-sm lg:text-base relative z-10"></i>
                            <span class="notification-dot" id="notif-dot" style="display:none;"></span>
                        </button>

                        {{-- Dropdown --}}
                        <div class="notif-dropdown" id="notif-dropdown">
                            <div class="notif-hdr">
                                <span class="notif-hdr-title">💬 New Messages</span>
                                <span class="notif-hdr-badge" id="notif-total-badge">0 Unread</span>
                            </div>
                            <div class="notif-list" id="notif-list">
                                <div class="notif-empty">
                                    <i class="fa-regular fa-comment-dots"></i>
                                    No new messages
                                </div>
                            </div>
                            <div class="notif-ftr">
                                <a href="{{ route('admin.chat.index') }}">Open Chat Center →</a>
                            </div>
                        </div>
                    </div>

                    {{-- Create Button --}}
                    <a href="{{ route('admin.products.create') }}" class="create-btn">
                        <i class="fa-solid fa-plus text-[8px] lg:text-[10px]"></i>
                        <span>NEW</span>
                    </a>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="content-area">
                <div class="animate-page w-full max-w-[1600px] mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    {{-- Mobile Overlay --}}
    <div id="sidebar-overlay"></div>

    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('main-sidebar');
        const collapseBtn = document.getElementById('collapse-btn');
        const arrowIcon = document.getElementById('arrow-icon');
        const mobileToggle = document.getElementById('mobile-toggle');
        const sidebarCloseBtn = document.getElementById('sidebar-close-btn');
        const overlay = document.getElementById('sidebar-overlay');
        const loaderWrapper = document.getElementById('loader-wrapper');
        const loaderPercentage = document.getElementById('loader-percentage');
        const bgVideo = document.getElementById('bg-video');

        // ===== VIDEO LOADING FIX =====
        function loadVideo() {
            if (bgVideo) {
                bgVideo.load();
                
                const playPromise = bgVideo.play();
                
                if (playPromise !== undefined) {
                    playPromise
                        .then(() => {
                            console.log('✅ Video playing successfully');
                        })
                        .catch(error => {
                            console.log('❌ Video autoplay failed:', error);
                            
                            document.addEventListener('click', function playVideo() {
                                bgVideo.play();
                                document.removeEventListener('click', playVideo);
                            }, { once: true });
                        });
                }
            }
        }

        // ===== PREMIUM LOADER WITH PERCENTAGE =====
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.floor(Math.random() * 10) + 5;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                
                setTimeout(() => {
                    loaderWrapper.classList.add('hidden');
                    loadVideo();
                    initGSAP();
                }, 500);
            }
            loaderPercentage.textContent = progress;
        }, 200);

        // Fallback: Hide loader after 3 seconds max
        setTimeout(() => {
            if (!loaderWrapper.classList.contains('hidden')) {
                loaderWrapper.classList.add('hidden');
                loadVideo();
                initGSAP();
            }
        }, 3000);

        // ===== GSAP ANIMATIONS =====
        function initGSAP() {
            gsap.registerPlugin(ScrollTrigger, Draggable);

            // Animate sidebar items
            gsap.from('.nav-item', {
                opacity: 0,
                x: -20,
                duration: 0.5,
                stagger: 0.05,
                ease: 'power2.out'
            });

            // Animate header
            gsap.from('.glass-nav', {
                y: -100,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            });

            // Animate main content
            gsap.from('main', {
                opacity: 0,
                y: 30,
                duration: 0.8,
                delay: 0.2,
                ease: 'power2.out'
            });

            // Floating animation for logo
            gsap.to('.logo-icon', {
                y: -3,
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: 'power1.inOut'
            });

            // Pulsing glow for active nav item
            if (document.querySelector('.active-link')) {
                gsap.to('.active-link', {
                    boxShadow: '0 0 30px rgba(239, 68, 68, 0.5)',
                    duration: 1.5,
                    repeat: -1,
                    yoyo: true,
                    ease: 'power1.inOut'
                });
            }

            // Parallax effect on video
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 10;
                const y = (e.clientY / window.innerHeight - 0.5) * 10;
                
                gsap.to('.video-background video', {
                    x: x,
                    y: y,
                    duration: 2,
                    ease: 'power2.out'
                });
            });
        }

        // ===== MOBILE SIDEBAR TOGGLE (OPEN) =====
        if (mobileToggle) {
            mobileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.add('mobile-sidebar-show');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                
                // Animate sidebar opening
                gsap.fromTo(sidebar, 
                    { x: -300, opacity: 0 },
                    { x: 0, opacity: 1, duration: 0.4, ease: 'power2.out' }
                );
            });
        }

        // ===== SIDEBAR CLOSE BUTTON =====
        if (sidebarCloseBtn) {
            sidebarCloseBtn.addEventListener('click', closeSidebar);
        }

        // Close on overlay click
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('mobile-sidebar-show')) {
                closeSidebar();
            }
        });

        function closeSidebar() {
            gsap.to(sidebar, {
                x: -300,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.in',
                onComplete: () => {
                    sidebar.classList.remove('mobile-sidebar-show');
                    sidebar.style.transform = '';
                    sidebar.style.opacity = '';
                }
            });
            
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // ===== SIDEBAR COLLAPSE (Desktop only) =====
        if (collapseBtn) {
            collapseBtn.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
                arrowIcon?.classList.toggle('rotate-180');
                
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('sidebar-collapsed'));
                
                // Animate icons
                gsap.to('.nav-item i', {
                    scale: sidebar.classList.contains('sidebar-collapsed') ? 1.2 : 1,
                    duration: 0.3
                });
            });
        }

        // Load saved state
        if (window.innerWidth > 1024) {
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('sidebar-collapsed');
                arrowIcon?.classList.add('rotate-180');
            }
        }

        // ===== SEARCH WITH ANIMATION =====
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                gsap.to(searchInput, {
                    width: '300px',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            searchInput.addEventListener('blur', () => {
                if (!searchInput.value) {
                    gsap.to(searchInput, {
                        width: '100%',
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                }
            });
        }

        // ===== NOTIFICATION BELL ANIMATION =====
        setInterval(() => {
            const bell = document.querySelector('.notification-btn i');
            if (bell && !bell.matches(':hover')) {
                gsap.to(bell, {
                    rotation: 15,
                    duration: 0.2,
                    yoyo: true,
                    repeat: 1,
                    ease: 'power1.inOut'
                });
            }
        }, 5000);

        // ===== DRAGGABLE SIDEBAR (for fun) =====
        if (window.innerWidth > 1024) {
            Draggable.create('.logo-icon', {
                type: 'rotation',
                inertia: true,
                onDragEnd: function() {
                    gsap.to(this.target, {
                        rotation: 0,
                        duration: 1,
                        ease: 'elastic.out(1, 0.3)'
                    });
                }
            });
        }

        // ===== RESIZE HANDLER =====
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                overlay.classList.remove('active');
                sidebar.classList.remove('mobile-sidebar-show');
                sidebar.style.transform = '';
                sidebar.style.opacity = '';
                document.body.style.overflow = 'auto';
            } else {
                // Remove collapsed state on mobile
                sidebar.classList.remove('sidebar-collapsed');
            }
        });

        // ===== TOAST NOTIFICATIONS =====
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: '#1f2937',
                color: '#fff',
                iconColor: '#ef4444'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: '#1f2937',
                color: '#fff',
                iconColor: '#ef4444'
            });
        @endif

        // ===== LIVE CHAT NOTIFICATION SYSTEM =====
        let notifOpen   = false;
        let lastUnread  = 0;
        let notifData   = [];

        function toggleNotif(e) {
            e && e.stopPropagation();
            const dd = document.getElementById('notif-dropdown');
            notifOpen = !notifOpen;
            dd.classList.toggle('open', notifOpen);
            if (notifOpen) renderNotifDropdown();
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('notif-wrapper');
            if (wrapper && !wrapper.contains(e.target) && notifOpen) {
                notifOpen = false;
                document.getElementById('notif-dropdown').classList.remove('open');
            }
        });

        function fetchUnreadMessages() {
            fetch('{{ route('admin.chat.unread') }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(r => r.json())
            .then(data => {
                const total    = data.total ?? 0;
                const senders  = data.senders ?? [];
                notifData      = senders;

                // Update bell dot
                const dot  = document.getElementById('notif-dot');
                const badge= document.getElementById('nav-unread-badge');

                if (total > 0) {
                    // Bell dot
                    dot.style.display = 'flex';
                    dot.textContent   = total > 99 ? '99+' : total;

                    // Nav badge
                    badge.textContent = total;
                    badge.classList.remove('hidden');

                    // If new messages arrived while dropdown is closed → shake bell
                    if (total > lastUnread && !notifOpen && typeof gsap !== 'undefined') {
                        gsap.to('#notif-btn i', {
                            rotation: 20, duration: 0.1, repeat: 5, yoyo: true, ease: 'power1.inOut',
                            onComplete: () => gsap.set('#notif-btn i', { rotation: 0 })
                        });
                    }
                } else {
                    dot.style.display = 'none';
                    dot.textContent   = '';
                    badge.classList.add('hidden');
                }

                lastUnread = total;

                // Update badge header text
                const hdrBadge = document.getElementById('notif-total-badge');
                if (hdrBadge) hdrBadge.textContent = `${total} Unread`;

                // Re-render if open
                if (notifOpen) renderNotifDropdown();
            })
            .catch(() => {});
        }

        function renderNotifDropdown() {
            const list = document.getElementById('notif-list');
            if (!list) return;

            if (!notifData || notifData.length === 0) {
                list.innerHTML = `
                    <div class="notif-empty">
                        <i class="fa-regular fa-comment-dots"></i>
                        No new messages right now
                    </div>`;
                return;
            }

            list.innerHTML = notifData.map(u => `
                <a href="{{ route('admin.chat.index') }}" class="notif-item">
                    <div class="notif-avatar">
                        ${u.name.charAt(0).toUpperCase()}
                        ${u.is_online ? '<span class="notif-online"></span>' : ''}
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div class="notif-name">${u.name}</div>
                        <div class="notif-msg">${u.message ?? 'Sent you a message'}</div>
                        <div class="notif-time">${u.time ?? ''}</div>
                    </div>
                    ${u.unread > 0 ? `<div class="notif-cnt">${u.unread}</div>` : ''}
                </a>
            `).join('');
        }

        // Initial fetch + poll every 12 seconds
        fetchUnreadMessages();
        setInterval(fetchUnreadMessages, 12000);

    </script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>