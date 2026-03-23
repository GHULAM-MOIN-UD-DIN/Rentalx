{{-- resources/views/Pages/chat.blade.php --}}
@extends('layouts.app')

@section('title', 'Chat with Support')

@push('styles')
<style>
    /* ===== ULTIMATE PREMIUM VARIABLES ===== */
    :root {
        /* Primary Colors */
        --primary: #ef4444;
        --primary-dark: #dc2626;
        --primary-light: #f87171;
        --primary-soft: #fee2e2;
        --primary-glow: rgba(239, 68, 68, 0.5);
        --primary-glow-soft: rgba(239, 68, 68, 0.25);
        
        /* Secondary Colors */
        --secondary: #22c55e;
        --secondary-dark: #16a34a;
        --secondary-light: #4ade80;
        --secondary-glow: rgba(34, 197, 94, 0.3);
        
        /* Neutral Colors */
        --bg-dark: #0a0a0a;
        --bg-darker: #030303;
        --bg-card: #111111;
        --bg-card-light: #1a1a1a;
        --bg-gradient: linear-gradient(145deg, #0a0a0a, #1a1a1a);
        --bg-gradient-premium: radial-gradient(circle at 100% 0%, rgba(239,68,68,0.1) 0%, transparent 50%),
                              radial-gradient(circle at 0% 100%, rgba(239,68,68,0.1) 0%, transparent 50%),
                              linear-gradient(145deg, #0a0a0a, #1a1a1a);
        
        /* Text Colors */
        --text-primary: #ffffff;
        --text-secondary: #e5e5e5;
        --text-muted: #9ca3af;
        --text-dim: #6b7280;
        
        /* Border Colors */
        --border-glow: rgba(239, 68, 68, 0.25);
        --border-subtle: rgba(255, 255, 255, 0.05);
        --border-strong: rgba(239, 68, 68, 0.5);
        
        /* Shadow Variables */
        --shadow-xs: 0 2px 4px rgba(0, 0, 0, 0.1);
        --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.12);
        --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.14);
        --shadow-lg: 0 12px 24px rgba(0, 0, 0, 0.16);
        --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2);
        --shadow-2xl: 0 30px 60px rgba(0, 0, 0, 0.25);
        --shadow-inner: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        --shadow-glow: 0 0 30px var(--primary-glow);
        
        /* Glass Effects */
        --glass-bg: rgba(255, 255, 255, 0.03);
        --glass-bg-strong: rgba(255, 255, 255, 0.06);
        --glass-border: rgba(255, 255, 255, 0.05);
        --glass-border-strong: rgba(255, 255, 255, 0.1);
        
        /* Transitions */
        --transition-instant: 100ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: 200ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: 400ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: 500ms cubic-bezier(0.34, 1.56, 0.64, 1);
        
        /* Layout Variables - Fully Responsive */
        --sidebar-width-xs: 100%;
        --sidebar-width-sm: 320px;
        --sidebar-width-md: 350px;
        --sidebar-width-lg: 380px;
        --sidebar-width-xl: 400px;
        
        --header-height-xs: 60px;
        --header-height-sm: 65px;
        --header-height-md: 70px;
        --header-height-lg: 75px;
        --header-height-xl: 80px;
        
        --input-height-xs: 60px;
        --input-height-sm: 65px;
        --input-height-md: 70px;
        --input-height-lg: 75px;
        --input-height-xl: 80px;
        
        /* Spacing Variables */
        --spacing-xs: 4px;
        --spacing-sm: 8px;
        --spacing-md: 12px;
        --spacing-lg: 16px;
        --spacing-xl: 20px;
        --spacing-2xl: 24px;
        --spacing-3xl: 32px;
        --spacing-4xl: 40px;
        
        /* Border Radius */
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --radius-3xl: 28px;
        --radius-full: 9999px;
        
        /* Z-Index Layers */
        --z-background: 0;
        --z-default: 1;
        --z-header: 10;
        --z-sidebar: 20;
        --z-modal: 100;
        --z-toast: 200;
        --z-tooltip: 300;
    }

    /* ===== RESET & BASE STYLES ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-size: 16px;
        min-height: 100vh;
        scroll-behavior: smooth;
    }

    body {
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--bg-darker);
        color: var(--text-primary);
        line-height: 1.5;
        overflow-x: hidden;
    }

    /* ===== CHAT WRAPPER ===== */
    .chat-wrapper {
        display: flex;
        height: 750px;
        max-height: calc(100vh - 180px); /* Ensure space for nav and footer */
        width: 95%;
        max-width: 1400px;
        margin: 100px auto 40px; 
        position: relative;
        overflow: hidden;
        background: var(--bg-gradient-premium);
        border-radius: var(--radius-2xl);
        border: 1px solid var(--border-glow);
        box-shadow: var(--shadow-2xl);
        z-index: 5;
    }

    @media (max-width: 768px) {
        .chat-wrapper {
            height: calc(100vh - 80px);
            max-height: none;
            width: 100%;
            margin: 80px 0 0;
            border-radius: 0;
            z-index: 100;
        }
    }

    /* ===== ANIMATED BACKGROUND ===== */
    .chat-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(239,68,68,0.15) 0%, transparent 40%),
            radial-gradient(circle at 80% 70%, rgba(239,68,68,0.1) 0%, transparent 40%),
            repeating-linear-gradient(45deg, rgba(255,255,255,0.01) 0px, rgba(255,255,255,0.01) 1px, transparent 1px, transparent 30px);
        pointer-events: none;
        animation: backgroundPulse 20s ease-in-out infinite;
        z-index: var(--z-background);
    }

    @keyframes backgroundPulse {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.02); }
    }

    /* ===== USER LIST SIDEBAR ===== */
    .user-list-panel {
        width: var(--sidebar-width-lg);
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        background: rgba(5, 5, 5, 0.98);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-right: 1px solid var(--border-glow);
        position: relative;
        z-index: var(--z-sidebar);
        box-shadow: 10px 0 40px rgba(0, 0, 0, 0.5);
        transition: all var(--transition-smooth);
    }

    @media (min-width: 1400px) {
        .user-list-panel {
            width: var(--sidebar-width-xl);
        }
    }

    @media (max-width: 992px) {
        .user-list-panel {
            width: var(--sidebar-width-md);
        }
    }

    @media (max-width: 768px) {
        .user-list-panel {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width-sm);
            transform: translateX(-100%);
            z-index: 100;
            transition: transform var(--transition-bounce);
        }
        
        .user-list-panel.show {
            transform: translateX(0);
        }
    }

    @media (max-width: 576px) {
        .user-list-panel {
            width: 85%;
            max-width: 320px;
        }
    }

    .user-list-panel::after {
        content: '';
        position: absolute;
        top: 0;
        right: -1px;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, 
            transparent 0%, 
            var(--primary) 20%, 
            var(--primary-dark) 50%, 
            var(--primary) 80%, 
            transparent 100%);
        animation: borderFlow 3s linear infinite;
    }

    @keyframes borderFlow {
        0% { opacity: 0.3; transform: scaleY(1); }
        50% { opacity: 1; transform: scaleY(1.05); }
        100% { opacity: 0.3; transform: scaleY(1); }
    }

    /* ===== TOGGLE SIDEBAR BUTTON (Mobile) ===== */
    .sidebar-toggle {
        display: none;
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: 50px;
        height: 50px;
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        z-index: 101;
        box-shadow: var(--shadow-lg), 0 0 30px var(--primary-glow);
        transition: all var(--transition-bounce);
        align-items: center;
        justify-content: center;
    }

    .sidebar-toggle:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .sidebar-toggle i {
        transition: transform var(--transition-base);
    }

    .sidebar-toggle:hover i {
        transform: rotate(90deg);
    }

    @media (max-width: 768px) {
        .sidebar-toggle {
            display: flex;
        }
    }

    /* ===== PANEL HEADER ===== */
    .panel-header {
        padding: clamp(16px, 3vw, 24px) clamp(16px, 3vw, 20px);
        border-bottom: 1px solid var(--border-subtle);
        flex-shrink: 0;
        background: rgba(0, 0, 0, 0.3);
    }

    .panel-header h2 {
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        font-weight: 800;
        margin-bottom: clamp(15px, 2vw, 20px);
        display: flex;
        align-items: center;
        gap: clamp(5px, 1vw, 10px);
        background: linear-gradient(135deg, #fff, var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .panel-header h2 i {
        -webkit-text-fill-color: var(--primary);
        filter: drop-shadow(0 0 15px var(--primary-glow));
        animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }

    /* ===== PREMIUM SEARCH BOX ===== */
    .search-box {
        position: relative;
        margin-bottom: clamp(12px, 2vw, 15px);
    }

    .search-box i {
        position: absolute;
        left: clamp(14px, 2vw, 16px);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-dim);
        font-size: clamp(0.85rem, 1.5vw, 0.9rem);
        transition: all var(--transition-base);
        z-index: 2;
        pointer-events: none;
    }

    .search-box input {
        width: 100%;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-subtle);
        border-radius: var(--radius-full);
        padding: clamp(12px, 2vw, 14px) clamp(18px, 3vw, 20px) 
                 clamp(12px, 2vw, 14px) clamp(40px, 5vw, 45px);
        color: var(--text-primary);
        font-size: clamp(0.9rem, 1.8vw, 0.95rem);
        outline: none;
        transition: all var(--transition-smooth);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .search-box input:focus {
        border-color: var(--primary);
        background: rgba(239, 68, 68, 0.05);
        box-shadow: 0 0 40px var(--primary-glow);
        transform: scale(1.01);
    }

    .search-box input:focus + i {
        color: var(--primary);
        transform: translateY(-50%) scale(1.1);
    }

    .search-box input::placeholder {
        color: var(--text-dim);
        transition: all var(--transition-base);
        font-size: clamp(0.85rem, 1.5vw, 0.9rem);
    }

    .search-box input:focus::placeholder {
        opacity: 0.3;
        transform: translateX(10px);
    }

    /* ===== UNREAD STATS CARD ===== */
    .unread-stats {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, rgba(239,68,68,0.15), rgba(220,38,38,0.05));
        padding: clamp(10px, 1.8vw, 12px) clamp(14px, 2.5vw, 16px);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-glow);
        animation: statsPulse 3s ease-in-out infinite;
    }

    @keyframes statsPulse {
        0%, 100% { box-shadow: 0 0 20px var(--primary-glow-soft); }
        50% { box-shadow: 0 0 40px var(--primary-glow); }
    }

    .unread-stats span {
        color: var(--text-secondary);
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: clamp(5px, 1vw, 8px);
    }

    .unread-stats strong {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: clamp(1.1rem, 2vw, 1.3rem);
        font-weight: 800;
    }

    /* ===== USER LIST SCROLLABLE ===== */
    .user-list {
        flex: 1;
        overflow-y: auto;
        padding: clamp(12px, 2vw, 16px) clamp(10px, 1.8vw, 12px);
        scrollbar-width: thin;
        scrollbar-color: var(--primary) transparent;
    }

    .user-list::-webkit-scrollbar {
        width: 4px;
    }

    .user-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .user-list::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius-full);
    }

    /* ===== USER ITEM CARD ===== */
    .user-item {
        display: flex;
        align-items: center;
        gap: clamp(12px, 2vw, 16px);
        padding: clamp(12px, 2vw, 16px) clamp(16px, 2.5vw, 20px);
        margin: clamp(2px, 0.5vw, 4px) 0;
        cursor: pointer;
        transition: all var(--transition-smooth);
        border-radius: var(--radius-lg);
        position: relative;
        animation: itemSlideUp 0.5s var(--transition-bounce);
        animation-fill-mode: both;
        width: 100%;
    }

    @keyframes itemSlideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-item:nth-child(1) { animation-delay: 0.05s; }
    .user-item:nth-child(2) { animation-delay: 0.1s; }
    .user-item:nth-child(3) { animation-delay: 0.15s; }
    .user-item:nth-child(4) { animation-delay: 0.2s; }
    .user-item:nth-child(5) { animation-delay: 0.25s; }
    .user-item:nth-child(6) { animation-delay: 0.3s; }
    .user-item:nth-child(7) { animation-delay: 0.35s; }
    .user-item:nth-child(8) { animation-delay: 0.4s; }
    .user-item:nth-child(9) { animation-delay: 0.45s; }
    .user-item:nth-child(10) { animation-delay: 0.5s; }

    .user-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(239,68,68,0.2), transparent);
        border-radius: var(--radius-lg);
        opacity: 0;
        transition: all var(--transition-base);
        z-index: -1;
    }

    .user-item:hover {
        transform: translateX(10px) scale(1.02);
        background: rgba(239, 68, 68, 0.05);
    }

    .user-item:hover::before {
        opacity: 1;
    }

    .user-item.active {
        background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(220,38,38,0.1));
        border-left: 4px solid var(--primary);
        box-shadow: 0 15px 35px rgba(239, 68, 68, 0.25);
    }

    .user-item.active::after {
        content: '';
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary);
        box-shadow: 0 0 15px var(--primary-glow);
        animation: activePulse 1.5s ease-in-out infinite;
    }

    @keyframes activePulse {
        0%, 100% { opacity: 0.5; transform: translateY(-50%) scale(1); }
        50% { opacity: 1; transform: translateY(-50%) scale(1.2); }
    }

    /* ===== USER AVATAR ===== */
    .user-item-avatar {
        width: clamp(48px, 7vw, 56px);
        height: clamp(48px, 7vw, 56px);
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: clamp(1rem, 2vw, 1.2rem);
        color: white;
        position: relative;
        flex-shrink: 0;
        overflow: hidden;
        border: 3px solid transparent;
        background-clip: padding-box;
        box-shadow: 0 0 30px var(--primary-glow);
        transition: all var(--transition-bounce);
    }

    .user-item:hover .user-item-avatar {
        transform: rotate(5deg) scale(1.1);
        border-color: var(--primary);
        box-shadow: 0 0 50px var(--primary-glow);
    }

    .user-item-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all var(--transition-base);
    }

    .user-item:hover .user-item-avatar img {
        transform: scale(1.1);
    }

    /* ===== STATUS INDICATOR ===== */
    .status-dot-sidebar {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: clamp(12px, 2vw, 14px);
        height: clamp(12px, 2vw, 14px);
        border-radius: var(--radius-full);
        background: var(--secondary);
        border: 2px solid var(--bg-card);
        animation: statusGlow 2s ease-in-out infinite;
        z-index: 2;
    }

    @keyframes statusGlow {
        0%, 100% { 
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 0 8px rgba(34, 197, 94, 0);
            transform: scale(1.1);
        }
    }

    .status-dot-sidebar.offline {
        background: #6b7280;
        animation: none;
    }

    /* ===== USER INFO ===== */
    .user-item-info {
        flex: 1;
        min-width: 0;
    }

    .user-item-name {
        font-size: clamp(0.95rem, 1.8vw, 1.1rem);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: clamp(4px, 1vw, 6px);
        display: flex;
        align-items: center;
        gap: clamp(4px, 1vw, 8px);
        letter-spacing: -0.3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-item-badge {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        font-size: clamp(0.6rem, 1.2vw, 0.7rem);
        padding: 2px clamp(6px, 1.2vw, 8px);
        border-radius: var(--radius-full);
        font-weight: 600;
        box-shadow: 0 0 15px var(--primary-glow);
        white-space: nowrap;
    }

    .verified-icon {
        color: #3b82f6;
        font-size: clamp(0.7rem, 1.3vw, 0.8rem);
        filter: drop-shadow(0 0 5px rgba(59, 130, 246, 0.5));
    }

    .user-item-preview {
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        color: var(--text-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        gap: clamp(4px, 1vw, 6px);
    }

    .preview-icon {
        color: var(--primary);
        font-size: clamp(0.7rem, 1.3vw, 0.8rem);
        animation: slideRight 2s ease-in-out infinite;
    }

    @keyframes slideRight {
        0%, 100% { transform: translateX(0); opacity: 0.5; }
        50% { transform: translateX(3px); opacity: 1; }
    }

    .user-item-time {
        font-size: clamp(0.65rem, 1.2vw, 0.75rem);
        color: var(--text-dim);
        margin-left: auto;
        padding-left: clamp(5px, 1vw, 10px);
        white-space: nowrap;
    }

    /* ===== MAIN CHAT AREA ===== */
    .main-chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        overflow: hidden;
        position: relative;
        background: rgba(0, 0, 0, 0.4);
        transition: all var(--transition-smooth);
        z-index: 5;
    }

    @media (max-width: 768px) {
        .main-chat-area {
            width: 100%;
        }
    }

    /* ===== CHAT HEADER ===== */
    .chat-header {
        height: var(--header-height-lg);
        display: flex;
        align-items: center;
        gap: clamp(12px, 2vw, 20px);
        padding: 0 clamp(16px, 3vw, 30px);
        background: rgba(17, 17, 17, 0.98);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-bottom: 1px solid var(--border-glow);
        box-shadow: var(--shadow-lg);
        z-index: var(--z-header);
        flex-shrink: 0;
        position: relative;
    }

    @media (max-width: 1200px) {
        .chat-header {
            height: var(--header-height-lg);
        }
    }

    @media (max-width: 992px) {
        .chat-header {
            height: var(--header-height-md);
            padding: 0 20px;
        }
    }

    @media (max-width: 768px) {
        .chat-header {
            height: var(--header-height-sm);
            padding: 0 16px;
        }
    }

    @media (max-width: 576px) {
        .chat-header {
            height: var(--header-height-xs);
            gap: 10px;
        }
    }

    .chat-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--primary) 20%, 
            var(--primary-dark) 50%, 
            var(--primary) 80%, 
            transparent 100%);
        animation: headerGlow 3s linear infinite;
    }

    @keyframes headerGlow {
        0% { opacity: 0.3; transform: scaleX(1); }
        50% { opacity: 1; transform: scaleX(1.02); }
        100% { opacity: 0.3; transform: scaleX(1); }
    }

    /* ===== MENU BUTTON (Mobile) ===== */
    .menu-btn {
        display: none;
        width: clamp(40px, 5vw, 48px);
        height: clamp(40px, 5vw, 48px);
        border-radius: var(--radius-full);
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        color: var(--text-secondary);
        font-size: clamp(1rem, 2vw, 1.2rem);
        cursor: pointer;
        transition: all var(--transition-bounce);
        align-items: center;
        justify-content: center;
    }

    .menu-btn:hover {
        border-color: var(--primary);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 10px 25px var(--primary-glow);
    }

    @media (max-width: 768px) {
        .menu-btn {
            display: flex;
        }
    }

    /* ===== BACK BUTTON ===== */
    .back-btn {
        width: clamp(42px, 5vw, 48px);
        height: clamp(42px, 5vw, 48px);
        border-radius: var(--radius-full);
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-bounce);
        color: var(--text-secondary);
        font-size: clamp(1rem, 2vw, 1.2rem);
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .back-btn {
            width: 38px;
            height: 38px;
            font-size: 1rem;
        }
    }

    .back-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        opacity: 0;
        transition: var(--transition-base);
        z-index: -1;
    }

    .back-btn:hover {
        border-color: var(--primary);
        color: white;
        transform: translateX(-3px) scale(1.1);
        box-shadow: 0 10px 30px var(--primary-glow);
    }

    .back-btn:hover::before {
        opacity: 1;
    }

    .back-btn:active {
        transform: translateX(0) scale(0.95);
    }

    /* ===== CHAT AVATAR ===== */
    .chat-avatar {
        width: clamp(48px, 7vw, 56px);
        height: clamp(48px, 7vw, 56px);
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        color: white;
        position: relative;
        flex-shrink: 0;
        overflow: hidden;
        border: 3px solid var(--border-glow);
        box-shadow: 0 0 40px var(--primary-glow);
        transition: all var(--transition-bounce);
        animation: avatarGlow 3s ease-in-out infinite;
    }

    @keyframes avatarGlow {
        0%, 100% { 
            box-shadow: 0 0 30px var(--primary-glow);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 60px var(--primary-glow);
            transform: scale(1.03);
        }
    }

    .chat-avatar:hover {
        transform: rotate(5deg) scale(1.08);
    }

    .chat-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-base);
    }

    .chat-avatar:hover img {
        transform: scale(1.1);
    }

    /* ===== ONLINE DOT ===== */
    .online-dot {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: clamp(14px, 2vw, 16px);
        height: clamp(14px, 2vw, 16px);
        border-radius: var(--radius-full);
        background: var(--secondary);
        border: 3px solid var(--bg-card);
        animation: onlinePulse 2s ease-in-out infinite;
        z-index: 2;
    }

    @keyframes onlinePulse {
        0%, 100% { 
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 0 12px rgba(34, 197, 94, 0);
            transform: scale(1.1);
        }
    }

    .online-dot.offline {
        background: #6b7280;
        animation: none;
    }

    /* ===== HEADER INFO ===== */
    .header-info {
        flex: 1;
        min-width: 0;
    }

    .header-info h3 {
        font-weight: 800;
        font-size: clamp(1rem, 2.2vw, 1.3rem);
        margin-bottom: clamp(4px, 1vw, 6px);
        background: linear-gradient(135deg, #fff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .header-status {
        font-size: clamp(0.75rem, 1.5vw, 0.85rem);
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: clamp(4px, 1vw, 6px);
        font-weight: 500;
    }

    .header-status::before {
        content: '';
        width: clamp(6px, 1.2vw, 8px);
        height: clamp(6px, 1.2vw, 8px);
        border-radius: var(--radius-full);
        background: currentColor;
        display: inline-block;
        animation: blink 1.5s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    .header-status.offline {
        color: #9ca3af;
    }

    .header-status.offline::before {
        background: #9ca3af;
        animation: none;
    }

    /* ===== ACTION BUTTONS ===== */
    .header-actions {
        display: flex;
        gap: clamp(8px, 1.5vw, 15px);
    }

    @media (max-width: 480px) {
        .header-actions {
            gap: 5px;
        }
    }

    .action-btn {
        width: clamp(40px, 5vw, 48px);
        height: clamp(40px, 5vw, 48px);
        border-radius: var(--radius-full);
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-bounce);
        color: var(--text-secondary);
        font-size: clamp(1rem, 2vw, 1.2rem);
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .action-btn {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
    }

    .action-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        opacity: 0;
        transition: var(--transition-base);
        z-index: -1;
    }

    .action-btn:hover {
        border-color: var(--primary);
        color: white;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 10px 30px var(--primary-glow);
    }

    .action-btn:hover::before {
        opacity: 1;
    }

    .action-btn.green:hover {
        border-color: var(--secondary);
        box-shadow: 0 10px 30px var(--secondary-glow);
    }

    .action-btn.green:hover::before {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
    }

    /* ===== MESSAGES AREA ===== */
    .messages-area {
        flex: 1;
        overflow-y: auto;
        padding: clamp(16px, 3vw, 30px) clamp(16px, 3vw, 30px) clamp(16px, 2vw, 20px);
        display: flex;
        flex-direction: column;
        gap: clamp(8px, 1.5vw, 12px);
        background: transparent;
        scroll-behavior: smooth;
        position: relative;
    }

    .messages-area::-webkit-scrollbar {
        width: 6px;
    }

    .messages-area::-webkit-scrollbar-track {
        background: transparent;
    }

    .messages-area::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius-full);
        transition: var(--transition-base);
    }

    .messages-area::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, var(--primary-dark), var(--primary));
    }

    /* ===== MESSAGE ROWS ===== */
    .msg-row {
        display: flex;
        align-items: flex-end;
        gap: clamp(8px, 1.5vw, 12px);
        animation: messageSlide 0.4s var(--transition-bounce);
        transform-origin: left;
        margin: clamp(2px, 0.5vw, 4px) 0;
    }

    .msg-row.mine {
        flex-direction: row-reverse;
        transform-origin: right;
    }

    @keyframes messageSlide {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* ===== AVATAR SMALL ===== */
    .msg-avatar-small {
        width: clamp(32px, 5vw, 40px);
        height: clamp(32px, 5vw, 40px);
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
        border: 2px solid var(--border-glow);
        box-shadow: var(--shadow-md);
        transition: all var(--transition-base);
    }

    .msg-row:hover .msg-avatar-small {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 0 30px var(--primary-glow);
    }

    .msg-avatar-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-base);
    }

    .msg-row:hover .msg-avatar-small img {
        transform: scale(1.1);
    }

    /* ===== MESSAGE BUBBLES ===== */
    .bubble {
        max-width: min(70%, 500px);
        padding: clamp(10px, 2vw, 14px) clamp(16px, 3vw, 22px);
        border-radius: var(--radius-2xl);
        font-size: clamp(0.85rem, 1.8vw, 0.95rem);
        line-height: 1.6;
        word-break: break-word;
        position: relative;
        transition: all var(--transition-smooth);
        animation: bubblePop 0.4s var(--transition-bounce);
    }

    @media (max-width: 768px) {
        .bubble {
            max-width: 85%;
        }
    }

    @media (max-width: 480px) {
        .bubble {
            max-width: 90%;
            padding: 10px 14px;
            font-size: 0.9rem;
        }
    }

    @keyframes bubblePop {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        80% {
            transform: scale(1.02);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .bubble.mine {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-bottom-right-radius: var(--radius-sm);
        box-shadow: 0 10px 30px var(--primary-glow);
        position: relative;
        overflow: hidden;
    }

    .bubble.mine::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: translateX(-100%);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        100% {
            transform: translateX(100%);
        }
    }

    .bubble.theirs {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        color: var(--text-primary);
        border: 1px solid var(--glass-border);
        border-bottom-left-radius: var(--radius-sm);
        box-shadow: var(--shadow-md);
    }

    .bubble:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: var(--shadow-2xl);
    }

    /* ===== IMAGE BUBBLE ===== */
    .bubble-image {
        max-width: min(350px, 80%);
        border-radius: var(--radius-2xl);
        overflow: hidden;
        cursor: pointer;
        transition: all var(--transition-bounce);
        border: 2px solid transparent;
        box-shadow: var(--shadow-lg);
    }

    .bubble-image:hover {
        transform: scale(1.05) rotate(1deg);
        border-color: var(--primary);
        box-shadow: 0 25px 40px var(--primary-glow);
    }

    .bubble-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: var(--transition-base);
    }

    .bubble-image:hover img {
        transform: scale(1.1);
    }

    /* ===== FILE BUBBLE ===== */
    .bubble-file {
        display: flex;
        align-items: center;
        gap: clamp(10px, 2vw, 15px);
        padding: clamp(10px, 2vw, 12px) clamp(15px, 3vw, 20px);
        background: rgba(255, 255, 255, 0.08);
        border-radius: var(--radius-lg);
        font-size: clamp(0.85rem, 1.8vw, 0.95rem);
        transition: all var(--transition-base);
        flex-wrap: wrap;
    }

    .bubble-file:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateX(8px);
    }

    .bubble-file i {
        font-size: clamp(1.5rem, 3vw, 2rem);
        color: var(--primary);
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .bubble-file .action-btn {
        width: clamp(32px, 5vw, 36px);
        height: clamp(32px, 5vw, 36px);
        font-size: clamp(0.9rem, 1.5vw, 1rem);
    }

    /* ===== MESSAGE META ===== */
    .msg-meta {
        font-size: clamp(0.65rem, 1.2vw, 0.75rem);
        color: var(--text-muted);
        margin-top: clamp(4px, 1vw, 8px);
        display: flex;
        align-items: center;
        gap: clamp(4px, 1vw, 8px);
        padding: 0 4px;
    }

    .msg-row.mine .msg-meta {
        justify-content: flex-end;
    }

    .tick {
        color: var(--text-muted);
        transition: var(--transition-base);
    }

    .tick.read {
        color: #60a5fa;
        animation: tickPop 0.3s ease;
    }

    @keyframes tickPop {
        0% { transform: scale(0); }
        80% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* ===== DATE DIVIDER ===== */
    .date-divider {
        text-align: center;
        font-size: clamp(0.7rem, 1.3vw, 0.8rem);
        color: var(--text-muted);
        padding: clamp(15px, 2.5vw, 20px) 0;
        position: relative;
        margin: clamp(5px, 1vw, 10px) 0;
    }

    .date-divider span {
        background: rgba(17, 17, 17, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: clamp(6px, 1.5vw, 8px) clamp(16px, 3vw, 24px);
        border-radius: var(--radius-full);
        border: 1px solid var(--border-glow);
        box-shadow: var(--shadow-md);
        animation: fadeScale 0.5s ease;
        display: inline-block;
    }

    @keyframes fadeScale {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .date-divider::before,
    .date-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: calc(50% - 120px);
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--primary), transparent);
    }

    @media (max-width: 768px) {
        .date-divider::before,
        .date-divider::after {
            width: calc(50% - 80px);
        }
    }

    @media (max-width: 480px) {
        .date-divider::before,
        .date-divider::after {
            width: calc(50% - 60px);
        }
    }

    .date-divider::before { left: 0; }
    .date-divider::after { right: 0; }

    /* ===== INPUT AREA ===== */
    .input-area {
        height: var(--input-height-lg);
        min-height: 70px;
        padding: 0 clamp(16px, 3vw, 30px);
        background: rgba(15, 15, 15, 1); /* Solid background */
        backdrop-filter: blur(20px);
        border-top: 1px solid var(--border-glow);
        display: flex;
        align-items: center;
        gap: clamp(10px, 2vw, 15px);
        position: relative;
        flex-shrink: 0;
        z-index: 50;
    }

    @media (max-width: 1200px) {
        .input-area {
            height: var(--input-height-lg);
        }
    }

    @media (max-width: 992px) {
        .input-area {
            height: var(--input-height-md);
            padding: 0 20px;
        }
    }

    @media (max-width: 768px) {
        .input-area {
            height: var(--input-height-sm);
            padding: 0 16px;
        }
    }

    @media (max-width: 576px) {
        .input-area {
            height: var(--input-height-xs);
            gap: 8px;
        }
    }

    .input-area::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary), var(--primary-dark), var(--primary), transparent);
        animation: borderGlow 3s linear infinite;
    }

    /* ===== EMOJI & ATTACH BUTTONS ===== */
    .emoji-btn, .attach-btn {
        width: clamp(44px, 6vw, 52px);
        height: clamp(44px, 6vw, 52px);
        border-radius: var(--radius-full);
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: clamp(1.2rem, 2.2vw, 1.4rem);
        transition: all var(--transition-bounce);
        flex-shrink: 0;
        color: var(--text-secondary);
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .emoji-btn, .attach-btn {
            width: 38px;
            height: 38px;
            font-size: 1.1rem;
        }
    }

    .emoji-btn::before, .attach-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        opacity: 0;
        transition: var(--transition-base);
        z-index: -1;
    }

    .emoji-btn:hover, .attach-btn:hover {
        background: transparent;
        color: white;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 10px 30px var(--primary-glow);
        border-color: transparent;
    }

    .emoji-btn:hover::before, .attach-btn:hover::before {
        opacity: 1;
    }

    /* ===== INPUT WRAPPER ===== */
    .msg-input-wrap {
        flex: 1;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        padding: clamp(6px, 1.2vw, 8px) clamp(15px, 2.5vw, 20px);
        transition: all var(--transition-smooth);
        position: relative;
        overflow: hidden;
        height: clamp(48px, 7vw, 56px);
    }

    .msg-input-wrap:focus-within {
        border-color: var(--primary);
        background: rgba(239, 68, 68, 0.05);
        box-shadow: 0 0 40px var(--primary-glow);
    }

    .msg-input-wrap::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark), var(--primary));
        border-radius: var(--radius-full);
        opacity: 0;
        transition: var(--transition-base);
        z-index: -1;
    }

    .msg-input-wrap:focus-within::before {
        opacity: 0.5;
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    #msg-input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        color: var(--text-primary);
        font-size: clamp(0.9rem, 1.8vw, 1rem);
        resize: none;
        max-height: 100px;
        font-family: inherit;
        line-height: 1.5;
        padding: clamp(4px, 1vw, 8px) 0;
    }

    #msg-input::placeholder {
        color: var(--text-dim);
        transition: var(--transition-base);
        font-size: clamp(0.85rem, 1.6vw, 0.95rem);
    }

    #msg-input:focus::placeholder {
        opacity: 0.3;
        transform: translateX(15px);
    }

    /* ===== SEND BUTTON ===== */
    .send-btn {
        width: clamp(48px, 7vw, 56px);
        height: clamp(48px, 7vw, 56px);
        border-radius: var(--radius-full);
        border: none;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        font-size: clamp(1.1rem, 2.2vw, 1.3rem);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-bounce);
        flex-shrink: 0;
        box-shadow: 0 10px 30px var(--primary-glow);
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .send-btn {
            width: 42px;
            height: 42px;
            font-size: 1.1rem;
        }
    }

    .send-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        opacity: 0;
        transition: var(--transition-base);
    }

    .send-btn:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 20px 50px var(--primary-glow);
    }

    .send-btn:hover::before {
        opacity: 1;
    }

    .send-btn:active {
        transform: translateY(0) scale(0.95);
    }

    .send-btn i {
        position: relative;
        z-index: 1;
        transition: var(--transition-base);
    }

    .send-btn:hover i {
        transform: translateX(5px) rotate(45deg);
    }

    /* ===== EMOJI PICKER ===== */
    .emoji-picker-wrap {
        position: absolute;
        bottom: clamp(80px, 10vh, 90px);
        left: clamp(16px, 3vw, 30px);
        background: rgba(17, 17, 17, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--border-glow);
        border-radius: var(--radius-2xl);
        padding: clamp(16px, 3vw, 25px);
        width: min(380px, 90vw);
        max-width: calc(100vw - 32px);
        display: none;
        z-index: var(--z-modal);
        box-shadow: var(--shadow-2xl);
        animation: scaleIn 0.3s var(--transition-bounce);
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .emoji-picker-wrap.show {
        display: block;
    }

    .emoji-category {
        margin-bottom: clamp(12px, 2vw, 20px);
    }

    .emoji-cat-title {
        font-size: clamp(0.7rem, 1.3vw, 0.8rem);
        color: var(--text-muted);
        margin-bottom: clamp(8px, 1.5vw, 12px);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .emoji-grid {
        display: flex;
        flex-wrap: wrap;
        gap: clamp(4px, 1vw, 8px);
    }

    .emoji-item {
        width: clamp(36px, 6vw, 42px);
        height: clamp(36px, 6vw, 42px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.4rem, 2.5vw, 1.6rem);
        cursor: pointer;
        border-radius: var(--radius-md);
        transition: all var(--transition-bounce);
        background: transparent;
    }

    .emoji-item:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        transform: scale(1.2) rotate(5deg);
        box-shadow: 0 10px 25px var(--primary-glow);
    }

    /* ===== FILE PREVIEW ===== */
    .file-preview-box {
        display: none;
        align-items: center;
        gap: clamp(12px, 2vw, 20px);
        padding: clamp(12px, 2vw, 16px) clamp(16px, 3vw, 30px);
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.05));
        border-top: 2px solid var(--primary);
        font-size: clamp(0.85rem, 1.6vw, 0.95rem);
        animation: slideDown 0.3s ease;
        height: clamp(60px, 8vh, 80px);
    }

    .file-preview-box.show {
        display: flex;
    }

    .file-preview-box img {
        height: clamp(40px, 6vh, 50px);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        transition: var(--transition-base);
    }

    .file-preview-box img:hover {
        transform: scale(1.1) rotate(2deg);
        box-shadow: var(--shadow-lg);
    }

    .remove-file {
        cursor: pointer;
        color: var(--primary);
        margin-left: auto;
        width: clamp(36px, 5vw, 40px);
        height: clamp(36px, 5vw, 40px);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(239, 68, 68, 0.15);
        transition: all var(--transition-bounce);
    }

    .remove-file:hover {
        background: var(--primary);
        color: white;
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 0 20px var(--primary-glow);
    }

    /* ===== TYPING INDICATOR ===== */
    .typing-indicator {
        display: none;
        align-items: center;
        gap: clamp(6px, 1.2vw, 8px);
        padding: clamp(10px, 2vw, 14px) clamp(18px, 3vw, 24px);
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: var(--radius-full);
        border: 1px solid var(--border-glow);
        width: fit-content;
        margin: clamp(8px, 1.5vw, 10px) clamp(16px, 3vw, 30px);
        animation: slideUp 0.3s ease;
    }

    .typing-indicator.show {
        display: flex;
    }

    .typing-dot {
        width: clamp(8px, 1.5vw, 10px);
        height: clamp(8px, 1.5vw, 10px);
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        animation: typingBounce 1.2s ease-in-out infinite;
    }

    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingBounce {
        0%, 80%, 100% {
            transform: translateY(0);
            opacity: 0.5;
        }
        40% {
            transform: translateY(-12px);
            opacity: 1;
        }
    }

    /* ===== CALL MODAL ===== */
    .call-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        z-index: var(--z-modal);
        display: none;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .call-modal.show {
        display: flex;
    }

    .call-modal-card {
        background: linear-gradient(135deg, #1a1a1a, #0a0a0a);
        border: 1px solid var(--border-glow);
        border-radius: var(--radius-3xl);
        padding: clamp(30px, 5vw, 60px) clamp(20px, 4vw, 60px);
        text-align: center;
        width: min(400px, 90%);
        box-shadow: var(--shadow-2xl);
        animation: modalPop 0.6s var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }

    .call-modal-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 30%, var(--primary-glow), transparent 70%);
        opacity: 0.4;
        animation: pulseGlow 2s ease-in-out infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }

    @keyframes modalPop {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        80% {
            transform: scale(1.05);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .call-avatar-big {
        width: clamp(100px, 15vw, 140px);
        height: clamp(100px, 15vw, 140px);
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        margin: 0 auto clamp(20px, 3vw, 30px);
        animation: callPulse 2s ease-in-out infinite;
        border: 4px solid var(--border-glow);
        box-shadow: 0 0 80px var(--primary-glow);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .call-avatar-big img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @keyframes callPulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 40px var(--primary-glow);
        }
        50% {
            transform: scale(1.1);
            box-shadow: 0 0 100px var(--primary-glow);
        }
    }

    .call-type-badge {
        display: inline-block;
        padding: clamp(8px, 1.5vw, 10px) clamp(20px, 4vw, 32px);
        background: rgba(239, 68, 68, 0.15);
        color: var(--primary);
        border-radius: var(--radius-full);
        font-size: clamp(0.85rem, 1.5vw, 1rem);
        font-weight: 600;
        margin-bottom: clamp(12px, 2vw, 20px);
        border: 1px solid var(--border-glow);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        animation: slideDown 0.5s ease;
    }

    .call-status {
        color: var(--text-muted);
        font-size: clamp(0.95rem, 1.8vw, 1.1rem);
        margin: clamp(15px, 2.5vw, 25px) 0;
        animation: blink 1.5s infinite;
    }

    .call-actions {
        display: flex;
        gap: clamp(20px, 3vw, 30px);
        justify-content: center;
        margin-top: clamp(20px, 4vw, 35px);
    }

    .call-end-btn {
        width: clamp(60px, 10vw, 80px);
        height: clamp(60px, 10vw, 80px);
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        font-size: clamp(1.5rem, 3vw, 2rem);
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        transition: all var(--transition-bounce);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 40px rgba(239, 68, 68, 0.6);
        position: relative;
        overflow: hidden;
    }

    .call-end-btn:hover {
        transform: scale(1.2) rotate(5deg);
        box-shadow: 0 25px 60px rgba(239, 68, 68, 0.8);
    }

    .call-end-btn i {
        animation: shake 0.5s ease-in-out infinite;
    }

    @keyframes shake {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }

    /* ===== LIGHTBOX ===== */
    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.98);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        z-index: var(--z-toast);
        display: none;
        align-items: center;
        justify-content: center;
        cursor: zoom-out;
        animation: fadeIn 0.3s ease;
    }

    .lightbox.show {
        display: flex;
    }

    .lightbox img {
        max-width: 90vw;
        max-height: 90vh;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-2xl);
        animation: zoomIn 0.5s var(--transition-bounce);
        border: 2px solid var(--border-glow);
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.5);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* ===== ENCRYPTION BADGE ===== */
    .encryption-badge {
        text-align: center;
        color: var(--text-muted);
        font-size: clamp(0.7rem, 1.3vw, 0.8rem);
        padding: clamp(15px, 2.5vw, 20px);
        animation: fadeIn 1s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: clamp(8px, 1.5vw, 10px);
        letter-spacing: 0.5px;
    }

    .encryption-badge i {
        color: var(--primary);
        animation: lockPulse 2s ease-in-out infinite;
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
    }

    @keyframes lockPulse {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.2); }
    }

    /* ===== LOADING SPINNER ===== */
    .loading-spinner {
        width: clamp(40px, 6vw, 50px);
        height: clamp(40px, 6vw, 50px);
        border: 3px solid var(--glass-border);
        border-top-color: var(--primary);
        border-right-color: var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: clamp(20px, 4vw, 30px) auto;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* ===== PULSE RING ===== */
    .pulse-ring {
        position: relative;
    }

    .pulse-ring::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 2px solid var(--primary);
        animation: ringPulse 2s ease-out infinite;
    }

    @keyframes ringPulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    /* ===== UTILITY CLASSES ===== */
    .hover-lift {
        transition: var(--transition-base);
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .gradient-text {
        background: linear-gradient(135deg, #fff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ===== MARGIN UTILITIES ===== */
    .m-0 { margin: 0; }
    .m-1 { margin: 4px; }
    .m-2 { margin: 8px; }
    .m-3 { margin: 12px; }
    .m-4 { margin: 16px; }
    .m-5 { margin: 20px; }

    .mt-1 { margin-top: 4px; }
    .mt-2 { margin-top: 8px; }
    .mt-3 { margin-top: 12px; }
    .mt-4 { margin-top: 16px; }
    .mt-5 { margin-top: 20px; }

    .mb-1 { margin-bottom: 4px; }
    .mb-2 { margin-bottom: 8px; }
    .mb-3 { margin-bottom: 12px; }
    .mb-4 { margin-bottom: 16px; }
    .mb-5 { margin-bottom: 20px; }

    .ml-1 { margin-left: 4px; }
    .ml-2 { margin-left: 8px; }
    .ml-3 { margin-left: 12px; }
    .ml-4 { margin-left: 16px; }
    .ml-5 { margin-left: 20px; }

    .mr-1 { margin-right: 4px; }
    .mr-2 { margin-right: 8px; }
    .mr-3 { margin-right: 12px; }
    .mr-4 { margin-right: 16px; }
    .mr-5 { margin-right: 20px; }

    /* ===== PADDING UTILITIES ===== */
    .p-0 { padding: 0; }
    .p-1 { padding: 4px; }
    .p-2 { padding: 8px; }
    .p-3 { padding: 12px; }
    .p-4 { padding: 16px; }
    .p-5 { padding: 20px; }
</style>
@endpush

@section('content')
<div class="chat-wrapper" id="chatWrapper">
    {{-- Sidebar Toggle Button (Mobile) --}}
    <button class="sidebar-toggle" onclick="toggleChatSidebar()" id="chatSidebarToggle">
        <i class="fa-solid fa-comments"></i>
    </button>

    {{-- ===== USER LIST PANEL (SIDEBAR) ===== --}}
    <div class="user-list-panel" id="userListPanel">
        <div class="panel-header">
            <h2>
                <i class="fa-brands fa-whatsapp"></i>
                Chat Inbox
            </h2>
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Search conversations...">
            </div>
            <div class="unread-stats">
                <span><i class="fa-regular fa-envelope mr-2"></i>Total unread</span>
                <strong id="sidebarUnread">0</strong>
            </div>
        </div>

        <div class="user-list" id="userList">
            <!-- User items will be dynamically loaded here -->
        </div>
    </div>

    {{-- ===== MAIN CHAT AREA ===== --}}
    <div class="main-chat-area" id="mainChatArea">
        {{-- Chat Header --}}
        <div class="chat-header">
            <button class="menu-btn" onclick="toggleChatSidebar()" id="chatMenuBtn">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a href="{{ route('home') }}" class="back-btn" title="Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="chat-avatar pulse-ring" id="chatAvatar">
                <span id="chatAvatarText">AD</span>
                <img id="chatAvatarImg" src="" alt="" style="display: none;">
                <span class="online-dot" id="adminOnlineDot"></span>
            </div>

            <div class="header-info">
                <h3 class="gradient-text" id="chatUserName">@isset($admin){{ $admin->name }}@else Support Admin @endisset</h3>
                <p class="header-status" id="adminStatusText">
                    <span>Synchronizing...</span>
                </p>
            </div>

            <div class="header-actions">
                <button class="action-btn green" onclick="startCall('audio')" title="Voice Call">
                    <i class="fa-solid fa-phone"></i>
                </button>
                <button class="action-btn green" onclick="startCall('video')" title="Video Call">
                    <i class="fa-solid fa-video"></i>
                </button>
            </div>
        </div>

        {{-- File Preview --}}
        <div class="file-preview-box" id="filePreviewBox">
            <span id="filePreviewContent"></span>
            <span class="remove-file" onclick="removeFile()">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>

        {{-- Messages Area --}}
        <div class="messages-area" id="messagesArea">
            <div class="encryption-badge">
                <i class="fa-solid fa-lock"></i>
                <span>End-to-end encrypted</span>
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <div class="loading-spinner" id="loadingSpinner"></div>
        </div>

        {{-- Typing Indicator --}}
        <div class="typing-indicator" id="typingIndicator">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        </div>

        {{-- Input Area --}}
        <div class="input-area">
            <button class="emoji-btn" id="emojiBtn" onclick="toggleEmoji()" title="Emoji">
                <i class="fa-regular fa-face-smile"></i>
            </button>

            <div class="msg-input-wrap">
                <textarea id="msg-input" placeholder="Type a message..." rows="1"
                    onkeydown="handleKeyDown(event)"
                    oninput="autoResize(this)"></textarea>
            </div>

            <button class="attach-btn" onclick="document.getElementById('fileInput').click()" title="Attach">
                <i class="fa-solid fa-paperclip"></i>
            </button>
            <input type="file" id="fileInput" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx" style="display:none" onchange="handleFileSelect(this)">

            <button class="send-btn" onclick="sendMessage()" id="sendBtn" title="Send">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>

        {{-- Emoji Picker --}}
        <div class="emoji-picker-wrap" id="emojiPicker">
            <div class="emoji-category">
                <div class="emoji-cat-title">😊 Smileys</div>
                <div class="emoji-grid" id="emojiGrid"></div>
            </div>
            <div class="emoji-category">
                <div class="emoji-cat-title">❤️ Hearts</div>
                <div class="emoji-grid" id="heartsGrid"></div>
            </div>
            <div class="emoji-category">
                <div class="emoji-cat-title">👋 Gestures</div>
                <div class="emoji-grid" id="gesturesGrid"></div>
            </div>
        </div>
    </div>
</div>

{{-- Call Modal --}}
<div class="call-modal" id="callModal">
    <div class="call-modal-card">
        <div class="call-avatar-big" id="callAvatarBig"></div>
        <div class="call-type-badge" id="callTypeBadge">Voice Call</div>
        <h3 class="gradient-text" id="callUserName" style="font-size:1.8rem;font-weight:800;margin:0 0 15px;">Support Admin</h3>
        <p class="call-status" id="callStatusText">Calling...</p>
        <div class="call-actions">
            <button class="call-end-btn" onclick="endCall()">
                <i class="fa-solid fa-phone-slash"></i>
            </button>
        </div>
    </div>
</div>

{{-- Image Lightbox --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <img id="lightboxImg" src="" alt="Image">
</div>
@endsection

@push('scripts')
<script>
// ======================================================
// CONFIGURATION
// ======================================================
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
const USER_NAME = "{{ Auth::user()->name ?? 'User' }}";
const USER_ID = "{{ Auth::id() ?? 1 }}";
const ADMIN_ID = "{{ $admin->id ?? 1 }}";
const ADMIN_NAME = "{{ $admin->name ?? 'Support Admin' }}";
const ADMIN_AVATAR = "{{ $admin->profile->profile_photo_url ?? '' }}";
const ADMIN_HAS_PHOTO = {{ isset($admin->profile) && $admin->profile->profile_photo ? 'true' : 'false' }};

// ======================================================
// STATE MANAGEMENT
// ======================================================
let currentUserId = ADMIN_ID;
let users = [];
let messages = {};
let selectedFile = null;
let lastMsgCount = 0;
let lastDate = null;
let callTimer = null;
let typingTimer = null;
let isSidebarVisible = window.innerWidth > 768;
let newMessageSound = new Audio('https://assets.mixkit.co/active_storage/sfx/2354/2354-preview.mp3');

// ======================================================
// EMOJI DATA
// ======================================================
const emojis = {
    smileys: ['😀','😁','😂','🤣','😃','😄','😅','😆','😉','😊','😋','😎','😍','🥰','😘','🤩','😏','😒','😞','😢','😭','😤','😔','😕','😟','😯','😲','😳','😨','😰','😥','😓','🤗','🤔','🤭','🤫','🤥','😶','😐','😑','😬','🙄','😯','😦','😧','😮','😲','😴','🤤','😪','😵','🤐','🥴','🤢','🤮','🤧','😷','🤒','🤕','🤑','🤠','😈','👿','👹','👺','🤡','💩','👻','💀','☠️','👽','👾','🤖','🎃','😺','😸','😹','😻','😼','😽','🙀','😿','😾'],
    hearts: ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❣️','💕','💞','💓','💗','💖','💘','💝','💟','☮️','✝️','☪️','🕉️','☸️','✡️','🔯','🕎','☯️','☦️','🛐','⛎','♈','♉','♊','♋','♌','♍','♎','♏','♐','♑','♒','♓','🆔','⚛️','🉑','☢️','☣️','📴','📳','🈶','🈚','🈸','🈺','🈷️','✴️','🆚','💮','🉐','㊙️','㊗️','🈴','🈵','🈹','🈲','🅰️','🅱️','🆎','🆑','🅾️','🆘','❌','⭕','🛑','⛔','📛','🚫','💯','💢','♨️','🚷','🚯','🚳','🚱','🔞','📵','🚭','❗','❕','❓','❔','‼️','⁉️','🔅','🔆','〽️','⚠️','🚸','🔱','⚜️','🔰','♻️','✅','🈯️','💹','❇️','✳️','❎','🌐','💠','Ⓜ️','🌀','💤','🏧','🚹','🚺','🚼','🚻','🚮','🎦','📶','🈁','🔣','ℹ️','🔤','🔡','🔠','🔢','🔣','🔤','🆙','🆒','🆓','🆕','🆖'],
    gestures: ['👋','🤚','🖐️','✋','🖖','👌','🤌','🤏','✌️','🤞','🫰','🤟','🤘','🤙','👈','👉','👆','🖕','👇','☝️','👍','👎','✊','👊','🤛','🤜','👏','🙌','🫶','👐','🤲','🤝','🙏','✍️','💅','🤳','💪','🦾','🦵','🦿','🦶','👣','👀','🫀','🫁','🧠','🦷','🦴','👅','👄','🫦','💋','🩸']
};

function buildEmojiPicker() {
    const fill = (id, list) => {
        const g = document.getElementById(id);
        if (!g) return;
        g.innerHTML = '';
        list.slice(0, 24).forEach(e => {
            const d = document.createElement('div');
            d.className = 'emoji-item hover-lift';
            d.textContent = e;
            d.onclick = () => insertEmoji(e);
            g.appendChild(d);
        });
    };
    fill('emojiGrid', emojis.smileys);
    fill('heartsGrid', emojis.hearts);
    fill('gesturesGrid', emojis.gestures);
}

function toggleEmoji() {
    const picker = document.getElementById('emojiPicker');
    if (picker) picker.classList.toggle('show');
}

function insertEmoji(e) {
    const input = document.getElementById('msg-input');
    if (!input) return;
    
    const start = input.selectionStart;
    const end = input.selectionEnd;
    input.value = input.value.slice(0, start) + e + input.value.slice(end);
    input.setSelectionRange(start + e.length, start + e.length);
    input.focus();
    
    input.style.transform = 'scale(1.02)';
    setTimeout(() => input.style.transform = 'scale(1)', 200);
}

document.addEventListener('click', e => {
    const picker = document.getElementById('emojiPicker');
    const btn = document.getElementById('emojiBtn');
    if (picker && btn && !picker.contains(e.target) && !btn.contains(e.target)) {
        picker.classList.remove('show');
    }
});

// ======================================================
// SIDEBAR FUNCTIONS
// ======================================================
function toggleChatSidebar() {
    const panel = document.getElementById('userListPanel');
    const toggle = document.getElementById('chatSidebarToggle');
    if (!panel || !toggle) return;
    
    isSidebarVisible = !isSidebarVisible;
    
    if (isSidebarVisible) {
        panel.classList.add('show');
        toggle.innerHTML = '<i class="fa-solid fa-times"></i>';
    } else {
        panel.classList.remove('show');
        toggle.innerHTML = '<i class="fa-solid fa-comments"></i>';
    }
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768) {
        const panel = document.getElementById('userListPanel');
        const toggle = document.getElementById('chatSidebarToggle');
        
        if (panel && toggle && !panel.contains(e.target) && !toggle.contains(e.target) && isSidebarVisible) {
            toggleChatSidebar();
        }
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        const panel = document.getElementById('userListPanel');
        const toggle = document.getElementById('chatSidebarToggle');
        if (panel && toggle) {
            panel.classList.remove('show');
            isSidebarVisible = false;
            toggle.innerHTML = '<i class="fa-solid fa-comments"></i>';
        }
    }
});

// ======================================================
// USER LIST FUNCTIONS
// ======================================================
function fetchUsers() {
    // For users, they only ever chat with the Admin
    users = [
        {
            id: ADMIN_ID,
            name: ADMIN_NAME,
            avatar: ADMIN_AVATAR,
            hasPhoto: ADMIN_HAS_PHOTO,
            isAdmin: true,
            isOnline: false,
            lastMessage: 'Support Team',
            lastMessageTime: '',
            unread: 0
        }
    ];
    renderUserList();
}

function renderUserList() {
    const container = document.getElementById('userList');
    if (!container) return;
    
    container.innerHTML = '';
    
    users.forEach((user, index) => {
        const userEl = createUserElement(user, index);
        container.appendChild(userEl);
    });
    
    updateUnreadCount();
}

function createUserElement(user, index) {
    const div = document.createElement('div');
    div.className = `user-item ${user.id === currentUserId ? 'active' : ''}`;
    div.dataset.userId = user.id;
    div.onclick = () => switchUser(user.id);
    
    const avatarInitials = user.name.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase();
    
    div.innerHTML = `
        <div class="user-item-avatar">
            ${user.hasPhoto && user.avatar ? `<img src="${user.avatar}" alt="${user.name}">` : avatarInitials}
            <span class="status-dot-sidebar ${user.isOnline ? '' : 'offline'}"></span>
        </div>
        <div class="user-item-info">
            <div class="user-item-name">
                ${user.name}
                ${user.isAdmin ? '<i class="fa-solid fa-circle-check verified-icon" title="Verified Admin"></i>' : ''}
                ${user.isAdmin ? '<span class="user-item-badge">Admin</span>' : ''}
            </div>
            <div class="user-item-preview">
                <i class="fa-regular fa-message preview-icon"></i>
                <span id="preview-${user.id}">${user.lastMessage}</span>
            </div>
        </div>
        <div class="user-item-time" id="time-${user.id}">${user.lastMessageTime}</div>
    `;
    
    // Add animation delay
    div.style.animationDelay = `${index * 0.1}s`;
    
    return div;
}

function switchUser(userId) {
    currentUserId = userId;
    
    // Update active state in user list
    document.querySelectorAll('.user-item').forEach(item => {
        item.classList.remove('active');
        if (item.dataset.userId == userId) {
            item.classList.add('active');
        }
    });
    
    // Update chat header
    const user = users.find(u => u.id == userId);
    if (user) {
        const userNameEl = document.getElementById('chatUserName');
        const avatarText = document.getElementById('chatAvatarText');
        const avatarImg = document.getElementById('chatAvatarImg');
        const onlineDot = document.getElementById('adminOnlineDot');
        const statusText = document.getElementById('adminStatusText');
        
        if (userNameEl) userNameEl.textContent = user.name;
        
        if (avatarText && avatarImg) {
            if (user.hasPhoto) {
                avatarText.style.display = 'none';
                avatarImg.style.display = 'block';
                avatarImg.src = user.avatar;
            } else {
                avatarText.style.display = 'flex';
                avatarImg.style.display = 'none';
                avatarText.textContent = user.name.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase();
            }
        }
        
        // Update online status
        if (onlineDot && statusText) {
            if (user.isOnline) {
                onlineDot.classList.remove('offline');
                statusText.innerHTML = '<span>Online</span>';
                statusText.classList.remove('offline');
            } else {
                onlineDot.classList.add('offline');
                statusText.innerHTML = '<span>Offline</span>';
                statusText.classList.add('offline');
            }
        }
    }
    
    // Close sidebar on mobile after selecting user
    if (window.innerWidth <= 768 && isSidebarVisible) {
        toggleChatSidebar();
    }
    
    // Fetch messages for this user
    fetchUserMessages(userId);
}

async function fetchUserMessages(userId) {
    try {
        const response = await fetch("{{ route('chat.messages') }}");
        const data = await response.json();
        
        if (data.messages) {
            messages[userId] = data.messages;
            renderMessages(userId);
        }
    } catch (err) {
        console.error("Failed to fetch messages:", err);
    }
}

function renderMessages(userId) {
    const area = document.getElementById('messagesArea');
    if (!area) return;
    
    const userMessages = messages[userId] || [];
    
    area.innerHTML = `<div class="encryption-badge"><i class="fa-solid fa-lock"></i><span>End-to-end encrypted</span><i class="fa-solid fa-lock"></i></div>`;
    lastDate = null;
    
    userMessages.forEach(msg => {
        maybeAddDateDivider(area, msg.time);
        area.appendChild(renderBubble(msg));
    });
    
    lastMsgCount = userMessages.length;
    area.scrollTo({
        top: area.scrollHeight,
        behavior: 'smooth'
    });
}

// ======================================================
// MESSAGES
// ======================================================
function renderBubble(msg) {
    const row = document.createElement('div');
    row.className = `msg-row ${msg.is_mine ? 'mine' : ''}`;
    row.dataset.id = msg.id;

    const av = document.createElement('div');
    av.className = 'msg-avatar-small hover-lift';
    
    const sender = msg.is_mine ? USER_NAME : (users.find(u => u.id == currentUserId)?.name || 'User');
    const avatarUrl = msg.avatar; 
    const avatarInitials = sender.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase();

    // Use image if available, otherwise initials
    if (avatarUrl) {
        av.innerHTML = `<img src="${avatarUrl}" alt="${sender}">`;
    } else {
        av.textContent = avatarInitials;
    }

    const content = document.createElement('div');
    const bubble = document.createElement('div');
    bubble.className = `bubble ${msg.is_mine ? 'mine' : 'theirs'}`;

    if (msg.type === 'image' && msg.file_url) {
        bubble.className = `bubble-image ${msg.is_mine ? 'mine' : ''}`;
        bubble.style.padding = '0';
        bubble.innerHTML = `<img src="${msg.file_url}" alt="Image" onclick="openLightbox('${msg.file_url}')">`;
        if (msg.body) {
            const cap = document.createElement('div');
            cap.className = `bubble ${msg.is_mine ? 'mine' : 'theirs'}`;
            cap.style.marginTop = '8px';
            cap.textContent = msg.body;
            content.appendChild(bubble);
            content.appendChild(cap);
        }
    } else if (msg.type === 'file' && msg.file_url) {
        bubble.innerHTML = `<div class="bubble-file"><i class="fa-solid fa-file"></i><span>${msg.file_name || 'File'}</span><a href="${msg.file_url}" download class="action-btn" style="width:36px;height:36px;"><i class="fa-solid fa-download"></i></a></div>`;
    } else {
        bubble.textContent = msg.body || '';
    }

    const meta = document.createElement('div');
    meta.className = 'msg-meta';
    meta.innerHTML = `${msg.time} ${msg.is_mine ? `<span class="tick ${msg.read_at ? 'read' : ''}">✓✓</span>` : ''}`;

    if (!content.children.length) content.appendChild(bubble);
    content.appendChild(meta);

    row.appendChild(av);
    row.appendChild(content);

    return row;
}

function maybeAddDateDivider(area, timeStr) {
    const today = new Date().toDateString();
    
    if (lastDate !== today) {
        lastDate = today;
        const div = document.createElement('div');
        div.className = 'date-divider';
        const span = document.createElement('span');
        span.textContent = 'Today';
        div.appendChild(span);
        area.appendChild(div);
    }
}

function updateUnreadCount() {
    const totalUnread = users.reduce((sum, user) => sum + (user.unread || 0), 0);
    const unreadEl = document.getElementById('sidebarUnread');
    if (unreadEl) unreadEl.textContent = totalUnread;
}

async function sendMessage() {
    const input = document.getElementById('msg-input');
    const sendBtn = document.getElementById('sendBtn');
    if (!input || !sendBtn) return;
    
    const body = input.value.trim();
    if (!body && !selectedFile) return;

    sendBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
    sendBtn.disabled = true;

    const formData = new FormData();
    formData.append('body', body);
    if (selectedFile) formData.append('file', selectedFile);
    formData.append('_token', CSRF);

    try {
        const response = await fetch("{{ route('chat.send') }}", {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            const newMsg = data.message;
            if (!messages[currentUserId]) messages[currentUserId] = [];
            messages[currentUserId].push(newMsg);
            
            const area = document.getElementById('messagesArea');
            if (area) {
                maybeAddDateDivider(area, newMsg.time);
                area.appendChild(renderBubble(newMsg));
                area.scrollTo({ top: area.scrollHeight, behavior: 'smooth' });
            }
            
            input.value = '';
            autoResize(input);
            removeFile();
        }
    } catch (err) {
        console.error("Message send failed:", err);
    } finally {
        sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i>';
        sendBtn.disabled = false;
    }
}

function handleKeyDown(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
}

function autoResize(el) {
    if (!el) return;
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 120) + 'px';
}

// ======================================================
// FILE UPLOAD
// ======================================================
function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) return;
    selectedFile = file;
    const box = document.getElementById('filePreviewBox');
    const content = document.getElementById('filePreviewContent');
    
    if (!box || !content) return;
    
    if (file.type.startsWith('image/')) {
        const url = URL.createObjectURL(file);
        content.innerHTML = `<img src="${url}" alt="Preview"> <span style="color:#fff;">${file.name}</span>`;
    } else {
        content.innerHTML = `<i class="fa-solid fa-file" style="color:#ef4444;font-size:2rem;"></i> <span style="color:#fff;">${file.name}</span>`;
    }
    
    box.classList.add('show');
}

function removeFile() {
    selectedFile = null;
    const fileInput = document.getElementById('fileInput');
    const box = document.getElementById('filePreviewBox');
    const content = document.getElementById('filePreviewContent');
    
    if (fileInput) fileInput.value = '';
    if (box) box.classList.remove('show');
    if (content) content.innerHTML = '';
}

// ======================================================
// ONLINE STATUS
// ======================================================
async function pingOnlineStatus() {
    const onlineDot = document.getElementById('adminOnlineDot');
    const statusText = document.getElementById('adminStatusText');
    
    try {
        const response = await fetch("{{ route('chat.ping') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF }
        });
        const data = await response.json();
        
        if (onlineDot && statusText) {
            if (data.admin_online) {
                onlineDot.classList.remove('offline');
                statusText.innerHTML = '<span>Online</span>';
                statusText.classList.remove('offline');
            } else {
                onlineDot.classList.add('offline');
                statusText.innerHTML = `<span>Last seen ${data.admin_last_seen || 'recently'}</span>`;
                statusText.classList.add('offline');
            }
        }
    } catch (err) {
        console.error("Ping failed:", err);
    }
}

