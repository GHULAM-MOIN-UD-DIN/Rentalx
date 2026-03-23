@extends('layouts.app')

@section('content')
<!-- FLEET HERO -->
<section class="fleet-hero flex items-center pt-20">
    <div class="container mx-auto px-4 sm:px-6 md:px-12 py-14 sm:py-20">
        <div class="max-w-2xl heroContent">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em] font-semibold border-l-4 border-red-500 pl-4">OUR FLEET // 2025</span>
            <h1 class="text-5xl sm:text-7xl md:text-8xl font-black italic leading-[0.9] mt-4">RENT A <span class="text-red-500">CAR</span></h1>
            <p class="text-gray-300 text-base sm:text-lg mt-5 max-w-lg leading-relaxed">{{ count($cars) }} elite vehicles. Every one maintained to factory spec, fully insured, and ready to deliver to your door.</p>
            <div class="flex flex-wrap gap-3 mt-7">
                <div class="bg-white/5 border border-white/10 rounded-full px-4 py-2 text-xs flex items-center gap-2"><i class="fa-solid fa-circle text-green-400 text-[8px]"></i> {{ count($cars) }} Cars Available</div>
                <div class="bg-white/5 border border-white/10 rounded-full px-4 py-2 text-xs flex items-center gap-2"><i class="fa-solid fa-circle text-green-400 text-[8px]"></i> Free Delivery</div>
                <div class="bg-white/5 border border-white/10 rounded-full px-4 py-2 text-xs flex items-center gap-2"><i class="fa-solid fa-circle text-green-400 text-[8px]"></i> Insurance Included</div>
            </div>
        </div>
    </div>
</section>

