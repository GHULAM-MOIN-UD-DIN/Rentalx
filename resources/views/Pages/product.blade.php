@extends('layouts.app')

@section('content')

<style>
/* ============================================================
   APEX CATALOG — ULTRA PREMIUM V5.0
   End-Level Design System - Next Generation
============================================================ */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;1,700;1,800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #ef4444;
    --primary-dark: #b91c1c;
    --primary-glow: rgba(239, 68, 68, 0.5);
    --accent: #f59e0b;
    --accent-glow: rgba(245, 158, 11, 0.3);
    --bg-deep: #0a0c0f;
    --bg-darker: #020408;
    --surface-light: rgba(255, 255, 255, 0.03);
    --surface-medium: rgba(255, 255, 255, 0.05);
    --surface-heavy: rgba(255, 255, 255, 0.08);
    --border-light: rgba(255, 255, 255, 0.05);
    --border-medium: rgba(255, 255, 255, 0.08);
    --border-heavy: rgba(255, 255, 255, 0.12);
    --text-primary: #ffffff;
    --text-secondary: #f0f0f0;
    --text-muted: #9ca3af;
    --text-dim: #6b7280;
    --gradient-1: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    --gradient-2: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
    --gradient-3: linear-gradient(135deg, rgba(239,68,68,0.2) 0%, rgba(249,115,22,0.1) 100%);
    --shadow-1: 0 20px 40px -15px rgba(0,0,0,0.5);
    --shadow-2: 0 30px 60px -20px rgba(239,68,68,0.25);
    --shadow-3: 0 0 0 1px rgba(239,68,68,0.1), 0 30px 60px -20px rgba(0,0,0,0.8);
    --blur-1: blur(20px);
    --blur-2: blur(40px);
    --transition-1: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    --transition-2: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--bg-darker);
    color: var(--text-primary);
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow-x: hidden;
    line-height: 1.6;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-deep);
}

::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 20px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

/* ===== HERO SECTION - HOME STYLE UPGRADE ===== */
.hero-section {
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 120px 0 80px;
    background: linear-gradient(90deg, #000000 0%, rgba(0,0,0,0.6) 50%, transparent 100%),
                url('https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
}

@media (max-width: 768px) {
    .hero-section {
        background: linear-gradient(180deg, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.7) 100%),
                    url('https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?q=80&w=800&auto=format&fit=crop') no-repeat center center/cover;
    }
}

.hero-bg {
    display: none; /* Removed for cleaner look like home page */
}

.hero-content {
    position: relative;
    z-index: 10;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    backdrop-filter: blur(12px);
    padding: 10px 24px;
    border-radius: 100px;
    margin-bottom: 32px;
}

.hero-eyebrow-dot {
    width: 8px;
    height: 8px;
    background: var(--primary);
    border-radius: 50%;
    box-shadow: 0 0 20px var(--primary);
    animation: pulse-dot 2s ease-in-out infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.5); }
}

.hero-eyebrow-text {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--primary);
}

.hero-title {
    font-size: clamp(3rem, 10vw, 7rem);
    font-weight: 900;
    line-height: 0.9;
    letter-spacing: -4px;
    text-transform: uppercase;
    margin-bottom: 24px;
    animation: slide-in 1s ease-out 0.1s both;
}

.hero-title-line {
    display: block;
    background: linear-gradient(135deg, #ffffff 30%, #9ca3af 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-title-accent {
    display: block;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-style: italic;
    position: relative;
}

.hero-title-accent::after {
    content: '';
    position: absolute;
    bottom: 10px;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(135deg, rgba(239,68,68,0.2) 0%, rgba(245,158,11,0.2) 100%);
    filter: blur(20px);
    z-index: -1;
}

.hero-description {
    font-size: 1.1rem;
    color: var(--text-muted);
    max-width: 600px;
    margin-bottom: 48px;
    line-height: 1.8;
    animation: slide-in 1s ease-out 0.2s both;
}

@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-container {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    animation: slide-in 1s ease-out 0.3s both;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--surface-light);
    backdrop-filter: var(--blur-1);
    border: 1px solid var(--border-light);
    border-radius: 24px;
    padding: 20px 28px;
    transition: var(--transition-1);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--gradient-3);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.stat-card:hover {
    border-color: rgba(239,68,68,0.3);
    transform: translateY(-5px) scale(1.02);
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    position: relative;
    z-index: 1;
}

.stat-icon-red {
    background: rgba(239,68,68,0.1);
    color: var(--primary);
}

.stat-icon-amber {
    background: rgba(245,158,11,0.1);
    color: var(--accent);
}

.stat-icon-green {
    background: rgba(34,197,94,0.1);
    color: #22c55e;
}

.stat-content {
    position: relative;
    z-index: 1;
}

.stat-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-dim);
    margin-bottom: 4px;
}

.stat-value {
    font-size: 18px;
    font-weight: 900;
    color: var(--text-primary);
}

