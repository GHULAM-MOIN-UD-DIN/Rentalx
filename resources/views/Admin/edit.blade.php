@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX EDIT PRODUCT - ULTRA-PREMIUM STYLES
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
}

/* ===== ANIMATIONS ===== */
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
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

.page-header p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.page-header p strong {
    color: var(--primary);
}

.back-btn {
    background: rgba(255, 255, 255, 0.03);
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

/* ===== ALERTS ===== */
.alert-error {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 1rem;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--danger);
    animation: slideInUp 0.5s ease-out;
}

.alert-error i {
    font-size: 1.25rem;
    animation: pulse 2s infinite;
}

.alert-error ul {
    margin-top: 0.5rem;
    margin-left: 1.5rem;
    color: var(--text-secondary);
}

/* ===== CONTENT GRID ===== */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    align-items: start;
}

/* ===== FORM CARD ===== */
.form-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    overflow: hidden;
    animation: scaleIn 0.6s ease-out;
}

.form-card:hover {
    border-color: var(--border-hover);
    box-shadow: 0 30px 60px -15px rgba(239, 68, 68, 0.3);
}

/* Form Header */
.form-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
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

/* Form Body */
.form-body {
    padding: 2rem;
}

/* Section Headers */
.section-header {
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.section-header i {
    color: var(--primary);
    width: 2rem;
    height: 2rem;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Form Grids */
.form-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
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

.form-label {
    font-size: 0.75rem;
    font-weight: 800;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-left: 0.5rem;
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
    font-size: 0.95rem;
    transition: all 0.3s;
    width: 100%;
}

.form-input:hover {
    border-color: var(--primary-light);
    background: rgba(239, 68, 68, 0.02);
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
}

.form-input.error {
    border-color: var(--danger);
}

/* Textarea */
.form-textarea {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid var(--border);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    color: white;
    font-size: 0.95rem;
    transition: all 0.3s;
    width: 100%;
    min-height: 120px;
    resize: vertical;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
}

/* File Input */
.file-input {
    background: rgba(0, 0, 0, 0.3);
    border: 2px dashed var(--border);
    border-radius: 1.5rem;
    padding: 1rem;
    color: white;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s;
}

.file-input:hover {
    border-color: var(--primary);
    background: rgba(239, 68, 68, 0.05);
}

.file-input::file-selector-button {
    background: var(--primary);
    border: none;
    border-radius: 1rem;
    padding: 0.5rem 1rem;
    color: white;
    font-weight: 600;
    margin-right: 1rem;
    cursor: pointer;
    transition: all 0.3s;
}

.file-input::file-selector-button:hover {
    background: var(--primary-dark);
    transform: scale(1.05);
}

/* Gallery Preview */
.gallery-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1rem;
}

.gallery-item {
    position: relative;
    width: 5rem;
    height: 5rem;
    border-radius: 1rem;
    overflow: hidden;
    border: 2px solid var(--border);
    transition: all 0.3s;
}

.gallery-item:hover {
    border-color: var(--primary);
    transform: scale(1.1);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.gallery-item:hover .gallery-item-overlay {
    opacity: 1;
}

.gallery-item-overlay i {
    color: white;
    font-size: 1rem;
}

/* Checkbox */
.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 1rem 0;
    padding: 0.75rem;
    background: rgba(239, 68, 68, 0.05);
    border: 1px solid rgba(239, 68, 68, 0.1);
    border-radius: 1rem;
}

.checkbox-wrapper input[type="checkbox"] {
    width: 1.25rem;
    height: 1.25rem;
    accent-color: var(--primary);
}

.checkbox-wrapper label {
    color: white;
    font-weight: 600;
}

/* Error Message */
.error-message {
    color: var(--danger);
    font-size: 0.7rem;
    margin-left: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.btn-cancel {
    flex: 1;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 1rem;
    color: var(--text-secondary);
    font-weight: 800;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    text-align: center;
}

.btn-cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
    transform: translateY(-2px);
}

.btn-submit {
    flex: 1;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 1rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 20px 30px -10px rgba(239, 68, 68, 0.3);
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 25px 40px -15px rgba(239, 68, 68, 0.5);
}

/* ===== SIDEBAR CARDS ===== */
.sidebar-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 1.5rem;
    animation: slideInRight 0.6s ease-out;
    margin-bottom: 1.5rem;
}

.sidebar-card:hover {
    border-color: var(--border-hover);
    box-shadow: 0 20px 40px -15px rgba(239, 68, 68, 0.2);
}

