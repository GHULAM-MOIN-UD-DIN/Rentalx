@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX EDIT CAR - ULTRA-PREMIUM STYLES
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
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.back-btn {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    text-decoration: none;
}

.back-btn:hover {
    border-color: var(--primary);
    color: white;
    transform: translateX(-5px);
    background: rgba(239, 68, 68, 0.1);
}

/* ===== FORM CONTAINER ===== */
.form-container {
    max-width: 900px;
    margin: 0 auto;
}

.form-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    overflow: hidden;
}

/* Form Header */
.form-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.form-header-icon {
    width: 4rem;
    height: 4rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: var(--shadow-primary-lg);
}

.form-header-content h2 {
    font-size: 1.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.25rem;
}

.form-header-content p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* Form Body */
.form-body {
    padding: 2rem;
}

/* Grid Layout */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Form Groups */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label i {
    color: var(--primary);
}

/* Input Styles */
.form-input {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
    width: 100%;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Textarea */
.form-textarea {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
    width: 100%;
    min-height: 120px;
    resize: vertical;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Select */
.form-select {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
    width: 100%;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1.5rem center;
    padding-right: 3rem;
}

.form-select:focus {
    outline: none;
    border-color: var(--primary);
}

/* Current Image */
.current-image {
    margin: 1rem 0;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.current-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 0.5rem;
}

.current-image-info {
    flex: 1;
}

.current-image-info p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.current-image-info small {
    color: var(--text-muted);
    font-size: 0.7rem;
}

/* File Input */
.file-input-wrapper {
    position: relative;
    margin-top: 1rem;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 10;
}

.file-label {
    background: rgba(0, 0, 0, 0.3);
    border: 2px dashed var(--border);
    border-radius: 1.5rem;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    cursor: pointer;
}

.file-label:hover {
    border-color: var(--primary);
    background: rgba(239, 68, 68, 0.05);
}

.file-label i {
    font-size: 2rem;
    color: var(--primary);
}

.file-label span {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

/* New Image Preview */
.image-preview {
    margin-top: 1rem;
    display: none;
    border-radius: 1rem;
    overflow: hidden;
}

.image-preview.active {
    display: block;
}

.image-preview img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 1rem 2rem;
    color: var(--text-secondary);
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
}

.btn-submit {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 1rem 2.5rem;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: var(--shadow-primary);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-primary-lg);
}

/* Responsive */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .btn-cancel,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .form-header {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <h1>EDIT <span>VEHICLE</span></h1>
        <p class="text-gray-400 text-sm mt-1">Update vehicle information</p>
    </div>
    <a href="{{ route('admin.rentacar.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Fleet
    </a>
</div>

<!-- FORM CONTAINER -->
<div class="form-container">
    <div class="form-card">
        
        <!-- FORM HEADER -->
        <div class="form-header">
            <div class="form-header-icon">
                <i class="fa-solid fa-car-side"></i>
            </div>
            <div class="form-header-content">
                <h2>{{ $car->brand }} {{ $car->model }}</h2>
                <p>Edit the details below to update this vehicle</p>
            </div>
        </div>

        <!-- FORM BODY -->
        <div class="form-body">
            <form action="{{ route('admin.rentacar.update', $car->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="editCarForm">
                @csrf
                @method('PUT')

                <!-- Basic Information - 2 Column Grid -->
                <div class="form-grid">
                    <!-- Brand -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Brand
                        </label>
                        <input type="text" 
                               name="brand" 
                               class="form-input" 
                               value="{{ old('brand', $car->brand) }}"
                               required>
                    </div>

                    <!-- Model -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Model
                        </label>
                        <input type="text" 
                               name="model" 
                               class="form-input" 
                               value="{{ old('model', $car->model) }}"
                               required>
                    </div>
                </div>

                <!-- Pricing & Availability -->
                <div class="form-grid">
                    <!-- Price Per Day -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-dollar-sign"></i>
                            Price Per Day ($)
                        </label>
                        <input type="number" 
                               name="price_per_day" 
                               class="form-input" 
                               value="{{ old('price_per_day', $car->price_per_day) }}">
                    </div>

                    <!-- Availability -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-circle-check"></i>
                            Availability
                        </label>
                        <select name="is_available" class="form-select">
                            <option value="1" {{ $car->is_available ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !$car->is_available ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>
                </div>

                <!-- Performance Specs -->
                <h3 style="color: white; font-weight: 800; margin: 1.5rem 0 1rem;">
                    Performance Specifications
                </h3>

                <div class="form-grid">
                    <!-- Horsepower -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-horse-head"></i>
                            Horsepower
                        </label>
                        <input type="number" 
                               name="horsepower" 
                               class="form-input" 
                               value="{{ old('horsepower', $car->horsepower) }}">
                    </div>

                    <!-- Acceleration -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-gauge-high"></i>
                            Acceleration (0-100 km/h)
                        </label>
                        <input type="text" 
                               name="acceleration" 
                               class="form-input" 
                               value="{{ old('acceleration', $car->acceleration) }}">
                    </div>

                    <!-- Top Speed -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-gauge-max"></i>
                            Top Speed
                        </label>
                        <input type="text" 
                               name="top_speed" 
                               class="form-input" 
                               value="{{ old('top_speed', $car->top_speed) }}">
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-message"></i>
                        Description
                    </label>
                    <textarea name="description" 
                              class="form-textarea">{{ old('description', $car->description) }}</textarea>
                </div>

                <!-- Current Image -->
                @if($car->image)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}">
                    <div class="current-image-info">
                        <p>Current Image</p>
                        <small>Upload a new image below to replace this one</small>
                    </div>
                </div>
                @endif

                <!-- New Image Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-image"></i>
                        New Image (Optional)
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" 
                               name="image" 
                               id="carImage" 
                               class="file-input" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <div class="file-label">
                            <i class="fa-regular fa-cloud-upload"></i>
                            <span>Click to upload new image</span>
                        </div>
                    </div>
                    <div class="image-preview" id="imagePreview">
                        <img src="" alt="Preview">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.rentacar.index') }}" class="btn-cancel">
                        <i class="fa-regular fa-xmark"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Update Vehicle</span>
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Image Preview
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.add('active');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.remove('active');
    }
}

// Form Loading State
document.getElementById('editCarForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('loading');
    submitBtn.innerHTML = '<span>Updating...</span> <i class="fa-solid fa-spinner fa-spin"></i>';
});

// GSAP Animations
if (typeof gsap !== 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        gsap.from('.form-group', {
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.05,
            ease: 'power2.out'
        });
    });
}
</script>
@endsection