/* ===== CATALOG SECTION ===== */
.catalog-section {
    padding: 60px 0 120px;
    position: relative;
}

.section-header {
    margin-bottom: 60px;
    text-align: center;
}

.section-subtitle {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 16px;
    display: inline-block;
    background: rgba(239,68,68,0.1);
    padding: 8px 20px;
    border-radius: 100px;
    border: 1px solid rgba(239,68,68,0.2);
}

.section-title {
    font-size: 3rem;
    font-weight: 900;
    line-height: 1.1;
    text-transform: uppercase;
    background: linear-gradient(135deg, #ffffff 30%, #9ca3af 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Filter Panel */
.filter-panel {
    background: rgba(10, 12, 15, 0.8);
    backdrop-filter: var(--blur-2);
    border: 1px solid var(--border-medium);
    border-radius: 40px;
    padding: 40px;
    position: sticky;
    top: 100px;
    box-shadow: var(--shadow-1);
    transition: var(--transition-1);
}

.filter-panel:hover {
    border-color: rgba(239,68,68,0.2);
    box-shadow: var(--shadow-2);
}

.filter-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-light);
}

.filter-header h3 {
    font-size: 20px;
    font-weight: 900;
    font-style: italic;
    background: linear-gradient(135deg, #ffffff, #9ca3af);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.filter-reset {
    width: 40px;
    height: 40px;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-dim);
    transition: var(--transition-1);
}

.filter-reset:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #ffffff;
    transform: rotate(180deg);
}

.filter-section {
    margin-bottom: 28px;
}

.filter-section-title {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--text-dim);
    margin-bottom: 12px;
}

.filter-input-wrapper {
    position: relative;
}

.filter-input {
    width: 100%;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 16px 20px;
    font-size: 14px;
    color: var(--text-primary);
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: var(--transition-1);
}

.filter-input:focus {
    outline: none;
    border-color: var(--primary);
    background: rgba(239,68,68,0.05);
    box-shadow: 0 0 0 4px rgba(239,68,68,0.1);
}

.filter-icon {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-dim);
    pointer-events: none;
}

.filter-select {
    appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23ef4444' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
    padding-right: 52px !important;
    font-weight: 600;
}

.filter-select:hover {
    border-color: var(--primary);
    background-color: rgba(239, 68, 68, 0.05);
}

.filter-select option {
    background: #111;
    color: #fff;
    padding: 15px;
}

.price-range-container {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 20px;
}

.price-range {
    width: 100%;
    height: 4px;
    background: var(--surface-heavy);
    border-radius: 10px;
    outline: none;
    -webkit-appearance: none;
}

.price-range::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background: var(--primary);
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 0 20px var(--primary);
    transition: var(--transition-1);
}

.price-range::-webkit-slider-thumb:hover {
    transform: scale(1.2);
}

.price-values {
    display: flex;
    justify-content: space-between;
    margin-top: 16px;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-dim);
}

.price-value {
    font-size: 16px;
    font-weight: 900;
    color: var(--primary);
    background: rgba(239,68,68,0.1);
    padding: 6px 12px;
    border-radius: 12px;
}

.filter-actions {
    display: flex;
    gap: 12px;
    margin-top: 32px;
}

.filter-apply {
    flex: 1;
    background: var(--gradient-1);
    border: none;
    border-radius: 20px;
    padding: 16px;
    color: #ffffff;
    font-weight: 900;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    cursor: pointer;
    transition: var(--transition-1);
    box-shadow: 0 10px 30px rgba(239,68,68,0.3);
    position: relative;
    overflow: hidden;
}

.filter-apply::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.filter-apply:hover::before {
    width: 300px;
    height: 300px;
}

.filter-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(239,68,68,0.4);
}

/* ===== PRODUCT CARD - ULTRA PREMIUM ===== */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

.product-card {
    position: relative;
    background: linear-gradient(145deg, rgba(20, 22, 25, 0.9) 0%, rgba(10, 12, 15, 0.95) 100%);
    backdrop-filter: var(--blur-1);
    border: 1px solid var(--border-light);
    border-radius: 40px;
    overflow: hidden;
    transition: var(--transition-2);
    cursor: pointer;
    transform-style: preserve-3d;
    perspective: 1000px;
}

.product-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(239,68,68,0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.6s ease;
    z-index: 1;
}

.product-card:hover {
    transform: translateY(-10px) rotateX(2deg);
    border-color: rgba(239,68,68,0.3);
    box-shadow: var(--shadow-3);
}

.product-card:hover::before {
    opacity: 1;
}

/* Image Zone */
.card-image-zone {
    position: relative;
    height: 280px;
    background: radial-gradient(circle at 50% 50%, rgba(239,68,68,0.05) 0%, transparent 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    overflow: hidden;
    z-index: 2;
}

.card-image-zone::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, rgba(2,4,8,0.9) 0%, transparent 100%);
    pointer-events: none;
    z-index: 3;
}

