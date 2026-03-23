@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX PRODUCT LIST - ULTRA-PREMIUM STYLES
   ================================================ */

:root {
    --primary: #ef4444;
    --primary-dark: #dc2626;
    --primary-light: #f87171;
    --accent: #f97316;
    --dark: #030712;
    --darker: #000000;
    --bg: #0a0a0a;
    --card-bg: rgba(17, 24, 39, 0.7);
    --card-bg-hover: rgba(17, 24, 39, 0.8);
    --border: rgba(255, 255, 255, 0.05);
    --border-hover: rgba(239, 68, 68, 0.3);
    --text-primary: #ffffff;
    --text-secondary: #9ca3af;
    --text-muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
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

/* ===== ANIMATIONS ===== */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ===== PAGE CONTAINER ===== */
.page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.animate-page {
    animation: scaleIn 0.6s ease-out;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-bottom: 2rem;
    animation: slideInUp 0.6s ease-out;
}

@media (min-width: 1024px) {
    .page-header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.02em;
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin-top: 0.25rem;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.export-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 0.75rem;
    color: var(--text-secondary);
    transition: all 0.3s;
    cursor: pointer;
}

.export-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary);
}

.add-btn {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 1.5rem;
    padding: 0.75rem 1.5rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    text-decoration: none;
    box-shadow: var(--shadow-primary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.add-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-primary-lg);
}

.add-btn i {
    transition: transform 0.3s;
    font-size: 0.75rem;
}

.add-btn:hover i {
    transform: rotate(90deg);
}

/* ===== STATS CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

@media (min-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

.stat-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s;
    animation: slideInUp 0.5s ease-out;
    animation-fill-mode: both;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.2s; }
.stat-card:nth-child(5) { animation-delay: 0.25s; }

.stat-card:hover {
    border-color: var(--border-hover);
    transform: translateY(-3px);
    box-shadow: var(--shadow-primary);
}

.stat-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.stat-icon.primary { background: var(--primary); }
.stat-icon.success { background: var(--success); }
.stat-icon.warning { background: var(--warning); }
.stat-icon.danger { background: var(--danger); }
.stat-icon.purple { background: #a855f7; }

.stat-content {
    flex: 1;
}

.stat-label {
    font-size: 0.6rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.25rem;
}

.stat-label.primary { color: var(--primary); }
.stat-label.success { color: var(--success); }
.stat-label.warning { color: var(--warning); }
.stat-label.danger { color: var(--danger); }
.stat-label.purple { color: #a855f7; }

.stat-value {
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    line-height: 1.2;
}

/* ===== ALERT ===== */
.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: var(--success);
    animation: slideInUp 0.5s ease-out;
}

.alert-success .alert-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-success i {
    font-size: 1rem;
}

.alert-success button {
    background: transparent;
    border: none;
    color: var(--success);
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.3s;
}

