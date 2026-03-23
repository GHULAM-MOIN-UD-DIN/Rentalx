@extends('layouts.app')

@section('content')
<style>
    .appointment-hero {
        background: linear-gradient(135deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 100%),
                    url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        min-height: 40vh;
    }
    
    .form-section {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 2rem;
        backdrop-filter: blur(10px);
    }
    
    .form-input, .form-select {
        width: 100%;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        color: white;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.3s;
    }
    
    .form-input:focus, .form-select:focus {
        border-color: #ef4444;
        background: rgba(239,68,68,0.04);
        box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
    }
    
    .form-input::placeholder {
        color: rgba(255,255,255,0.3);
    }
    
    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        color: rgba(255,255,255,0.5);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    
    .addon-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .addon-checkbox:hover {
        border-color: #ef4444;
        background: rgba(239,68,68,0.04);
    }
    
    .addon-checkbox input[type="checkbox"] {
        accent-color: #ef4444;
        width: 1rem;
        height: 1rem;
    }
    
    .summary-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: 1.5rem;
        padding: 1.5rem;
        position: sticky;
        top: 100px;
    }
    
    .car-summary-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 1rem;
        border: 1px solid rgba(239,68,68,0.3);
    }
</style>

<!-- Sweet Alert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- HERO SECTION -->
<section class="appointment-hero flex items-center pt-32 pb-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-black italic mb-4">BOOK YOUR <span class="text-red-500">RIDE</span></h1>
        <p class="text-gray-400 max-w-2xl mx-auto">Complete the form below to reserve your dream car. Our team will confirm your booking within 4 minutes.</p>
    </div>
</section>