// ======================================================
// CALL MODAL
// ======================================================
function startCall(type) {
    const modal = document.getElementById('callModal');
    const badge = document.getElementById('callTypeBadge');
    const avatarBig = document.getElementById('callAvatarBig');
    const userName = document.getElementById('callUserName');
    
    if (!modal || !badge || !avatarBig || !userName) return;
    
    const currentUser = users.find(u => u.id == currentUserId);
    
    if (currentUser?.hasPhoto) {
        avatarBig.innerHTML = `<img src="${currentUser.avatar}" alt="" style="width:100%;height:100%;object-fit:cover;">`;
    } else {
        avatarBig.textContent = currentUser?.name.split(' ').map(n => n[0]).join('').slice(0, 2).toUpperCase() || 'AD';
    }
    
    userName.textContent = currentUser?.name || 'Support Admin';
    badge.textContent = type === 'video' ? '📹 Video Call' : '📞 Voice Call';
    modal.classList.add('show');

    let secs = 0;
    const statusEl = document.getElementById('callStatusText');
    if (!statusEl) return;
    
    if (callTimer) clearInterval(callTimer);
    
    callTimer = setInterval(() => {
        secs++;
        if (secs < 5) statusEl.textContent = 'Calling...';
        else if (secs < 10) statusEl.textContent = 'Ringing...';
        else {
            statusEl.textContent = 'No answer';
            clearInterval(callTimer);
            setTimeout(endCall, 2000);
        }
    }, 1000);
}

