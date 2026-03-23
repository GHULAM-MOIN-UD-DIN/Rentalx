@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX ADMIN APPOINTMENTS - ULTRA-PREMIUM STYLES
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

/* ===== ANIMATIONS ===== */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
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

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    padding: 0 0.5rem;
}

.page-header h2 {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.25rem;
}

.page-header h2 span {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header .header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.export-btn {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #10b981;
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    text-decoration: none;
}

.export-btn:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.3);
}

.total-badge {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--primary);
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 700;
}

/* ===== STATS CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1.25rem;
    transition: all 0.3s;
    animation: slideInUp 0.5s ease-out;
    animation-fill-mode: both;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.2s; }
.stat-card:nth-child(5) { animation-delay: 0.25s; }
.stat-card:nth-child(6) { animation-delay: 0.3s; }

.stat-card:hover {
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: var(--shadow-primary);
}

.stat-card .stat-label {
    color: var(--text-secondary);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
}

.stat-card .stat-value {
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
}

.stat-card.total .stat-value { color: var(--primary); }
.stat-card.pending .stat-value { color: #f59e0b; }
.stat-card.confirmed .stat-value { color: #10b981; }
.stat-card.completed .stat-value { color: #3b82f6; }
.stat-card.cancelled .stat-value { color: #ef4444; }
.stat-card.revenue .stat-value { color: var(--primary); }

/* ===== MAIN CARD ===== */
.main-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    overflow: hidden;
    margin-top: 2rem;
    animation: scaleIn 0.6s ease-out;
}

.card-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header h3 i {
    color: var(--primary);
}

/* ===== FILTERS SECTION ===== */
.filters-section {
    padding: 2rem;
    border-bottom: 1px solid var(--border);
    background: rgba(0, 0, 0, 0.2);
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 1rem;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.filter-input {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
    width: 100%;
}

.filter-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    background: rgba(0, 0, 0, 0.5);
}

.filter-input::placeholder {
    color: var(--text-muted);
}

.filter-select {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.filter-btn {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    height: fit-content;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary-lg);
}

.reset-btn {
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    color: var(--text-secondary);
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    height: fit-content;
}

.reset-btn:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

/* ===== ALERT ===== */
.alert-premium {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 1rem;
    color: #10b981;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.alert-premium i {
    font-size: 1.25rem;
}

.btn-close-custom {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
    padding: 0.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-close-custom:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

/* ===== TABLE ===== */
.table-responsive {
    overflow-x: auto;
    margin: 2rem;
}

.premium-table {
    width: 100%;
    border-collapse: collapse;
}

.premium-table thead tr {
    border-bottom: 2px solid var(--border);
}

.premium-table thead th {
    padding: 1rem;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--primary);
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
    padding: 1rem;
    color: white;
    font-size: 0.875rem;
}

/* Customer Info */
.customer-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.customer-name {
    font-weight: 700;
    color: white;
}

