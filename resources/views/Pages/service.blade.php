@extends('layouts.app')

@section('content')


<!-- ===== HERO ===== -->
<section class="services-hero relative overflow-hidden flex items-center pt-20" style="min-height: 70vh;">
    {{-- Floating Decorative Elements --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 blur-[120px] rounded-full -mr-64 -mt-64"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-red-600/3 blur-[100px] rounded-full -ml-48 -mb-48"></div>
    
    <div class="container mx-auto px-6 md:px-12 py-16 relative z-10">
        <div class="max-w-4xl heroContent">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-12 h-[2px] bg-red-500"></span>
                <span class="text-red-400 text-sm tracking-[0.5em] font-black uppercase">Elite Experiences</span>
            </div>
            <h1 class="text-6xl sm:text-8xl md:text-9xl font-black italic leading-[0.85] tracking-tighter">
                OUR <span class="text-red-500 text-outline">SERVICES</span>
            </h1>
            <p class="text-gray-400 text-lg sm:text-xl mt-8 max-w-2xl leading-relaxed font-medium">
                From single-day thrills to month-long grand tours, every service we offer is precision-engineered to exceed your expectations.
            </p>
            
            <div class="flex flex-wrap gap-4 mt-10">
                @php $chips = ['Daily Rental', 'Chauffeur Drive', 'Corporate Lease', 'Track Days', 'Events', 'Airport Transfer']; @endphp
                @foreach($chips as $chip)
                    <div class="flex items-center gap-2 bg-white/5 backdrop-blur-md border border-white/10 rounded-full px-5 py-2.5 text-xs font-bold tracking-wider hover:bg-white/10 transition-all cursor-default">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> {{ $chip }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== SERVICES TABS + CONTENT ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-black border-b border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">EXPLORE ALL SERVICES</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">WHAT WE <span class="text-red-500">DO</span></h2>
            <p class="text-gray-400 max-w-xl mx-auto mt-4 text-sm sm:text-base">Choose your experience</p>
        </div>

        <!-- TABS -->
        <div class="flex flex-wrap gap-3 justify-center mb-10 sm:mb-14" id="tabBar">
            <button class="tab-btn active" onclick="switchTab('daily')">Daily Rental</button>
            <button class="tab-btn" onclick="switchTab('chauffeur')">Chauffeur</button>
            <button class="tab-btn" onclick="switchTab('corporate')">Corporate</button>
            <button class="tab-btn" onclick="switchTab('track')">Track Days</button>
            <button class="tab-btn" onclick="switchTab('events')">Events</button>
            <button class="tab-btn" onclick="switchTab('airport')">Airport Transfer</button>
        </div>

        <!-- TAB: DAILY RENTAL -->
        <div class="tab-content active" id="tab-daily">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-car-side"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">DAILY <span class="text-red-500">RENTAL</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Rent your dream machine for a day, weekend, or week. Full-tank delivery, comprehensive insurance, and 24/7 roadside support included. Minimum 24h, no maximum.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Free delivery within city limits</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Full tank guaranteed on pickup</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Comprehensive CDW insurance</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> 24/7 roadside assistance</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Unlimited mileage on select models</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> BOOK NOW</button>
                        <button class="border border-white/20 hover:border-red-500 px-7 py-3.5 rounded-full text-sm font-bold transition">View Fleet</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl">
                        <i class="fa-solid fa-clock text-red-400 text-xl mb-2"></i>
                        <p class="font-black text-sm">From 24hrs</p>
                        <p class="text-xs text-gray-400 mt-1">Flexible duration</p>
                    </div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl">
                        <i class="fa-solid fa-shield-halved text-red-400 text-xl mb-2"></i>
                        <p class="font-black text-sm">Full Cover</p>
                        <p class="text-xs text-gray-400 mt-1">CDW included</p>
                    </div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl">
                        <i class="fa-solid fa-truck-fast text-red-400 text-xl mb-2"></i>
                        <p class="font-black text-sm">Free Delivery</p>
                        <p class="text-xs text-gray-400 mt-1">Hotel / Home</p>
                    </div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl">
                        <i class="fa-solid fa-headset text-red-400 text-xl mb-2"></i>
                        <p class="font-black text-sm">24/7 Support</p>
                        <p class="text-xs text-gray-400 mt-1">Always available</p>
                    </div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">$199 <span class="text-xs text-gray-400">/day</span></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: CHAUFFEUR -->
        <div class="tab-content" id="tab-chauffeur">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-user-tie"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">CHAUFFEUR <span class="text-red-500">DRIVE</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Sit back, relax, and arrive in absolute style. Our professionally trained, multilingual chauffeurs are former luxury hospitality professionals who know every road, every shortcut, and every elite destination.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Certified professional chauffeurs</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Multilingual — English, Arabic, French</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Meet & greet at airports</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Chilled beverages on board</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Real-time flight tracking</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> BOOK CHAUFFEUR</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-star text-red-400 text-xl mb-2"></i><p class="font-black text-sm">5-Star Rated</p><p class="text-xs text-gray-400 mt-1">4.9 driver score</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-language text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Multilingual</p><p class="text-xs text-gray-400 mt-1">6 languages</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-plane-arrival text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Airport Meet</p><p class="text-xs text-gray-400 mt-1">Name board pickup</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-martini-glass text-red-400 text-xl mb-2"></i><p class="font-black text-sm">On-Board Bar</p><p class="text-xs text-gray-400 mt-1">Premium refreshments</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">$350 <span class="text-xs text-gray-400">/day</span></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: CORPORATE -->
        <div class="tab-content" id="tab-corporate">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">CORPORATE <span class="text-red-500">LEASE</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Elevate your company fleet. RENTALX Corporate provides dedicated account management, monthly billing, priority fleet allocation, and custom branding options for your executive team.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Dedicated account manager</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Monthly consolidated invoicing</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Priority fleet for executives</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Custom brand wraps available</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Discounts from 5+ vehicles</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> ENQUIRE NOW</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-users text-red-400 text-xl mb-2"></i><p class="font-black text-sm">5–50 Cars</p><p class="text-xs text-gray-400 mt-1">Scalable fleet</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-file-invoice-dollar text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Monthly Bill</p><p class="text-xs text-gray-400 mt-1">Consolidated invoice</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-percent text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Up to 25% Off</p><p class="text-xs text-gray-400 mt-1">Volume discounts</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-headset text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Dedicated Rep</p><p class="text-xs text-gray-400 mt-1">Direct line always</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">Custom <span class="text-xs text-gray-400">pricing</span></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: TRACK DAYS -->
        <div class="tab-content" id="tab-track">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-flag-checkered"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">TRACK <span class="text-red-500">DAYS</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Push the limits on some of the world's most iconic circuits. Our track day packages include professional instructor guidance, full safety gear, and unlimited laps in your chosen supercar.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Iconic circuits — Dubai, Laguna Seca, Spa</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Pro instructor co-pilot session</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Full racing gear provided</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> GoPro footage of your laps</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Exclusive paddock lounge access</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> BOOK TRACK DAY</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-gauge-high text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Unlimited Laps</p><p class="text-xs text-gray-400 mt-1">Full day on track</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-helmet-safety text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Full Safety Gear</p><p class="text-xs text-gray-400 mt-1">Helmet, suit, gloves</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-video text-red-400 text-xl mb-2"></i><p class="font-black text-sm">GoPro Footage</p><p class="text-xs text-gray-400 mt-1">Your laps recorded</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-person-skiing text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Pro Instructor</p><p class="text-xs text-gray-400 mt-1">Expert coaching</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">$999 <span class="text-xs text-gray-400">/session</span></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: EVENTS -->
        <div class="tab-content" id="tab-events">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-champagne-glasses"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">EVENTS & <span class="text-red-500">WEDDINGS</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Make your special occasion unforgettable. RENTALX events fleet includes decorated vehicles, coordinated convoys, red carpet arrivals, and complete event-day coordination by our concierge team.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Wedding fleet coordination</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Red carpet arrival service</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Custom floral decoration</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Coordinated convoy available</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Photography partner access</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> PLAN MY EVENT</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-ring text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Weddings</p><p class="text-xs text-gray-400 mt-1">Full day service</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-camera text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Photo Shoots</p><p class="text-xs text-gray-400 mt-1">Background fleet</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-car-on text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Convoy Mode</p><p class="text-xs text-gray-400 mt-1">Up to 10 cars</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-certificate text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Decoration</p><p class="text-xs text-gray-400 mt-1">Custom florals</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">$799 <span class="text-xs text-gray-400">/event</span></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: AIRPORT -->
        <div class="tab-content" id="tab-airport">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <div>
                    <div class="w-16 h-16 bg-red-600/10 rounded-2xl flex items-center justify-center text-3xl text-red-500 mb-5"><i class="fa-solid fa-plane-arrival"></i></div>
                    <h3 class="text-3xl sm:text-4xl font-black italic">AIRPORT <span class="text-red-500">TRANSFER</span></h3>
                    <p class="text-gray-300 mt-4 leading-relaxed text-sm sm:text-base">Land and glide. Our airport transfer service guarantees a RENTALX driver waiting when you land, flight-tracked, name-boarded, and ready. Zero waiting, zero stress — just pure arrival.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Real-time flight tracking</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Name board & meet at arrivals</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> All airports covered worldwide</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> Luggage assistance included</div>
                        <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400"></i> 45-min free wait on delays</div>
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button class="bg-red-600 hover:bg-red-700 px-7 py-3.5 rounded-full text-sm font-black tracking-wider transition flex items-center gap-2"><i class="fa-solid fa-bolt"></i> BOOK TRANSFER</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-satellite-dish text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Flight Tracked</p><p class="text-xs text-gray-400 mt-1">Auto-adjusted timing</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-suitcase text-red-400 text-xl mb-2"></i><p class="font-black text-sm">Luggage Help</p><p class="text-xs text-gray-400 mt-1">Handled with care</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-globe text-red-400 text-xl mb-2"></i><p class="font-black text-sm">All Airports</p><p class="text-xs text-gray-400 mt-1">Worldwide coverage</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl"><i class="fa-solid fa-hourglass-half text-red-400 text-xl mb-2"></i><p class="font-black text-sm">45 Min Wait</p><p class="text-xs text-gray-400 mt-1">Free on delays</p></div>
                    <div class="feature-strip p-4 sm:p-5 rounded-2xl col-span-2">
                        <div class="flex justify-between items-center"><span class="text-sm font-bold">Starting from</span><span class="text-red-400 text-xl font-black">$149 <span class="text-xs text-gray-400">/transfer</span></span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ===== 6 SERVICE CARDS OVERVIEW ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-[#070707]">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">FULL SPECTRUM</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">ALL <span class="text-red-500">SERVICES</span></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-car-side"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Daily Rental</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">From 24 hours to weeks. The full RENTALX fleet at your fingertips with comprehensive cover included.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">from $199<span class="text-xs text-gray-400">/day</span></span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('daily'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Book →</button>
                </div>
            </div>

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-user-tie"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Chauffeur Drive</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">Professional, multilingual drivers. Arrive anywhere in absolute comfort and unmatched style.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">from $350<span class="text-xs text-gray-400">/day</span></span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('chauffeur'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Book →</button>
                </div>
            </div>

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-briefcase"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Corporate Lease</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">Dedicated fleet for your executive team. Volume pricing, monthly billing, custom branding.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">Custom</span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('corporate'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Enquire →</button>
                </div>
            </div>

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-flag-checkered"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Track Days</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">Unlimited laps on the world's best circuits. Instructor co-pilot, full gear, GoPro footage.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">from $999<span class="text-xs text-gray-400">/session</span></span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('track'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Book →</button>
                </div>
            </div>

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-champagne-glasses"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Events & Weddings</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">Red carpet arrivals, floral decoration, convoy coordination. Make every moment iconic.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">from $799<span class="text-xs text-gray-400">/event</span></span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('events'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Book →</button>
                </div>
            </div>

            <div class="service-big-card p-7 sm:p-8 svcCard">
                <div class="svc-icon text-4xl sm:text-5xl text-red-500 mb-5"><i class="fa-solid fa-plane-arrival"></i></div>
                <h3 class="text-xl sm:text-2xl font-black italic">Airport Transfer</h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">Flight-tracked, name-boarded. Land and glide into your waiting RENTALX, zero stress.</p>
                <div class="mt-5 pt-5 border-t border-white/5 flex justify-between items-center">
                    <span class="text-red-400 font-black text-lg">from $149<span class="text-xs text-gray-400">/transfer</span></span>
                    <button class="text-xs border border-white/20 hover:border-red-500 px-4 py-2 rounded-full transition" onclick="switchTab('airport'); document.getElementById('tabBar').scrollIntoView({behavior:'smooth'})">Book →</button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== MEMBERSHIP PACKAGES ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">CHOOSE YOUR TIER</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">MEMBERSHIP <span class="text-red-500">PLANS</span></h2>
            <p class="text-gray-400 max-w-xl mx-auto mt-4 text-sm sm:text-base">Unlock more with every tier</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-5xl mx-auto">

            <!-- STANDARD -->
            <div class="pkg-card p-7 sm:p-8 pkgCard">
                <p class="text-xs tracking-[0.3em] text-gray-400 uppercase">Standard</p>
                <p class="text-4xl font-black mt-2">$49<span class="text-sm font-normal text-gray-400">/mo</span></p>
                <p class="text-xs text-gray-500 mt-1">billed annually</p>
                <div class="my-6 h-px bg-white/5"></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Access to standard fleet</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Online booking portal</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>24/7 email support</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Basic insurance</span></div>
                <div class="check-item muted"><i class="fa-solid fa-xmark"></i><span>Free vehicle delivery</span></div>
                <div class="check-item muted"><i class="fa-solid fa-xmark"></i><span>Priority booking</span></div>
                <div class="check-item muted"><i class="fa-solid fa-xmark"></i><span>Track day access</span></div>
                <button class="w-full mt-6 border border-white/20 hover:border-red-500 py-3 rounded-full text-sm font-bold tracking-wider transition">GET STARTED</button>
            </div>

            <!-- ELITE (FEATURED) -->
            <div class="pkg-card featured p-7 sm:p-8 pkgCard relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <span class="badge-popular text-white">MOST POPULAR</span>
                </div>
                <p class="text-xs tracking-[0.3em] text-red-400 uppercase">Elite</p>
                <p class="text-4xl font-black mt-2">$149<span class="text-sm font-normal text-gray-400">/mo</span></p>
                <p class="text-xs text-gray-500 mt-1">billed annually</p>
                <div class="my-6 h-px bg-red-500/20"></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Full fleet access incl. supercars</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Priority online & phone booking</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>24/7 phone concierge</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Zero-excess insurance</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Free vehicle delivery</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>1 free upgrade/month</span></div>
                <div class="check-item muted"><i class="fa-solid fa-xmark"></i><span>Track day access</span></div>
                <button class="w-full mt-6 bg-red-600 hover:bg-red-700 py-3 rounded-full text-sm font-black tracking-wider transition flex items-center justify-center gap-2"><i class="fa-solid fa-crown"></i> JOIN ELITE</button>
            </div>

            <!-- PRESTIGE -->
            <div class="pkg-card p-7 sm:p-8 pkgCard">
                <p class="text-xs tracking-[0.3em] text-orange-400 uppercase">Prestige</p>
                <p class="text-4xl font-black mt-2">$349<span class="text-sm font-normal text-gray-400">/mo</span></p>
                <p class="text-xs text-gray-500 mt-1">billed annually</p>
                <div class="my-6 h-px bg-white/5"></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Unlimited fleet access</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Dedicated account manager</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>24/7 personal concierge</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Full zero-excess cover</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Unlimited free delivery</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>Unlimited upgrades</span></div>
                <div class="check-item"><i class="fa-solid fa-check"></i><span>2 free track days/year</span></div>
                <button class="w-full mt-6 border border-orange-500/40 hover:border-orange-500 py-3 rounded-full text-sm font-bold tracking-wider transition text-orange-400">GO PRESTIGE</button>
            </div>

        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-b from-[#0a0a0a] to-black">
    <div class="container mx-auto max-w-3xl">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">SIMPLE PROCESS</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">HOW IT <span class="text-red-500">WORKS</span></h2>
        </div>
        <div class="space-y-8 sm:space-y-10 relative">
            <div class="process-step flex gap-5 sm:gap-6 processStep">
                <div class="flex flex-col items-center">
                    <div class="step-num">1</div>
                    <div class="w-px flex-1 bg-gradient-to-b from-red-500/40 to-transparent mt-2"></div>
                </div>
                <div class="pb-8">
                    <h4 class="text-lg sm:text-xl font-black italic">PICK YOUR SERVICE</h4>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Browse our 6 premium services. Daily rental, chauffeur, corporate, track days, events, or airport transfer — choose what fits your need.</p>
                </div>
            </div>
            <div class="process-step flex gap-5 sm:gap-6 processStep">
                <div class="flex flex-col items-center">
                    <div class="step-num">2</div>
                    <div class="w-px flex-1 bg-gradient-to-b from-red-500/40 to-transparent mt-2"></div>
                </div>
                <div class="pb-8">
                    <h4 class="text-lg sm:text-xl font-black italic">SELECT YOUR VEHICLE</h4>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Filter by category, performance specs, or budget. Every vehicle in our fleet is maintained to factory standard and fully insured.</p>
                </div>
            </div>
            <div class="process-step flex gap-5 sm:gap-6 processStep">
                <div class="flex flex-col items-center">
                    <div class="step-num">3</div>
                    <div class="w-px flex-1 bg-gradient-to-b from-red-500/40 to-transparent mt-2"></div>
                </div>
                <div class="pb-8">
                    <h4 class="text-lg sm:text-xl font-black italic">CONFIRM & CUSTOMISE</h4>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Set your dates, add extras like a chauffeur or GPS, choose delivery location, and confirm with a single payment. Simple.</p>
                </div>
            </div>
            <div class="process-step flex gap-5 sm:gap-6 processStep">
                <div class="flex flex-col items-center">
                    <div class="step-num">4</div>
                </div>
                <div>
                    <h4 class="text-lg sm:text-xl font-black italic">DRIVE & ENJOY</h4>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">Your car arrives. You turn the key. Everything else disappears. This is what RENTALX feels like.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MARQUEE ===== -->
<section class="py-10 sm:py-14 overflow-hidden bg-black">
    <div class="marquee-container">
        <div class="scroll-left text-4xl sm:text-6xl font-black italic text-red-600/20">
            <span>DAILY RENTAL</span><span class="text-white/20">✦</span><span>CHAUFFEUR</span><span class="text-white/20">✦</span><span>TRACK DAYS</span><span class="text-white/20">✦</span><span>CORPORATE</span><span class="text-white/20">✦</span><span>EVENTS</span><span class="text-white/20">✦</span><span>AIRPORT</span><span class="text-white/20">✦</span><span>DAILY RENTAL</span><span class="text-white/20">✦</span><span>CHAUFFEUR</span><span class="text-white/20">✦</span><span>TRACK DAYS</span><span class="text-white/20">✦</span><span>CORPORATE</span><span class="text-white/20">✦</span>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-[#070707]">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">REAL EXPERIENCES</span>
            <h2 class="text-4xl sm:text-5xl font-black italic mt-3">WHAT THEY <span class="text-red-500">SAY</span></h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            <div class="testi-card p-6 sm:p-7 testiCard">
                <div class="flex gap-1 text-yellow-400 text-xs mb-4">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">"The track day at Dubai Autodrome was a religious experience. The RS6 on a circuit? Absolutely insane. Instructor was world-class."</p>
                <div class="flex items-center gap-3 mt-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center font-black text-sm flex-shrink-0">KM</div>
                    <div><p class="font-black text-sm">Karim M.</p><p class="text-xs text-red-400">Track Day · Dubai</p></div>
                </div>
            </div>
            <div class="testi-card p-6 sm:p-7 testiCard">
                <div class="flex gap-1 text-yellow-400 text-xs mb-4">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">"Our wedding convoy — 6 cars, all decorated, perfectly coordinated. Our guests were absolutely stunned. RENTALX made it flawless."</p>
                <div class="flex items-center gap-3 mt-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-600 to-red-500 flex items-center justify-center font-black text-sm flex-shrink-0">SR</div>
                    <div><p class="font-black text-sm">Sara & Rami</p><p class="text-xs text-red-400">Wedding · Monaco</p></div>
                </div>
            </div>
            <div class="testi-card p-6 sm:p-7 testiCard sm:col-span-2 lg:col-span-1">
                <div class="flex gap-1 text-yellow-400 text-xs mb-4">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">"We use RENTALX Corporate for our entire executive team across 3 cities. The dedicated manager saves us hours every week. Best decision we made."</p>
                <div class="flex items-center gap-3 mt-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-600 to-red-500 flex items-center justify-center font-black text-sm flex-shrink-0">JT</div>
                    <div><p class="font-black text-sm">James T., CFO</p><p class="text-xs text-red-400">Corporate · New York</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-r from-red-900/20 via-black to-orange-900/10 border-y border-red-500/10">
    <div class="container mx-auto text-center">
        <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">READY TO ROLL?</span>
        <h2 class="text-4xl sm:text-6xl md:text-7xl font-black italic mt-4">START YOUR <span class="text-red-500">DRIVE</span></h2>
        <p class="text-gray-300 max-w-xl mx-auto mt-5 text-sm sm:text-base">Book any service in under 3 minutes. Our concierge team handles everything else.</p>
        <div class="flex flex-wrap gap-4 justify-center mt-8 sm:mt-10">
            <a href="" class="bg-red-600 hover:bg-red-700 px-8 sm:px-12 py-4 rounded-full font-black tracking-wide text-sm transition-all flex items-center gap-2 shadow-2xl shadow-red-600/30"><i class="fa-solid fa-bolt"></i> BOOK NOW</a>
            <a href="" class="border border-white/20 hover:border-red-500 px-8 sm:px-12 py-4 rounded-full text-sm font-bold tracking-wide transition">CONTACT CONCIERGE →</a>
        </div>
    </div>
</section>

<style>
    /* PAGE-SPECIFIC STYLES — Global nav/menu/sidebar handled by app.blade.php */

    /* HERO */
    .services-hero {
        background: linear-gradient(135deg, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.6) 55%, rgba(239,68,68,0.1) 100%),
                    url('{{ asset('images/service.avif') }}') no-repeat center center/cover;
        min-height: 58vh;
    }
    @media (max-width: 768px) {    
        .services-hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.8) 100%),
                        url('{{ asset('images/service.avif') }}') no-repeat center center/cover;
        }
    }

    /* SERVICE BIG CARDS */
    .service-big-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 2rem;
        overflow: hidden;
        transition: all 0.45s ease;
        position: relative;
    }
    .service-big-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(239,68,68,0.06), transparent 60%);
        opacity: 0;
        transition: opacity 0.4s;
    }
    .service-big-card:hover { border-color: #ef4444; transform: translateY(-8px); box-shadow: 0 35px 50px -20px rgba(239,68,68,0.25); }
    .service-big-card:hover::before { opacity: 1; }
    .service-big-card:hover .svc-icon { color: #f97316; transform: scale(1.1) rotate(-5deg); }
    .svc-icon { transition: all 0.4s ease; }

    /* PACKAGE CARDS */
    .pkg-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 2rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    .pkg-card.featured { border-color: #ef4444; background: linear-gradient(145deg, rgba(239,68,68,0.08), rgba(0,0,0,0.6)); }
    .pkg-card:hover { transform: translateY(-8px); box-shadow: 0 30px 45px -15px rgba(239,68,68,0.2); border-color: #ef4444; }
    .pkg-card .check-item { display: flex; align-items: flex-start; gap: 0.75rem; font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-bottom: 0.75rem; }
    .pkg-card .check-item i { color: #ef4444; margin-top: 0.1rem; flex-shrink: 0; }
    .pkg-card .check-item.muted i { color: rgba(255,255,255,0.2); }
    .pkg-card .check-item.muted span { color: rgba(255,255,255,0.25); }

    /* FEATURE STRIP */
    .feature-strip {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 1.25rem;
        transition: all 0.3s;
    }
    .feature-strip:hover { border-color: rgba(239,68,68,0.4); background: rgba(239,68,68,0.04); }

    /* PROCESS STEP */
    .process-step { position: relative; }
    .step-num { width: 3rem; height: 3rem; border-radius: 50%; background: linear-gradient(135deg, #ef4444, #f97316); display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1rem; flex-shrink: 0; }

    /* TABS */
    .tab-btn { padding: 0.6rem 1.25rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.1em; border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.5); transition: all 0.3s; cursor: pointer; background: transparent; white-space: nowrap; }
    .tab-btn.active, .tab-btn:hover { background: #ef4444; border-color: #ef4444; color: white; }

    /* TESTIMONIAL */
    .testi-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; transition: all 0.4s; }
    .testi-card:hover { border-color: #ef4444; transform: translateY(-5px); box-shadow: 0 20px 35px -10px rgba(239,68,68,0.2); }

    /* MARQUEE */
    .scroll-left { white-space: nowrap; animation: scrollRTL 30s linear infinite; display: inline-flex; gap: 2rem; }
    @keyframes scrollRTL { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .marquee-container { mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent); overflow: hidden; }

    /* SCROLL TOP UNIFIED */
    .scroll-top { display: none !important; } /* Managed by app.blade.php globaly */

    .container { width: 100%; max-width: 1400px; margin: 0 auto; }
</style>

<script>
(function() {
    // Avoid re-initializing GSAP if already done, but ensure our specific page anims run
    window.addEventListener('load', () => {
        if (typeof gsap === 'undefined') return;
        
        gsap.registerPlugin(ScrollTrigger);
        gsap.from('.heroContent', { x: -60, opacity: 0, duration: 1.2, delay: 0.2, clearProps: 'all' });

        const sets = [
            ['.svcCard', { y: 50, opacity: 0, stagger: 0.12, duration: 0.8 }],
            ['.pkgCard', { y: 50, opacity: 0, stagger: 0.15, duration: 0.9 }],
            ['.processStep', { x: -40, opacity: 0, stagger: 0.2, duration: 0.8 }],
            ['.testiCard', { y: 40, opacity: 0, stagger: 0.15, duration: 0.8 }]
        ];
        
        sets.forEach(([sel, props]) => {
            const els = document.querySelectorAll(sel);
            if (!els.length) return;
            gsap.from(els, { 
                scrollTrigger: { 
                    trigger: els[0], 
                    start: 'top 90%', 
                    toggleActions: 'play none none none' 
                }, 
                ...props, 
                clearProps: 'all' 
            });
        });
    });

    // TABS (Global exposure for onclick)
    window.switchTab = function(id) {
        document.querySelectorAll('.tab-content').forEach(t => {
            t.classList.remove('active');
            t.style.display = 'none';
        });
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        
        const tab = document.getElementById('tab-' + id);
        if(tab) {
            tab.style.display = 'block';
            setTimeout(() => tab.classList.add('active'), 10);
        }
        
        const btns = document.querySelectorAll('.tab-btn');
        const activeBtn = Array.from(btns).find(btn => btn.getAttribute('onclick')?.includes(`'${id}'`));
        if(activeBtn) activeBtn.classList.add('active');
    };
})();
</script>

@endsection