.card-image {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
    filter: drop-shadow(0 20px 30px rgba(0,0,0,0.5));
    transition: var(--transition-2);
    position: relative;
    z-index: 2;
}

.product-card:hover .card-image {
    transform: scale(1.1) translateY(-10px);
    filter: drop-shadow(0 30px 40px rgba(239,68,68,0.3));
}

/* Badges */
.card-badge {
    position: absolute;
    z-index: 10;
    padding: 8px 16px;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 2px;
    text-transform: uppercase;
    border-radius: 100px;
    backdrop-filter: var(--blur-1);
}

.badge-hot {
    top: 20px;
    right: 20px;
    background: rgba(0,0,0,0.7);
    border: 1px solid rgba(245,158,11,0.3);
    color: var(--accent);
    box-shadow: 0 0 20px rgba(245,158,11,0.2);
}

.badge-hot i {
    margin-right: 5px;
    color: var(--accent);
}

.badge-new {
    top: 20px;
    left: 20px;
    background: var(--gradient-1);
    color: #ffffff;
    box-shadow: 0 5px 20px rgba(239,68,68,0.3);
}

/* Quick View Button */
.quick-view-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    width: 60px;
    height: 60px;
    background: var(--gradient-1);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 20px;
    opacity: 0;
    transition: var(--transition-2);
    cursor: pointer;
    z-index: 20;
    box-shadow: 0 0 0 10px rgba(239,68,68,0.2);
}

.product-card:hover .quick-view-btn {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.quick-view-btn:hover {
    transform: translate(-50%, -50%) scale(1.1);
    box-shadow: 0 0 0 15px rgba(239,68,68,0.2);
}

/* Rating Badge */
.rating-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(0,0,0,0.7);
    backdrop-filter: var(--blur-1);
    border: 1px solid var(--border-light);
    border-radius: 100px;
    padding: 8px 16px;
    z-index: 10;
    transition: var(--transition-1);
    cursor: pointer;
}

.rating-badge:hover {
    border-color: var(--accent);
    background: rgba(0,0,0,0.8);
}

.stars {
    display: flex;
    gap: 2px;
    color: var(--accent);
    font-size: 10px;
}

.rating-value {
    font-weight: 900;
    color: #ffffff;
}

.rating-count {
    color: var(--text-dim);
    font-size: 10px;
}

/* Sold Out Overlay */
.sold-out-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.8);
    backdrop-filter: var(--blur-1);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 30;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.product-card.stock-out .sold-out-overlay {
    opacity: 1;
}

.sold-out-text {
    font-size: 28px;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    color: #ffffff;
    background: var(--primary);
    padding: 16px 32px;
    border-radius: 20px;
    transform: rotate(-5deg);
    box-shadow: 0 20px 40px rgba(239,68,68,0.3);
    border: 2px solid rgba(255,255,255,0.1);
}

/* Card Content */
.card-content {
    padding: 24px 24px 28px;
    position: relative;
    z-index: 2;
    background: linear-gradient(to top, rgba(2,4,8,0.95) 0%, rgba(2,4,8,0.8) 100%);
}

.card-category {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 8px;
    display: inline-block;
    background: rgba(239,68,68,0.1);
    padding: 4px 12px;
    border-radius: 100px;
}

.card-title {
    font-size: 18px;
    font-weight: 900;
    line-height: 1.3;
    margin-bottom: 20px;
    color: #ffffff;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 47px;
    transition: color 0.3s ease;
}

.product-card:hover .card-title {
    color: var(--primary);
}

/* Stock Indicator */
.stock-indicator {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    background: var(--surface-light);
    padding: 12px 16px;
    border-radius: 20px;
    border: 1px solid var(--border-light);
}

.stock-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.7; }
}

.dot-high {
    background: #22c55e;
    box-shadow: 0 0 15px #22c55e;
}

.dot-low {
    background: #f97316;
    box-shadow: 0 0 15px #f97316;
}

.dot-out {
    background: #6b7280;
    box-shadow: 0 0 15px #6b7280;
}