function endCall() {
    if (callTimer) clearInterval(callTimer);
    const modal = document.getElementById('callModal');
    if (modal) modal.classList.remove('show');
}

// ======================================================
// LIGHTBOX
// ======================================================
function openLightbox(url) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightboxImg');
    if (lightbox && img) {
        img.src = url;
        lightbox.classList.add('show');
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    if (lightbox) lightbox.classList.remove('show');
}

// ======================================================
// TYPING INDICATOR
// ======================================================
const msgInput = document.getElementById('msg-input');

if (msgInput) {
    msgInput.addEventListener('input', () => {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.classList.add('show');
        
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            if (indicator) indicator.classList.remove('show');
        }, 2000);
    });
}

// ======================================================
// SEARCH
// ======================================================
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const userItems = document.querySelectorAll('.user-item');
        
        userItems.forEach(item => {
            const nameEl = item.querySelector('.user-item-name');
            if (nameEl) {
                const name = nameEl.textContent.toLowerCase();
                item.style.display = name.includes(searchTerm) ? 'flex' : 'none';
            }
        });
    });
}

// ======================================================
// INITIALIZATION
// ======================================================
document.addEventListener('DOMContentLoaded', () => {
    buildEmojiPicker();
    fetchUsers();
    
    // Set initial user to admin
    setTimeout(() => {
        switchUser(ADMIN_ID);
    }, 500);
    
    // Hide loading spinner
    setTimeout(() => {
        const spinner = document.getElementById('loadingSpinner');
        if(spinner) spinner.style.display = 'none';
    }, 1500);
    
    // Set smooth scroll
    const messagesArea = document.getElementById('messagesArea');
    if (messagesArea) messagesArea.style.scrollBehavior = 'smooth';
    
    // Set up intervals
    setInterval(updateUnreadCount, 3000);
    setInterval(pingOnlineStatus, 15000);
    
    // Fade in chat wrapper
    const wrapper = document.getElementById('chatWrapper');
    if (wrapper) {
        wrapper.style.opacity = '0';
        wrapper.style.transition = 'opacity 1s ease-in-out';
        setTimeout(() => wrapper.style.opacity = '1', 100);
    }
});
</script>
@endpush