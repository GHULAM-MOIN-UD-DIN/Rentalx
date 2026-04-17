@extends('layouts.app')

@section('content')
<!-- Profile Header with Cover -->
<div class="relative h-64 md:h-80 overflow-hidden">
    <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    
    <!-- Profile Info Overlay -->
    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
        <div class="container mx-auto flex flex-col md:flex-row items-start md:items-end gap-6">
            <!-- Profile Photo -->
            <div class="relative -mb-12 md:mb-0">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-2xl border-4 border-white/10 overflow-hidden bg-gradient-to-br from-red-600 to-orange-500 shadow-2xl">
                    <img src="{{ $user->profile->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                </div>
                <button onclick="document.getElementById('profile-photo-input').click()" class="absolute -bottom-2 -right-2 w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition shadow-lg cursor-pointer">
                    <i class="fa-solid fa-camera text-xs"></i>
                </button>
                <input type="file" id="profile-photo-input" class="hidden" accept="image/*" onchange="uploadPhoto(this, 'profile')">
            </div>
            
            <!-- User Info -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-black">{{ $user->name }}</h1>
                    @php $badge = $user->profile->membership_badge; @endphp
                    <span class="px-3 py-1 bg-{{ $badge['bg'] }} text-{{ $badge['color'] }} rounded-full text-xs font-bold flex items-center gap-1">
                        <i class="{{ $badge['icon'] }}"></i>
                        {{ $badge['name'] }} Member
                    </span>
                </div>
                
                <div class="flex flex-wrap gap-4 text-sm text-gray-300">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-envelope text-red-400"></i>
                        {{ $user->email }}
                    </div>
                    @if($user->profile->phone)
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-phone text-red-400"></i>
                        {{ $user->profile->phone }}
                    </div>
                    @endif
                    @if($user->profile->city)
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-location-dot text-red-400"></i>
                        {{ $user->profile->city }}, {{ $user->profile->country ?? 'Pakistan' }}
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Edit Button -->
            <a href="{{ route('profile.edit') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/10 px-6 py-3 rounded-xl text-sm font-bold transition flex items-center gap-2">
                <i class="fa-regular fa-pen-to-square"></i>
                Edit Profile
            </a>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="container mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Left Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Profile Completion Card -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-red-400"></i>
                    Profile Completion
                </h3>
                <div class="mb-2 flex justify-between text-sm">
                    <span class="text-gray-400">{{ $user->profile->completion_percentage }}% Complete</span>
                    <span class="text-red-400">{{ 100 - $user->profile->completion_percentage }}% remaining</span>
                </div>
                <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full" style="width: {{ $user->profile->completion_percentage }}%"></div>
                </div>
                
                @if($user->profile->completion_percentage < 100)
                <a href="{{ route('profile.edit') }}" class="mt-4 text-sm text-red-400 hover:text-red-300 flex items-center gap-1">
                    <i class="fa-solid fa-circle-arrow-right"></i>
                    Complete your profile
                </a>
                @endif
            </div>
            
            <!-- Stats Card -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-chart-simple text-red-400"></i>
                    Statistics
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-3 bg-white/5 rounded-xl">
                        <div class="text-2xl font-black text-red-400">{{ $user->orders()->count() }}</div>
                        <div class="text-xs text-gray-400">Total Orders</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 rounded-xl">
                        <div class="text-2xl font-black text-red-400">{{ $user->appointments()->count() }}</div>
                        <div class="text-xs text-gray-400">Appointments</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 rounded-xl">
                        <div class="text-2xl font-black text-red-400">{{ $user->wishlists()->count() }}</div>
                        <div class="text-xs text-gray-400">Wishlist</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 rounded-xl">
                        <div class="text-2xl font-black text-red-400">{{ $user->profile->reward_points }}</div>
                        <div class="text-xs text-gray-400">Points</div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-link text-red-400"></i>
                    Quick Links
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('profile.orders') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-cart-shopping text-red-400 w-5"></i>
                            My Orders
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-500"></i>
                    </a>
                    <a href="{{ route('profile.appointments') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-regular fa-calendar-check text-red-400 w-5"></i>
                            Appointments
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-500"></i>
                    </a>
                    <a href="{{ route('profile.wishlist') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-regular fa-heart text-red-400 w-5"></i>
                            Wishlist
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-500"></i>
                    </a>
                    <a href="{{ route('profile.settings') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-gear text-red-400 w-5"></i>
                            Settings
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-500"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Right Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Bio Section -->
            @if($user->profile->bio)
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-3 flex items-center gap-2">
                    <i class="fa-regular fa-message text-red-400"></i>
                    About Me
                </h3>
                <p class="text-gray-300">{{ $user->profile->bio }}</p>
            </div>
            @endif
            
            <!-- Personal Information -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-id-card text-red-400"></i>
                    Personal Information
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    @if($user->profile->date_of_birth)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Date of Birth</p>
                        <p class="text-sm">{{ $user->profile->date_of_birth->format('F d, Y') }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->gender)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Gender</p>
                        <p class="text-sm">{{ ucfirst(str_replace('_', ' ', $user->profile->gender)) }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->phone)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Phone</p>
                        <p class="text-sm">{{ $user->profile->phone }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->alternate_phone)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Alternate Phone</p>
                        <p class="text-sm">{{ $user->profile->alternate_phone }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->occupation)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Occupation</p>
                        <p class="text-sm">{{ $user->profile->occupation }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->company)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Company</p>
                        <p class="text-sm">{{ $user->profile->company }}</p>
                    </div>
                    @endif
                    
                    @if($user->profile->website)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Website</p>
                        <a href="{{ $user->profile->website }}" target="_blank" class="text-sm text-red-400 hover:text-red-300">{{ $user->profile->website }}</a>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Address Information -->
            @if($user->profile->full_address)
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-location-dot text-red-400"></i>
                    Address
                </h3>
                <p class="text-gray-300">{{ $user->profile->full_address }}</p>
            </div>
            @endif
            
            <!-- Social Links -->
            @if($user->profile->social_facebook || $user->profile->social_twitter || $user->profile->social_instagram || $user->profile->social_linkedin)
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-share-nodes text-red-400"></i>
                    Social Links
                </h3>
                <div class="flex gap-3">
                    @if($user->profile->social_facebook)
                    <a href="{{ $user->profile->social_facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-[#1877f2]/20 flex items-center justify-center hover:bg-[#1877f2] transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    @endif
                    
                    @if($user->profile->social_twitter)
                    <a href="{{ $user->profile->social_twitter }}" target="_blank" class="w-10 h-10 rounded-full bg-black/20 flex items-center justify-center hover:bg-black transition">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    @endif
                    
                    @if($user->profile->social_instagram)
                    <a href="{{ $user->profile->social_instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-pink-600/20 flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @endif
                    
                    @if($user->profile->social_linkedin)
                    <a href="{{ $user->profile->social_linkedin }}" target="_blank" class="w-10 h-10 rounded-full bg-[#0a66c2]/20 flex items-center justify-center hover:bg-[#0a66c2] transition">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- Membership Info -->
            <div class="bg-gradient-to-br from-red-600/10 to-orange-600/10 border border-red-500/20 rounded-2xl p-6">
                <h3 class="font-black mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-crown text-red-400"></i>
                    Membership Benefits
                </h3>
                
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-400">Current Tier</p>
                        <p class="text-2xl font-black text-{{ $badge['color'] }}">{{ $badge['name'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Reward Points</p>
                        <p class="text-2xl font-black text-red-400">{{ $badge['points'] }}</p>
                    </div>
                </div>
                
                @if($badge['next_tier'])
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-400">{{ $badge['points'] }} points</span>
                        <span class="text-red-400">{{ $badge['points_to_next'] }} needed for {{ ucfirst($badge['next_tier']) }}</span>
                    </div>
                    @php $progress = ($badge['points'] / ($badge['points'] + $badge['points_to_next'])) * 100; @endphp
                    <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full" style="width: {{ $progress }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Upload photo function
function uploadPhoto(input, type) {
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('photo', input.files[0]);
        formData.append('type', type);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Show loading
        Swal.fire({
            title: 'Uploading...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch('{{ route("profile.upload.photo") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'Something went wrong'
            });
        });
    }
}
</script>
@endsection