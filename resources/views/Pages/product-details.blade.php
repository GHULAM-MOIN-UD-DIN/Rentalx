@extends('layouts.app')

@section('content')


<!-- Flash Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4 z-3" style="background: rgba(16,185,129,0.9); border: none; color: white; border-radius: 2rem; padding: 1rem 2rem; backdrop-filter: blur(10px);" role="alert">
        <i class="fa-regular fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4 z-3" style="background: rgba(239,68,68,0.9); border: none; color: white; border-radius: 2rem; padding: 1rem 2rem; backdrop-filter: blur(10px);" role="alert">
        <i class="fa-regular fa-circle-xmark me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<style>
/* ================================================
   RENTALX PREMIUM PRODUCT DETAIL PAGE - COMPLETE FIX
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --secondary: #f97316;
    --dark: #030712;
    --darker: #000000;
    --bg: #0a0a0a;
    --card-bg: rgba(17, 24, 39, 0.7);
    --card-bg-light: #1f2937;
    --border: rgba(255, 255, 255, 0.08);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --gold: #fbbf24;
    --success: #10b981;
    --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    --shadow-hover: 0 30px 60px -15px rgba(239, 68, 68, 0.3);
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--bg);
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    overflow-x: hidden;
}

/* ===== CONTAINER ===== */
.product-detail-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 8rem 1.5rem 4rem;
    width: 100%;
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
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
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

/* ===== BREADCRUMB ===== */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
    animation: slideInUp 0.6s ease-out;
}

.breadcrumb a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.breadcrumb a:hover {
    color: var(--primary);
    transform: translateX(-2px);
}

.breadcrumb i {
    font-size: 0.625rem;
    color: var(--primary);
}

.breadcrumb span {
    color: white;
    font-weight: 600;
}

/* ===== MAIN GRID ===== */
.product-main-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 3rem;
    margin-bottom: 4rem;
}

/* ===== GALLERY SECTION ===== */
.gallery-section {
    position: sticky;
    top: 6rem;
    animation: slideInLeft 0.8s ease-out;
}

.main-image-container {
    background: linear-gradient(135deg, #1f2937, #111827);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    margin-bottom: 1rem;
}

.main-image-container:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-hover);
}

.main-image-container::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(239,68,68,0.1), transparent 70%);
    opacity: 0;
    transition: var(--transition);
    pointer-events: none;
}

.main-image-container:hover::before {
    opacity: 1;
}

.main-image-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: var(--transition);
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5));
}

.main-image-container:hover img {
    transform: scale(1.05);
}

/* Product Badges */
.product-badge {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    z-index: 10;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.product-badge.hot {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 10px 20px -5px rgba(239,68,68,0.3);
}

.product-badge.new {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 10px 20px -5px rgba(16,185,129,0.3);
}

.product-badge.bestseller {
    background: linear-gradient(135deg, #f97316, #ea580c);
    color: white;
    box-shadow: 0 10px 20px -5px rgba(249,115,22,0.3);
}

/* Sold Count Badge */
.sold-count-badge {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    z-index: 10;
}

.sold-count-badge i {
    color: var(--gold);
    font-size: 0.75rem;
}

.sold-count-badge span {
    font-size: 0.7rem;
    font-weight: 700;
    color: white;
}

.sold-count-badge strong {
    color: var(--gold);
    font-size: 0.9rem;
    margin-right: 0.25rem;
}

/* Thumbnail Grid */
.thumb-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.75rem;
}

.thumb-item {
    background: linear-gradient(135deg, #1f2937, #111827);
    border: 2px solid transparent;
    border-radius: 1rem;
    padding: 0.5rem;
    cursor: pointer;
    transition: var(--transition);
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    aspect-ratio: 1;
}

.thumb-item:hover {
    border-color: var(--primary);
    transform: translateY(-3px);
}

.thumb-item.active {
    border-color: var(--primary);
    box-shadow: 0 0 20px rgba(239,68,68,0.3);
}

.thumb-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: var(--transition);
}

.thumb-item:hover img {
    transform: scale(1.1);
}

/* ===== INFO SECTION ===== */
.info-section {
    animation: slideInRight 0.8s ease-out;
}

.brand-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 2rem;
    padding: 0.5rem 1rem;
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.product-title span {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Rating Container */
.rating-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.stars {
    color: var(--gold);
    font-size: 0.875rem;
    letter-spacing: 2px;
}

.rating-text {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.rating-text strong {
    color: white;
    font-size: 1.1rem;
    margin-right: 0.25rem;
}

.verified-badge {
    background: rgba(16,185,129,0.1);
    border: 1px solid rgba(16,185,129,0.2);
    color: var(--success);
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

/* Price Card */
.price-card {
    background: rgba(239,68,68,0.05);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 1.5rem;
    padding: 1.5rem;
    margin: 1.5rem 0;
    position: relative;
    overflow: hidden;
}

.price-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--primary), var(--secondary));
}

.price-current {
    font-size: 2.5rem;
    font-weight: 900;
    color: white;
    line-height: 1;
    display: inline-block;
}

.price-current small {
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--text-secondary);
    margin-left: 0.5rem;
}

.price-old {
    font-size: 1rem;
    color: var(--text-secondary);
    text-decoration: line-through;
    margin-left: 1rem;
}

.discount-badge {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 700;
    margin-left: 1rem;
    display: inline-block;
}

/* Stock Status */
.stock-status {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1.5rem 0;
    padding: 1rem;
    background: rgba(255,255,255,0.02);
    border-radius: 1rem;
}

.stock-indicator {
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    position: relative;
}

.stock-indicator.in {
    background: var(--success);
    box-shadow: 0 0 10px var(--success);
    animation: pulse 2s infinite;
}

.stock-indicator.low {
    background: #f97316;
    box-shadow: 0 0 10px #f97316;
    animation: pulse 2s infinite;
}

.stock-indicator.out {
    background: var(--primary);
    box-shadow: 0 0 10px var(--primary);
}