.stock-text {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stock-bar-container {
    flex: 1;
    height: 4px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.stock-bar {
    height: 100%;
    border-radius: 10px;
    transition: width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.bar-high {
    background: linear-gradient(90deg, #22c55e, #4ade80);
}

.bar-low {
    background: linear-gradient(90deg, #f97316, #fb923c);
}

.bar-out {
    background: #4b5563;
}

.stock-number {
    font-size: 10px;
    font-weight: 800;
    color: var(--text-dim);
}

/* Reviews Preview */
.reviews-preview {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding: 8px 12px;
    background: var(--surface-light);
    border-radius: 16px;
    cursor: pointer;
    transition: var(--transition-1);
}

.reviews-preview:hover {
    background: rgba(239,68,68,0.1);
}

.mini-stars {
    display: flex;
    gap: 2px;
    color: var(--accent);
    font-size: 8px;
}

.reviews-count {
    font-size: 9px;
    font-weight: 700;
    color: var(--text-dim);
    flex: 1;
}

.reviews-cta {
    font-size: 9px;
    font-weight: 800;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Card Footer */
.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid var(--border-light);
    padding-top: 20px;
    margin-top: 8px;
}

.price-wrapper {
    display: flex;
    flex-direction: column;
}

.price-label {
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-dim);
    margin-bottom: 4px;
}

.price-value-large {
    font-size: 24px;
    font-weight: 900;
    font-style: italic;
    color: #ffffff;
    line-height: 1;
}

.price-currency {
    font-size: 12px;
    font-style: normal;
    color: var(--text-dim);
    margin-right: 2px;
}

.card-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 24px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    transition: var(--transition-2);
    cursor: pointer;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-buy {
    background: var(--gradient-1);
    color: #ffffff;
    box-shadow: 0 8px 20px rgba(239,68,68,0.3);
}

.btn-buy::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-buy:hover::before {
    width: 300px;
    height: 300px;
}

.btn-buy:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(239,68,68,0.4);
}

.btn-notify {
    background: transparent;
    border: 1px solid var(--border-heavy);
    color: var(--text-dim);
    cursor: not-allowed;
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 0;
    background: var(--surface-light);
    border-radius: 60px;
    border: 1px solid var(--border-light);
}

.empty-icon {
    font-size: 80px;
    color: #1f2937;
    margin-bottom: 24px;
}

.empty-title {
    font-size: 32px;
    font-weight: 900;
    font-style: italic;
    color: #374151;
    margin-bottom: 16px;
}

.empty-text {
    font-size: 14px;
    color: #4b5563;
    margin-bottom: 32px;
}

.empty-btn {
    display: inline-block;
    background: var(--surface-heavy);
    border: 1px solid var(--border-heavy);
    padding: 16px 40px;
    border-radius: 30px;
    color: #ffffff;
    font-weight: 800;
    text-decoration: none;
    transition: var(--transition-1);
}

.empty-btn:hover {
    background: var(--primary);
    border-color: var(--primary);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(239,68,68,0.3);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 60px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    color: var(--text-dim);
    font-weight: 800;
    text-decoration: none;
    transition: var(--transition-1);
}

.pagination a:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239,68,68,0.3);
}

.pagination .active span {
    background: var(--gradient-1);
    border-color: var(--primary);
    color: #ffffff;
    box-shadow: 0 8px 20px rgba(239,68,68,0.3);
}

/* ===== QUICK VIEW MODAL - ULTRA PREMIUM ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0,0,0,0.95);
    backdrop-filter: var(--blur-2);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-overlay.open {
    display: flex;
}

.modal-container {
    width: 100%;
    max-width: 1000px;
    max-height: 90vh;
    background: linear-gradient(145deg, #111316 0%, #0a0c0f 100%);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 50px 100px rgba(0,0,0,0.8), 0 0 0 1px rgba(239,68,68,0.1);
    position: relative;
}

.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px 40px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    background: rgba(0,0,0,0.3);
}

.modal-header-content {
    flex: 1;
}

.modal-eyebrow {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 6px;
}

.modal-title {
    font-size: 24px;
    font-weight: 900;
    font-style: italic;
    color: #ffffff;
    line-height: 1.2;
    word-break: break-word;
}

.modal-close {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-dim);
    font-size: 18px;
    cursor: pointer;
    transition: var(--transition-1);
    flex-shrink: 0;
    margin-left: 20px;
}

.modal-close:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #ffffff;
    transform: rotate(90deg);
}

.modal-body {
    overflow-y: auto;
    padding: 40px;
    max-height: calc(90vh - 160px);
    scrollbar-width: thin;
    scrollbar-color: var(--primary) transparent;
}

.modal-body::-webkit-scrollbar {
    width: 4px;
}

.modal-body::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 10px;
}

/* Modal Spinner */
.modal-spinner {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 0;
}

.spinner-ring {
    width: 70px;
    height: 70px;
    border: 3px solid rgba(239,68,68,0.1);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 24px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.spinner-text {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: #4b5563;
}

/* Modal Content */
.modal-summary {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 40px;
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 40px;
    padding: 40px;
    margin-bottom: 40px;
}

@media (max-width: 700px) {
    .modal-summary {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

.rating-overview {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-right: 1px solid rgba(255,255,255,0.05);
    padding-right: 40px;
}

@media (max-width: 700px) {
    .rating-overview {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding-right: 0;
        padding-bottom: 30px;
    }
}

.big-rating {
    font-size: 80px;
    font-weight: 900;
    font-style: italic;
    line-height: 1;
    color: #ffffff;
    margin-bottom: 10px;
}

.rating-stars-large {
    display: flex;
    gap: 6px;
    color: var(--accent);
    font-size: 20px;
    margin: 16px 0;
}

.rating-total {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--text-dim);
}

.rating-bars {
    display: flex;
    flex-direction: column;
    gap: 12px;
    justify-content: center;
}

.rating-bar-row {
    display: flex;
    align-items: center;
    gap: 12px;
}

.rating-bar-label {
    font-size: 10px;
    font-weight: 800;
    color: var(--text-dim);
    width: 20px;
    flex-shrink: 0;
}

.rating-bar-bg {
    flex: 1;
    height: 6px;
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
    overflow: hidden;
}

.rating-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 10px;
    transition: width 1s ease-out;
}

.rating-bar-percent {
    font-size: 10px;
    font-weight: 700;
    color: #6b7280;
    width: 35px;
    text-align: right;
    flex-shrink: 0;
}

/* Review Cards */
.review-cards {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.review-card {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 30px;
    padding: 24px 28px;
    transition: var(--transition-1);
}

.review-card:hover {
    border-color: rgba(239,68,68,0.15);
    transform: translateX(5px);
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    flex-wrap: wrap;
    gap: 12px;
}

.reviewer-info {
    display: flex;
    flex-direction: column;
}

.reviewer-name {
    font-size: 14px;
    font-weight: 900;
    color: #ffffff;
}

.review-date {
    font-size: 9px;
    color: var(--text-dim);
    margin-top: 2px;
}

.review-stars {
    display: flex;
    gap: 3px;
    color: var(--accent);
    font-size: 11px;
    flex-shrink: 0;
}

.review-comment {
    font-size: 13px;
    color: #9ca3af;
    line-height: 1.7;
}

/* Modal Footer */
.modal-footer {
    padding: 20px 40px;
    border-top: 1px solid rgba(255,255,255,0.05);
    display: flex;
    justify-content: center;
    background: rgba(0,0,0,0.3);
}

.modal-footer-link {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--primary);
    text-decoration: none;
    transition: var(--transition-1);
}

.modal-footer-link:hover {
    color: #ffffff;
    gap: 18px;
}

/* Empty State */
.modal-empty {
    text-align: center;
    padding: 60px 0;
}

.modal-empty-icon {
    font-size: 60px;
    color: #1f2937;
    margin-bottom: 20px;
}

.modal-empty-title {
    font-size: 24px;
    font-weight: 900;
    font-style: italic;
    color: #374151;
    margin-bottom: 12px;
}

.modal-empty-text {
    font-size: 13px;
    color: #4b5563;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.fade-up {
    animation: fadeInUp 1s ease-out forwards;
}

.fade-left {
    animation: fadeInLeft 1s ease-out forwards;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .catalog-section {
        padding: 40px 0 80px;
    }
    
    .filter-panel {
        position: relative;
        top: 0;
        margin-bottom: 40px;
    }
}

@media (max-width: 768px) {
    .hero-title {
        letter-spacing: -2px;
    }
    
    .stats-container {
        gap: 16px;
    }
    
    .stat-card {
        padding: 16px 20px;
    }
    
    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 20px;
    }
    
    .modal-summary {
        padding: 25px;
    }
    
    .review-card {
        padding: 18px 20px;
    }
}

@media (max-width: 480px) {
    .products-grid {
        gap: 20px;
    }
    
    .filter-panel {
        padding: 25px;
    }
    
    .pagination a,
    .pagination span {
        width: 40px;
        height: 40px;
    }
}

/* Loading Animation for Cards */
.product-card {
    opacity: 0;
    animation: cardAppear 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(60px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Stagger children animations */
.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.15s; }
.product-card:nth-child(3) { animation-delay: 0.2s; }
.product-card:nth-child(4) { animation-delay: 0.25s; }
.product-card:nth-child(5) { animation-delay: 0.3s; }
.product-card:nth-child(6) { animation-delay: 0.35s; }
.product-card:nth-child(7) { animation-delay: 0.4s; }
.product-card:nth-child(8) { animation-delay: 0.45s; }
.product-card:nth-child(9) { animation-delay: 0.5s; }
.product-card:nth-child(10) { animation-delay: 0.55s; }
</style>

{{-- HERO SECTION - UPDATED TO HOME STYLE --}}
<section class="hero-section">
    <div class="hero-overlay"></div>
    
    <div class="container mx-auto px-5 lg:px-12 hero-content">
        <div class="hero-eyebrow">
            <span class="hero-eyebrow-dot"></span>
            <span class="hero-eyebrow-text">ELITE PERFORMANCE MARKETPLACE</span>
        </div>
        
        <h1 class="hero-title">
            <span class="hero-title-line">PREMIUM</span>
            <span class="hero-title-accent">CATALOGX</span>
        </h1>
        
        <p class="hero-description">
            Experience the pinnacle of automotive excellence with OEM-verified spares, real-time stock intelligence & expedited delivery for serious builders.
        </p>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon stat-icon-red">
                    <i class="fa-solid fa-gauge-high"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Verified</div>
                    <div class="stat-value">OEM Parts</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon stat-icon-amber">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Warranty</div>
                    <div class="stat-value">24 Months</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon stat-icon-green">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Delivery</div>
                    <div class="stat-value">2–3 Days</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CATALOG SECTION --}}
