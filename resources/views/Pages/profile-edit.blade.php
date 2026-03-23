@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black to-[#070707] pt-24 pb-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header with Breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                <a href="{{ route('home') }}" class="hover:text-red-400 transition">Home</a>
                <i class="fa-solid fa-chevron-right text-xs"></i>
                <a href="{{ route('profile.index') }}" class="hover:text-red-400 transition">Profile</a>
                <i class="fa-solid fa-chevron-right text-xs"></i>
                <span class="text-red-400">Edit Profile</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-black italic">
                EDIT <span class="text-red-500">PROFILE</span>
            </h1>
            <p class="text-gray-400 mt-2">Update your personal information and settings</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-4 gap-8">
            
            <!-- Left Sidebar - Profile Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 sticky top-24">
                    <!-- Profile Photo -->
                    <div class="text-center mb-6">
                        <div class="relative inline-block">
                            <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-white/10 bg-gradient-to-br from-red-600 to-orange-500 mx-auto">
                                <img src="{{ $user->profile->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            </div>
                            <button onclick="document.getElementById('profile-photo-input').click()" 
                                    class="absolute -bottom-2 -right-2 w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition shadow-lg cursor-pointer border-2 border-black">
                                <i class="fa-solid fa-camera text-sm"></i>
                            </button>
                            <input type="file" id="profile-photo-input" class="hidden" accept="image/*" onchange="uploadPhoto(this, 'profile')">
                        </div>
                        <h2 class="text-xl font-bold mt-4">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        
                        <!-- Member Since -->
                        <div class="mt-3 inline-flex items-center gap-2 bg-white/5 px-4 py-2 rounded-full text-xs">
                            <i class="fa-regular fa-calendar text-red-400"></i>
                            <span>Member since {{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <!-- Cover Photo Upload -->
                    <div class="mt-6 pt-6 border-t border-white/10">
                        <h3 class="font-bold mb-3 flex items-center gap-2">
                            <i class="fa-regular fa-image text-red-400"></i>
                            Cover Photo
                        </h3>
                        <div class="relative h-20 rounded-xl overflow-hidden bg-gradient-to-r from-gray-800 to-gray-900">
                            <img src="{{ $user->profile->cover_photo_url }}" alt="Cover" class="w-full h-full object-cover opacity-50">
                            <button onclick="document.getElementById('cover-photo-input').click()" 
                                    class="absolute inset-0 w-full h-full flex items-center justify-center bg-black/50 hover:bg-black/70 transition">
                                <i class="fa-solid fa-camera text-2xl text-white"></i>
                            </button>
                            <input type="file" id="cover-photo-input" class="hidden" accept="image/*" onchange="uploadPhoto(this, 'cover')">
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="mt-6 p-4 bg-gradient-to-br from-red-600/10 to-orange-600/10 rounded-xl border border-red-500/20">
                        <h3 class="font-bold text-sm mb-2 flex items-center gap-2">
                            <i class="fa-regular fa-lightbulb text-red-400"></i>
                            Quick Tips
                        </h3>
                        <ul class="space-y-2 text-xs text-gray-300">
                            <li class="flex items-start gap-2">
                                <i class="fa-regular fa-circle-check text-green-400 mt-0.5"></i>
                                <span>Complete your profile to get better recommendations</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-regular fa-circle-check text-green-400 mt-0.5"></i>
                                <span>Add a profile photo to build trust</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-regular fa-circle-check text-green-400 mt-0.5"></i>
                                <span>Verify your email for account security</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Navigation Links -->
                    <div class="mt-6 space-y-2">
                        <a href="{{ route('profile.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-300 hover:text-red-400">
                            <i class="fa-regular fa-eye w-5"></i>
                            <span>View Profile</span>
                        </a>
                        <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition text-gray-300 hover:text-red-400">
                            <i class="fa-solid fa-gear w-5"></i>
                            <span>Account Settings</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side - Edit Form -->
            <div class="lg:col-span-3">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Card -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h2 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-regular fa-user text-red-400"></i>
                            PERSONAL INFORMATION
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Full Name <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition @error('name') border-red-500 @enderror"
                                       placeholder="Enter your full name" required>
                                @error('name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->profile->phone) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none @error('phone') border-red-500 @enderror"
                                       placeholder="+92 300 1234567">
                                @error('phone')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alternate Phone -->
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Alternate Phone
                                </label>
                                <input type="tel" name="alternate_phone" value="{{ old('alternate_phone', $user->profile->alternate_phone) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="+92 321 7654321">
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Date of Birth
                                </label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->profile->date_of_birth ? $user->profile->date_of_birth->format('Y-m-d') : '') }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none [color-scheme:dark]">
                            </div>

                            <!-- Gender -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Gender
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="male" 
                                               {{ old('gender', $user->profile->gender) == 'male' ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 bg-white/5 border-white/10 focus:ring-red-500 focus:ring-2">
                                        <span class="text-sm text-gray-300">Male</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="female"
                                               {{ old('gender', $user->profile->gender) == 'female' ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 bg-white/5 border-white/10 focus:ring-red-500 focus:ring-2">
                                        <span class="text-sm text-gray-300">Female</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="other"
                                               {{ old('gender', $user->profile->gender) == 'other' ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 bg-white/5 border-white/10 focus:ring-red-500 focus:ring-2">
                                        <span class="text-sm text-gray-300">Other</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="prefer_not_to_say"
                                               {{ old('gender', $user->profile->gender) == 'prefer_not_to_say' ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 bg-white/5 border-white/10 focus:ring-red-500 focus:ring-2">
                                        <span class="text-sm text-gray-300">Prefer not to say</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Card -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h2 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-red-400"></i>
                            ADDRESS INFORMATION
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Address Line 1 -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Address Line 1
                                </label>
                                <input type="text" name="address_line1" value="{{ old('address_line1', $user->profile->address_line1) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="House/Flat No., Street Name">
                            </div>

                            <!-- Address Line 2 -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Address Line 2
                                </label>
                                <input type="text" name="address_line2" value="{{ old('address_line2', $user->profile->address_line2) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="Area, Landmark (Optional)">
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    City
                                </label>
                                <input type="text" name="city" value="{{ old('city', $user->profile->city) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="e.g., Karachi">
                            </div>

                            <!-- State -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    State / Province
                                </label>
                                <input type="text" name="state" value="{{ old('state', $user->profile->state) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="e.g., Sindh">
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Postal Code
                                </label>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->profile->postal_code) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="e.g., 75000">
                            </div>

                            <!-- Country -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Country
                                </label>
                                <select name="country" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none appearance-none">
                                    <option value="" class="bg-gray-900">Select Country</option>
                                    <option value="Pakistan" {{ old('country', $user->profile->country) == 'Pakistan' ? 'selected' : '' }} class="bg-gray-900">Pakistan</option>
                                    <option value="UAE" {{ old('country', $user->profile->country) == 'UAE' ? 'selected' : '' }} class="bg-gray-900">UAE</option>
                                    <option value="India" {{ old('country', $user->profile->country) == 'India' ? 'selected' : '' }} class="bg-gray-900">India</option>
                                    <option value="USA" {{ old('country', $user->profile->country) == 'USA' ? 'selected' : '' }} class="bg-gray-900">USA</option>
                                    <option value="UK" {{ old('country', $user->profile->country) == 'UK' ? 'selected' : '' }} class="bg-gray-900">UK</option>
                                    <option value="Canada" {{ old('country', $user->profile->country) == 'Canada' ? 'selected' : '' }} class="bg-gray-900">Canada</option>
                                    <option value="Australia" {{ old('country', $user->profile->country) == 'Australia' ? 'selected' : '' }} class="bg-gray-900">Australia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information Card -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h2 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-briefcase text-red-400"></i>
                            PROFESSIONAL INFORMATION
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Bio -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Bio
                                </label>
                                <textarea name="bio" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none resize-none"
                                          placeholder="Tell us a little about yourself...">{{ old('bio', $user->profile->bio) }}</textarea>
                            </div>

                            <!-- Occupation -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Occupation
                                </label>
                                <input type="text" name="occupation" value="{{ old('occupation', $user->profile->occupation) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="e.g., Software Engineer">
                            </div>

                            <!-- Company -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Company
                                </label>
                                <input type="text" name="company" value="{{ old('company', $user->profile->company) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="e.g., Tech Solutions Ltd">
                            </div>

                            <!-- Website -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Website
                                </label>
                                <input type="url" name="website" value="{{ old('website', $user->profile->website) }}" 
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="https://example.com">
                            </div>
                        </div>
                    </div>

                    <!-- Social Links Card -->
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h2 class="text-xl font-black mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-share-nodes text-red-400"></i>
                            SOCIAL LINKS
                        </h2>

                        <div class="space-y-4">
                            <!-- Facebook -->
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[#1877f2]/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-brands fa-facebook-f text-[#1877f2]"></i>
                                </div>
                                <input type="url" name="social_facebook" value="{{ old('social_facebook', $user->profile->social_facebook) }}" 
                                       class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="https://facebook.com/username">
                            </div>

                            <!-- Twitter -->
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-black/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-brands fa-x-twitter text-gray-400"></i>
                                </div>
                                <input type="url" name="social_twitter" value="{{ old('social_twitter', $user->profile->social_twitter) }}" 
                                       class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="https://twitter.com/username">
                            </div>

                            <!-- Instagram -->
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-pink-600/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-brands fa-instagram text-pink-400"></i>
                                </div>
                                <input type="url" name="social_instagram" value="{{ old('social_instagram', $user->profile->social_instagram) }}" 
                                       class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="https://instagram.com/username">
                            </div>

                            <!-- LinkedIn -->
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[#0a66c2]/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-brands fa-linkedin-in text-[#0a66c2]"></i>
                                </div>
                                <input type="url" name="social_linkedin" value="{{ old('social_linkedin', $user->profile->social_linkedin) }}" 
                                       class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                                       placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-wrap items-center justify-end gap-4">
                        <a href="{{ route('profile.index') }}" class="px-6 py-3 border border-white/10 rounded-xl text-sm font-bold hover:bg-white/5 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 rounded-xl text-sm font-bold hover:from-red-700 hover:to-red-800 transition flex items-center gap-2 shadow-lg shadow-red-600/30">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Photo Upload Script -->
<script>
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
                throw new Error(data.message || 'Upload failed');
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

@push('styles')
<style>
/* Custom styles for date input */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.5;
    cursor: pointer;
}
input[type="date"]::-webkit-calendar-picker-indicator:hover {
    opacity: 1;
}

/* Custom radio button styles */
input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    background: transparent;
    position: relative;
    cursor: pointer;
}
input[type="radio"]:checked {
    border-color: #ef4444;
    background: #ef4444;
    box-shadow: 0 0 10px rgba(239,68,68,0.3);
}
input[type="radio"]:checked::after {
    content: '';
    position: absolute;
    top: 4px;
    left: 4px;
    width: 6px;
    height: 6px;
    background: white;
    border-radius: 50%;
}
</style>
@endpush

@endsection