.customer-email {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.customer-phone {
    font-size: 0.7rem;
    color: var(--text-muted);
}

/* Car Info */
.car-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.car-name {
    font-weight: 700;
    color: white;
}

.car-price {
    font-size: 0.7rem;
    color: var(--primary);
}

/* Date Info */
.date-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.date-range {
    font-weight: 700;
    color: white;
}

.date-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

/* Price */
.price-value {
    font-weight: 900;
    color: var(--primary);
    font-size: 1rem;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.status-badge.confirmed {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.status-badge.completed {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.status-badge.cancelled {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.2);
}

/* Action Buttons */
.action-group {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.action-btn {
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 0.5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    background: transparent;
    color: var(--text-secondary);
}

.action-btn:hover {
    transform: translateY(-2px);
}

.action-btn.view {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.action-btn.view:hover {
    background: #3b82f6;
    color: white;
    box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.3);
}

.action-btn.edit {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.action-btn.edit:hover {
    background: #f59e0b;
    color: white;
    box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.3);
}

.action-btn.delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.action-btn.delete:hover {
    background: #ef4444;
    color: white;
    box-shadow: 0 10px 20px -5px rgba(239, 68, 68, 0.3);
}

/* Dropdown */
.dropdown-menu-custom {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 0.5rem;
    min-width: 160px;
}

.dropdown-item-custom {
    padding: 0.5rem 1rem;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s;
    background: transparent;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-item-custom:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--primary);
}

.dropdown-item-custom.text-danger:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state i {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

/* Pagination */
.pagination-wrapper {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 0.25rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item .page-link {
    display: block;
    padding: 0.5rem 0.75rem;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}

.page-item .page-link:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(239, 68, 68, 0.1);
}

.page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

/* ===== MODAL ===== */
.modal-premium {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
}

.modal-header-premium {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-title-premium {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modal-title-premium i {
    color: var(--primary);
}

.modal-body-premium {
    padding: 1.5rem;
}

.modal-body-premium p {
    color: var(--text-secondary);
    line-height: 1.6;
}

.modal-footer-premium {
    padding: 1.5rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.modal-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    border: none;
}

.modal-btn.cancel {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text-secondary);
}

.modal-btn.cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

.modal-btn.delete {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
}

.modal-btn.delete:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary-lg);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1400px) {
    .stats-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .filter-form {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 1024px) {
    .filter-form {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-form {
        grid-template-columns: 1fr;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .premium-table thead {
        display: none;
    }
    
    .premium-table tbody tr {
        display: block;
        padding: 1rem;
        border: 1px solid var(--border);
        border-radius: 1rem;
        margin-bottom: 1rem;
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
        font-weight: 700;
        min-width: 100px;
        color: var(--text-secondary);
        font-size: 0.7rem;
        text-transform: uppercase;
    }
    
    .action-group {
        justify-content: flex-start;
        margin-top: 0.5rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .pagination-wrapper {
        overflow-x: auto;
    }
}
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <h2>CAR <span>APPOINTMENTS</span></h2>
        <p class="text-gray-400 text-sm mt-1">Manage all customer bookings and schedules</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.appointments.export') }}" class="export-btn">
            <i class="fa-solid fa-file-excel"></i>
            Export
        </a>
        <span class="total-badge">
            <i class="fa-regular fa-calendar mr-1"></i>
            {{ $appointments->total() }} Total
        </span>
    </div>
</div>

<!-- STATS CARDS -->
<div class="stats-grid">
    <div class="stat-card total">
        <div class="stat-label">Total</div>
        <div class="stat-value">{{ $stats['total'] }}</div>
    </div>
    <div class="stat-card pending">
        <div class="stat-label">Pending</div>
        <div class="stat-value">{{ $stats['pending'] }}</div>
    </div>
    <div class="stat-card confirmed">
        <div class="stat-label">Confirmed</div>
        <div class="stat-value">{{ $stats['confirmed'] }}</div>
    </div>
    <div class="stat-card completed">
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $stats['completed'] }}</div>
    </div>
    <div class="stat-card cancelled">
        <div class="stat-label">Cancelled</div>
        <div class="stat-value">{{ $stats['cancelled'] }}</div>
    </div>
    <div class="stat-card revenue">
        <div class="stat-label">Revenue</div>
        <div class="stat-value">Rs {{ number_format($stats['total_revenue'] ?? 0) }}</div>
    </div>
</div>

<!-- MAIN CARD -->
<div class="main-card">
    <div class="card-header">
        <h3>
            <i class="fa-regular fa-calendar-check"></i>
            Appointment Management
        </h3>
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-400">
                <i class="fa-regular fa-clock mr-1"></i>
                Last updated: {{ now()->format('d M Y H:i') }}
            </span>
        </div>
    </div>

    <!-- FILTERS SECTION -->
    <div class="filters-section">
        <form method="GET" class="filter-form">
            <div class="filter-group">
                <label class="filter-label">Search</label>
                <input type="text" name="search" class="filter-input" 
                       placeholder="Customer, email, car..." value="{{ request('search') }}">
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select name="status" class="filter-select">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">From Date</label>
                <input type="date" name="date_from" class="filter-input" value="{{ request('date_from') }}">
            </div>
            
            <div class="filter-group">
                <label class="filter-label">To Date</label>
                <input type="date" name="date_to" class="filter-input" value="{{ request('date_to') }}">
            </div>
            
            <div class="filter-group" style="grid-column: span 2;">
                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="filter-btn">
                        <i class="fa-solid fa-filter"></i>
                        Apply Filters
                    </button>
                    <a href="" class="reset-btn">
                        <i class="fa-solid fa-rotate-right"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert-premium" style="margin: 0 2rem 1.5rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fa-regular fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close-custom" data-bs-dismiss="alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Dates</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Booked On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $app)
                <tr>
                    <td data-label="ID">#{{ $app->id }}</td>
                    <td data-label="Customer">
                        <div class="customer-info">
                            <span class="customer-name">{{ $app->first_name }} {{ $app->last_name }}</span>
                            <span class="customer-email">{{ $app->email }}</span>
                            @if($app->phone)
                                <span class="customer-phone">{{ $app->phone }}</span>
                            @endif
                        </div>
                    </td>
                    <td data-label="Car">
                        <div class="car-info">
                            <span class="car-name">{{ $app->car_name }}</span>
                            <span class="car-price">Rs {{ number_format($app->price_per_day) }}/day</span>
                        </div>
                    </td>
                    <td data-label="Dates">
                        <div class="date-info">
                            <span class="date-range">{{ $app->pickup_date->format('d M Y') }}</span>
                            <span class="date-label">to {{ $app->return_date->format('d M Y') }}</span>
                        </div>
                    </td>
                    <td data-label="Total">
                        <span class="price-value">Rs {{ number_format($app->total_price) }}</span>
                    </td>
                    <td data-label="Status">
                        <span class="status-badge {{ $app->status }}">
                            <i class="fa-regular fa-circle"></i>
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td data-label="Booked On">
                        <span>{{ $app->created_at->format('d M Y H:i') }}</span>
                    </td>
                    <td data-label="Actions">
                        <div class="action-group">
                            <a href="{{ route('admin.appointments.show', $app->id) }}" 
                               class="action-btn view" title="View Details">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            
                            <div class="dropdown" style="position: relative;">
                                <button class="action-btn edit" type="button" 
                                        onclick="toggleDropdown({{ $app->id }})">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <div id="dropdown-{{ $app->id }}" class="dropdown-menu-custom" 
                                     style="display: none; position: absolute; z-index: 1000; right: 0;">
                                    <form action="{{ route('admin.appointments.status', $app->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="dropdown-item-custom">
                                            <i class="fa-regular fa-check-circle mr-2"></i>
                                            Confirm
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.appointments.status', $app->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="dropdown-item-custom">
                                            <i class="fa-regular fa-circle-check mr-2"></i>
                                            Complete
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.appointments.status', $app->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="dropdown-item-custom text-danger">
                                            <i class="fa-regular fa-circle-xmark mr-2"></i>
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <button class="action-btn delete" onclick="confirmDelete({{ $app->id }})">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            
                            <form id="delete-form-{{ $app->id }}" 
                                  action="{{ route('admin.appointments.delete', $app->id) }}" 
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="fa-regular fa-calendar-xmark"></i>
                        <h5>No appointments found</h5>
                        <p class="text-gray-400 text-sm mt-2">Try adjusting your filters or create a new appointment</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if($appointments->hasPages())
    <div class="pagination-wrapper">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if($appointments->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fa-solid fa-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->previousPageUrl() }}">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                    @if($page == $appointments->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($appointments->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->nextPageUrl() }}">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fa-solid fa-chevron-right"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-premium">
            <div class="modal-header-premium">
                <h5 class="modal-title-premium">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Confirm Delete
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body-premium">
                <p>Are you sure you want to delete this appointment? This action cannot be undone.</p>
            </div>
            <div class="modal-footer-premium">
                <button type="button" class="modal-btn cancel" data-bs-dismiss="modal">
                    <i class="fa-regular fa-xmark mr-2"></i>
                    Cancel
                </button>
                <button type="button" class="modal-btn delete" id="confirmDeleteBtn">
                    <i class="fa-regular fa-trash-can mr-2"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteId = null;
let deleteModal = null;

document.addEventListener('DOMContentLoaded', function() {
    if (typeof bootstrap !== 'undefined') {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    }
});

function confirmDelete(id) {
    deleteId = id;
    if (deleteModal) {
        deleteModal.show();
    }
}

document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
    if (deleteId) {
        document.getElementById('delete-form-' + deleteId).submit();
    }
});

function toggleDropdown(id) {
    const dropdown = document.getElementById('dropdown-' + id);
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
        
        // Close when clicking outside
        document.addEventListener('click', function closeDropdown(e) {
            if (!dropdown.contains(e.target) && !e.target.closest('.action-btn.edit')) {
                dropdown.style.display = 'none';
                document.removeEventListener('click', closeDropdown);
            }
        });
    } else {
        dropdown.style.display = 'none';
    }
}

// Initialize Bootstrap components if available
if (typeof bootstrap !== 'undefined') {
    // Close alerts
    document.querySelectorAll('[data-bs-dismiss="alert"]').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.alert-premium').remove();
        });
    });
}
</script>
@endsection