.alert-success button:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* ===== FILTER SECTION ===== */
.filter-section {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

@media (min-width: 768px) {
    .filter-section {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}

.search-wrapper {
    position: relative;
    flex: 1;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.875rem;
    transition: color 0.3s;
}

.search-wrapper:focus-within .search-icon {
    color: var(--primary);
}

.search-input {
    width: 100%;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.search-input::placeholder {
    color: var(--text-muted);
}

.filter-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-select {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 2rem 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    cursor: pointer;
    min-width: 140px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
}

.reset-btn {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1.25rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
}

.reset-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

/* ===== TABLE CARD ===== */
.table-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    overflow: hidden;
    box-shadow: var(--shadow-2xl);
    margin-bottom: 2rem;
}

/* Table Styles */
.table-responsive {
    overflow-x: auto;
}

.premium-table {
    width: 100%;
    border-collapse: collapse;
}

.premium-table thead tr {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
}

.premium-table thead th {
    padding: 1.5rem 2rem;
    font-size: 0.65rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.2em;
    text-align: left;
}

.premium-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: all 0.3s;
}

.premium-table tbody tr:hover {
    background: rgba(239, 68, 68, 0.05);
}

.premium-table tbody td {
    padding: 1.25rem 2rem;
    color: var(--text-primary);
    font-size: 0.9rem;
}

/* Product Info */
.product-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.product-image-wrapper {
    position: relative;
    flex-shrink: 0;
}

.product-image-glow {
    position: absolute;
    inset: 0;
    background: var(--primary);
    border-radius: 1rem;
    filter: blur(8px);
    opacity: 0;
    transition: opacity 0.3s;
}

tr:hover .product-image-glow {
    opacity: 0.2;
}

.product-image {
    position: relative;
    width: 4rem;
    height: 4rem;
    border-radius: 1rem;
    object-fit: cover;
    border: 2px solid var(--border);
    transition: all 0.5s;
}

tr:hover .product-image {
    transform: scale(1.1);
    border-color: var(--primary);
}

.product-details {
    display: flex;
    flex-direction: column;
}

.product-name {
    font-weight: 900;
    color: white;
    font-size: 1rem;
    margin-bottom: 0.25rem;
    transition: color 0.3s;
}

tr:hover .product-name {
    color: var(--primary);
}

.product-sku {
    font-size: 0.65rem;
    color: var(--text-muted);
    font-family: monospace;
}

.product-brand {
    font-size: 0.6rem;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Category Badge */
.category-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 1rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    border-radius: 2rem;
    font-size: 0.65rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    transition: all 0.3s;
}

tr:hover .category-badge {
    background: rgba(239, 68, 68, 0.1);
    border-color: var(--primary);
    color: var(--primary);
}

/* Price Info */
.price-current {
    font-size: 1rem;
    font-weight: 900;
    color: white;
}

.price-old {
    font-size: 0.7rem;
    color: var(--text-muted);
    text-decoration: line-through;
    margin-top: 0.1rem;
}

.discount-badge {
    display: inline-block;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: var(--success);
    font-size: 0.6rem;
    font-weight: 800;
    padding: 0.1rem 0.5rem;
    border-radius: 1rem;
    margin-top: 0.25rem;
}

/* Rating */
.rating-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.rating-stars {
    display: flex;
    gap: 0.15rem;
    color: #fbbf24;
    font-size: 0.75rem;
}

.rating-count {
    font-size: 0.65rem;
    color: var(--text-muted);
}

.sold-count {
    font-size: 0.6rem;
    color: var(--text-secondary);
    margin-top: 0.15rem;
}

/* Stock Status */
.stock-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stock-indicator {
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.stock-indicator.success { background: var(--success); box-shadow: 0 0 8px var(--success); }
.stock-indicator.warning { background: var(--warning); box-shadow: 0 0 8px var(--warning); }
.stock-indicator.danger { background: var(--danger); box-shadow: 0 0 8px var(--danger); }

.stock-text {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stock-text.success { color: var(--success); }
.stock-text.warning { color: var(--warning); }
.stock-text.danger { color: var(--danger); }

.featured-badge {
    display: inline-block;
    background: rgba(168, 85, 247, 0.1);
    border: 1px solid rgba(168, 85, 247, 0.2);
    color: #a855f7;
    font-size: 0.55rem;
    font-weight: 800;
    padding: 0.2rem 0.75rem;
    border-radius: 1rem;
    margin-top: 0.25rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Action Buttons */
.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    opacity: 0.2;
    transition: opacity 0.3s;
}

tr:hover .action-group {
    opacity: 1;
}

.action-btn {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.action-btn.edit:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary);
}

.action-btn.delete:hover {
    background: var(--danger);
    border-color: var(--danger);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -10px var(--danger);
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-icon {
    width: 5rem;
    height: 5rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--text-muted);
    font-size: 2.5rem;
}

.empty-state h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
}

.empty-state .add-first-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 2rem;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.875rem;
    transition: all 0.3s;
}

.empty-state .add-first-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-primary-lg);
}

/* Pagination */
.pagination-wrapper {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--border);
    background: rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
}

@media (min-width: 768px) {
    .pagination-wrapper {
        flex-direction: row;
        justify-content: space-between;
    }
}