<section class="catalog-section">
    <div class="container mx-auto px-5 lg:px-12">
        
        <div class="section-header fade-up">
            <div class="section-subtitle">Curated Collection</div>
            <h2 class="section-title">Performance Parts</h2>
        </div>
        
        <div class="flex flex-col lg:flex-row gap-10">
            
            {{-- FILTER SIDEBAR --}}
            <aside class="w-full lg:w-80 flex-shrink-0 fade-left">
                <div class="filter-panel">
                    <div class="filter-header">
                        <h3>FILTERS</h3>
                        <a href="{{ route('product.list') }}" class="filter-reset">
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                    </div>
                    
                    <form action="{{ route('product.list') }}" method="GET">
                        {{-- Search --}}
                        <div class="filter-section">
                            <div class="filter-section-title">Search</div>
                            <div class="filter-input-wrapper">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Engine, Brakes, ECU…"
                                       class="filter-input">
                                <i class="fa-solid fa-magnifying-glass filter-icon"></i>
                            </div>
                        </div>
                        
                        {{-- Category --}}
                        <div class="filter-section">
                            <div class="filter-section-title">Category</div>
                            <div class="filter-input-wrapper">
                                <select name="category" 
                                        onchange="this.form.submit()" 
                                        class="filter-input filter-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category }}" 
                                                {{ request('category') == $cat->category ? 'selected' : '' }}>
                                            {{ $cat->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- Price Range --}}
                        <div class="filter-section">
                            <div class="filter-section-title">Price Range</div>
                            <div class="price-range-container">
                                <input type="range" 
                                       name="max_price" 
                                       min="0" 
                                       max="500000" 
                                       step="5000"
                                       value="{{ request('max_price', 500000) }}"
                                       class="price-range"
                                       oninput="document.getElementById('priceDisplay').innerText = 'PKR ' + parseInt(this.value).toLocaleString()">
                                <div class="price-values">
                                    <span>PKR 0</span>
                                    <span class="price-value" id="priceDisplay">
                                        PKR {{ number_format(request('max_price', 500000)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Actions --}}
                        <div class="filter-actions">
                            <button type="submit" class="filter-apply">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </aside>
            
            {{-- PRODUCT GRID --}}
            <main class="flex-1 min-w-0">
                <div class="products-grid">
                    @forelse($products as $product)
                    @php
                        $stock  = $product->stock ?? 0;
                        $sold   = $product->sold_count ?? 0;
                        $rating = round($product->rating ?? 0, 1);
                        $reviewCount = $product->reviews_count ?? 0;
                        $isOut  = $stock <= 0;
                        $isLow  = $stock > 0 && $stock <= 5;
                        $fillPct = $isOut ? 0 : min(100, $stock > 50 ? 100 : $stock * 2);
                    @endphp
                    
                    <div class="product-card {{ $isOut ? 'stock-out' : '' }}" 
                         data-product-id="{{ $product->id }}">
                        
                        {{-- Sold Out Overlay --}}
                        @if($isOut)
                        <div class="sold-out-overlay">
                            <span class="sold-out-text">Sold Out</span>
                        </div>
                        @endif
                        
                        {{-- Image Zone --}}
                        <div class="card-image-zone"
                             onclick="openQuickView({{ $product->id }}, '{{ addslashes($product->name) }}')">
                            
                            @if($sold > 10)
                                <div class="card-badge badge-hot">
                                    <i class="fa-solid fa-fire-flame-curved"></i>
                                    {{ $sold }} SOLD
                                </div>
                            @endif
                            
                            @if($product->created_at && $product->created_at->diffInDays(now()) <= 14)
                                <div class="card-badge badge-new">NEW</div>
                            @endif
                            
                            {{-- Quick View Button --}}
                            <button class="quick-view-btn" 
                                    onclick="event.stopPropagation(); openQuickView({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="card-image"
                                 loading="lazy"
                                 onerror="this.src='https://via.placeholder.com/300x300/1a1a1a/ef4444?text=PART'">
                            
                            {{-- Rating Badge --}}
                            @if($reviewCount > 0)
                            <div class="rating-badge" 
                                 onclick="event.stopPropagation(); openQuickView({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                <div class="stars">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fa-{{ $i <= floor($rating) ? 'solid' : ($i - 0.5 <= $rating ? 'solid fa-star-half-stroke' : 'regular') }} fa-star"></i>
                                    @endfor
                                </div>
                                <span class="rating-value">{{ $rating }}</span>
                                <span class="rating-count">({{ $reviewCount }})</span>
                            </div>
                            @endif
                        </div>
                        
                        {{-- Card Content --}}
                        <div class="card-content">
                            
                            {{-- Category --}}
                            <div class="card-category">{{ $product->category }}</div>
                            
                            {{-- Title --}}
                            <h3 class="card-title">{{ $product->name }}</h3>
                            
                            {{-- Stock Indicator --}}
                            <div class="stock-indicator">
                                <div class="stock-dot {{ $isOut ? 'dot-out' : ($isLow ? 'dot-low' : 'dot-high') }}"></div>
                                <span class="stock-text {{ $isOut ? 'text-gray-500' : ($isLow ? 'text-orange-400' : 'text-green-400') }}">
                                    {{ $isOut ? 'Out of Stock' : ($isLow ? 'Low Stock' : 'In Stock') }}
                                </span>
                                <div class="stock-bar-container">
                                    <div class="stock-bar {{ $isOut ? 'bar-out' : ($isLow ? 'bar-low' : 'bar-high') }}"
                                         style="width: {{ $fillPct }}%"></div>
                                </div>
                                <span class="stock-number">{{ $stock }}u</span>
                            </div>
                            
                            {{-- Reviews Preview --}}
                            @if($reviewCount > 0)
                            <div class="reviews-preview"
                                 onclick="openQuickView({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                <div class="mini-stars">
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fa-{{ $i <= floor($rating) ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <span class="reviews-count">{{ $reviewCount }} Reviews</span>
                                <span class="reviews-cta">View →</span>
                            </div>
                            @else
                            <div class="text-[10px] font-bold text-gray-700 mb-5">No reviews yet</div>
                            @endif
                            
                            {{-- Footer --}}
                            <div class="card-footer">
                                <div class="price-wrapper">
                                    <div class="price-label">Price</div>
                                    <div class="price-value-large">
                                        <span class="price-currency">PKR</span>{{ number_format($product->price) }}
                                    </div>
                                </div>
                                
                                @if($isOut)
                                    <button class="card-btn btn-notify" disabled>
                                        <i class="fa-regular fa-bell"></i> Notify
                                    </button>
                                @else
                                    <button onclick="addToCart({{ $product->id }}, this)" class="card-btn btn-buy">
                                        Add to Cart <i class="fa-solid fa-cart-plus ml-1"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    {{-- Empty State --}}
                    <div class="empty-state">
                        <i class="fa-solid fa-car-burst empty-icon"></i>
                        <h3 class="empty-title">NO MATCHING PARTS</h3>
                        <p class="empty-text">We don't have this component in our active inventory.</p>
                        <a href="{{ route('product.list') }}" class="empty-btn">
                            BROWSE ALL CATALOG
                        </a>
                    </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                @if($products->hasPages())
                <div class="pagination-wrapper">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @endif
            </main>
        </div>
    </div>
</section>

{{-- QUICK VIEW MODAL --}}
<div id="quickViewModal" class="modal-overlay" onclick="closeQuickView(event)">
    <div class="modal-container" id="modalContainer">
        
        {{-- Modal Header --}}
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-eyebrow">Expert Feedback Dossier</div>
                <div class="modal-title" id="modalTitle">PRODUCT REVIEWS</div>
            </div>
            <button class="modal-close" onclick="closeQuickView(null)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        {{-- Modal Body --}}
        <div class="modal-body" id="modalBody">
            
            {{-- Spinner --}}
            <div class="modal-spinner" id="modalSpinner">
                <div class="spinner-ring"></div>
                <div class="spinner-text">Retrieving Field Data...</div>
            </div>
            
            {{-- Content --}}
            <div id="modalContent" style="display: none;"></div>
            
            {{-- Empty State --}}
            <div class="modal-empty" id="modalEmpty" style="display: none;">
                <div class="modal-empty-icon"><i class="fa-regular fa-comment-slash"></i></div>
                <div class="modal-empty-title">NO BATTLE DATA YET</div>
                <div class="modal-empty-text">Be the first to test and review this component.</div>
            </div>
        </div>
        
        {{-- Modal Footer --}}
        <div class="modal-footer">
            <a href="#" id="modalDetailsLink" class="modal-footer-link">
                View Full Product Specs <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.product-card, .filter-panel, .section-header').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(el);
    });
    
    // Add hover effect for stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            gsap?.to(card, { scale: 1.02, duration: 0.3, ease: 'power2.out' });
        });
        card.addEventListener('mouseleave', () => {
            gsap?.to(card, { scale: 1, duration: 0.3, ease: 'power2.out' });
        });
    });
});

