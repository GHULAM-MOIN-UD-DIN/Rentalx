@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX CAR LIST - ULTRA-PREMIUM STYLES
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
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
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
    animation: slideInUp 0.6s ease-out;
}

.page-header h1 {
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(135deg, white, #e5e7eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.25rem;
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.add-btn {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

.add-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    color: white;
}

/* ===== STATS CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
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
}

.stat-card:hover {
    border-color: var(--primary);
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
}

.stat-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.25rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
}

/* ===== FILTERS ===== */
.filters-section {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    min-width: 250px;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.875rem;
}

.search-box input {
    width: 100%;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-select {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 2rem 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    cursor: pointer;
    min-width: 150px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
}

/* ===== CARS GRID ===== */
.cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.car-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    overflow: hidden;
    transition: all 0.4s;
}

.car-card:hover {
    transform: translateY(-8px);
    border-color: var(--primary);
    box-shadow: 0 15px 30px rgba(239, 68, 68, 0.3);
}

.car-image {
    height: 200px;
    background: linear-gradient(135deg, #1f2937, #111827);
    position: relative;
    overflow: hidden;
}

.car-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s;
}

.car-card:hover .car-image img {
    transform: scale(1.1);
}

.car-image .image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.car-image .image-placeholder i {
    font-size: 3rem;
    color: var(--text-muted);
    opacity: 0.5;
}

.availability-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.4rem 1rem;
    border-radius: 2rem;
    font-size: 0.65rem;
    font-weight: 700;
    z-index: 10;
    backdrop-filter: blur(10px);
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.availability-badge.available {
    background: rgba(16, 185, 129, 0.2);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.availability-badge.unavailable {
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

.car-content {
    padding: 1.5rem;
}

.car-brand {
    color: var(--primary);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
}

.car-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.75rem;
}

.car-title h3 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    margin: 0;
}

.price-tag {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 0.4rem 1rem;
    border-radius: 2rem;
    font-weight: 900;
    font-size: 1rem;
    color: white;
    white-space: nowrap;
}

.price-tag small {
    font-size: 0.65rem;
    opacity: 0.8;
}

.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.5rem;
    margin: 1rem 0;
    padding: 1rem 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}

.spec-item {
    text-align: center;
}

.spec-item i {
    color: var(--primary);
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.spec-item .spec-value {
    font-size: 0.875rem;
    font-weight: 700;
    color: white;
}

.spec-item .spec-label {
    font-size: 0.6rem;
    color: var(--text-secondary);
    text-transform: uppercase;
}

.description-preview {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin: 0.75rem 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-edit, .btn-delete {
    flex: 1;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.7rem;
    color: var(--text-secondary);
    font-size: 0.75rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-edit:hover {
    border-color: var(--info);
    color: var(--info);
    background: rgba(59, 130, 246, 0.1);
}

.btn-delete:hover {
    border-color: var(--danger);
    color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
}

/* ===== EMPTY STATE ===== */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2rem;
}

.empty-state i {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
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
    transition: all 0.3s;
}

.empty-state .add-first-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    color: white;
}

/* ===== PAGINATION ===== */
.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 0.35rem;
    list-style: none;
    padding: 0;
    margin: 0;
    flex-wrap: wrap;
    justify-content: center;
}

.page-item .page-link {
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

.modal-header-premium h5 {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modal-header-premium h5 i {
    color: var(--danger);
}

.modal-body-premium {
    padding: 1.5rem;
    color: var(--text-secondary);
}

.modal-footer-premium {
    padding: 1.5rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.btn-cancel-modal {
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.6rem 1.5rem;
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-cancel-modal:hover {
    border-color: var(--primary);
    color: white;
}

.btn-delete-modal {
    background: linear-gradient(135deg, var(--danger), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 0.6rem 1.5rem;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-delete-modal:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
}

.btn-close-custom {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    font-size: 1.25rem;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.btn-close-custom:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

/* ===== ALERT ===== */
.alert-premium {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 1rem;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #10b981;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .filters-section {
        flex-direction: column;
    }
    
    .search-box, .filter-select {
        width: 100%;
    }
    
    .cars-grid {
        grid-template-columns: 1fr;
    }
    
    .car-title {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <h1>FLEET <span>MANAGEMENT</span></h1>
        <p>Manage your premium vehicle collection</p>
    </div>
    <a href="{{ route('admin.rentacar.create') }}" class="add-btn">
        <i class="fa-solid fa-plus"></i>
        Add New Car
    </a>
</div>

<!-- SUCCESS ALERT -->
@if(session('success'))
<div class="alert-premium">
    <div class="d-flex align-items-center gap-3">
        <i class="fa-regular fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    <button type="button" class="btn-close-custom" onclick="this.parentElement.remove()">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
@endif

<!-- STATS CARDS -->
<div class="stats-grid">
    @php
        $totalCars = $cars->total();
        $availableCars = $cars->where('is_available', 1)->count();
        $unavailableCars = $cars->where('is_available', 0)->count();
        $avgPrice = $cars->avg('price_per_day') ?? 0;
    @endphp
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-car-side"></i>
        </div>
        <div class="stat-label">Total Cars</div>
        <div class="stat-value">{{ $totalCars }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="color: #10b981;">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="stat-label">Available</div>
        <div class="stat-value">{{ $availableCars }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="color: #ef4444;">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <div class="stat-label">Unavailable</div>
        <div class="stat-value">{{ $unavailableCars }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="color: #f59e0b;">
            <i class="fa-solid fa-dollar-sign"></i>
        </div>
        <div class="stat-label">Avg. Price</div>
        <div class="stat-value">${{ number_format($avgPrice, 0) }}</div>
    </div>
</div>

<!-- FILTERS -->
<div class="filters-section">
    <div class="search-box">
        <i class="fa-regular fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Search by brand or model...">
    </div>
    
    <select class="filter-select" id="availabilityFilter">
        <option value="">All Cars</option>
        <option value="1">Available Only</option>
        <option value="0">Unavailable Only</option>
    </select>
    
    <select class="filter-select" id="sortFilter">
        <option value="name_asc">Name A-Z</option>
        <option value="name_desc">Name Z-A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
</div>

<!-- CARS GRID -->
<div class="cars-grid" id="carsGrid">
    @forelse($cars as $car)
    <div class="car-card" 
         data-brand="{{ strtolower($car->brand) }}" 
         data-model="{{ strtolower($car->model) }}"
         data-price="{{ $car->price_per_day }}"
         data-available="{{ $car->is_available ? '1' : '0' }}">
        
        <!-- Car Image -->
        <div class="car-image">
            @if($car->image && file_exists(public_path('car_images/' . $car->image)))
                <img src="{{ asset('car_images/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}">
            @else
                <div class="image-placeholder">
                    <i class="fa-solid fa-car-side"></i>
                </div>
            @endif
            
            <!-- Availability Badge -->
            <div class="availability-badge {{ $car->is_available ? 'available' : 'unavailable' }}">
                <i class="fa-regular {{ $car->is_available ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                {{ $car->is_available ? 'Available' : 'Unavailable' }}
            </div>
        </div>
        
        <!-- Car Content -->
        <div class="car-content">
            <div class="car-brand">{{ $car->brand }}</div>
            <div class="car-title">
                <h3>{{ $car->model }}</h3>
                <span class="price-tag">
                    ${{ number_format($car->price_per_day) }}<small>/day</small>
                </span>
            </div>
            
            <!-- Specs -->
            @if($car->horsepower || $car->acceleration || $car->top_speed)
            <div class="specs-grid">
                @if($car->horsepower)
                <div class="spec-item">
                    <i class="fa-solid fa-horse-head"></i>
                    <div class="spec-value">{{ $car->horsepower }} HP</div>
                    <div class="spec-label">Power</div>
                </div>
                @endif
                
                @if($car->acceleration)
                <div class="spec-item">
                    <i class="fa-solid fa-gauge-high"></i>
                    <div class="spec-value">{{ $car->acceleration }}s</div>
                    <div class="spec-label">0-100</div>
                </div>
                @endif
                
                @if($car->top_speed)
                <div class="spec-item">
                    <i class="fa-solid fa-gauge-max"></i>
                    <div class="spec-value">{{ $car->top_speed }} km/h</div>
                    <div class="spec-label">Top Speed</div>
                </div>
                @endif
            </div>
            @endif
            
            <!-- Description -->
            @if($car->description)
            <div class="description-preview">
                {{ Str::limit($car->description, 100) }}
            </div>
            @endif
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.rentacar.edit', $car->id) }}" class="btn-edit">
                    <i class="fa-regular fa-pen-to-square"></i>
                    Edit
                </a>
                <button type="button" class="btn-delete" onclick="confirmDelete({{ $car->id }}, '{{ $car->brand }} {{ $car->model }}')">
                    <i class="fa-regular fa-trash-can"></i>
                    Delete
                </button>
            </div>
            
            <!-- FIXED: Delete Form - Changed route name from 'admin.rentacar.destroy' to 'admin.rentacar.delete' -->
            <form id="delete-form-{{ $car->id }}" 
                  action="{{ route('admin.rentacar.delete', $car->id) }}" 
                  method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="fa-regular fa-car-side"></i>
        <h3>No Cars Found</h3>
        <p>Get started by adding your first vehicle to the fleet</p>
        <a href="{{ route('admin.rentacar.create') }}" class="add-first-btn">
            <i class="fa-regular fa-plus"></i>
            Add Your First Car
        </a>
    </div>
    @endforelse
</div>

<!-- PAGINATION -->
@if(method_exists($cars, 'links'))
<div class="pagination-wrapper">
    {{ $cars->links() }}
</div>
@endif

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-premium">
            <div class="modal-header-premium">
                <h5>
                    <i class="fa-regular fa-triangle-exclamation"></i>
                    Confirm Delete
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body-premium" id="deleteModalBody">
                Are you sure you want to delete this car? This action cannot be undone.
            </div>
            <div class="modal-footer-premium">
                <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-delete-modal" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // ===== DELETE CONFIRMATION =====
    let deleteId = null;
    let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    
    window.confirmDelete = function(id, carName) {
        deleteId = id;
        $('#deleteModalBody').html(`Are you sure you want to delete <strong>${carName}</strong>? This action cannot be undone.`);
        deleteModal.show();
    };
    
    $('#confirmDeleteBtn').click(function() {
        if (deleteId) {
            $('#delete-form-' + deleteId).submit();
        }
    });
    
    // ===== SEARCH AND FILTER =====
    function filterAndSortCars() {
        const searchTerm = $('#searchInput').val().toLowerCase().trim();
        const availability = $('#availabilityFilter').val();
        const sortBy = $('#sortFilter').val();
        
        const cards = $('.car-card').get();
        
        // Filter
        const filteredCards = cards.filter(card => {
            const $card = $(card);
            const brand = $card.data('brand') || '';
            const model = $card.data('model') || '';
            const isAvailable = $card.data('available') === '1';
            
            if (searchTerm && !brand.includes(searchTerm) && !model.includes(searchTerm)) {
                return false;
            }
            
            if (availability !== '') {
                const shouldBeAvailable = availability === '1';
                if (isAvailable !== shouldBeAvailable) return false;
            }
            
            return true;
        });
        
        // Sort
        filteredCards.sort((a, b) => {
            const $a = $(a);
            const $b = $(b);
            const priceA = parseFloat($a.data('price')) || 0;
            const priceB = parseFloat($b.data('price')) || 0;
            const nameA = ($a.data('brand') + ' ' + $a.data('model')).toLowerCase();
            const nameB = ($b.data('brand') + ' ' + $b.data('model')).toLowerCase();
            
            switch(sortBy) {
                case 'name_asc': return nameA.localeCompare(nameB);
                case 'name_desc': return nameB.localeCompare(nameA);
                case 'price_asc': return priceA - priceB;
                case 'price_desc': return priceB - priceA;
                default: return 0;
            }
        });
        
        // Hide all and show filtered
        $('.car-card').hide();
        $(filteredCards).show();
        
        // Handle empty state
        if (filteredCards.length === 0) {
            if ($('.empty-state').length === 0) {
                $('#carsGrid').append(`
                    <div class="empty-state">
                        <i class="fa-regular fa-car-side"></i>
                        <h3>No Cars Found</h3>
                        <p>No vehicles match your search criteria</p>
                    </div>
                `);
            }
        } else {
            $('.empty-state').remove();
        }
    }
    
    // Debounce function
    let timeout;
    $('#searchInput').on('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(filterAndSortCars, 300);
    });
    
    $('#availabilityFilter, #sortFilter').on('change', filterAndSortCars);
    
    // ===== AUTO-HIDE ALERT =====
    setTimeout(function() {
        $('.alert-premium').fadeOut(500, function() {
            $(this).remove();
        });
    }, 3000);
});
</script>
@endsection