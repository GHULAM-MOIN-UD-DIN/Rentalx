@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="relative h-48 md:h-64 overflow-hidden">
    @if($appointment->car && $appointment->car->image_url)
        <img src="{{ $appointment->car->image_url }}" alt="Car" class="w-full h-full object-cover">
    @else
        <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8 container mx-auto">
        <h1 class="text-3xl md:text-4xl font-black flex items-center gap-3">
            <i class="fa-solid fa-calendar-check text-red-500"></i>
            Booking Details
        </h1>
        <p class="text-gray-300 mt-2">Booking #APT-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }} • {{ $appointment->car_name }}</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Left Side: Booking Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Booking Status Card -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-black flex items-center gap-2">
                        <i class="fa-solid fa-signal text-red-500"></i>
                        Booking Status
                    </h3>
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider
                        @if($appointment->status == 'pending') bg-yellow-500/20 text-yellow-500 border border-yellow-500/20
                        @elseif($appointment->status == 'confirmed') bg-green-500/20 text-green-500 border border-green-500/20
                        @elseif($appointment->status == 'cancelled') bg-red-500/20 text-red-500 border border-red-500/20
                        @else bg-blue-500/20 text-blue-500 border border-blue-500/20 @endif">
                        {{ $appointment->status }}
                    </span>
                </div>
                
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                        <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Pickup Date</p>
                        <p class="font-black text-white">{{ $appointment->pickup_date->format('D, M d, Y') }}</p>
                    </div>
                    <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                        <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Return Date</p>
                        <p class="font-black text-white">{{ $appointment->return_date->format('D, M d, Y') }}</p>
                    </div>
                    <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                        <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Duration</p>
                        <p class="font-black text-red-500">{{ $appointment->days }} Days</p>
                    </div>
                </div>
            </div>

            <!-- Rental Details -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <h3 class="font-black flex items-center gap-2">
                        <i class="fa-solid fa-car text-red-500"></i>
                        Vehicle & Location
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="w-full md:w-64 h-40 rounded-2xl bg-white/5 border border-white/10 overflow-hidden">
                            @if($appointment->car && $appointment->car->image_url)
                                <img src="{{ $appointment->car->image_url }}" alt="{{ $appointment->car_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fa-solid fa-car text-4xl text-white/20"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-4">
                            <div>
                                <h4 class="text-2xl font-black text-white">{{ $appointment->car_name }}</h4>
                                <p class="text-sm text-gray-400">Luxury Rental Service</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-600/10 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-location-dot text-red-500"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Delivery Location</p>
                                    <p class="text-white font-bold">{{ $appointment->delivery_location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($appointment->special_requests)
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-pen-fancy text-red-500"></i>
                    Special Requests
                </h3>
                <p class="text-gray-300 text-sm leading-relaxed italic">"{{ $appointment->special_requests }}"</p>
            </div>
            @endif
        </div>

        <!-- Right Side: Pricing & Customer -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Pricing Card -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar text-red-500"></i>
                    Price Breakup
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Daily Rate</span>
                        <span class="font-bold">Rs. {{ number_format($appointment->price_per_day) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Days</span>
                        <span class="font-bold">x {{ $appointment->days }}</span>
                    </div>
                    @if($appointment->addons)
                    <div class="pt-2">
                        <p class="text-[10px] uppercase font-black text-gray-500 tracking-widest mb-2">Add-ons</p>
                        @foreach($appointment->addons as $addon)
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-400">• {{ $addon }}</span>
                            <span class="text-green-500 font-bold">Included</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="pt-4 border-t border-white/10 flex justify-between">
                        <span class="font-black text-lg">Total Amount</span>
                        <span class="font-black text-xl text-red-500">Rs. {{ number_format($appointment->total_price) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Card -->
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-user-tag text-red-500"></i>
                    Customer Info
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center">
                            <i class="fa-solid fa-user text-xs text-red-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Name</p>
                            <p class="text-sm font-bold">{{ $appointment->first_name }} {{ $appointment->last_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-xs text-red-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Email</p>
                            <p class="text-sm font-bold">{{ $appointment->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center">
                            <i class="fa-solid fa-phone text-xs text-red-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Phone</p>
                            <p class="text-sm font-bold">{{ $appointment->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($appointment->status == 'pending')
            <button onclick="cancelAppointment({{ $appointment->id }})" class="w-full bg-white/5 hover:bg-red-600/20 border border-white/10 hover:border-red-500/50 text-gray-400 hover:text-red-500 py-4 rounded-2xl font-black transition">
                CANCEL BOOKING
            </button>
            @endif
        </div>
    </div>
</div>

<script>
function cancelAppointment(id) {
    Swal.fire({
        title: 'Cancel Booking?',
        text: "Are you sure you want to cancel this booking? This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#374151',
        confirmButtonText: 'Yes, cancel it!',
        background: '#111',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/appointment/${id}/cancel`;
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }
    })
}
</script>
@endsection