@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX ADD CAR FORM - ULTRA-PREMIUM STYLES
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

@keyframes shine {
    0% { transform: translateX(-100%) rotate(45deg); }
    100% { transform: translateX(100%) rotate(45deg); }
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
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header .back-btn {
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

.page-header .back-btn:hover {
    border-color: var(--primary);
    color: white;
    transform: translateX(-5px);
    background: rgba(239, 68, 68, 0.1);
}

/* ===== FORM CONTAINER ===== */
.form-container {
    max-width: 900px;
    margin: 0 auto;
    animation: scaleIn 0.6s ease-out;
}

.form-card {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    overflow: hidden;
    position: relative;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 0% 0%, rgba(239, 68, 68, 0.1), transparent 70%);
    opacity: 0;
    transition: opacity 0.5s;
    pointer-events: none;
}

.form-card:hover::before {
    opacity: 1;
}

/* ===== FORM HEADER ===== */
.form-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    overflow: hidden;
}

.form-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary), var(--accent), var(--primary), transparent);
    animation: borderGlow 3s linear infinite;
}

@keyframes borderGlow {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
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
    animation: float 3s ease-in-out infinite;
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

/* ===== FORM BODY ===== */
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

.form-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Form Groups */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    animation: slideInUp 0.5s ease-out;
    animation-fill-mode: both;
}

.form-group:nth-child(1) { animation-delay: 0.05s; }
.form-group:nth-child(2) { animation-delay: 0.1s; }
.form-group:nth-child(3) { animation-delay: 0.15s; }
.form-group:nth-child(4) { animation-delay: 0.2s; }
.form-group:nth-child(5) { animation-delay: 0.25s; }
.form-group:nth-child(6) { animation-delay: 0.3s; }
.form-group:nth-child(7) { animation-delay: 0.35s; }
.form-group:nth-child(8) { animation-delay: 0.4s; }

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
    font-size: 0.875rem;
}

.required-star {
    color: var(--primary);
    margin-left: 0.25rem;
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

.form-input:hover {
    border-color: var(--primary-light);
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    background: rgba(0, 0, 0, 0.5);
}

.form-input::placeholder {
    color: var(--text-muted);
    font-size: 0.875rem;
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
    font-family: inherit;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    background: rgba(0, 0, 0, 0.5);
}

.form-textarea::placeholder {
    color: var(--text-muted);
}

/* Select Styles */
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

.form-select:hover {
    border-color: var(--primary-light);
}

.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-select option {
    background: var(--darker);
    color: white;
}

/* File Input */
.file-input-wrapper {
    position: relative;
    width: 100%;
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
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.3s;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.file-label:hover {
    border-color: var(--primary);
    background: rgba(239, 68, 68, 0.05);
}

.file-label i {
    font-size: 2.5rem;
    color: var(--primary);
    transition: all 0.3s;
}

.file-label:hover i {
    transform: scale(1.1);
}

.file-label span {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.file-label small {
    font-size: 0.7rem;
    color: var(--text-muted);
}

.file-preview {
    margin-top: 1rem;
    display: none;
    position: relative;
    border-radius: 1rem;
    overflow: hidden;
}

.file-preview img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
    border-radius: 1rem;
}

.file-preview.active {
    display: block;
    animation: scaleIn 0.3s ease-out;
}

/* ===== SPECS GRID ===== */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 0.5rem;
}

.spec-input-group {
    position: relative;
}

.spec-input {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 0.75rem 1rem;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s;
    width: 100%;
    padding-left: 2.5rem;
}

.spec-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.spec-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary);
    font-size: 0.875rem;
}

/* ===== FORM ACTIONS ===== */
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
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
    transform: translateY(-2px);
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
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-primary);
}

.btn-submit::before {
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

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-primary-lg);
}

.btn-submit:hover::before {
    width: 300px;
    height: 300px;
}

.btn-submit:active {
    transform: translateY(0) scale(0.95);
}

.btn-submit i {
    font-size: 1rem;
    transition: transform 0.3s;
}

.btn-submit:hover i {
    transform: translateX(5px) rotate(5deg);
}