// Quick View Modal
let modalOpen = false;

function openQuickView(productId, productName) {
    const overlay = document.getElementById('quickViewModal');
    const container = document.getElementById('modalContainer');
    const spinner = document.getElementById('modalSpinner');
    const content = document.getElementById('modalContent');
    const empty = document.getElementById('modalEmpty');
    const title = document.getElementById('modalTitle');
    const detailsLink = document.getElementById('modalDetailsLink');
    
    title.innerText = productName.toUpperCase();
    detailsLink.href = `/product/${productId}`;
    modalOpen = true;
    
    spinner.style.display = 'flex';
    content.style.display = 'none';
    empty.style.display = 'none';
    content.innerHTML = '';
    
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    
    // Animate modal opening
    gsap?.fromTo(container,
        { opacity: 0, scale: 0.9, y: 30 },
        { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
    );
    
    // Fetch reviews
    fetch(`/product/${productId}/reviews`)
        .then(response => response.json())
        .then(data => {
            spinner.style.display = 'none';
            
            if (!data.success || data.total_reviews === 0) {
                empty.style.display = 'block';
                return;
            }
            
            const avg = parseFloat(data.average_rating);
            const total = data.total_reviews;
            const stats = data.rating_stats || {};
            
            // Generate stars HTML
            const starsHtml = (rating) => {
                let html = '';
                for (let i = 1; i <= 5; i++) {
                    if (i <= Math.floor(rating)) {
                        html += '<i class="fa-solid fa-star"></i>';
                    } else if (i - 0.5 <= rating) {
                        html += '<i class="fa-solid fa-star-half-stroke"></i>';
                    } else {
                        html += '<i class="fa-regular fa-star"></i>';
                    }
                }
                return html;
            };
            
            // Rating bars
            let barsHtml = '';
            [5,4,3,2,1].forEach(star => {
                const count = stats[star] || 0;
                const percent = total > 0 ? (count / total * 100) : 0;
                barsHtml += `
                    <div class="rating-bar-row">
                        <span class="rating-bar-label">${star}</span>
                        <div class="rating-bar-bg">
                            <div class="rating-bar-fill" style="width: ${percent}%"></div>
                        </div>
                        <span class="rating-bar-percent">${Math.round(percent)}%</span>
                    </div>`;
            });
            
            // Reviews list
            let reviewsHtml = '';
            (data.reviews?.data || []).forEach(review => {
                const date = new Date(review.created_at).toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
                reviewsHtml += `
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-name">${review.user?.name || 'Anonymous'}</div>
                                <div class="review-date">${date}</div>
                            </div>
                            <div class="review-stars">${starsHtml(review.rating)}</div>
                        </div>
                        <div class="review-comment">${review.comment || ''}</div>
                    </div>`;
            });
            
            content.innerHTML = `
                <div class="modal-summary">
                    <div class="rating-overview">
                        <div class="big-rating">${avg.toFixed(1)}</div>
                        <div class="rating-stars-large">${starsHtml(avg)}</div>
                        <div class="rating-total">Based on ${total} Reviews</div>
                    </div>
                    <div class="rating-bars">
                        ${barsHtml}
                    </div>
                </div>
                <div class="review-cards">
                    ${reviewsHtml}
                </div>`;
            
            content.style.display = 'block';
            
            // Animate reviews
            gsap?.from('.review-card', {
                opacity: 0,
                y: 20,
                stagger: 0.1,
                duration: 0.6,
                ease: 'power2.out'
            });
        })
        .catch(() => {
            spinner.style.display = 'none';
            empty.style.display = 'block';
        });
}

function closeQuickView(event) {
    if (event && event.target !== document.getElementById('quickViewModal')) return;
    
    const overlay = document.getElementById('quickViewModal');
    const container = document.getElementById('modalContainer');
    modalOpen = false;
    
    gsap?.to(container, {
        opacity: 0,
        scale: 0.9,
        y: 20,
        duration: 0.4,
        ease: 'power3.in',
        onComplete: () => {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    });
}

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOpen) {
        closeQuickView(null);
    }
});

