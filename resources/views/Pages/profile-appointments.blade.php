@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="relative h-48 md:h-64 overflow-hidden">
    <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8 container mx-auto">
        <h1 class="text-3xl md:text-4xl font-black flex items-center gap-3">
            <i class="fa-solid fa-calendar-check text-red-500"></i>
            My Appointments
        </h1>
        <p class="text-gray-300 mt-2">Track and manage your car rental bookings</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 sticky top-24">
                <div class="flex items-center gap-4 mb-8">
                    <img src="{{ $user->profile->profile_photo_url }}" alt="Profile" class="w-12 h-12 rounded-xl object-cover border-2 border-red-500/50">
                    <div>
                        <h3 class="font-bold text-sm">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-regular fa-user w-5"></i>
                        Profile Overview
                    </a>
                    <a href="{{ route('profile.orders') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-solid fa-cart-shopping w-5"></i>
                        My Orders
                    </a>
                    <a href="{{ route('profile.appointments') }}" class="flex items-center gap-3 p-3 rounded-xl bg-red-600/10 text-red-500 border border-red-500/20 font-bold transition">
                        <i class="fa-regular fa-calendar-check w-5"></i>
                        Appointments
                    </a>
                    <a href="{{ route('profile.wishlist') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-regular fa-heart w-5"></i>
                        Wishlist
                    </a>
                    <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-400">
                        <i class="fa-solid fa-gear w-5"></i>
                        Settings
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Appointments Content -->
        <div class="lg:col-span-3 space-y-6">
            @if($appointments->isEmpty())
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-16 text-center">
                <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-regular fa-calendar-xmark text-4xl text-red-500"></i>
                </div>
                <h2 class="text-2xl font-black mb-2">No Appointments Found</h2>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">You haven't booked any car rental services yet. Browse our luxury fleet today!</p>
                <a href="{{ route('rentacar.page') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-bold transition inline-flex items-center gap-2">
                    Explore Cars
                    <i class="fa-solid fa-car"></i>
                </a>
            </div>
            @else
                @foreach($appointments as $appointment)
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden hover:border-red-500/30 transition group">
                    <div class="flex flex-col md:flex-row">
                        <!-- Car Image -->
                        <div class="w-full md:w-48 h-48 bg-white/5 overflow-hidden">
                            @if($appointment->car && $appointment->car->image_url)
                                <img src="{{ $appointment->car->image_url }}" alt="{{ $appointment->car_name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-red-600/10">
                                    <i class="fa-solid fa-car text-4xl text-red-500"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-black text-white group-hover:text-red-500 transition">{{ $appointment->car_name }}</h3>
                                    <div class="flex items-center gap-3 mt-1 text-sm text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-red-500"></i>
                                            {{ $appointment->pickup_date->format('M d') }} - {{ $appointment->return_date->format('M d, Y') }}
                                        </span>
                                        <span class="text-gray-600">|</span>
                                        <span class="flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot text-red-500"></i>
                                            {{ $appointment->delivery_location }}
                                        </span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                    @if($appointment->status == 'pending') bg-yellow-500/20 text-yellow-500 border border-yellow-500/20
                                    @elseif($appointment->status == 'confirmed') bg-green-500/20 text-green-500 border border-green-500/20
                                    @elseif($appointment->status == 'cancelled') bg-red-500/20 text-red-500 border border-red-500/20
                                    @else bg-blue-500/20 text-blue-500 border border-blue-500/20 @endif">
                                    {{ $appointment->status }}
                                </span>
                            </div>

                            <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-6">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Total Price</p>
                                        <p class="font-black text-red-500">Rs. {{ number_format($appointment->total_price) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Booking ID</p>
                                        <p class="font-bold text-xs text-white">#APT-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('appointment.details', $appointment->id) }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-xs font-bold transition">View Details</a>
                                    @if($appointment->status == 'pending')
                                    <button onclick="cancelAppointment({{ $appointment->id }})" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-bold transition">Cancel</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function cancelAppointment(id) {
    Swal.fire({
        title: 'Cancel Booking?',
        text: "Are you sure you want to cancel this car rental service? This cannot be undone.",
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

<style>
/* Custom Pagination Styles */
.pagination {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}
.page-item .page-link {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #9ca3af;
    padding: 0.5rem 1rem;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}
.page-item.active .page-link {
    background: #ef4444;
    border-color: #ef4444;
    color: white;
}
.page-item:hover .page-link {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.5);
    color: #ef4444;
}
</style>
@endsection