<!-- SEARCH BAR -->
<section class="px-4 sm:px-6 md:px-12 -mt-8 relative z-30 pb-0">
    <div class="container mx-auto">
        <div class="search-bar p-5 sm:p-7">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <span class="search-label">Pick-up Date</span>
                    <input type="date" class="search-input">
                </div>
                <div>
                    <span class="search-label">Return Date</span>
                    <input type="date" class="search-input">
                </div>
                <div>
                    <span class="search-label">Location</span>
                    <div class="relative">
                        <select class="search-input appearance-none cursor-pointer">
                            <option>Dubai — HQ</option>
                            <option>Dubai Airport</option>
                            <option>New York</option>
                            <option>London</option>
                            <option>Paris</option>
                            <option>Monaco</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-xl font-black text-sm tracking-wider transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i> SEARCH
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FILTERS + FLEET -->
<section class="py-12 sm:py-16 px-4 sm:px-6 md:px-12 bg-black" id="fleetSection">
    <div class="container mx-auto">

        <!-- FILTER ROW -->
        <div class="flex flex-wrap items-center gap-3 mb-8">
            <span class="text-xs text-gray-500 tracking-widest uppercase mr-1 hidden sm:block">Filter:</span>
            <button class="filter-pill active" onclick="filterCars('all', this)">All Cars</button>
            <button class="filter-pill" onclick="filterCars('supercar', this)">Supercars</button>
            <button class="filter-pill" onclick="filterCars('suv', this)">Luxury SUV</button>
            <button class="filter-pill" onclick="filterCars('sedan', this)">Sedans</button>
            <button class="filter-pill" onclick="filterCars('electric', this)">Electric</button>
            <button class="filter-pill" onclick="filterCars('convertible', this)">Convertible</button>

            <!-- SORT -->
            <div class="ml-auto relative">
                <select class="search-input text-xs py-2 px-3 pr-8 appearance-none cursor-pointer" onchange="sortCars(this.value)" style="min-width:130px;">
                    <option value="default">Sort: Default</option>
                    <option value="price-asc">Price: Low → High</option>
                    <option value="price-desc">Price: High → Low</option>
                    <option value="power">Most Powerful</option>
                    <option value="rating">Top Rated</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
            </div>
        </div>

        <!-- RESULTS COUNT -->
        <p class="text-xs text-gray-500 mb-6"><span id="resultCount">{{ count($cars) }}</span> vehicles found</p>

        <!-- CAR GRID - DYNAMIC FROM DATABASE -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6" id="carGrid">
            @forelse($cars as $car)
            <div class="car-card" data-id="{{ $car->id }}" data-category="{{ $car->category ?? 'supercar' }}" data-price="{{ $car->price_per_day }}" data-hp="{{ $car->hp ?? 0 }}" data-rating="{{ $car->rating ?? 4.5 }}">
                <div class="car-img-wrap" style="height:200px;">
                    @if($car->image)
                        <img src="{{ asset('car_images/'.$car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" style="height:200px; object-fit:cover; width:100%;" loading="lazy">
                    @else
                        <div style="height:200px; background:linear-gradient(135deg,#333,#0a0a0a); display:flex; align-items:center; justify-content:center;">
                            <i class="fa-solid fa-car text-red-500/30 text-5xl"></i>
                        </div>
                    @endif
                    <span class="car-badge badge-{{ $car->badge ?? 'available' }}">{{ $car->badge_label ?? ($car->is_available ? '✅ AVAILABLE' : '📅 BOOKED') }}</span>
                    <button class="wish-btn" onclick="toggleWish({{ $car->id }}, this)" title="Wishlist">
                        <i class="fa-regular fa-heart text-sm"></i>
                    </button>
                </div>
                <div class="p-5 sm:p-6 flex flex-col flex-1">
                    <div class="flex justify-between items-start gap-2">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $car->brand }}</p>
                            <h3 class="text-base sm:text-lg font-black mt-0.5 leading-tight">{{ $car->brand }} {{ $car->model }}</h3>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-red-500 font-black text-lg">${{ number_format($car->price_per_day) }}</p>
                            <p class="text-xs text-gray-500">/day</p>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 mt-3 leading-relaxed">{{ $car->description ?? $car->brand . ' ' . $car->model . ' ready to rent. Premium condition, full insurance included.' }}</p>

                    <!-- SPECS -->
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 mt-4">
                        <div class="spec-row"><i class="fa-solid fa-bolt"></i>{{ $car->hp ?? 'N/A' }} HP</div>
                        <div class="spec-row"><i class="fa-solid fa-gauge-high"></i>{{ $car->speed ?? 'N/A' }}</div>
                        <div class="spec-row"><i class="fa-solid fa-stopwatch"></i>{{ $car->acceleration ?? 'N/A' }} 0-100</div>
                        <div class="spec-row"><i class="fa-solid fa-users"></i>{{ $car->seats ?? 4 }} seats</div>
                        <div class="spec-row"><i class="fa-solid fa-gas-pump"></i>{{ $car->fuel_type ?? 'Petrol' }}</div>
                        <div class="spec-row"><i class="fa-solid fa-gears"></i>{{ $car->transmission ?? 'Auto' }}</div>
                    </div>

                    <!-- RATING -->
                    <div class="flex items-center gap-2 mt-4">
                        <div class="stars">
                            @php $rating = $car->rating ?? 4.5; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                @elseif($i - $rating <= 0.5 && $rating - floor($rating) > 0)
                                    <i class="fa-solid fa-star-half-stroke text-yellow-400 text-xs"></i>
                                @else
                                    <i class="fa-regular fa-star text-yellow-400 text-xs"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs text-gray-400">{{ number_format($rating, 1) }} ({{ $car->reviews ?? 0 }} reviews)</span>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex gap-2 mt-5 mt-auto pt-4 border-t border-white/5">
                        @if($car->is_available ?? true)
                            <a href="{{ route('appointment.create', ['car_id' => $car->id]) }}" class="flex-1 bg-red-600 hover:bg-red-700 py-3 rounded-xl text-xs font-black tracking-wider transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-key"></i> RENT NOW
                            </a>
                        @else
                            <button disabled class="flex-1 bg-gray-600/50 py-3 rounded-xl text-xs font-black tracking-wider flex items-center justify-center gap-2 cursor-not-allowed">
                                <i class="fa-solid fa-clock"></i> UNAVAILABLE
                            </button>
                        @endif
                        <button onclick="toggleCompare({{ $car->id }}, this)" title="Compare" class="w-11 h-11 border border-white/15 hover:border-red-500 rounded-xl flex items-center justify-center text-sm transition compare-toggle-{{ $car->id }}">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fa-solid fa-car-burst text-red-500/30 text-6xl mb-4"></i>
                <h3 class="text-2xl font-black">No cars available</h3>
                <p class="text-gray-400 mt-2">Check back later for new arrivals</p>
            </div>
            @endforelse
        </div>

        <!-- EMPTY STATE (for filtering) -->
        <div class="empty-state" id="emptyState">
            <i class="fa-solid fa-car-burst text-red-500/30 text-6xl mb-4"></i>
            <h4 class="text-xl font-black">No cars match your filter</h4>
            <p class="text-gray-400 text-sm mt-2">Try a different category</p>
            <button onclick="filterCars('all', document.querySelector('.filter-pill'))" class="mt-4 border border-red-500/40 text-red-400 px-6 py-2.5 rounded-full text-sm hover:bg-red-600/10 transition">Show All</button>
        </div>
    </div>