.sidebar-card h3 {
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sidebar-card h3 i {
    color: var(--primary);
}

/* Current Image */
.current-image {
    border-radius: 1.5rem;
    overflow: hidden;
    position: relative;
}

.current-image img {
    width: 100%;
    height: 16rem;
    object-fit: cover;
    transition: all 0.5s;
}

.current-image:hover img {
    transform: scale(1.1);
}

.image-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.current-image:hover .image-overlay {
    opacity: 1;
}

.image-overlay span {
    background: rgba(255, 255, 255, 0.9);
    color: var(--dark);
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-weight: 700;
    font-size: 0.75rem;
}

/* Stats List */
.stats-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.stat-value {
    color: white;
    font-weight: 700;
}

.rating-display {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.rating-display i {
    color: #fbbf24;
    font-size: 0.75rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.7rem;
    font-weight: 700;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.status-badge.out {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.status-badge.discontinued {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

/* Help Card */
.help-card {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 2rem;
    padding: 1.5rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.help-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.2), transparent 70%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.help-card i {
    font-size: 2rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}

.help-card h4 {
    font-size: 1.25rem;
    font-weight: 900;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.help-card p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.875rem;
    position: relative;
    z-index: 1;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .form-grid-2,
    .form-grid-3 {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
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
    
    .page-header h1 {
        font-size: 1.5rem;
    }
    
    .back-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <h1>EDIT <span>PRODUCT</span></h1>
        <p>Updating: <strong>{{ $product->name }}</strong></p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to List
    </a>
</div>

<!-- ERROR ALERTS -->
@if(session('error'))
<div class="alert-error">
    <i class="fa-regular fa-circle-exclamation"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

@if($errors->any())
<div class="alert-error">
    <i class="fa-regular fa-circle-exclamation"></i>
    <div>
        <span>Please fix the following errors:</span>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- CONTENT GRID -->
<div class="content-grid">
    
    <!-- MAIN FORM -->
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="form-header-content">
                <h2>Edit Product Information</h2>
                <p>Update the product details below</p>
            </div>
        </div>

        <div class="form-body">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <h3 class="section-header">
                    <i class="fa-regular fa-info-circle"></i>
                    Basic Information
                </h3>

                <div class="form-grid-2">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Product Name
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-input @error('name') error @enderror" 
                               value="{{ old('name', $product->name) }}">
                        @error('name')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-layer-group"></i>
                            Category
                        </label>
                        <input type="text" 
                               name="category" 
                               class="form-input @error('category') error @enderror" 
                               value="{{ old('category', $product->category) }}">
                        @error('category')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">
                            <i class="fa-regular fa-message"></i>
                            Description
                        </label>
                        <textarea name="description" 
                                  class="form-textarea @error('description') error @enderror" 
                                  rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <h3 class="section-header">
                    <i class="fa-regular fa-chart-line"></i>
                    Pricing & Stock
                </h3>

                <div class="form-grid-3">
                    <!-- Price -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-dollar-sign"></i>
                            Price (Rs)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="price" 
                               class="form-input @error('price') error @enderror" 
                               value="{{ old('price', $product->price) }}">
                        @error('price')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Old Price -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-tag"></i>
                            Old Price
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="old_price" 
                               class="form-input" 
                               value="{{ old('old_price', $product->old_price) }}">
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-cubes"></i>
                            Stock
                        </label>
                        <input type="number" 
                               name="stock" 
                               class="form-input @error('stock') error @enderror" 
                               value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <h3 class="section-header">
                    <i class="fa-regular fa-gear"></i>
                    Specifications
                </h3>

                <div class="form-grid-2">
                    <!-- Brand -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-building"></i>
                            Brand
                        </label>
                        <input type="text" 
                               name="brand" 
                               class="form-input" 
                               value="{{ old('brand', $product->brand) }}">
                    </div>

                    <!-- Model -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-barcode"></i>
                            Model
                        </label>
                        <input type="text" 
                               name="model" 
                               class="form-input" 
                               value="{{ old('model', $product->model) }}">
                    </div>

                    <!-- Material -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-shirt"></i>
                            Material
                        </label>
                        <input type="text" 
                               name="material" 
                               class="form-input" 
                               value="{{ old('material', $product->material) }}">
                    </div>

                    <!-- Weight -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-weight-hanging"></i>
                            Weight
                        </label>
                        <input type="text" 
                               name="weight" 
                               class="form-input" 
                               value="{{ old('weight', $product->weight) }}">
                    </div>

                    <!-- Manufacturer -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-industry"></i>
                            Manufacturer
                        </label>
                        <input type="text" 
                               name="manufacturer" 
                               class="form-input" 
                               value="{{ old('manufacturer', $product->manufacturer) }}">
                    </div>

                    <!-- Origin -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-globe"></i>
                            Country of Origin
                        </label>
                        <input type="text" 
                               name="origin" 
                               class="form-input" 
                               value="{{ old('origin', $product->origin) }}">
                    </div>
                </div>

                <!-- Images -->
                <h3 class="section-header">
                    <i class="fa-regular fa-image"></i>
                    Product Images
                </h3>

                <div class="form-grid-2">
                    <!-- Main Image -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-image"></i>
                            Replace Main Image
                        </label>
                        <input type="file" 
                               name="image" 
                               class="file-input" 
                               accept="image/jpeg,image/png,image/jpg">
                        @error('image')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Gallery Images -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-images"></i>
                            Add Gallery Images
                        </label>
                        <input type="file" 
                               name="gallery_images[]" 
                               class="file-input" 
                               accept="image/jpeg,image/png,image/jpg" 
                               multiple>
                        <small class="text-xs text-gray-500 ml-2">You can select multiple images</small>
                    </div>
                </div>

                <!-- Current Gallery -->
                @if($product->gallery_images && count($product->gallery_images) > 0)
                <div class="gallery-preview">
                    @foreach($product->gallery_images as $image)
                    <div class="gallery-item">
                        <img src="{{ asset('products/'.$image) }}" alt="Gallery">
                        <div class="gallery-item-overlay">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- SEO Section -->
                <h3 class="section-header">
                    <i class="fa-regular fa-search"></i>
                    SEO Settings
                </h3>

                <div class="form-grid-2">
                    <!-- Meta Title -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-heading"></i>
                            Meta Title
                        </label>
                        <input type="text" 
                               name="meta_title" 
                               class="form-input" 
                               value="{{ old('meta_title', $product->meta_title) }}">
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-key"></i>
                            Meta Keywords
                        </label>
                        <input type="text" 
                               name="meta_keywords" 
                               class="form-input" 
                               value="{{ old('meta_keywords', $product->meta_keywords) }}">
                    </div>

                    <!-- Meta Description -->
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">
                            <i class="fa-regular fa-message"></i>
                            Meta Description
                        </label>
                        <textarea name="meta_description" 
                                  class="form-textarea" 
                                  rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                    </div>
                </div>

                <!-- Featured Checkbox -->
                <div class="checkbox-wrapper">
                    <input type="checkbox" 
                           name="featured" 
                           id="featured" 
                           value="1" 
                           {{ old('featured', $product->featured) ? 'checked' : '' }}>
                    <label for="featured">Mark as Featured Product</label>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                        <i class="fa-regular fa-xmark"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div>
        <!-- Current Image Card -->
        <div class="sidebar-card">
            <h3>
                <i class="fa-regular fa-image"></i>
                Current Main Image
            </h3>
            <div class="current-image">
                @if($product->image && file_exists(public_path('products/'.$product->image)))
                    <img src="{{ asset('products/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <div style="height: 16rem; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3);">
                        <i class="fa-regular fa-image fa-3x" style="color: var(--text-muted);"></i>
                    </div>
                @endif
                <div class="image-overlay">
                    <span>Preview Mode</span>
                </div>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="sidebar-card">
            <h3>
                <i class="fa-regular fa-chart-simple"></i>
                Product Statistics
            </h3>
            <div class="stats-list">
                <div class="stat-item">
                    <span class="stat-label">Total Sold</span>
                    <span class="stat-value">{{ number_format($product->sold_count ?? 0) }} units</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Average Rating</span>
                    <div class="rating-display">
                        <span class="stat-value">{{ number_format($product->rating ?? 0, 1) }}</span>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Total Reviews</span>
                    <span class="stat-value">{{ number_format($product->reviews_count ?? 0) }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Status</span>
                    @if($product->status == 'active')
                        <span class="status-badge active">Active</span>
                    @elseif($product->status == 'out_of_stock')
                        <span class="status-badge out">Out of Stock</span>
                    @else
                        <span class="status-badge discontinued">Discontinued</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Help Card -->
        <div class="help-card">
            <i class="fa-regular fa-circle-info"></i>
            <h4>Helpful Tip</h4>
            <p>Make sure your product image is high quality (min 800x800) for the best customer experience on the front-end.</p>
        </div>
    </div>
</div>

<script>
// File input preview
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {
        const files = this.files;
        const parent = this.closest('.form-group');
        const label = parent.querySelector('.form-label');
        
        if (files.length > 0) {
            if (files.length === 1) {
                label.innerHTML = `<i class="fa-regular fa-image"></i> Selected: ${files[0].name}`;
            } else {
                label.innerHTML = `<i class="fa-regular fa-images"></i> Selected: ${files.length} files`;
            }
        } else {
            label.innerHTML = this.hasAttribute('multiple') 
                ? '<i class="fa-regular fa-images"></i> Add Gallery Images'
                : '<i class="fa-regular fa-image"></i> Replace Main Image';
        }
    });
});

// GSAP Animations
if (typeof gsap !== 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        gsap.from('.form-group', {
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.03,
            ease: 'power2.out'
        });
        
        gsap.from('.sidebar-card', {
            x: 30,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power2.out'
        });
    });
}
</script>
@endsection