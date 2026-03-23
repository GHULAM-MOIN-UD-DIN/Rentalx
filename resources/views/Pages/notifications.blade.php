@extends('layouts.app')

@section('content')
<section class="min-h-screen pt-32 pb-20 px-4 md:px-12 bg-[#0a0a0a]">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-black italic tracking-tight">NOTIFICA<span class="text-red-500">TIONS</span></h1>
                <p class="text-gray-500 mt-2">Stay updated with our latest news and product launches.</p>
            </div>
            <div class="bg-red-500/10 border border-red-500/20 px-4 py-2 rounded-full hidden sm:block">
                <span class="text-red-400 text-sm font-bold tracking-widest uppercase">
                    {{ $notifications->whereNull('read_at')->count() }} UNREAD
                </span>
            </div>
        </div>

        {{-- Notifications List --}}
        <div class="space-y-4">
            @forelse($notifications as $notif)
                <div class="relative group">
                    <a href="{{ route('notifications.read', $notif->id) }}" 
                       class="block p-6 rounded-3xl transition-all duration-300 border {{ !$notif->read_at ? 'bg-white/5 border-red-500/30' : 'bg-white/[0.02] border-white/5 opacity-70' }} hover:border-red-500 hover:bg-white/[0.07] overflow-hidden">
                        
                        {{-- Unread Dot --}}
                        @if(!$notif->read_at)
                            <div class="absolute top-6 right-6 w-3 h-3 bg-red-600 rounded-full shadow-[0_0_15px_rgba(239,68,68,0.8)] animate-pulse"></div>
                        @endif

                        <div class="flex items-start gap-5">
                            {{-- Icon --}}
                            <div class="w-14 h-14 rounded-2xl flex-shrink-0 flex items-center justify-center 
                                {{ $notif->type == 'product' ? 'bg-red-500/20 text-red-500' : 'bg-blue-500/20 text-blue-500' }} border border-current opacity-80 mt-1">
                                @if($notif->type == 'product')
                                    <i class="fa-solid fa-rocket text-xl"></i>
                                @else
                                    <i class="fa-solid fa-bell text-xl"></i>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-xl font-bold {{ !$notif->read_at ? 'text-white' : 'text-gray-400' }}">{{ $notif->title }}</h3>
                                    <span class="text-[10px] font-black tracking-widest text-gray-600 uppercase">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-400 leading-relaxed">{{ $notif->message }}</p>
                                
                                @if($notif->type == 'product')
                                    <div class="mt-4 flex items-center gap-2 text-red-400 font-bold text-xs uppercase tracking-widest group-hover:gap-4 transition-all">
                                        Check Out The Pulse <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="py-20 text-center bg-white/[0.02] border border-white/5 rounded-[40px]">
                    <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-600">
                        <i class="fa-regular fa-bell-slash text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-500 italic">ALL QUIET ON THE FRONT</h3>
                    <p class="text-gray-600 mt-2">You don't have any notifications at the moment.</p>
                    <a href="{{ route('product.list') }}" class="inline-flex items-center gap-2 mt-8 text-red-500 font-black uppercase tracking-widest hover:text-red-400 transition-colors">
                        Browse New Arrivals <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $notifications->links() }}
        </div>
    </div>
</section>
@endsection