</section>

<!-- MARQUEE -->
<section class="py-10 sm:py-14 overflow-hidden bg-[#070707]">
    <div class="marquee-container">
        <div class="scroll-left text-4xl sm:text-6xl font-black italic text-red-600/20">
            <span>AUDI RS6</span><span class="text-white/20">✦</span><span>LAMBORGHINI</span><span class="text-white/20">✦</span><span>PORSCHE TAYCAN</span><span class="text-white/20">✦</span><span>BMW M8</span><span class="text-white/20">✦</span><span>FERRARI</span><span class="text-white/20">✦</span><span>BENTLEY</span><span class="text-white/20">✦</span><span>AUDI RS6</span><span class="text-white/20">✦</span><span>LAMBORGHINI</span><span class="text-white/20">✦</span><span>PORSCHE TAYCAN</span><span class="text-white/20">✦</span>
        </div>
    </div>
</section>

<!-- WHY RENTALX -->
<section class="py-16 sm:py-20 px-4 sm:px-6 bg-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-12">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">WHY CHOOSE US</span>
            <h2 class="text-4xl sm:text-5xl font-black italic mt-3">THE RENTALX <span class="text-red-500">PROMISE</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            <div class="text-center p-5 sm:p-6 promiseCard">
                <div class="w-14 h-14 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-4"><i class="fa-solid fa-shield-halved"></i></div>
                <h4 class="font-black text-sm sm:text-base">Full Insurance</h4>
                <p class="text-xs text-gray-400 mt-2">CDW included on every booking. Zero-excess for Elite members.</p>
            </div>
            <div class="text-center p-5 sm:p-6 promiseCard">
                <div class="w-14 h-14 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-4"><i class="fa-solid fa-truck-fast"></i></div>
                <h4 class="font-black text-sm sm:text-base">Free Delivery</h4>
                <p class="text-xs text-gray-400 mt-2">Delivered to your hotel, home or airport. Anytime, anywhere.</p>
            </div>
            <div class="text-center p-5 sm:p-6 promiseCard">
                <div class="w-14 h-14 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-4"><i class="fa-solid fa-headset"></i></div>
                <h4 class="font-black text-sm sm:text-base">24/7 Concierge</h4>
                <p class="text-xs text-gray-400 mt-2">Dedicated support at every hour. Call, text, or WhatsApp us.</p>
            </div>
            <div class="text-center p-5 sm:p-6 promiseCard">
                <div class="w-14 h-14 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-4"><i class="fa-solid fa-gem"></i></div>
                <h4 class="font-black text-sm sm:text-base">Factory Spec</h4>
                <p class="text-xs text-gray-400 mt-2">Every vehicle maintained to exact manufacturer standards.</p>
            </div>
        </div>
    </div>
</section>