// Prevent modal close when clicking inside modal
document.getElementById('modalContainer')?.addEventListener('click', (e) => {
    e.stopPropagation();
});

// Update price display
function updatePriceDisplay(value) {
    document.getElementById('priceDisplay').innerText = 'PKR ' + parseInt(value).toLocaleString();
}

// Add to Cart AJAX
function addToCart(productId, btn) {
    @guest
        window.location.href = '{{ route("login") }}';
        return;
    @endguest

    const originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                title: 'SUCCESS!',
                text: data.message,
                icon: 'success',
                background: '#0a0a0a',
                color: '#ffffff',
                confirmButtonColor: '#ef4444',
                timer: 2000,
                showConfirmButton: false,
                iconColor: '#ef4444'
            });

            // Update Global Badges
            if (typeof updateAllCartBadges === 'function') {
                updateAllCartBadges(data.cartCount);
            }
            
            // Visual feedback on button
            btn.innerHTML = '<i class="fa-solid fa-check"></i>';
            btn.style.background = '#22c55e';
            setTimeout(() => {
                btn.innerHTML = originalHtml;
                btn.style.background = '';
                btn.disabled = false;
            }, 2000);

        } else {
            Swal.fire({
                title: 'OOPS!',
                text: data.message,
                icon: 'error',
                background: '#0a0a0a',
                color: '#ffffff',
                confirmButtonColor: '#ef4444'
            });
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.innerHTML = originalHtml;
    });
}
</script>
@endsection