.stock-text {
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stock-text.in { color: var(--success); }
.stock-text.low { color: #f97316; }
.stock-text.out { color: var(--primary); }

/* Sold Count Display */
.sold-count-display {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(255,255,255,0.02);
    border-radius: 1rem;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
}

.sold-count-display i {
    color: var(--gold);
    font-size: 1rem;
}

.sold-count-display .sold-text {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.sold-count-display .sold-number {
    font-weight: 800;
    color: var(--gold);
    font-size: 1rem;
}

.sold-count-display .sold-label {
    color: white;
    font-weight: 600;
    margin-left: 0.25rem;
}

/* Product Description */
.product-description {
    color: var(--text-secondary);
    line-height: 1.8;
    margin: 1.5rem 0;
    font-size: 0.95rem;
    border-left: 3px solid var(--primary);
    padding-left: 1.5rem;
}

/* Key Features */
.key-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin: 1.5rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(255,255,255,0.02);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 0.75rem 1rem;
    transition: var(--transition);
}

.feature-item:hover {
    border-color: var(--primary);
    transform: translateX(5px);
    background: rgba(239,68,68,0.05);
}

.feature-item i {
    color: var(--primary);
    font-size: 1rem;
    width: 1.5rem;
    text-align: center;
}

.feature-item span {
    font-size: 0.875rem;
    font-weight: 600;
}

/* Quantity Selector */
.quantity-selector {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin: 2rem 0;
}

.qty-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.qty-controls {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    overflow: hidden;
}

.qty-btn {
    width: 2.5rem;
    height: 2.5rem;
    background: transparent;
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: rgba(239,68,68,0.1);
    color: var(--primary);
    transform: scale(1.1);
}

.qty-input {
    width: 3rem;
    height: 2.5rem;
    background: transparent;
    border: none;
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
    color: white;
    text-align: center;
    font-weight: 700;
    font-size: 0.875rem;
}

.qty-input:focus {
    outline: none;
}

.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Action Buttons */
.action-buttons {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1rem;
    margin: 2rem 0;
}

.btn-add-to-cart {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border: none;
    border-radius: 2rem;
    padding: 1rem 2rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.btn-add-to-cart::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-add-to-cart:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 30px -10px rgba(239,68,68,0.5);
}

.btn-add-to-cart:hover::before {
    left: 100%;
}

.btn-add-to-cart:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.btn-wishlist {
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    color: white;
    font-size: 1.25rem;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.btn-wishlist:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: scale(1.1);
}

.btn-wishlist.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

/* Additional Info */
.additional-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin: 2rem 0;
    padding: 1.5rem 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}

.info-item {
    text-align: center;
}

.info-item i {
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.info-item .label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-item .value {
    font-size: 0.8rem;
    font-weight: 700;
    margin-top: 0.25rem;
}

/* ===== TABS SECTION ===== */
.tabs-section {
    background: rgba(17, 24, 39, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 2rem;
    margin: 4rem 0;
    animation: slideInUp 0.8s ease-out;
}

.tabs-header {
    display: flex;
    gap: 2rem;
    border-bottom: 1px solid var(--border);
    padding-bottom: 1rem;
    margin-bottom: 2rem;
    overflow-x: auto;
}

.tab-btn {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 0.5rem 0;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    white-space: nowrap;
}

.tab-btn::after {
    content: '';
    position: absolute;
    bottom: -1.05rem;
    left: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    transition: var(--transition);
}

.tab-btn:hover {
    color: white;
}

.tab-btn.active {
    color: white;
}

.tab-btn.active::after {
    width: 100%;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Specifications Table */
.specs-table {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.spec-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(0,0,0,0.2);
    padding: 1rem;
    border-radius: 1rem;
    border: 1px solid var(--border);
}

.spec-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
    min-width: 100px;
}

.spec-value {
    font-size: 0.875rem;
    font-weight: 700;
    color: white;
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.feature-block {
    background: rgba(0,0,0,0.2);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 1.5rem;
}

.feature-block i {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 1rem;
}

.feature-block h4 {
    font-size: 1.1rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.feature-block p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    line-height: 1.6;
}

/* Reviews Summary */
.reviews-summary {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
    padding: 3rem;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(0, 0, 0, 0.3));
    border-radius: 2rem;
    border: 1px solid var(--border);
    align-items: center;
}

.average-rating {
    text-align: center;
    padding-right: 3rem;
    border-right: 1px solid var(--border);
}

.average-number {
    font-size: 5rem;
    font-weight: 900;
    color: white;
    line-height: 1;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, white, var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.total-reviews {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.rating-bars {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.rating-bar-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.rating-bar-label {
    min-width: 60px;
    font-size: 0.75rem;
    font-weight: 800;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.rating-bar-label i {
    color: var(--gold);
    font-size: 0.6rem;
}

.progress-container {
    flex: 1;
    height: 8px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--gold), #f59e0b);
    border-radius: 10px;
    transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 0 15px rgba(251, 191, 36, 0.3);
}

.rating-bar-count {
    min-width: 40px;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-align: right;
}

/* Review Cards */
.review-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.review-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 2.5rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.review-card:hover {
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.reviewer-box {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.reviewer-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
    box-shadow: 0 10px 20px rgba(239, 68, 68, 0.2);
}

.reviewer-meta h4 {
    font-size: 1.1rem;
    font-weight: 800;
    margin-bottom: 0.25rem;
}

.review-date {
    font-size: 0.75rem;
    color: var(--text-secondary);
    font-weight: 600;
}

.review-stars {
    display: flex;
    gap: 4px;
    color: var(--gold);
    font-size: 0.875rem;
}

.review-content {
    margin-bottom: 2rem;
}

.review-title {
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: 1rem;
    color: white;
}

.review-text {
    line-height: 1.7;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

/* Pros & Cons HUD */
.review-attributes {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.attr-box {
    padding: 1.25rem;
    border-radius: 1.25rem;
    background: rgba(255, 255, 255, 0.02);
}

.attr-box.pros { border-left: 4px solid #10b981; }
.attr-box.cons { border-left: 4px solid var(--primary); }

.attr-title {
    font-size: 0.75rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.attr-box.pros .attr-title { color: #10b981; }
.attr-box.cons .attr-title { color: var(--primary); }

.attr-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.attr-item {
    font-size: 0.85rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.attr-item i { font-size: 0.75rem; }

/* Review Images HUD */
.review-gallery {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.review-img {
    width: 80px;
    height: 80px;
    border-radius: 1rem;
    object-fit: cover;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: var(--transition);
}

.review-img:hover {
    transform: scale(1.1);
    border-color: var(--primary);
}

/* Review Form HUD */
.review-form-box {
    background: linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(0,0,0,0.5) 100%);
    border: 1px solid var(--border);
    border-radius: 3rem;
    padding: 4rem;
    margin-top: 5rem;
    position: relative;
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-subtitle {
    font-size: 0.75rem;
    font-weight: 800;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 4px;
    display: block;
    margin-bottom: 1rem;
}

.form-main-title {
    font-size: 2.5rem;
    font-weight: 900;
    font-style: italic;
}.form-main-title span { color: var(--primary); }

/* Custom Star Input */
.rating-input-row {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    margin-bottom: 3rem;
}

.star-input-group {
    display: flex;
    flex-direction: row-reverse;
    gap: 0.5rem;
}

.star-input-group input { display: none; }
.star-input-group label {
    font-size: 2.5rem;
    color: #374151;
    cursor: pointer;
    transition: var(--transition);
}

.star-input-group input:checked ~ label,
.star-input-group label:hover,
.star-input-group label:hover ~ label {
    color: var(--gold);
    text-shadow: 0 0 20px rgba(251, 191, 36, 0.4);
}

/* Modern Input Styling */
.modern-input {
    width: 100%;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 1.25rem;
    padding: 1.25rem 1.5rem;
    color: white;
    font-size: 0.95rem;
    outline: none;
    transition: var(--transition);
}

.modern-input:focus {
    border-color: var(--primary);
    background: rgba(239, 68, 68, 0.03);
    box-shadow: 0 0 30px rgba(239, 68, 68, 0.1);
}

.submit-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    border-radius: 1.25rem;
    padding: 1.5rem;
    font-size: 1rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    box-shadow: 0 20px 40px rgba(239, 68, 68, 0.3);
}

.submit-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(239, 68, 68, 0.4);
}
    gap: 1rem;
}

.reviewer-avatar {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    color: white;
}

.reviewer-name {
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.review-date {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.review-rating {
    color: var(--gold);
    font-size: 0.8rem;
    letter-spacing: 2px;
}

.review-title {
    font-size: 1.1rem;
    font-weight: 800;
    margin: 1rem 0 0.5rem;
}

.review-text {
    color: var(--text-secondary);
    line-height: 1.7;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.review-pros-cons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin: 1rem 0;
}

.pros h6, .cons h6 {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pros h6 { color: var(--success); }
.cons h6 { color: var(--primary); }

.pros ul, .cons ul {
    list-style: none;
    padding: 0;
}

.pros li, .cons li {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pros i { color: var(--success); }
.cons i { color: var(--primary); }

/* Review Form */
.review-form-container {
    background: rgba(0,0,0,0.2);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 2rem;
    margin-top: 2rem;
}

.form-title {
    font-size: 1.5rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
}

.form-title span {
    color: var(--primary);
}

.review-form {
    display: grid;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.form-control {
    background: rgba(0,0,0,0.3);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 0.25rem;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 1.5rem;
    color: #374151;
    cursor: pointer;
    transition: var(--transition);
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: var(--gold);
}

.pros-cons-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.file-input {
    background: rgba(0,0,0,0.3);
    border: 2px dashed var(--border);
    border-radius: 1rem;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
}

.file-input:hover {
    border-color: var(--primary);
    background: rgba(239,68,68,0.05);
}

.file-input i {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.file-input p {
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.submit-review-btn {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border: none;
    border-radius: 2rem;
    padding: 1rem 2rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
}

.submit-review-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 30px -10px rgba(239,68,68,0.5);
}

/* Shipping Tab */
.shipping-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.shipping-item {
    text-align: center;
    padding: 2rem;
    background: rgba(0,0,0,0.2);
    border-radius: 1rem;
    border: 1px solid var(--border);
}

.shipping-item i {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 1rem;
}

.shipping-item h4 {
    font-size: 1.1rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.shipping-item p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* ===== RELATED PRODUCTS ===== */
.related-section {
    margin: 5rem 0;
    animation: slideInUp 0.9s ease-out;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-subtitle {
    color: var(--primary);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3em;
    margin-bottom: 0.5rem;
    display: block;
}

.section-title {
    font-size: 2rem;
    font-weight: 900;
    text-transform: uppercase;
}

.section-title span {
    color: var(--primary);
    font-style: italic;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
}

.related-card {
    background: rgba(17, 24, 39, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: var(--transition);
    text-decoration: none;
    color: white;
}

.related-card:hover {
    transform: translateY(-10px);
    border-color: var(--primary);
    box-shadow: var(--shadow-hover);
}

.related-img {
    height: 200px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1f2937, #111827);
    position: relative;
}

.related-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: var(--transition);
}

.related-card:hover .related-img img {
    transform: scale(1.1);
}

.related-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.05em;
}

.related-info {
    padding: 1.5rem;
}

.related-brand {
    color: var(--primary);
    font-size: 0.6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.25rem;
}

.related-name {
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.related-price {
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--primary);
}

.related-price small {
    font-size: 0.7rem;
    color: var(--text-secondary);
    font-weight: 400;
    text-decoration: line-through;
    margin-left: 0.5rem;
}

/* ===== LOADING SPINNER ===== */
.loading-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .product-main-grid {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    
    .related-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .product-main-grid {
        grid-template-columns: 1fr;
    }
    
    .gallery-section {
        position: relative;
        top: 0;
    }
    
    .related-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .tabs-header {
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .reviews-summary {
        flex-direction: column;
        gap: 1rem;
    }
    
    .shipping-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .product-title {
        font-size: 2rem;
    }
    
    .price-current {
        font-size: 2rem;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
    
    .key-features {
        grid-template-columns: 1fr;
    }
    
    .additional-info {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .tabs-section {
        padding: 1.5rem;
    }
    
    .specs-table {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .pros-cons-grid {
        grid-template-columns: 1fr;
    }
    
    .shipping-grid {
        grid-template-columns: 1fr;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
    
    .thumb-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 480px) {
    .product-detail-container {
        padding: 6rem 1rem 2rem;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .rating-container {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .thumb-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .price-old {
        display: block;
        margin-left: 0;
        margin-top: 0.5rem;
    }
    
    .discount-badge {
        margin-left: 0;
        margin-top: 0.5rem;
        display: inline-block;
    }
}
</style>

@php
    // Reviews data fetch karein database se
    $approvedReviews = \App\Models\Review::where('product_id', $product->id)
        ->where('status', 'approved')
        ->with('user')
        ->get();
    
    $reviewCount = $approvedReviews->count();
    
    // Average rating calculate karein
    $averageRating = $reviewCount > 0 ? round($approvedReviews->avg('rating'), 1) : 0;
    
    // Rating distribution calculate karein
    $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
    foreach($approvedReviews as $rev) {
        if(isset($ratingCounts[$rev->rating])) {
            $ratingCounts[$rev->rating]++;
        }
    }
    
    // Product table se bhi check karein agar wahan stored hai toh
    if($reviewCount == 0 && $product->reviews_count > 0) {
        $reviewCount = $product->reviews_count;
        $averageRating = $product->average_rating ?? 0;
    }
@endphp

<!-- PRODUCT DETAIL CONTAINER -->
<div class="product-detail-container">
    
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('home') }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('product.list') }}">
            <span>Collection</span>
        </a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>{{ $product->name }}</span>
    </div>

    <!-- Main Product Grid -->
    <div class="product-main-grid">
        
        <!-- Gallery Section -->
        <div class="gallery-section">
            <div class="main-image-container" id="mainImageContainer">
                <!-- Badges -->
                @if($product->sold_count > 50)
                    <span class="product-badge hot">
                        <i class="fa-solid fa-fire"></i>
                        BESTSELLER
                    </span>
                @elseif($product->created_at->diffInDays(now()) < 7)
                    <span class="product-badge new">
                        <i class="fa-solid fa-star"></i>
                        NEW
                    </span>
                @endif
                
                <!-- Sold Count Badge -->
                <div class="sold-count-badge">
                    <i class="fa-solid fa-crown"></i>
                    <span>
                        <strong>{{ number_format($product->sold_count ?? 0) }}</strong>
                        sold
                    </span>
                </div>
                
                <img id="mainProductImage" src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            
            <!-- Thumbnail Grid -->
            <div class="thumb-grid" id="thumbGrid">
                <div class="thumb-item active" onclick="changeMainImage('{{ asset('products/' . $product->image) }}', this)">
                    <img src="{{ asset('products/' . $product->image) }}" alt="thumb">
                </div>
                
                @if(is_array($product->gallery_images) && count($product->gallery_images) > 0)
                    @foreach($product->gallery_images as $index => $gimg)
                        <div class="thumb-item" onclick="changeMainImage('{{ asset('products/' . $gimg) }}', this)">
                            <img src="{{ asset('products/' . $gimg) }}" alt="thumb {{ $index + 1 }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <span class="brand-tag">
                <i class="fa-regular fa-gem"></i>
                {{ strtoupper($product->brand ?? 'PREMIUM') }}
            </span>
            
            <h1 class="product-title">
                {{ $product->name }} 
                <span>EDITION</span>
            </h1>
            
            <!-- Rating - FIXED -->
            <div class="rating-container">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($averageRating))
                            <i class="fa-solid fa-star"></i>
                        @elseif($i - 0.5 <= $averageRating)
                            <i class="fa-solid fa-star-half-alt"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="rating-text">
                    <strong>{{ number_format($averageRating, 1) }}</strong> 
                    ({{ $reviewCount }} reviews)
                </span>
                <span class="verified-badge">
                    <i class="fa-regular fa-circle-check"></i>
                    100% AUTHENTIC
                </span>
            </div>

            <!-- Sold Count Display -->
            <div class="sold-count-display">
                <i class="fa-solid fa-crown"></i>
                <span class="sold-text">
                    <span class="sold-number">{{ number_format($product->sold_count ?? 0) }}</span>
                    <span class="sold-label">units sold</span>
                </span>
            </div>

            <!-- Price Card -->
            <div class="price-card">
                <div>
                    <span class="price-current">
                        Rs {{ number_format($product->price) }}
                        <small>/day</small>
                    </span>
                    
                    @if($product->old_price && $product->old_price > $product->price)
                        <span class="price-old">Rs {{ number_format($product->old_price) }}</span>
                        <span class="discount-badge">-{{ $product->getDiscountPercentage() }}%</span>
                    @endif
                </div>
            </div>

            <!-- Stock Status -->
            <div class="stock-status">
                @if($product->stock > 10)
                    <div class="stock-indicator in"></div>
                    <span class="stock-text in">
                        <i class="fa-regular fa-circle-check"></i>
                        {{ $product->stock }} UNITS AVAILABLE
                    </span>
                @elseif($product->stock > 0)
                    <div class="stock-indicator low"></div>
                    <span class="stock-text low">
                        <i class="fa-solid fa-exclamation"></i>
                        ONLY {{ $product->stock }} LEFT - HURRY!
                    </span>
                @else
                    <div class="stock-indicator out"></div>
                    <span class="stock-text out">
                        <i class="fa-regular fa-circle-xmark"></i>
                        OUT OF STOCK
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div class="product-description">
                {{ $product->description ?? 'Experience unparalleled performance and luxury with this premium vehicle. Engineered for those who demand excellence.' }}
            </div>

            <!-- Key Features -->
            <div class="key-features">
                <div class="feature-item">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>630 HP</span>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-bolt"></i>
                    <span>3.6 sec 0-100</span>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Quattro AWD</span>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-chair"></i>
                    <span>4 Seats</span>
                </div>
            </div>

            <!-- Quantity & Actions -->
            <form id="addToCartForm" action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                
                <div class="quantity-selector">
                    <span class="qty-label">QUANTITY</span>
                    <div class="qty-controls">
                        <button type="button" class="qty-btn" onclick="updateQuantity(-1)">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" name="quantity" id="productQuantity" class="qty-input" value="1" min="1" max="{{ $product->stock }}" readonly>
                        <button type="button" class="qty-btn" onclick="updateQuantity(1)">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" id="addToCartBtn" class="btn-add-to-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span id="btnText">{{ $product->stock > 0 ? 'ADD TO CART' : 'OUT OF STOCK' }}</span>
                    </button>
                    
                    <button type="button" id="wishlistBtn" class="btn-wishlist" onclick="toggleWishlist(this)">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
            </form>

            <!-- Additional Info -->
            <div class="additional-info">
                <div class="info-item">
                    <i class="fa-solid fa-truck"></i>
                    <div class="label">Delivery</div>
                    <div class="value">Free worldwide</div>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    <div class="label">Warranty</div>
                    <div class="value">24 months</div>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-rotate-left"></i>
                    <div class="label">Returns</div>
                    <div class="value">30 days</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs-header">
            <button class="tab-btn active" onclick="switchTab('specs', this)">SPECIFICATIONS</button>
            <button class="tab-btn" onclick="switchTab('features', this)">FEATURES</button>
            <button class="tab-btn" onclick="switchTab('reviews', this)">REVIEWS ({{ $reviewCount }})</button>
            <button class="tab-btn" onclick="switchTab('shipping', this)">SHIPPING</button>
        </div>

        <!-- Specifications Tab -->
        <div id="specs-tab" class="tab-content active">
            <div class="specs-table">
                <div class="spec-row">
                    <span class="spec-label">Brand</span>
                    <span class="spec-value">{{ $product->brand ?? 'Audi' }}</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Model</span>
                    <span class="spec-value">{{ $product->model ?? 'RS6' }}</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Year</span>
                    <span class="spec-value">{{ $product->year ?? '2025' }}</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Engine</span>
                    <span class="spec-value">4.0L V8 Twin-Turbo</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Power</span>
                    <span class="spec-value">630 HP @ 6000 rpm</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Torque</span>
                    <span class="spec-value">850 Nm</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">0-100 km/h</span>
                    <span class="spec-value">3.6 seconds</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Top Speed</span>
                    <span class="spec-value">305 km/h</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Transmission</span>
                    <span class="spec-value">8-speed Tiptronic</span>
                </div>
                <div class="spec-row">
                    <span class="spec-label">Drive</span>
                    <span class="spec-value">Quattro AWD</span>
                </div>
            </div>
        </div>

        <!-- Features Tab -->
        <div id="features-tab" class="tab-content">
            <div class="features-grid">
                <div class="feature-block">
                    <i class="fa-solid fa-microchip"></i>
                    <h4>Virtual Cockpit</h4>
                    <p>12.3" digital instrument cluster with MMI navigation plus</p>
                </div>
                <div class="feature-block">
                    <i class="fa-solid fa-volume-high"></i>
                    <h4>Bang & Olufsen</h4>
                    <p>3D Advanced Sound System with 19 speakers</p>
                </div>
                <div class="feature-block">
                    <i class="fa-solid fa-chair"></i>
                    <h4>Sports Seats</h4>
                    <p>Heated, ventilated, massage function with Valcona leather</p>
                </div>
                <div class="feature-block">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h4>Driver Assistance</h4>
                    <p>Adaptive cruise control, lane assist, night vision</p>
                </div>
            </div>
        </div>

        <!-- Reviews Tab Upgrade -->
        <div id="reviews-tab" class="tab-content">
            @if($reviewCount > 0)
                <!-- Premium Summary Dashboard -->
                <div class="reviews-summary reveal-up">
                    <div class="average-rating">
                        <div class="average-number">{{ number_format($averageRating, 1) }}</div>
                        <div class="stars" style="color: var(--gold); margin-bottom: 1rem;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($averageRating))
                                    <i class="fa-solid fa-star"></i>
                                @elseif($i - 0.5 <= $averageRating)
                                    <i class="fa-solid fa-star-half-alt"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="total-reviews">Based on {{ $reviewCount }} Verified Reviews</div>
                    </div>
                    
                    <div class="rating-bars">
                        @foreach([5,4,3,2,1] as $star)
                            @php
                                $count = $ratingCounts[$star] ?? 0;
                                $percentage = $reviewCount > 0 ? ($count / $reviewCount) * 100 : 0;
                            @endphp
                            <div class="rating-bar-item">
                                <span class="rating-bar-label">{{ $star }} <i class="fa-solid fa-star"></i></span>
                                <div class="progress-container">
                                    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="rating-bar-count">{{ number_format($percentage) }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Premium Review Interface -->
                <div class="review-list">
                    @foreach($approvedReviews as $review)
                        <div class="review-card reveal-up">
                            <div class="review-header">
                                <div class="reviewer-box">
                                    <div class="reviewer-avatar">
                                        {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="reviewer-meta">
                                        <div class="flex items-center gap-3">
                                            <h4>{{ $review->user->name ?? 'Anonymous User' }}</h4>
                                            @if($review->verified_purchase)
                                                <span class="verified-badge !bg-green-500/10 !text-green-500 !text-[9px] !px-2 !py-0.5">
                                                    <i class="fa-solid fa-circle-check"></i> VERIFIED BUYER
                                                </span>
                                            @endif
                                        </div>
                                        <span class="review-date">Submitted on {{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="review-stars">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="review-content">
                                @if($review->title)
                                    <h5 class="review-title">{{ $review->title }}</h5>
                                @endif
                                <p class="review-text">"{{ $review->comment }}"</p>
                                
                                @php
                                    $pros = is_string($review->pros) ? json_decode($review->pros, true) : $review->pros;
                                    $cons = is_string($review->cons) ? json_decode($review->cons, true) : $review->cons;
                                    $reviewImages = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                                @endphp

                                @if(!empty($pros) || !empty($cons))
                                    <div class="review-attributes">
                                        @if(!empty($pros) && is_array($pros))
                                            <div class="attr-box pros">
                                                <span class="attr-title"><i class="fa-solid fa-plus-circle"></i> Advantages</span>
                                                <div class="attr-list">
                                                    @foreach($pros as $pro)
                                                        @if(!empty($pro))
                                                            <div class="attr-item"><i class="fa-solid fa-check text-green-500"></i> {{ $pro }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if(!empty($cons) && is_array($cons))
                                            <div class="attr-box cons">
                                                <span class="attr-title"><i class="fa-solid fa-minus-circle"></i> Considerations</span>
                                                <div class="attr-list">
                                                    @foreach($cons as $con)
                                                        @if(!empty($con))
                                                            <div class="attr-item"><i class="fa-solid fa-xmark text-red-500"></i> {{ $con }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if(!empty($reviewImages) && is_array($reviewImages))
                                    <div class="review-gallery">
                                        @foreach($reviewImages as $img)
                                            <img src="{{ asset('uploads/reviews/' . $img) }}" class="review-img" onclick="openLightbox(this.src)">
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-6 pt-6 border-t border-white/5">
                                <button class="text-[10px] font-black uppercase text-gray-500 hover:text-red-500 transition flex items-center gap-2">
                                    <i class="fa-regular fa-thumbs-up"></i> Helpful ({{ $review->helpful_count ?? 0 }})
                                </button>
                                <button class="text-[10px] font-black uppercase text-gray-500 hover:text-white transition flex items-center gap-2">
                                    <i class="fa-regular fa-flag"></i> Report
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white/5 rounded-[3rem] border border-white/10 reveal-up">
                    <div class="w-24 h-24 bg-red-600/10 rounded-full flex items-center justify-center mx-auto mb-8 border border-red-500/20">
                        <i class="fa-solid fa-comment-slash text-3xl text-red-500"></i>
                    </div>
                    <h3 class="text-2xl font-black italic">BE THE FIRST TO REVIEW</h3>
                    <p class="text-gray-500 mt-4">This product hasn't been rated yet. Your feedback helps others!</p>
                </div>
            @endif

            <!-- Premium Review Form HUD -->
            @auth
                <div class="review-form-box reveal-up">
                    <div class="form-header">
                        <span class="form-subtitle">Share Your Experience</span>
                        <h2 class="form-main-title">WRITE A <span>REVIEW</span></h2>
                    </div>

                    <form id="reviewForm" class="space-y-8" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="rating-input-row">
                            <label class="text-[10px] font-black uppercase tracking-[4px] text-gray-500">How would you rate it?</label>
                            <div class="star-input-group">
                                @for($i=5; $i>=1; $i--)
                                    <input type="radio" name="rating" value="{{ $i }}" id="form-star-{{ $i }}" {{ $i==5 ? 'checked' : '' }}>
                                    <label for="form-star-{{ $i }}">★</label>
                                @endfor
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400">REVIEW TITLE</label>
                                <input type="text" name="title" class="modern-input" placeholder="e.g. Exceptional Build Quality!">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400">UP TO 5 PHOTOS</label>
                                <div class="modern-input flex items-center justify-between cursor-pointer" onclick="document.getElementById('revImgInput').click()">
                                    <span id="imgStatusLine" class="text-gray-500">Click to upload photos...</span>
                                    <i class="fa-solid fa-camera"></i>
                                    <input type="file" name="images[]" id="revImgInput" multiple hidden onchange="updateImgStatus(this)">
                                </div>
                            </div>
                        </div>

                        <div class="pros-cons-grid grid md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-green-500">ADVANTAGES (PROS)</label>
                                <input type="text" name="pros[]" class="modern-input" placeholder="What stood out?">
                                <input type="text" name="pros[]" class="modern-input" placeholder="Another positive...">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-red-500">CONSIDERATIONS (CONS)</label>
                                <input type="text" name="cons[]" class="modern-input" placeholder="Any drawbacks?">
                                <input type="text" name="cons[]" class="modern-input" placeholder="Could be improved...">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400">DETAILED COMMENTARY</label>
                            <textarea name="comment" class="modern-input !h-40 resize-none" placeholder="Describe your experience in detail..."></textarea>
                        </div>

                        <button type="submit" class="submit-btn" id="revSubmitBtn">
                            <i class="fa-solid fa-paper-plane"></i> SUBMIT REVIEW
                        </button>
                    </form>
                </div>
            @else
                <div class="review-form-box text-center py-20 reveal-up">
                    <i class="fa-solid fa-lock text-4xl text-red-500 mb-6"></i>
                    <h2 class="text-3xl font-black italic mb-4">MEMBER ONLY <span>ACCESS</span></h2>
                    <p class="text-gray-400 mb-10">Please login to share your expert opinion with the community.</p>
                    <a href="{{ route('login') }}" class="submit-btn max-w-sm mx-auto">LOGIN NOW</a>
                </div>
            @endauth
        </div>
        </div>

        <!-- Shipping Tab -->
        <div id="shipping-tab" class="tab-content">
            <div class="shipping-grid">
                <div class="shipping-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    <h4>Express Delivery</h4>
                    <p>2-3 business days</p>
                </div>
                <div class="shipping-item">
                    <i class="fa-solid fa-box"></i>
                    <h4>Secure Packaging</h4>
                    <p>Insurance included</p>
                </div>
                <div class="shipping-item">
                    <i class="fa-solid fa-globe"></i>
                    <h4>Worldwide</h4>
                    <p>Shipping to 150+ countries</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="related-section">
            <div class="section-header">
                <span class="section-subtitle">YOU MAY ALSO LIKE</span>
                <h2 class="section-title">RELATED <span>COLLECTION</span></h2>
            </div>
            
            <div class="related-grid">
                @foreach($relatedProducts->take(4) as $related)
                    <a href="{{ route('product.details', $related->id) }}" class="related-card">
                        <div class="related-img">
                            @if($related->sold_count > 20)
                                <span class="related-badge">
                                    <i class="fa-solid fa-fire"></i>
                                    HOT
                                </span>
                            @endif
                            <img src="{{ asset('products/' . ($related->image ?? 'default.jpg')) }}" alt="{{ $related->name }}">
                        </div>
                        <div class="related-info">
                            <div class="related-brand">{{ strtoupper($related->brand ?? 'AUDI') }}</div>
                            <div class="related-name">{{ Str::limit($related->name, 30) }}</div>
                            <div class="related-price">
                                Rs {{ number_format($related->price) }}
                                @if($related->old_price)
                                    <small>Rs {{ number_format($related->old_price) }}</small>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Initialize GSAP
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // Auto-hide flash messages after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);

    // Gallery Functions
    function changeMainImage(src, element) {
        document.getElementById('mainProductImage').src = src;
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        
        if (typeof gsap !== 'undefined') {
            gsap.fromTo('#mainProductImage', 
                { opacity: 0.5, scale: 0.95 },
                { opacity: 1, scale: 1, duration: 0.5, ease: 'power2.out' }
            );
        }
    }

    // Quantity Functions
    function updateQuantity(change) {
        const input = document.getElementById('productQuantity');
        const current = parseInt(input.value);
        const max = parseInt(input.getAttribute('max'));
        const newValue = current + change;
        
        if (newValue >= 1 && newValue <= max) {
            input.value = newValue;
            
            if (typeof gsap !== 'undefined') {
                gsap.fromTo(input, 
                    { scale: 1.2, color: '#ef4444' },
                    { scale: 1, color: 'white', duration: 0.3 }
                );
            }
        }
    }

    // Tab Switching
    function switchTab(tabName, btn) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        
        // Show selected tab
        document.getElementById(tabName + '-tab').classList.add('active');
        btn.classList.add('active');
        
        if (typeof gsap !== 'undefined') {
            gsap.fromTo('#' + tabName + '-tab', 
                { opacity: 0, y: 20 },
                { opacity: 1, y: 0, duration: 0.5 }
            );
        }
    }

    // Wishlist Toggle
    function toggleWishlist(btn) {
        @auth
            btn.classList.toggle('active');
            const icon = btn.querySelector('i');
            
            if (btn.classList.contains('active')) {
                icon.className = 'fa-solid fa-heart text-red-500';
                
                if (typeof gsap !== 'undefined') {
                    gsap.to(btn, { scale: 1.2, duration: 0.2, yoyo: true, repeat: 1 });
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Wishlist!',
                    text: 'This item has been saved to your wishlist.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#1f2937',
                    color: '#fff'
                });

                $.ajax({
                    url: '{{ route("wishlist.add", $product->id) }}',
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' }
                });
            } else {
                icon.className = 'fa-regular fa-heart';
            }
        @else
            Swal.fire({
                icon: 'info',
                title: 'Login Required',
                text: 'Please login to add items to your wishlist.',
                showConfirmButton: true,
                confirmButtonColor: '#ef4444',
                background: '#1f2937',
                color: '#fff'
            }).then(() => {
                window.location.href = '{{ route("login") }}';
            });
        @endauth
    }

    // Star Rating Hover Effect
    document.querySelectorAll('.star-rating label').forEach((label) => {
        label.addEventListener('mouseover', function() {
            const value = this.htmlFor.replace('star', '');
            const labels = document.querySelectorAll('.star-rating label');
            
            labels.forEach(l => l.style.color = '#374151');
            
            for (let i = 0; i < labels.length; i++) {
                if (i >= labels.length - value) {
                    labels[i].style.color = '#fbbf24';
                }
            }
        });
        
        label.addEventListener('mouseout', function() {
            const checked = document.querySelector('.star-rating input:checked');
            const labels = document.querySelectorAll('.star-rating label');
            
            if (checked) {
                const value = parseInt(checked.value);
                labels.forEach(l => l.style.color = '#374151');
                
                for (let i = 0; i < labels.length; i++) {
                    if (i >= labels.length - value) {
                        labels[i].style.color = '#fbbf24';
                    }
                }
            } else {
                labels.forEach(l => l.style.color = '#374151');
            }
        });
    });

    // Scroll to Top
    const scrollBtn = document.getElementById('scrollTop');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            scrollBtn.classList.add('show');
        } else {
            scrollBtn.classList.remove('show');
        }
    });

    // File input display
    function updateFileCount(input) {
        const fileCount = input.files.length;
        const fileInputText = document.getElementById('fileInputText');
        const fileCountSpan = document.getElementById('fileCount');
        
        if (fileCount > 0) {
            fileInputText.textContent = fileCount + ' file(s) selected';
            fileCountSpan.textContent = fileCount + ' file(s) selected';
            
            if (fileCount > 5) {
                alert('Maximum 5 files allowed. Only the first 5 will be uploaded.');
            }
        } else {
            fileInputText.textContent = 'Click to upload photos';
            fileCountSpan.textContent = '';
        }
    }

    // AJAX Add to Cart
    $(document).ready(function() {
        $('#addToCartForm').on('submit', function(e) {
            e.preventDefault();
            
            @auth
                const btn = $('#addToCartBtn');
                const btnText = $('#btnText');
                const originalText = btnText.text();
                
                // Disable button and show loading
                btn.prop('disabled', true);
                btnText.html('<span class="loading-spinner"></span> ADDING...');
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart!',
                            text: 'Item has been added to your shopping cart.',
                            showConfirmButton: true,
                            confirmButtonColor: '#ef4444',
                            background: '#1f2937',
                            color: '#fff',
                            iconColor: '#ef4444'
                        });
                        
                        // Update cart count globally
                        if (response.cartCount) {
                            updateAllCartBadges(response.cartCount);
                        }
                        
                        if (typeof gsap !== 'undefined') {
                            gsap.to(btn[0], {
                                scale: 1.1,
                                duration: 0.2,
                                yoyo: true,
                                repeat: 1,
                                onComplete: () => {
                                    btn.prop('disabled', false);
                                    btnText.html('<i class="fa-solid fa-bag-shopping"></i> ADD TO CART');
                                }
                            });
                        } else {
                            btn.prop('disabled', false);
                            btnText.html('<i class="fa-solid fa-bag-shopping"></i> ADD TO CART');
                        }
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong. Please try again.';
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: message,
                            confirmButtonColor: '#ef4444',
                            background: '#1f2937',
                            color: '#fff'
                        });
                        
                        btn.prop('disabled', false);
                        btnText.html(originalText);
                    }
                });
            @else
                Swal.fire({
                    icon: 'info',
                    title: 'Login Required',
                    text: 'Please login to add items to your cart.',
                    showConfirmButton: true,
                    confirmButtonColor: '#ef4444',
                    background: '#1f2937',
                    color: '#fff'
                }).then(() => {
                    window.location.href = '{{ route("login") }}';
                });
            @endauth
        });
    });

    // GSAP Animations
    if (typeof gsap !== 'undefined') {
        document.addEventListener('DOMContentLoaded', function() {
            gsap.from('.breadcrumb', {
                scrollTrigger: {
                    trigger: '.breadcrumb',
                    start: 'top 80%'
                },
                y: 30,
                opacity: 0,
                duration: 0.8
            });

            gsap.from('.feature-item', {
                scrollTrigger: {
                    trigger: '.key-features',
                    start: 'top 80%'
                },
                x: -30,
                opacity: 0,
                duration: 0.6,
                stagger: 0.1
            });

            gsap.from('.additional-info .info-item', {
                scrollTrigger: {
                    trigger: '.additional-info',
                    start: 'top 90%'
                },
                y: 30,
                opacity: 0,
                duration: 0.6,
                stagger: 0.1
            });

            gsap.from('.related-card', {
                scrollTrigger: {
                    trigger: '.related-section',
                    start: 'top 80%'
                },
                y: 50,
                opacity: 0,
                duration: 0.8,
                stagger: 0.15
            });
        });

        // Parallax effect on main image
        document.addEventListener('mousemove', (e) => {
            const image = document.getElementById('mainProductImage');
            const container = document.getElementById('mainImageContainer');
            
            if (window.innerWidth > 768 && image && container) {
                const rect = container.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                
                gsap.to(image, {
                    x: x * 20,
                    y: y * 20,
                    duration: 1,
                    ease: 'power2.out'
                });
            }
        });
    }

    // Review Lightbox
    function openLightbox(src) {
        Swal.fire({
            imageUrl: src,
            imageAlt: 'Review Photo',
            showConfirmButton: false,
            background: 'transparent',
            padding: 0,
            width: 'auto',
            backdrop: 'rgba(0,0,0,0.9)'
        });
    }

    // Image Status Update
    function updateImgStatus(input) {
        const line = document.getElementById('imgStatusLine');
        if(input.files && input.files.length > 0) {
            line.innerHTML = `<span class="text-green-500 font-bold">${input.files.length} Photo(s) Attached</span>`;
            line.classList.remove('text-gray-500');
        } else {
            line.innerText = 'Click to upload photos...';
            line.classList.add('text-gray-500');
        }
    }

    // Modern Review Form Submission
    document.addEventListener('DOMContentLoaded', function() {
        const revForm = document.getElementById('reviewForm');
        if (revForm) {
            revForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const btn = document.getElementById('revSubmitBtn');
                const originalContent = btn.innerHTML;
                
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> TRANSMITTING...';

                const formData = new FormData(this);

                $.ajax({
                    url: '{{ route("review.store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'TRANSMISSION COMPLETE',
                                text: response.message,
                                background: '#111827',
                                color: '#fff',
                                confirmButtonColor: '#ef4444'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'TRANSMISSION ERROR',
                                text: response.message,
                                background: '#111827',
                                color: '#fff'
                            });
                            btn.disabled = false;
                            btn.innerHTML = originalContent;
                        }
                    },
                    error: function(xhr) {
                        const error = xhr.responseJSON ? xhr.responseJSON.message : 'System Failure';
                        Swal.fire({
                            icon: 'error',
                            title: 'FATAL ERROR',
                            text: error,
                            background: '#111827',
                            color: '#fff'
                        });
                        btn.disabled = false;
                        btn.innerHTML = originalContent;
                    }
                });
            });
        }
    });

    // GSAP Scroll Animations
    if (typeof gsap !== 'undefined') {
        document.addEventListener('DOMContentLoaded', function() {
            // General Reveals
            gsap.utils.toArray('.reveal-up').forEach((elem) => {
                gsap.from(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: 'top 92%',
                        toggleActions: 'play none none none'
                    },
                    y: 60,
                    opacity: 0,
                    duration: 1.2,
                    ease: 'power3.out'
                });
            });

            // Tab specific stagger for reviews
            window.addEventListener('click', (e) => {
                const targetText = e.target.innerText || '';
                if(targetText.includes('REVIEWS')) {
                    setTimeout(() => {
                        gsap.from('.review-card', {
                            y: 40,
                            opacity: 0,
                            stagger: 0.15,
                            duration: 0.8,
                            ease: 'back.out(1.7)'
                        });
                    }, 100);
                }
            });
        });
    }
</script>
@endsection