<!-- CSS (only page-specific styles, no duplicate nav/sidebar styles) -->
<style>
    /* HERO */
    .fleet-hero {
        background: linear-gradient(135deg, rgba(0,0,0,0.96) 0%, rgba(0,0,0,0.75) 55%, rgba(239,68,68,0.08) 100%),
                    url('https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        min-height: 52vh;
    }
    @media (max-width: 768px) {
        .fleet-hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.96) 0%, rgba(0,0,0,0.85) 100%),
                        url('https://images.unsplash.com/photo-1526726538690-5cbf956ae2fd?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        }
    }

    /* SEARCH BAR */
    .search-bar {
        background: rgba(10,10,10,0.95);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 2rem;
        backdrop-filter: blur(20px);
        box-shadow: 0 30px 60px -20px rgba(0,0,0,0.8);
    }
    .search-input {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 1rem;
        padding: 0.875rem 1rem;
        color: white;
        font-size: 0.85rem;
        outline: none;
        transition: all 0.3s;
        width: 100%;
    }
    .search-input::placeholder { color: rgba(255,255,255,0.3); }
    .search-input:focus { border-color: #ef4444; background: rgba(239,68,68,0.04); }
    .search-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.15em; color: rgba(255,255,255,0.4); text-transform: uppercase; margin-bottom: 0.4rem; display: block; }

    /* FILTER PILLS */
    .filter-pill {
        padding: 0.5rem 1.1rem;
        border-radius: 2rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        border: 1px solid rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.5);
        transition: all 0.25s;
        cursor: pointer;
        background: transparent;
        white-space: nowrap;
    }
    .filter-pill:hover, .filter-pill.active { background: #ef4444; border-color: #ef4444; color: white; }

    /* CAR CARD */
    .car-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 1.75rem;
        overflow: hidden;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
    }
    .car-card:hover { border-color: #ef4444; transform: translateY(-8px); box-shadow: 0 35px 50px -15px rgba(239,68,68,0.22); }
    .car-card:hover .car-img-wrap img { transform: scale(1.06); }
    .car-img-wrap { overflow: hidden; position: relative; }
    .car-img-wrap img { transition: transform 0.6s ease; width: 100%; height: 100%; object-fit: cover; }

    /* BADGE */
    .car-badge { position: absolute; top: 0.75rem; left: 0.75rem; font-size: 0.6rem; font-weight: 900; letter-spacing: 0.15em; padding: 0.25rem 0.65rem; border-radius: 2rem; }
    .badge-available { background: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }
    .badge-hot { background: rgba(239,68,68,0.15); color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }
    .badge-new { background: rgba(249,115,22,0.15); color: #f97316; border: 1px solid rgba(249,115,22,0.3); }
    .badge-limited { background: rgba(168,85,247,0.15); color: #a855f7; border: 1px solid rgba(168,85,247,0.3); }

    /* WISHLIST BTN */
    .wish-btn { position: absolute; top: 0.75rem; right: 0.75rem; width: 36px; height: 36px; background: rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; backdrop-filter: blur(10px); }
    .wish-btn:hover, .wish-btn.active { background: rgba(239,68,68,0.2); border-color: #ef4444; color: #ef4444; }

    /* SPEC ROW */
    .spec-row { display: flex; align-items: center; gap: 0.4rem; font-size: 0.72rem; color: rgba(255,255,255,0.5); }
    .spec-row i { color: #ef4444; width: 12px; }

    /* RATING STARS */
    .stars { color: #fbbf24; font-size: 0.65rem; }

    /* MARQUEE */
    .scroll-left { white-space: nowrap; animation: scrollRTL 30s linear infinite; display: inline-flex; gap: 2rem; }
    @keyframes scrollRTL { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .marquee-container { mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent); overflow: hidden; }

    /* COMPARE BAR */
    .compare-bar { position: fixed; bottom: 0; left: 0; right: 0; z-index: 600; background: rgba(10,10,10,0.97); border-top: 1px solid rgba(239,68,68,0.3); padding: 0.875rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; transform: translateY(100%); transition: transform 0.35s; backdrop-filter: blur(16px); }
    .compare-bar.show { transform: translateY(0); }

    .container { width: 100%; max-width: 1380px; margin: 0 auto; }
</style>

<!-- Page-specific JavaScript -->
<script>
(function() {
    gsap.registerPlugin(ScrollTrigger);

    // SCROLL TOP
    const scrollTopBtn = document.getElementById('scrollTop');
    if(scrollTopBtn) {
        window.addEventListener('scroll', () => { 
            scrollTopBtn.classList.toggle('show', window.scrollY > 400); 
        });
    }

    // WISHLIST
    let wishlist = new Set();
    window.toggleWish = function(id, btn) {
        if (wishlist.has(id)) { 
            wishlist.delete(id); 
            btn.classList.remove('active'); 
            btn.innerHTML = '<i class="fa-regular fa-heart text-sm"></i>'; 
        } else { 
            wishlist.add(id); 
            btn.classList.add('active'); 
            btn.innerHTML = '<i class="fa-solid fa-heart text-sm"></i>'; 
        }
    }

    // COMPARE
    let compareList = new Set();
    window.toggleCompare = function(id, btn) {
        if (compareList.has(id)) { 
            compareList.delete(id); 
            btn.classList.remove('border-red-500', 'bg-red-600/10');
            btn.classList.add('border-white/15');
        } else { 
            if (compareList.size >= 3) { 
                alert('Max 3 cars to compare!'); 
                return; 
            } 
            compareList.add(id); 
            btn.classList.add('border-red-500', 'bg-red-600/10');
            btn.classList.remove('border-white/15');
        }
        const compareBar = document.getElementById('compareBar');
        const compareCount = document.getElementById('compareCount');
        if(compareCount) compareCount.textContent = compareList.size;
        if(compareBar) compareBar.classList.toggle('show', compareList.size > 0);
    }
    
    window.clearCompare = function() { 
        compareList.clear(); 
        const compareBar = document.getElementById('compareBar');
        const compareCount = document.getElementById('compareCount');
        if(compareCount) compareCount.textContent = 0; 
        if(compareBar) compareBar.classList.remove('show'); 
        document.querySelectorAll('[class*="compare-toggle-"]').forEach(btn => {
            btn.classList.remove('border-red-500', 'bg-red-600/10');
            btn.classList.add('border-white/15');
        });
    }

    // FILTER & SORT FUNCTIONS
    window.filterCars = function(cat, btn) {
        document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');
        
        const cars = document.querySelectorAll('.car-card');
        let visibleCount = 0;
        
        cars.forEach(car => {
            const category = car.dataset.category;
            if (cat === 'all' || category === cat) {
                car.style.display = '';
                visibleCount++;
            } else {
                car.style.display = 'none';
            }
        });
        
        const resultCount = document.getElementById('resultCount');
        if(resultCount) resultCount.textContent = visibleCount;
        const emptyState = document.getElementById('emptyState');
        if(emptyState) emptyState.classList.toggle('show', visibleCount === 0);
    }
    
    window.sortCars = function(val) {
        const grid = document.getElementById('carGrid');
        if(!grid) return;
        const cars = Array.from(document.querySelectorAll('.car-card'));
        
        if (val === 'price-asc') {
            cars.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                return priceA - priceB;
            });
        } else if (val === 'price-desc') {
            cars.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                return priceB - priceA;
            });
        } else if (val === 'power') {
            cars.sort((a, b) => {
                const hpA = parseFloat(a.dataset.hp) || 0;
                const hpB = parseFloat(b.dataset.hp) || 0;
                return hpB - hpA;
            });
        } else if (val === 'rating') {
            cars.sort((a, b) => {
                const ratingA = parseFloat(a.dataset.rating) || 0;
                const ratingB = parseFloat(b.dataset.rating) || 0;
                return ratingB - ratingA;
            });
        } else {
            // Default - restore original order (by ID maybe)
            cars.sort((a, b) => a.dataset.id - b.dataset.id);
        }
        
        // Reorder DOM
        cars.forEach(car => grid.appendChild(car));
    }

    // ANIMATIONS
    window.addEventListener('load', () => {
        gsap.from('.heroContent', { x: -60, opacity: 0, duration: 1.2, delay: 0.2, clearProps: 'all' });
        gsap.from('.search-bar', { y: 40, opacity: 0, duration: 0.9, delay: 0.4, clearProps: 'all' });
        
        const sets = [
            ['.promiseCard', { y: 40, opacity: 0, stagger: 0.12, duration: 0.8 }],
        ];
        sets.forEach(([sel, props]) => {
            const els = document.querySelectorAll(sel);
            if (!els.length) return;
            gsap.from(els, { scrollTrigger: { trigger: els[0], start: 'top 85%' }, ...props, clearProps: 'all' });
        });
        
        // Fallback visibility
        setTimeout(() => {
            document.querySelectorAll('section').forEach(el => { 
                el.style.opacity = '1'; 
                el.style.visibility = 'visible'; 
            });
        }, 3000);
    });

})();
</script>
@endsection