.pagination-info {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.pagination-info strong {
    color: white;
    font-weight: 800;
}

.pagination-links {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.pagination-links .page-link {
    display: block;
    padding: 0.5rem 0.9rem;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.pagination-links .page-link:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(239, 68, 68, 0.1);
}

.pagination-links .page-link.active {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
    box-shadow: var(--shadow-primary);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
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

/* Responsive */
@media (max-width: 1024px) {
    .premium-table thead th {
        padding: 1rem;
    }
    
    .premium-table tbody td {
        padding: 1rem;
    }
    
    .product-info {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 768px) {
    .premium-table thead {
        display: none;
    }
    
    .premium-table tbody tr {
        display: block;
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    
    .premium-table tbody td {
        display: flex;
        padding: 0.5rem 0;
        border: none;
        align-items: center;
        gap: 0.5rem;
    }
    
    .premium-table tbody td::before {
        content: attr(data-label);
        font-weight: 800;
        min-width: 100px;
        color: var(--text-secondary);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    
    .product-info {
        flex-direction: row;
        align-items: center;
    }
    
    .action-group {
        opacity: 1;
        justify-content: flex-start;
    }
}
</style>

<!-- PAGE CONTAINER -->
<div class="page-container animate-page">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1>INVENTORY <span>HUB</span></h1>
            <p>Real-time overview of your digital assets and stock levels</p>
        </div>
        <div class="header-actions">
            <button class="export-btn" onclick="exportTable()">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </button>
            <a href="{{ route('admin.products.create') }}" class="add-btn">
                <i class="fa-solid fa-plus"></i>
                Add New Product
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label primary">Total Items</div>
                <div class="stat-value">{{ number_format($products->total()) }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label success">In Stock</div>
                <div class="stat-value">{{ number_format($products->where('stock', '>', 0)->count()) }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fa-solid fa-exclamation"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label warning">Low Stock</div>
                <div class="stat-value">{{ number_format($products->where('stock', '<', 10)->where('stock', '>', 0)->count()) }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fa-solid fa-ban"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label danger">Out of Stock</div>
                <div class="stat-value">{{ number_format($products->where('stock', 0)->count()) }}</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label purple">Avg Rating</div>
                <div class="stat-value">{{ number_format($products->avg('rating') ?? 0, 1) }}</div>
            </div>
        </div>
    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
    <div class="alert-success">
        <div class="alert-content">
            <i class="fa-regular fa-circle-check"></i>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    <!-- FILTER SECTION -->
    <div class="filter-section">
        <form method="GET" action="{{ route('admin.products.index') }}" class="search-wrapper">
            <i class="fa-regular fa-magnifying-glass search-icon"></i>
            <input type="text" 
                   name="search" 
                   class="search-input" 
                   placeholder="Search by name, category..." 
                   value="{{ request('search') }}">
            <button type="submit" style="display: none;">Search</button>
        </form>
        
        <div class="filter-actions">
            <form method="GET" action="{{ route('admin.products.index') }}" id="filterForm">
                <select name="category" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->category }}" {{ request('category') == $cat->category ? 'selected' : '' }}>
                            {{ $cat->category }}
                        </option>
                    @endforeach
                </select>
            </form>
            
            <a href="{{ route('admin.products.index') }}" class="reset-btn">
                <i class="fa-solid fa-rotate"></i>
                Reset
            </a>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Pricing</th>
                        <th>Rating</th>
                        <th>Inventory</th>
                        <th class="text-center">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td data-label="Product">
                            <div class="product-info">
                                <div class="product-image-wrapper">
                                    <div class="product-image-glow"></div>
                                    <img src="{{ asset('products/'.$product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image">
                                </div>
                                <div class="product-details">
                                    <span class="product-name">{{ $product->name }}</span>
                                    <span class="product-sku">SKU-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    @if($product->brand)
                                        <span class="product-brand">{{ $product->brand }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td data-label="Category">
                            <span class="category-badge">{{ $product->category }}</span>
                        </td>

                        <td data-label="Price">
                            <div class="price-current">Rs {{ number_format($product->price) }}</div>
                            @if($product->old_price)
                                <div class="price-old">Rs {{ number_format($product->old_price) }}</div>
                                @php
                                    $discount = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                @endphp
                                <span class="discount-badge">-{{ $discount }}%</span>
                            @endif
                        </td>

                        <td data-label="Rating">
                            <div class="rating-wrapper">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product->rating))
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($i == ceil($product->rating) && $product->rating - floor($product->rating) >= 0.5)
                                            <i class="fa-solid fa-star-half-alt"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-count">({{ $product->reviews_count }})</span>
                                </div>
                                <span class="sold-count">{{ number_format($product->sold_count ?? 0) }} sold</span>
                            </div>
                        </td>

                        <td data-label="Stock">
                            @if($product->stock > 10)
                                <div class="stock-status">
                                    <div class="stock-indicator success"></div>
                                    <span class="stock-text success">{{ $product->stock }} In Stock</span>
                                </div>
                            @elseif($product->stock > 0)
                                <div class="stock-status">
                                    <div class="stock-indicator warning"></div>
                                    <span class="stock-text warning">{{ $product->stock }} Running Low</span>
                                </div>
                            @else
                                <div class="stock-status">
                                    <div class="stock-indicator danger"></div>
                                    <span class="stock-text danger">Out of Stock</span>
                                </div>
                            @endif
                            
                            @if($product->featured)
                                <span class="featured-badge">Featured</span>
                            @endif
                        </td>

                        <td data-label="Actions">
                            <div class="action-group">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="action-btn edit" 
                                   title="Edit Product">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirmDelete('{{ $product->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Delete Product">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <div class="empty-icon">
                                <i class="fa-regular fa-box-open"></i>
                            </div>
                            <h3>No Products Found</h3>
                            <p>Start by adding your first product to the inventory</p>
                            <a href="{{ route('admin.products.create') }}" class="add-first-btn">
                                <i class="fa-regular fa-plus"></i>
                                Add Your First Product
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        @if(method_exists($products, 'hasPages') && $products->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing <strong>{{ $products->firstItem() ?? 0 }}</strong> 
                to <strong>{{ $products->lastItem() ?? 0 }}</strong> 
                of <strong>{{ $products->total() }}</strong> results
            </div>
            <div class="pagination-links">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
// Delete confirmation
function confirmDelete(productName) {
    return Swal.fire({
        title: 'Delete Product?',
        html: `Are you sure you want to delete <strong>${productName}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        background: '#1f2937',
        color: '#fff',
        customClass: {
            popup: 'rounded-2xl'
        }
    }).then((result) => {
        return result.isConfirmed;
    });
}

// Export table as CSV
function exportTable() {
    const rows = document.querySelectorAll('.premium-table tbody tr');
    const headers = ['Product', 'Category', 'Price', 'Rating', 'Stock', 'Sold', 'Featured'];
    
    let csv = headers.join(',') + '\n';
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowData = [];
        
        // Product name
        const productName = cells[0]?.querySelector('.product-name')?.textContent || '';
        rowData.push(`"${productName}"`);
        
        // Category
        const category = cells[1]?.querySelector('.category-badge')?.textContent || '';
        rowData.push(`"${category}"`);
        
        // Price
        const price = cells[2]?.querySelector('.price-current')?.textContent || '';
        rowData.push(`"${price}"`);
        
        // Rating
        const rating = cells[3]?.querySelector('.rating-stars')?.textContent?.replace(/\n/g, '') || '';
        rowData.push(`"${rating}"`);
        
        // Stock
        const stock = cells[4]?.querySelector('.stock-text')?.textContent || '';
        rowData.push(`"${stock}"`);
        
        // Sold
        const sold = cells[3]?.querySelector('.sold-count')?.textContent || '';
        rowData.push(`"${sold}"`);
        
        // Featured
        const featured = cells[4]?.querySelector('.featured-badge')?.textContent || 'No';
        rowData.push(`"${featured}"`);
        
        csv += rowData.join(',') + '\n';
    });
    
    // Download CSV
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'products_export.csv';
    a.click();
    
    // Show success message
    Swal.fire({
        icon: 'success',
        title: 'Exported!',
        text: 'Products exported successfully',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        background: '#1f2937',
        color: '#fff'
    });
}

// Auto-hide alert after 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert-success');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    }
});

// GSAP Animations
if (typeof gsap !== 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        gsap.from('.stat-card', {
            y: 30,
            opacity: 0,
            duration: 0.5,
            stagger: 0.05,
            ease: 'power2.out'
        });
        
        gsap.from('.premium-table tbody tr', {
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.03,
            ease: 'power2.out',
            delay: 0.2
        });
    });
}
</script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection