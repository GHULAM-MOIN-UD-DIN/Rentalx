@extends('adminlayout.app')

@section('content')
<style>
/* ================================================
   RENTALX CREATE PRODUCT - ULTRA-PREMIUM STYLES
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
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
    letter-spacing: -0.02em;
}

.page-header h1 span {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-top: 0.25rem;
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
    box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
}

.back-btn i {
    transition: transform 0.3s;
}

.back-btn:hover i {
    transform: translateX(-3px);
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
    backdrop-filter: blur(10px);
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

.alert-error ul li {
    margin-bottom: 0.25rem;
}

/* ===== FORM CARD ===== */
.form-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 2.5rem;
    overflow: hidden;
    animation: scaleIn 0.6s ease-out;
    position: relative;
    margin-bottom: 2rem;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary), var(--accent), var(--primary), transparent);
    animation: shimmer 3s linear infinite;
}

.form-card:hover {
    border-color: var(--border-hover);
    box-shadow: var(--shadow-primary-lg);
}

/* Form Header */
.form-header {
    background: rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid var(--border);
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
    overflow: hidden;
}

.form-header::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 70% 30%, rgba(239, 68, 68, 0.1), transparent 70%);
    animation: rotate 20s linear infinite;
}

.form-header-icon {
    width: 4.5rem;
    height: 4.5rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    color: white;
    box-shadow: var(--shadow-primary-lg);
    position: relative;
    z-index: 10;
    animation: float 3s ease-in-out infinite;
}

.form-header-icon::after {
    content: '';
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, var(--primary), transparent);
    border-radius: 1.5rem;
    z-index: -1;
    animation: rotate 4s linear infinite;
}

.form-header-content {
    position: relative;
    z-index: 10;
}

.form-header-content h2 {
    font-size: 1.75rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.25rem;
    letter-spacing: -0.02em;
}

.form-header-content p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* Form Body */
.form-body {
    padding: 2.5rem;
}

/* Section Headers */
.section-header {
    font-size: 1.25rem;
    font-weight: 900;
    color: white;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid;
    border-image: linear-gradient(90deg, var(--primary), transparent) 1;
    position: relative;
}

.section-header i {
    color: var(--primary);
    font-size: 1.1rem;
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
    font-size: 0.875rem;
}

.required-star {
    color: var(--primary);
    margin-left: 0.25rem;
    animation: pulse 2s infinite;
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
    background: rgba(0, 0, 0, 0.5);
}

.form-input::placeholder {
    color: var(--text-muted);
    font-size: 0.875rem;
}

.form-input.error {
    border-color: var(--danger);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
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
    font-family: inherit;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
    background: rgba(0, 0, 0, 0.5);
}

.form-textarea::placeholder {
    color: var(--text-muted);
}

/* Input with Icon */
.input-with-icon {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary);
    font-size: 0.875rem;
    z-index: 10;
    opacity: 0.7;
}

.input-with-icon .form-input {
    padding-left: 3rem;
}

/* File Upload */
.file-upload {
    background: rgba(0, 0, 0, 0.3);
    border: 2px dashed var(--border);
    border-radius: 1.5rem;
    padding: 2.5rem 2rem;
    text-align: center;
    transition: all 0.3s;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.file-upload:hover {
    border-color: var(--primary);
    background: rgba(239, 68, 68, 0.05);
}

.file-upload::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 50% 50%, rgba(239, 68, 68, 0.1), transparent 70%);
    opacity: 0;
    transition: opacity 0.3s;
}

.file-upload:hover::before {
    opacity: 1;
}

.file-upload i {
    font-size: 3rem;
    color: var(--primary);
    margin-bottom: 1rem;
    transition: all 0.3s;
}

.file-upload:hover i {
    transform: scale(1.1) translateY(-5px);
}

.file-upload p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.file-upload small {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.file-upload input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}

/* Checkbox */
.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 2rem 0 1rem;
    padding: 1rem;
    background: rgba(239, 68, 68, 0.05);
    border: 1px solid rgba(239, 68, 68, 0.1);
    border-radius: 1rem;
    transition: all 0.3s;
}

.checkbox-wrapper:hover {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.2);
}

.checkbox-wrapper input[type="checkbox"] {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid var(--border);
    border-radius: 0.375rem;
    background: transparent;
    cursor: pointer;
    transition: all 0.3s;
    accent-color: var(--primary);
}

.checkbox-wrapper input[type="checkbox"]:checked {
    background: var(--primary);
    border-color: var(--primary);
}

.checkbox-wrapper label {
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
}

/* Error Message */
.error-message {
    color: var(--danger);
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 0.25rem;
    margin-left: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    animation: slideInLeft 0.3s ease-out;
}

.error-message i {
    font-size: 0.75rem;
}

/* Help Text */
.help-text {
    color: var(--text-muted);
    font-size: 0.7rem;
    margin-left: 0.5rem;
    margin-top: 0.25rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
    position: relative;
}

.form-actions::before {
    content: '';
    position: absolute;
    top: -1px;
    left: 0;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), transparent);
}