<!-- APPOINTMENT FORM -->
<section class="py-16 px-4">
    <div class="container mx-auto max-w-6xl">
        <form action="{{ route('appointment.store') }}" method="POST" id="appointmentForm">
            @csrf
            
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Form Fields (2/3 width) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    @if(session('error'))
                        <div class="bg-red-600/20 border border-red-500 rounded-xl p-4 text-red-400">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Personal Information -->
                    <div class="form-section p-6">
                        <h3 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-regular fa-user text-red-500"></i>
                            PERSONAL INFORMATION
                        </h3>
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" class="form-input @error('first_name') border-red-500 @enderror" 
                                       placeholder="Alex" value="{{ old('first_name') }}" required>
                                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" class="form-input @error('last_name') border-red-500 @enderror" 
                                       placeholder="Jordan" value="{{ old('last_name') }}" required>
                                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="form-label">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" class="form-input @error('email') border-red-500 @enderror" 
                                       placeholder="you@email.com" value="{{ old('email') }}" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-input" 
                                       placeholder="+1 212 000 0000" value="{{ old('phone') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Rental Details -->
                    <div class="form-section p-6">
                        <h3 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-red-500"></i>
                            RENTAL DETAILS
                        </h3>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Pick-up Date <span class="text-red-500">*</span></label>
                                <input type="date" name="pickup_date" class="form-input @error('pickup_date') border-red-500 @enderror" 
                                       value="{{ old('pickup_date') }}" required min="{{ date('Y-m-d') }}" id="pickupDate">
                                @error('pickup_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Return Date <span class="text-red-500">*</span></label>
                                <input type="date" name="return_date" class="form-input @error('return_date') border-red-500 @enderror" 
                                       value="{{ old('return_date') }}" required min="{{ date('Y-m-d') }}" id="returnDate">
                                @error('return_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label">Delivery Location <span class="text-red-500">*</span></label>
                            <select name="delivery_location" class="form-select @error('delivery_location') border-red-500 @enderror" required>
                                <option value="">Select Location</option>
                                <option value="Dubai HQ" {{ old('delivery_location') == 'Dubai HQ' ? 'selected' : '' }}>Dubai — HQ</option>
                                <option value="Dubai Airport" {{ old('delivery_location') == 'Dubai Airport' ? 'selected' : '' }}>Dubai Airport (DXB)</option>
                                <option value="Abu Dhabi Airport" {{ old('delivery_location') == 'Abu Dhabi Airport' ? 'selected' : '' }}>Abu Dhabi Airport</option>
                                <option value="Hotel Delivery" {{ old('delivery_location') == 'Hotel Delivery' ? 'selected' : '' }}>Hotel Delivery</option>
                                <option value="Home Delivery" {{ old('delivery_location') == 'Home Delivery' ? 'selected' : '' }}>Home Delivery</option>
                                <option value="Custom Address" {{ old('delivery_location') == 'Custom Address' ? 'selected' : '' }}>Custom Address</option>
                            </select>
                            @error('delivery_location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-4">
                            <label class="form-label">Special Requests (Optional)</label>
                            <textarea name="special_requests" class="form-input" rows="3" 
                                      placeholder="Any special requirements? Let us know...">{{ old('special_requests') }}</textarea>
                        </div>
                    </div>

                    <!-- Add-ons -->
                    <div class="form-section p-6">
                        <h3 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-plus-circle text-red-500"></i>
                            ADD-ONS
                        </h3>

                        <div class="grid sm:grid-cols-2 gap-3">
                            <label class="addon-checkbox">
                                <input type="checkbox" name="addons[]" value="Chauffeur" class="addon-checkbox" 
                                       {{ is_array(old('addons')) && in_array('Chauffeur', old('addons')) ? 'checked' : '' }}>
                                <div class="flex-1 flex justify-between">
                                    <span>Chauffeur</span>
                                    <span class="text-red-400">+$150/d</span>
                                </div>
                            </label>
                            <label class="addon-checkbox">
                                <input type="checkbox" name="addons[]" value="GPS Navigation" class="addon-checkbox"
                                       {{ is_array(old('addons')) && in_array('GPS Navigation', old('addons')) ? 'checked' : '' }}>
                                <div class="flex-1 flex justify-between">
                                    <span>GPS Navigation</span>
                                    <span class="text-red-400">+$30</span>
                                </div>
                            </label>
                            <label class="addon-checkbox">
                                <input type="checkbox" name="addons[]" value="Child Seat" class="addon-checkbox"
                                       {{ is_array(old('addons')) && in_array('Child Seat', old('addons')) ? 'checked' : '' }}>
                                <div class="flex-1 flex justify-between">
                                    <span>Child Seat</span>
                                    <span class="text-red-400">+$20</span>
                                </div>
                            </label>
                            <label class="addon-checkbox">
                                <input type="checkbox" name="addons[]" value="Zero-Excess Cover" class="addon-checkbox"
                                       {{ is_array(old('addons')) && in_array('Zero-Excess Cover', old('addons')) ? 'checked' : '' }}>
                                <div class="flex-1 flex justify-between">
                                    <span>Zero-Excess Cover</span>
                                    <span class="text-red-400">+$200</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Summary (1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="summary-card">
                        <h3 class="text-xl font-black mb-4">BOOKING SUMMARY</h3>
                        
                        <!-- Car Details -->
                        <div class="mb-4">
                            @if(isset($car))
                                <img src="{{ asset('car_images/'.$car->image) }}" alt="{{ $car->name }}" class="car-summary-img mb-3">
                                <h4 class="font-bold text-lg">{{ $car->brand }} {{ $car->model }}</h4>
                                <p class="text-sm text-gray-400">{{ $car->description ?? 'Premium vehicle' }}</p>
                                
                                <!-- Hidden inputs for car data -->
                                <input type="hidden" name="car_name" value="{{ $car->brand }} {{ $car->model }}">
                                <input type="hidden" name="price_per_day" value="{{ $car->price_per_day }}" id="pricePerDay">
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                            @else
                                <div class="bg-white/5 rounded-xl p-4 text-center mb-3">
                                    <i class="fa-solid fa-car text-red-500/30 text-4xl mb-2"></i>
                                    <p class="text-sm text-gray-400">Select a car from fleet</p>
                                </div>
                                <input type="hidden" name="car_name" value="{{ old('car_name') }}" id="carName">
                                <input type="hidden" name="price_per_day" value="{{ old('price_per_day', 0) }}" id="pricePerDay">
                            @endif
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-3 py-4 border-t border-white/10">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Daily Rate</span>
                                <span class="font-bold" id="displayDailyRate">${{ isset($car) ? number_format($car->price_per_day) : '0' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Number of Days</span>
                                <span class="font-bold" id="displayDays">1</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Add-ons</span>
                                <span class="font-bold" id="displayAddons">$0</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Insurance</span>
                                <span class="text-green-400">Included</span>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center py-4 border-t border-white/10">
                            <span class="text-lg font-black">TOTAL</span>
                            <span class="text-2xl font-black text-red-500" id="displayTotal">${{ isset($car) ? number_format($car->price_per_day) : '0' }}</span>
                        </div>

                        <!-- Hidden total input -->
                        <input type="hidden" name="total_price" id="totalPrice" value="{{ isset($car) ? $car->price_per_day : 0 }}">

                        <!-- Submit Button -->
                        <button type="submit" id="submitBtn" class="w-full bg-red-600 hover:bg-red-700 py-4 rounded-full font-black tracking-widest text-sm uppercase transition-all flex items-center justify-center gap-2 mt-4">
                            <i class="fa-solid fa-bolt"></i>
                            CONFIRM BOOKING
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-3">
                            <i class="fa-regular fa-clock"></i> Our team will confirm within 4 minutes
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Sweet Alert Success Message -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Booking Confirmed!',
        html: `
            <div class="text-center">
                <i class="fa-solid fa-circle-check text-6xl text-green-500 mb-4"></i>
                <p class="text-lg mb-2">Your appointment has been booked successfully!</p>
                <p class="text-sm text-gray-400">Booking ID: #{{ session('appointment_id') }}</p>
                <p class="text-sm text-gray-400 mt-2">Our team will confirm within 4 minutes</p>
            </div>
        `,
        showConfirmButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'View Details',
        showCancelButton: true,
        cancelButtonColor: '#6b7280',
        cancelButtonText: 'Book Another',
        background: '#1a1a1a',
        color: '#fff',
        backdrop: 'rgba(0,0,0,0.8)'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("appointment.details", session("appointment_id")) }}';
        } else {
            // Stay on same page to book another
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
</script>
@endif

<!-- Loading Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pickupDate = document.getElementById('pickupDate');
    const returnDate = document.getElementById('returnDate');
    const pricePerDay = parseFloat(document.getElementById('pricePerDay')?.value || 0);
    const displayDays = document.getElementById('displayDays');
    const displayDailyRate = document.getElementById('displayDailyRate');
    const displayAddons = document.getElementById('displayAddons');
    const displayTotal = document.getElementById('displayTotal');
    const totalInput = document.getElementById('totalPrice');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('appointmentForm');
    
    // Add-on prices
    const addonPrices = {
        'Chauffeur': 150,
        'GPS Navigation': 30,
        'Child Seat': 20,
        'Zero-Excess Cover': 200
    };

    function calculateDays() {
        if (pickupDate?.value && returnDate?.value) {
            const start = new Date(pickupDate.value);
            const end = new Date(returnDate.value);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            return diffDays > 0 ? diffDays : 1;
        }
        return 1;
    }

    function calculateAddons() {
        let total = 0;
        document.querySelectorAll('input[name="addons[]"]:checked').forEach(checkbox => {
            total += addonPrices[checkbox.value] || 0;
        });
        return total;
    }

    function updateSummary() {
        const days = calculateDays();
        const addonsTotal = calculateAddons();
        const dailyRate = pricePerDay;
        const subtotal = dailyRate * days;
        const total = subtotal + addonsTotal;
        
        displayDays.textContent = days;
        displayDailyRate.textContent = '$' + dailyRate.toLocaleString();
        displayAddons.textContent = '$' + addonsTotal.toLocaleString();
        displayTotal.textContent = '$' + total.toLocaleString();
        
        if (totalInput) {
            totalInput.value = total;
        }
    }

    // Show loading animation on form submit
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> PROCESSING...';
        submitBtn.disabled = true;
    });

    // Event listeners
    if (pickupDate) pickupDate.addEventListener('change', updateSummary);
    if (returnDate) returnDate.addEventListener('change', updateSummary);
    
    document.querySelectorAll('input[name="addons[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });

    // Set min dates
    if (pickupDate) {
        pickupDate.min = new Date().toISOString().split('T')[0];
        pickupDate.addEventListener('change', function() {
            if (returnDate) {
                returnDate.min = this.value;
            }
        });
    }

    // Initial calculation
    updateSummary();
});
</script>
@endsection