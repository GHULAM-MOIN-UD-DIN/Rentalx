@extends('adminlayout.app')

@section('title', 'Settings · RentalX')

@section('content')
<div class="space-y-8 animate-page">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black italic tracking-tight text-white uppercase">System <span class="text-red-500">Settings</span></h1>
            <p class="text-zinc-500 text-sm mt-1">Configure your platform's core parameters and appearance.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="px-6 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-bold rounded-xl transition-all border border-zinc-700">RESET</button>
            <button type="submit" form="settings-form" class="px-8 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-black rounded-xl transition-all shadow-lg shadow-red-600/20">SAVE CHANGES</button>
        </div>
    </div>

    <form id="settings-form" action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        {{-- Left: General Settings --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-3xl p-6 md:p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-red-600/10 rounded-2xl flex items-center justify-center text-red-500">
                        <i class="fa-solid fa-sliders text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-white italic">GENERAL CONFIGURATION</h3>
                        <p class="text-zinc-500 text-xs uppercase tracking-widest font-bold">Site Identity & Metadata</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Site Name</label>
                        <input type="text" value="RentalX" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all" placeholder="Enter site name">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Site Title</label>
                        <input type="text" value="Premium Luxury Car Rental" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all" placeholder="Enter page title">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Meta Description</label>
                        <textarea rows="3" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all resize-none" placeholder="Describe your platform...">RentalX is the world's leading premium car rental platform, offering elite vehicles for enthusiasts.</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-3xl p-6 md:p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-red-600/10 rounded-2xl flex items-center justify-center text-red-500">
                        <i class="fa-solid fa-envelope-open-text text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-white italic">CONTACT INFORMATION</h3>
                        <p class="text-zinc-500 text-xs uppercase tracking-widest font-bold">Public business details</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Support Email</label>
                        <input type="email" value="support@rentalx.com" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Phone Number</label>
                        <input type="text" value="+1 (555) 123-4567" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Office Address</label>
                        <input type="text" value="795 Folsom Ave, Suite 600, San Francisco, CA 94107" class="w-full bg-zinc-800/50 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:border-red-500 focus:outline-none transition-all">
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Appearance & Logo --}}
        <div class="space-y-8">
            <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-3xl p-6 md:p-8">
                <h3 class="text-sm font-black text-white italic mb-6">BRAND ASSETS</h3>
                
                <div class="space-y-6">
                    <div class="space-y-3">
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Main Logo</p>
                        <div class="aspect-video bg-zinc-800/50 rounded-2xl border border-dashed border-zinc-700 flex flex-col items-center justify-center gap-3 group hover:border-red-500/50 transition-all cursor-pointer overflow-hidden relative">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl text-zinc-600 group-hover:text-red-500 transition-colors"></i>
                            <span class="text-[10px] font-bold text-zinc-500">UPLOAD NEW LOGO</span>
                            <div class="absolute inset-0 bg-red-600/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-white/5">
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Favicon</p>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-zinc-800/50 rounded-xl border border-white/5 flex items-center justify-center text-red-500 text-xl">
                                <i class="fa-solid fa-gem"></i>
                            </div>
                            <button type="button" class="text-[10px] font-black text-red-500 hover:text-red-400 uppercase tracking-widest">Replace Favicon</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-600/20 to-zinc-900/40 backdrop-blur-xl border border-red-500/20 rounded-3xl p-6 md:p-8">
                <h3 class="text-sm font-black text-white italic mb-4">SYSTEM MAINTENANCE</h3>
                <p class="text-zinc-400 text-xs leading-relaxed mb-6">Clear system cache and re-optimize the platform performance.</p>
                
                <button type="button" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-black rounded-xl transition-all shadow-lg shadow-red-600/20 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-broom"></i>
                    OPTIMIZE PLATFORM
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