.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 2rem;
    padding: 1rem 2rem;
    color: var(--text-secondary);
    font-weight: 800;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.btn-cancel:hover {
    border-color: var(--primary);
    color: white;
    background: rgba(239, 68, 68, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -10px rgba(239, 68, 68, 0.3);
}

.btn-cancel i {
    transition: transform 0.3s;
}

.btn-cancel:hover i {
    transform: translateX(-3px);
}

.btn-submit {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: 2rem;
    padding: 1rem 2.5rem;
    color: white;
    font-weight: 800;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: var(--shadow-primary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    position: relative;
    overflow: hidden;
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

.btn-submit i {
    transition: transform 0.3s;
    font-size: 1rem;
}

.btn-submit:hover i {
    transform: translateX(5px) rotate(5deg);
}

.btn-submit:active {
    transform: translateY(0) scale(0.95);
}

/* Loading State */
.btn-submit.loading {
    opacity: 0.8;
    cursor: not-allowed;
}

.btn-submit.loading i {
    animation: rotate 1s linear infinite;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
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
        gap: 0.75rem;
    }
    
    .btn-cancel,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .form-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .form-header-icon {
        width: 4rem;
        height: 4rem;
        font-size: 2rem;
    }
    
    .form-body {
        padding: 1.5rem;
    }
    
    .section-header {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .page-header h1 {
        font-size: 1.75rem;
    }
    
    .back-btn {
        width: 100%;
        justify-content: center;
    }
    
    .form-header-content h2 {
        font-size: 1.5rem;
    }
    
    .file-upload {
        padding: 1.5rem;
    }
    
    .file-upload i {
        font-size: 2.5rem;
    }
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
</style>

<!-- PAGE CONTAINER -->
<div class="page-container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1>ADD NEW <span>PRODUCT</span></h1>
            <p>Create a new entry in your brand inventory</p>
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

    <!-- FORM CARD -->
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="form-header-content">
                <h2>Product Information</h2>
                <p>Fill in the details below to add a new product to your inventory</p>
            </div>
        </div>

        <div class="form-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
                @csrf

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
                            Product Name <span class="required-star">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-tag input-icon"></i>
                            <input type="text" 
                                   name="name" 
                                   class="form-input @error('name') error @enderror" 
                                   placeholder="e.g. Premium Leather Jacket"
                                   value="{{ old('name') }}"
                                   required>
                        </div>
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
                            Category <span class="required-star">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-layer-group input-icon"></i>
                            <input type="text" 
                                   name="category" 
                                   class="form-input @error('category') error @enderror" 
                                   placeholder="e.g. Apparel, Electronics"
                                   value="{{ old('category') }}"
                                   required>
                        </div>
                        @error('category')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Description - Full Width -->
                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">
                        <i class="fa-regular fa-message"></i>
                        Product Description <span class="required-star">*</span>
                    </label>
                    <textarea name="description" 
                              class="form-textarea @error('description') error @enderror" 
                              placeholder="Describe your product details here including features, benefits, and specifications..."
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">
                            <i class="fa-regular fa-circle-exclamation"></i>
                            {{ $message }}
                        </span>
                    @enderror
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
                            Price (Rs) <span class="required-star">*</span>
                        </label>
                        <div class="input-with-icon">
                            <span class="input-icon" style="font-weight: 700;">Rs</span>
                            <input type="number" 
                                   step="0.01" 
                                   name="price" 
                                   class="form-input @error('price') error @enderror" 
                                   placeholder="0.00"
                                   value="{{ old('price') }}"
                                   required>
                        </div>
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
                            Old Price (Rs)
                        </label>
                        <div class="input-with-icon">
                            <span class="input-icon" style="font-weight: 700;">Rs</span>
                            <input type="number" 
                                   step="0.01" 
                                   name="old_price" 
                                   class="form-input" 
                                   placeholder="0.00"
                                   value="{{ old('old_price') }}">
                        </div>
                        <span class="help-text">Original price before discount</span>
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-cubes"></i>
                            Stock Quantity <span class="required-star">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-cubes input-icon"></i>
                            <input type="number" 
                                   name="stock" 
                                   class="form-input @error('stock') error @enderror" 
                                   placeholder="e.g. 50"
                                   value="{{ old('stock') }}"
                                   required>
                        </div>
                        @error('stock')
                            <span class="error-message">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Product Specifications -->
                <h3 class="section-header">
                    <i class="fa-regular fa-gear"></i>
                    Product Specifications
                </h3>

                <div class="form-grid-2">
                    <!-- Brand -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-building"></i>
                            Brand
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-building input-icon"></i>
                            <input type="text" 
                                   name="brand" 
                                   class="form-input" 
                                   placeholder="e.g. Nike, Samsung, Audi"
                                   value="{{ old('brand') }}">
                        </div>
                    </div>

                    <!-- Model -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-barcode"></i>
                            Model
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-barcode input-icon"></i>
                            <input type="text" 
                                   name="model" 
                                   class="form-input" 
                                   placeholder="e.g. Air Max 2024, RS6"
                                   value="{{ old('model') }}">
                        </div>
                    </div>

                    <!-- Material -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-shirt"></i>
                            Material
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-shirt input-icon"></i>
                            <input type="text" 
                                   name="material" 
                                   class="form-input" 
                                   placeholder="e.g. Leather, Cotton, Aluminum"
                                   value="{{ old('material') }}">
                        </div>
                    </div>

                    <!-- Weight -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-weight-hanging"></i>
                            Weight
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-weight-hanging input-icon"></i>
                            <input type="text" 
                                   name="weight" 
                                   class="form-input" 
                                   placeholder="e.g. 500g, 2kg"
                                   value="{{ old('weight') }}">
                        </div>
                    </div>

                    <!-- Manufacturer -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-industry"></i>
                            Manufacturer
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-industry input-icon"></i>
                            <input type="text" 
                                   name="manufacturer" 
                                   class="form-input" 
                                   placeholder="e.g. Apple Inc., Audi AG"
                                   value="{{ old('manufacturer') }}">
                        </div>
                    </div>

                    <!-- Country of Origin -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-regular fa-globe"></i>
                            Country of Origin
                        </label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-globe input-icon"></i>
                            <input type="text" 
                                   name="origin" 
                                   class="form-input" 
                                   placeholder="e.g. China, USA, Germany"
                                   value="{{ old('origin') }}">
                        </div>
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
                            Main Image <span class="required-star">*</span>
                        </label>
                        <div class="file-upload" id="mainImageUpload">
                            <i class="fa-regular fa-cloud-upload"></i>
                            <p>Click or drag to upload main image</p>
                            <small>PNG, JPG, JPEG up to 2MB</small>
                            <input type="file" 
                                   name="image" 
                                   accept="image/jpeg,image/png,image/jpg"
                                   required>
                        </div>
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
                            Gallery Images (Optional)
                        </label>
                        <div class="file-upload" id="galleryUpload">
                            <i class="fa-regular fa-images"></i>
                            <p>Click or drag to upload multiple images</p>
                            <small>You can select multiple files (PNG, JPG, JPEG)</small>
                            <input type="file" 
                                   name="gallery_images[]" 
                                   accept="image/jpeg,image/png,image/jpg" 
                                   multiple>
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <h3 class="section-header">
                    <i class="fa-regular fa-search"></i>
                    SEO Settings (Optional)
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
                               placeholder="SEO title (leave empty to use product name)"
                               value="{{ old('meta_title') }}">
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
                               placeholder="keyword1, keyword2, keyword3"
                               value="{{ old('meta_keywords') }}">
                    </div>
                </div>

                <!-- Meta Description - Full Width -->
                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label">
                        <i class="fa-regular fa-message"></i>
                        Meta Description
                    </label>
                    <textarea name="meta_description" 
                              class="form-textarea" 
                              placeholder="Brief description for search engines (max 160 characters)">{{ old('meta_description') }}</textarea>
                </div>

                <!-- Featured Checkbox -->
                <div class="checkbox-wrapper">
                    <input type="checkbox" 
                           name="featured" 
                           id="featured" 
                           value="1" 
                           {{ old('featured') ? 'checked' : '' }}>
                    <label for="featured">Mark as Featured Product</label>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                        <i class="fa-regular fa-xmark"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Save Product</span>
                        <i class="fa-regular fa-circle-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// File upload preview
document.querySelectorAll('.file-upload input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        const parent = this.closest('.file-upload');
        const textEl = parent.querySelector('p');
        const iconEl = parent.querySelector('i');
        const files = this.files;
        
        if (files.length > 0) {
            if (files.length === 1) {
                textEl.textContent = files[0].name;
            } else {
                textEl.textContent = files.length + ' files selected';
            }
            // Change icon color to success
            iconEl.style.color = '#10b981';
            
            // Add success class animation
            parent.style.borderColor = '#10b981';
        } else {
            textEl.textContent = this.hasAttribute('multiple') 
                ? 'Click or drag to upload multiple images' 
                : 'Click or drag to upload main image';
            iconEl.style.color = 'var(--primary)';
            parent.style.borderColor = 'var(--border)';
        }
    });
});

// Form loading state
document.getElementById('productForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('loading');
    submitBtn.innerHTML = '<span>Saving Product...</span> <i class="fa-solid fa-spinner"></i>';
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
        
        gsap.from('.section-header', {
            x: -30,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out'
        });
    });
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-error');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

// Character counter for meta description
const metaDesc = document.querySelector('textarea[name="meta_description"]');
if (metaDesc) {
    metaDesc.addEventListener('input', function() {
        const maxLength = 160;
        const currentLength = this.value.length;
        
        // Create or update counter
        let counter = this.parentNode.querySelector('.char-counter');
        if (!counter) {
            counter = document.createElement('small');
            counter.className = 'help-text char-counter';
            this.parentNode.appendChild(counter);
        }
        
        counter.textContent = `${currentLength}/${maxLength} characters`;
        counter.style.color = currentLength > maxLength ? 'var(--danger)' : 'var(--text-muted)';
    });
}
</script>
@endsection