/* ===== ERROR STATES ===== */
.form-input.error,
.form-select.error,
.form-textarea.error {
    border-color: var(--danger);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.error-message {
    color: var(--danger);
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 0.25rem;
    margin-left: 1rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* ===== SUCCESS MESSAGE ===== */
.success-message {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 1rem;
    color: var(--success);
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: slideInUp 0.3s ease-out;
}

.success-message i {
    font-size: 1.25rem;
}

/* ===== LOADING STATE ===== */
.btn-submit.loading {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-submit.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .form-grid,
    .form-grid-3,
    .specs-grid {
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

@media (max-width: 480px) {
    .form-body {
        padding: 1.5rem;
    }
    
    .form-header {
        padding: 1.5rem;
    }
    
    .form-header-icon {
        width: 3rem;
        height: 3rem;
        font-size: 1.5rem;
    }
    
    .form-header-content h2 {
        font-size: 1.25rem;
    }
}
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <h1>ADD NEW <span>VEHICLE</span></h1>
        <p class="text-gray-400 text-sm mt-1">Add a new car to your premium fleet</p>
    </div>
    <a href="{{ route('admin.rentacar.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to List
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
                <h2>Vehicle Information</h2>
                <p>Fill in the details below to add a new vehicle to your fleet</p>
            </div>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
        <div class="success-message" style="margin: 1.5rem 2rem 0;">
            <i class="fa-regular fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- FORM BODY -->
        <div class="form-body">
            <form action="{{ route('admin.rentacar.store') }}" method="POST" enctype="multipart/form-data" id="addCarForm">
                @csrf

                <!-- Basic Information - 2 Column Grid -->
                <div class="form-grid">
                    <!-- Brand -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Brand <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="brand" 
                               class="form-input @error('brand') error @enderror" 
                               placeholder="e.g., Audi, BMW, Mercedes"
                               value="{{ old('brand') }}"
                               required>
                        @error('brand')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Model -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Model <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="model" 
                               class="form-input @error('model') error @enderror" 
                               placeholder="e.g., RS6, M5, S63"
                               value="{{ old('model') }}"
                               required>
                        @error('model')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Pricing & Availability - 2 Column Grid -->
                <div class="form-grid">
                    <!-- Price Per Day -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-dollar-sign"></i>
                            Price Per Day (PKR)
                        </label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 1.5rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);">Rs</span>
                            <input type="number" 
                                   name="price_per_day" 
                                   class="form-input" 
                                   placeholder="25000"
                                   value="{{ old('price_per_day') }}"
                                   style="padding-left: 3rem;">
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-circle-check"></i>
                            Availability Status
                        </label>
                        <select name="is_available" class="form-select">
                            <option value="1" selected>Available for Rent</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                </div>

                <!-- Performance Specs - 3 Column Grid -->
                <h3 style="color: white; font-weight: 800; margin: 1.5rem 0 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-gauge-high" style="color: var(--primary);"></i>
                    Performance Specifications
                </h3>

                <div class="specs-grid">
                    <!-- Horsepower -->
                    <div class="spec-input-group">
                        <i class="fa-solid fa-horse-head spec-icon"></i>
                        <input type="number" 
                               name="horsepower" 
                               class="spec-input" 
                               placeholder="Horsepower"
                               value="{{ old('horsepower') }}">
                    </div>

                    <!-- Acceleration -->
                    <div class="spec-input-group">
                        <i class="fa-solid fa-gauge spec-icon"></i>
                        <input type="text" 
                               name="acceleration" 
                               class="spec-input" 
                               placeholder="0-100 km/h"
                               value="{{ old('acceleration') }}">
                    </div>

                    <!-- Top Speed -->
                    <div class="spec-input-group">
                        <i class="fa-solid fa-gauge-high spec-icon"></i>
                        <input type="text" 
                               name="top_speed" 
                               class="spec-input" 
                               placeholder="Top Speed (km/h)"
                               value="{{ old('top_speed') }}">
                    </div>
                </div>

                <!-- Description - Full Width -->
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">
                        <i class="fa-regular fa-message"></i>
                        Description
                    </label>
                    <textarea name="description" 
                              class="form-textarea @error('description') error @enderror" 
                              placeholder="Enter vehicle description, features, and highlights...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">
                            <i class="fa-regular fa-circle-exclamation"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">
                        <i class="fa-regular fa-image"></i>
                        Vehicle Image
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
                            <span>Click or drag to upload</span>
                            <small>Supported: JPG, PNG, GIF (Max 5MB)</small>
                        </div>
                    </div>
                    <div class="file-preview" id="imagePreview">
                        <img src="" alt="Preview">
                    </div>
                    @error('image')
                        <span class="error-message">
                            <i class="fa-regular fa-circle-exclamation"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.rentacar.index') }}" class="btn-cancel">
                        <i class="fa-regular fa-xmark"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Add Vehicle</span>
                        <i class="fa-regular fa-plus"></i>
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
document.getElementById('addCarForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('loading');
    submitBtn.innerHTML = '<span>Adding Vehicle...</span> <i class="fa-solid fa-spinner"></i>';
});

// Auto-hide success message
document.addEventListener('DOMContentLoaded', function() {
    const successMsg = document.querySelector('.success-message');
    if (successMsg) {
        setTimeout(() => {
            successMsg.style.opacity = '0';
            successMsg.style.transition = 'opacity 0.5s';
            setTimeout(() => successMsg.remove(), 500);
        }, 3000);
    }
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
        
        gsap.from('.form-header-icon', {
            scale: 0,
            rotation: -180,
            duration: 0.8,
            ease: 'back.out(1.7)'
        });
    });
}
</script>
@endsection