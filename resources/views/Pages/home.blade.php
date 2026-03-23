@extends('layouts.app')

@section('content')

<!-- HERO BANNER -->
<section class="hero-banner w-full flex items-center relative overflow-hidden min-h-[600px] md:min-h-[90vh]">
    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-30 flex items-center py-16 sm:py-20 md:py-24 lg:py-0">
        <div class="w-full lg:w-1/2 lg:ml-auto text-center lg:text-left" id="bannerContent">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.3em] font-semibold border-l-4 border-red-500 pl-3 sm:pl-4 inline-block">2025 // UNLEASHED</span>
            <h1 class="hero-title text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black italic leading-[0.9] mt-4 sm:mt-6">AUDI <span class="text-red-500">RS6</span></h1>
            <p class="hero-price text-2xl sm:text-3xl font-light mt-2">$375 <span class="text-sm text-gray-400">/day</span></p>
            <p class="text-gray-300 max-w-md mx-auto lg:mx-0 mt-3 sm:mt-4 text-sm sm:text-base">Twin-turbo V8 · Quattro · 630hp · 0-100 in 3.6s</p>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-6 sm:mt-8 justify-center lg:justify-start">
                <button class="bg-red-600 hover:bg-red-700 px-6 sm:px-8 lg:px-10 py-3 sm:py-4 rounded-full font-bold tracking-wide text-xs sm:text-sm transition-all flex items-center gap-2 shadow-2xl shadow-red-600/20 justify-center">
                    <i class="fa-solid fa-bolt"></i> BOOK DRIVE
                </button>
                <button class="border border-white/20 hover:border-red-500 px-4 sm:px-6 py-3 sm:py-4 rounded-full transition flex items-center justify-center">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </div>
            <div class="flex flex-wrap gap-4 sm:gap-6 mt-6 sm:mt-8 text-xs sm:text-sm border-t border-white/10 pt-5 justify-center lg:justify-start">
                <div><i class="fa-solid fa-gauge-high text-red-400 mr-1"></i> 630 HP</div>
                <div><i class="fa-solid fa-gas-pump text-red-400 mr-1"></i> 9.6L/100km</div>
                <div><i class="fa-solid fa-chair text-red-400 mr-1"></i> 4 seats</div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: FEATURES -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-gradient-to-b from-black to-[#0a0a0a]">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">ANIMATED TEASATION</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">DRIVING <span class="text-red-500">EMOTIONS</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base px-4">Every curve, every detail — experience the thrill before you turn the key.</p>
        </div>
        <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <div class="feature-card p-5 sm:p-6 md:p-7 rounded-2xl sm:rounded-3xl text-center cardAnim">
                <div class="w-12 h-12 sm:w-16 md:w-20 sm:h-16 md:h-20 mx-auto bg-red-600/10 rounded-2xl sm:rounded-3xl flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mt-4 sm:mt-5 md:mt-6">630 HP</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">Twin-turbo V8, launch control.</p>
            </div>
            <div class="feature-card p-5 sm:p-6 md:p-7 rounded-2xl sm:rounded-3xl text-center cardAnim">
                <div class="w-12 h-12 sm:w-16 md:w-20 sm:h-16 md:h-20 mx-auto bg-red-600/10 rounded-2xl sm:rounded-3xl flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500">
                    <i class="fa-solid fa-gauge-high"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mt-4 sm:mt-5 md:mt-6">3.6 SEC</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">0-100 km/h — silent thrust.</p>
            </div>
            <div class="feature-card p-5 sm:p-6 md:p-7 rounded-2xl sm:rounded-3xl text-center cardAnim">
                <div class="w-12 h-12 sm:w-16 md:w-20 sm:h-16 md:h-20 mx-auto bg-red-600/10 rounded-2xl sm:rounded-3xl flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mt-4 sm:mt-5 md:mt-6">QUATTRO</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">Intelligent all‑wheel drive.</p>
            </div>
            <div class="feature-card p-5 sm:p-6 md:p-7 rounded-2xl sm:rounded-3xl text-center cardAnim">
                <div class="w-12 h-12 sm:w-16 md:w-20 sm:h-16 md:h-20 mx-auto bg-red-600/10 rounded-2xl sm:rounded-3xl flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500">
                    <i class="fa-solid fa-fan"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mt-4 sm:mt-5 md:mt-6">AERODYNAMIC</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">Active air suspension.</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: TEASATION STATS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-[#070707] border-y border-white/5">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
            <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden group order-2 lg:order-1" id="teaserMedia">
                <img src="https://images.unsplash.com/photo-1556189250-72ba954cfc2b?q=80&w=2070&auto=format&fit=crop" 
                     class="w-full h-auto object-cover transition-transform duration-3000 group-hover:scale-105" 
                     alt="interior">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <div class="w-14 h-14 sm:w-16 md:w-20 sm:h-16 md:h-20 bg-red-600 rounded-full flex items-center justify-center text-xl sm:text-2xl md:text-3xl animate-pulse shadow-2xl cursor-pointer">
                        <i class="fa-solid fa-play ml-1"></i>
                    </div>
                </div>
            </div>
            <div class="space-y-5 sm:space-y-6 md:space-y-8 order-1 lg:order-2 text-center lg:text-left">
                <span class="text-red-400 text-xs sm:text-sm tracking-[0.3em]">TEASATION // 2025</span>
                <h2 class="section-title text-3xl sm:text-4xl md:text-5xl font-black italic">BEYOND <span class="text-red-500">DRIVING</span></h2>
                <p class="text-gray-300 text-sm sm:text-base md:text-lg">Feel the precision, hear the roar.</p>
                <div class="grid grid-cols-2 gap-4 sm:gap-5 md:gap-6 mt-5 sm:mt-6 md:mt-8">
                    <div class="stat-item text-left">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-black text-red-500 counter" data-target="630">0</div>
                        <p class="text-xs text-gray-400 mt-1">Horsepower</p>
                    </div>
                    <div class="stat-item text-left">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-black text-red-500 counter" data-target="3.6">0.0</div>
                        <p class="text-xs text-gray-400 mt-1">0-100 km/h</p>
                    </div>
                    <div class="stat-item text-left">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-black text-red-500 counter" data-target="305">0</div>
                        <p class="text-xs text-gray-400 mt-1">Top speed (km/h)</p>
                    </div>
                    <div class="stat-item text-left">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-black text-red-500 counter" data-target="8">0</div>
                        <p class="text-xs text-gray-400 mt-1">Cylinders</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 1: PREMIUM PARTNERS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-black">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-10 md:mb-12">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">CURATED EXCELLENCE</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">PREMIUM <span class="text-red-500">PARTNERS</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base px-4">Collaborations with world's finest automotive houses</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
            <div class="premium-badge p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl text-center backdrop-blur-sm">
                <i class="fa-regular fa-clock text-3xl sm:text-4xl md:text-5xl text-red-400 mb-2 sm:mb-3"></i>
                <h4 class="font-bold text-xs sm:text-sm md:text-base">IWC</h4>
                <p class="text-xs text-gray-400 mt-1">engineering time</p>
            </div>
            <div class="premium-badge p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl text-center backdrop-blur-sm">
                <i class="fa-solid fa-champagne-glasses text-3xl sm:text-4xl md:text-5xl text-red-400 mb-2 sm:mb-3"></i>
                <h4 class="font-bold text-xs sm:text-sm md:text-base">MOËT</h4>
                <p class="text-xs text-gray-400 mt-1">celebrate moments</p>
            </div>
            <div class="premium-badge p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl text-center backdrop-blur-sm">
                <i class="fa-solid fa-headphones text-3xl sm:text-4xl md:text-5xl text-red-400 mb-2 sm:mb-3"></i>
                <h4 class="font-bold text-xs sm:text-sm md:text-base">BANG & OLUFSEN</h4>
                <p class="text-xs text-gray-400 mt-1">audio perfection</p>
            </div>
            <div class="premium-badge p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl text-center backdrop-blur-sm">
                <i class="fa-solid fa-shoe-prints text-3xl sm:text-4xl md:text-5xl text-red-400 mb-2 sm:mb-3"></i>
                <h4 class="font-bold text-xs sm:text-sm md:text-base">PUMA</h4>
                <p class="text-xs text-gray-400 mt-1">driver gear</p>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 2: PERFORMANCE METRICS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-gradient-to-b from-[#0a0a0a] to-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">PRECISION ENGINEERED</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">PERFORMANCE <span class="text-red-500">METRICS</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6 sm:gap-8 md:gap-12 max-w-4xl mx-auto">
            <div class="space-y-4 sm:space-y-5 md:space-y-6">
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Acceleration (0-100km/h)</span>
                        <span class="text-red-400">3.6 sec</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="98"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Top speed</span>
                        <span class="text-red-400">305 km/h</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="90"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Horsepower</span>
                        <span class="text-red-400">630 hp</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="100"></div></div>
                </div>
            </div>
            <div class="space-y-4 sm:space-y-5 md:space-y-6">
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Torque</span>
                        <span class="text-red-400">850 Nm</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="95"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Downforce (max)</span>
                        <span class="text-red-400">110 kg</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="75"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs sm:text-sm md:text-base mb-1 sm:mb-2">
                        <span>Braking (100-0km/h)</span>
                        <span class="text-red-400">31 m</span>
                    </div>
                    <div class="spec-meter"><div class="spec-fill" data-width="88"></div></div>
                </div>
            </div>
        </div>
        <p class="text-center text-xs sm:text-sm text-gray-400 mt-6 sm:mt-8 md:mt-10">* data based on RS6 performance package</p>
    </div>
</section>

<!-- NEW SECTION 3: CONCIERGE SERVICE -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-black">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">TAILORED EXPERIENCE</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">CONCIERGE <span class="text-red-500">SERVICE</span></h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 lg:gap-6">
            <div class="concierge-card new-section-card text-center p-4 sm:p-5 md:p-6 lg:p-8 rounded-xl sm:rounded-2xl">
                <div class="concierge-icon text-3xl sm:text-4xl md:text-5xl text-red-500 mb-2 sm:mb-3 md:mb-4">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">24/7 support</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-1 sm:mt-2">Round‑the‑clock personal assistant</p>
            </div>
            <div class="concierge-card new-section-card text-center p-4 sm:p-5 md:p-6 lg:p-8 rounded-xl sm:rounded-2xl">
                <div class="concierge-icon text-3xl sm:text-4xl md:text-5xl text-red-500 mb-2 sm:mb-3 md:mb-4">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">Delivery to you</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-1 sm:mt-2">Car delivered at hotel / home</p>
            </div>
            <div class="concierge-card new-section-card text-center p-4 sm:p-5 md:p-6 lg:p-8 rounded-xl sm:rounded-2xl">
                <div class="concierge-icon text-3xl sm:text-4xl md:text-5xl text-red-500 mb-2 sm:mb-3 md:mb-4">
                    <i class="fa-solid fa-map"></i>
                </div>
                <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">Curated routes</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-1 sm:mt-2">Scenic drives & track days</p>
            </div>
            <div class="concierge-card new-section-card text-center p-4 sm:p-5 md:p-6 lg:p-8 rounded-xl sm:rounded-2xl">
                <div class="concierge-icon text-3xl sm:text-4xl md:text-5xl text-red-500 mb-2 sm:mb-3 md:mb-4">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">VIP treatment</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-1 sm:mt-2">Access to exclusive events</p>
            </div>
        </div>
    </div>
</section>

<!-- HORIZONTAL SCROLL MARQUEE -->
<section class="py-10 sm:py-12 md:py-16 lg:py-20 overflow-hidden bg-black">
    <div class="marquee-container">
        <div class="scroll-left text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black italic text-red-600/20">
            <span>RENTALX</span><span class="text-white/20">✦</span><span>RS6</span><span class="text-white/20">✦</span><span>QUATTRO</span><span class="text-white/20">✦</span><span>630HP</span><span class="text-white/20">✦</span><span>RENTALX</span><span class="text-white/20">✦</span><span>RS6</span><span class="text-white/20">✦</span><span>QUATTRO</span><span class="text-white/20">✦</span><span>630HP</span><span class="text-white/20">✦</span><span>RENTALX</span><span class="text-white/20">✦</span><span>RS6</span><span class="text-white/20">✦</span><span>QUATTRO</span><span class="text-white/20">✦</span><span>630HP</span><span class="text-white/20">✦</span>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-gradient-to-b from-[#0a0a0a] to-black">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">SIMPLE PROCESS</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">HOW IT <span class="text-red-500">WORKS</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base px-4">Three easy steps to your dream drive</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 md:gap-6 lg:gap-8">
            <div class="how-it-works-step text-center p-5 sm:p-6 md:p-8">
                <div class="w-14 h-14 sm:w-16 md:w-20 lg:w-24 sm:h-16 md:h-20 lg:h-24 mx-auto bg-red-600/10 rounded-full flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500 mb-4 sm:mb-5 md:mb-6">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 sm:mb-3">1. CHOOSE</h3>
                <p class="text-gray-400 text-xs sm:text-sm md:text-base">Browse our elite fleet of premium vehicles</p>
            </div>
            <div class="how-it-works-step text-center p-5 sm:p-6 md:p-8">
                <div class="w-14 h-14 sm:w-16 md:w-20 lg:w-24 sm:h-16 md:h-20 lg:h-24 mx-auto bg-red-600/10 rounded-full flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500 mb-4 sm:mb-5 md:mb-6">
                    <i class="fa-regular fa-calendar"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 sm:mb-3">2. BOOK</h3>
                <p class="text-gray-400 text-xs sm:text-sm md:text-base">Select dates and customize your experience</p>
            </div>
            <div class="how-it-works-step text-center p-5 sm:p-6 md:p-8">
                <div class="w-14 h-14 sm:w-16 md:w-20 lg:w-24 sm:h-16 md:h-20 lg:h-24 mx-auto bg-red-600/10 rounded-full flex items-center justify-center text-2xl sm:text-3xl md:text-4xl text-red-500 mb-4 sm:mb-5 md:mb-6">
                    <i class="fa-solid fa-key"></i>
                </div>
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2 sm:mb-3">3. DRIVE</h3>
                <p class="text-gray-400 text-xs sm:text-sm md:text-base">Pick up and enjoy the ultimate driving thrill</p>
            </div>
        </div>
    </div>
</section>

<!-- BRANDS / TRUSTED PARTNERS -->
<section class="py-12 sm:py-14 md:py-16 lg:py-20 px-4 sm:px-6 bg-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-6 sm:mb-8 md:mb-10 lg:mb-12">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">TRUSTED PARTNERS</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-black italic mt-2">WORLD-<span class="text-red-500">CLASS</span> FLEET</h2>
        </div>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 sm:gap-4 md:gap-5 lg:gap-6 items-center">
            <div class="brand-logo text-center">
                <i class="fa-solid fa-microchip text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">AUDI</p>
            </div>
            <div class="brand-logo text-center">
                <i class="fa-solid fa-compass text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">BMW</p>
            </div>
            <div class="brand-logo text-center">
                <i class="fa-solid fa-award text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">MERCEDES</p>
            </div>
            <div class="brand-logo text-center">
                <i class="fa-solid fa-car text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">PORSCHE</p>
            </div>
            <div class="brand-logo text-center">
                <i class="fa-solid fa-gauge-high text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">LAMBORGHINI</p>
            </div>
            <div class="brand-logo text-center">
                <i class="fa-solid fa-bolt text-3xl sm:text-4xl md:text-5xl text-gray-500 hover:text-red-500 transition"></i>
                <p class="text-xs mt-1 sm:mt-2">FERRARI</p>
            </div>
        </div>
    </div>
</section>

<!-- LATEST NEWS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-gradient-to-b from-black to-[#0a0a0a]">
    <div class="container mx-auto">
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">INSIDER UPDATES</span>
            <h2 class="section-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black italic mt-3">LATEST <span class="text-red-500">NEWS</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base px-4">Stay tuned with automotive world</p>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
            <div class="news-card p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl">
                <div class="h-28 sm:h-32 md:h-36 lg:h-40 bg-gradient-to-b from-red-900/20 to-transparent rounded-xl mb-3 sm:mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-3xl sm:text-4xl md:text-5xl text-red-500/50"></i>
                </div>
                <span class="text-xs text-red-400">MARCH 15, 2025</span>
                <h3 class="text-base sm:text-lg md:text-xl font-bold mt-2">2026 RS6 revealed</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">More power, hybrid tech, and bold design</p>
                <a href="#" class="inline-block mt-3 sm:mt-4 text-red-500 text-xs sm:text-sm font-semibold">Read more →</a>
            </div>
            <div class="news-card p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl">
                <div class="h-28 sm:h-32 md:h-36 lg:h-40 bg-gradient-to-b from-red-900/20 to-transparent rounded-xl mb-3 sm:mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-calendar text-3xl sm:text-4xl md:text-5xl text-red-500/50"></i>
                </div>
                <span class="text-xs text-red-400">MARCH 10, 2025</span>
                <h3 class="text-base sm:text-lg md:text-xl font-bold mt-2">Track day events</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">Join us at Laguna Seca this summer</p>
                <a href="#" class="inline-block mt-3 sm:mt-4 text-red-500 text-xs sm:text-sm font-semibold">Read more →</a>
            </div>
            <div class="news-card p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl sm:col-span-2 md:col-span-1">
                <div class="h-28 sm:h-32 md:h-36 lg:h-40 bg-gradient-to-b from-red-900/20 to-transparent rounded-xl mb-3 sm:mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-award text-3xl sm:text-4xl md:text-5xl text-red-500/50"></i>
                </div>
                <span class="text-xs text-red-400">MARCH 5, 2025</span>
                <h3 class="text-base sm:text-lg md:text-xl font-bold mt-2">Award for excellence</h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-2">RENTALX wins best premium service 2025</p>
                <a href="#" class="inline-block mt-3 sm:mt-4 text-red-500 text-xs sm:text-sm font-semibold">Read more →</a>
            </div>
        </div>
    </div>
</section>

<!-- ELITE COLLECTION -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-gradient-to-r from-black to-[#0c0c0c]">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-2 gap-8 sm:gap-10 md:gap-12 items-center">
            <div class="leftAnim text-center md:text-left">
                <span class="text-red-400 text-xs sm:text-sm tracking-widest">✦ EXCLUSIVE PACKAGE</span>
                <h2 class="section-title text-3xl sm:text-4xl md:text-5xl font-black italic mt-3 sm:mt-4">THE <span class="text-red-500">ELITE</span> COLLECTION</h2>
                <p class="text-gray-300 mt-4 sm:mt-5 md:mt-6 text-sm sm:text-base">Hand-picked vehicles, concierge delivery, and personalized itineraries. Only for members.</p>
                <div class="flex gap-3 sm:gap-4 mt-5 sm:mt-6 md:mt-8 justify-center md:justify-start">
                    <div class="w-12 h-12 sm:w-14 md:w-16 sm:h-14 md:h-16 bg-white/5 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-xl md:text-2xl text-red-500">
                        <i class="fa-solid fa-champagne-glasses"></i>
                    </div>
                    <div class="w-12 h-12 sm:w-14 md:w-16 sm:h-14 md:h-16 bg-white/5 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-xl md:text-2xl text-red-500">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="w-12 h-12 sm:w-14 md:w-16 sm:h-14 md:h-16 bg-white/5 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-xl md:text-2xl text-red-500">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 sm:gap-4 rightAnim">
                <div class="new-section-card p-4 sm:p-5 md:p-6 text-center rounded-xl sm:rounded-2xl">
                    <i class="fa-solid fa-car-side text-2xl sm:text-3xl md:text-4xl text-red-500"></i>
                    <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold mt-2 sm:mt-3">Supersports</h4>
                </div>
                <div class="new-section-card p-4 sm:p-5 md:p-6 text-center rounded-xl sm:rounded-2xl">
                    <i class="fa-solid fa-bolt text-2xl sm:text-3xl md:text-4xl text-red-500"></i>
                    <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold mt-2 sm:mt-3">Electric GT</h4>
                </div>
                <div class="new-section-card p-4 sm:p-5 md:p-6 text-center rounded-xl sm:rounded-2xl">
                    <i class="fa-solid fa-tree text-2xl sm:text-3xl md:text-4xl text-red-500"></i>
                    <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold mt-2 sm:mt-3">Luxury SUV</h4>
                </div>
                <div class="new-section-card p-4 sm:p-5 md:p-6 text-center rounded-xl sm:rounded-2xl">
                    <i class="fa-solid fa-gem text-2xl sm:text-3xl md:text-4xl text-red-500"></i>
                    <h4 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold mt-2 sm:mt-3">Limited</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- REVIEWS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-[#0a0a0a]">
    <div class="container mx-auto">
        <h2 class="section-title text-3xl sm:text-4xl md:text-5xl font-black italic text-center mb-2">DRIVERS <span class="text-red-500">REVIEWS</span></h2>
        <p class="text-gray-400 text-center mb-6 sm:mb-8 md:mb-10 lg:mb-12 text-sm sm:text-base">What our elite members say</p>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
            <div class="new-section-card p-5 sm:p-6 md:p-8 reviewCard rounded-xl sm:rounded-2xl">
                <i class="fa-solid fa-quote-right text-xl sm:text-2xl md:text-3xl text-red-500/30"></i>
                <p class="mt-3 sm:mt-4 text-gray-300 text-xs sm:text-sm md:text-base">"The RS6 was mind-blowing. Everything seamless."</p>
                <div class="flex items-center gap-2 sm:gap-3 mt-4 sm:mt-6">
                    <div class="w-8 h-8 sm:w-9 md:w-10 sm:h-9 md:h-10 bg-red-600 rounded-full flex-shrink-0"></div>
                    <div>
                        <h5 class="font-bold text-xs sm:text-sm md:text-base">— M. Chen</h5>
                        <div class="text-yellow-400 text-xs">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-section-card p-5 sm:p-6 md:p-8 reviewCard rounded-xl sm:rounded-2xl">
                <i class="fa-solid fa-quote-right text-xl sm:text-2xl md:text-3xl text-red-500/30"></i>
                <p class="mt-3 sm:mt-4 text-gray-300 text-xs sm:text-sm md:text-base">"Perfect condition, fast delivery. Will book again."</p>
                <div class="flex items-center gap-2 sm:gap-3 mt-4 sm:mt-6">
                    <div class="w-8 h-8 sm:w-9 md:w-10 sm:h-9 md:h-10 bg-red-600 rounded-full flex-shrink-0"></div>
                    <div>
                        <h5 class="font-bold text-xs sm:text-sm md:text-base">— S. Ahmed</h5>
                        <div class="text-yellow-400 text-xs">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-section-card p-5 sm:p-6 md:p-8 reviewCard rounded-xl sm:rounded-2xl sm:col-span-2 md:col-span-1">
                <i class="fa-solid fa-quote-right text-xl sm:text-2xl md:text-3xl text-red-500/30"></i>
                <p class="mt-3 sm:mt-4 text-gray-300 text-xs sm:text-sm md:text-base">"Unforgettable experience. The Quattro grip is unreal."</p>
                <div class="flex items-center gap-2 sm:gap-3 mt-4 sm:mt-6">
                    <div class="w-8 h-8 sm:w-9 md:w-10 sm:h-9 md:h-10 bg-red-600 rounded-full flex-shrink-0"></div>
                    <div>
                        <h5 class="font-bold text-xs sm:text-sm md:text-base">— E. Novak</h5>
                        <div class="text-yellow-400 text-xs">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RECOMMENDED ITEMS -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 px-4 sm:px-6 bg-black">
    <div class="container mx-auto">
        <h3 class="text-2xl sm:text-3xl md:text-4xl font-black italic text-center mb-6 sm:mb-8 md:mb-10">RECOMMENDED <span class="text-red-500">ITEMS</span></h3>

        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5 md:gap-6">
            @if(isset($products) && count($products) > 0)
                @foreach($products->take(10) as $product)
                    <a href="{{ route('product.details', $product->id) }}" class="block">
                        <div class="product-card-item bg-white/5 rounded-xl sm:rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-300 hover:scale-105">
                            <div class="product-img-wrapper aspect-square overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('products/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/200x200?text=Product" class="w-full h-full object-cover" alt="Product">
                                @endif
                            </div>
                            <div class="product-info-box p-3 sm:p-4">
                                <div class="flex justify-between items-center">
                                    <p class="product-price-main text-red-500 font-bold text-sm sm:text-base">Rs {{ number_format($product->price) }}</p>
                                    <button onclick="event.preventDefault(); addToCart({{ $product->id }}, this)" class="bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white w-8 h-8 rounded-lg transition-all flex items-center justify-center">
                                        <i class="fa-solid fa-cart-plus text-xs"></i>
                                    </button>
                                </div>
                                <p class="product-name-text text-white text-xs sm:text-sm mt-1">{{ Str::limit($product->name, 35) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="col-span-full text-center py-8 sm:py-10">
                    <p class="text-gray-400 text-sm sm:text-base">No products available</p>
                </div>
            @endif
        </div>
    </div>
</section>


    <!-- STATS COUNTERS -->
    <section class="py-14 sm:py-20 px-4 sm:px-6 border-y border-white/5 bg-gradient-to-b from-black to-[#070707]">
        <div class="container mx-auto text-center">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
                <div class="numItem">
                    <div class="stat-numbers text-4xl sm:text-5xl font-black text-red-500 counter" data-target="1500">0</div>
                    <p class="text-xs sm:text-sm tracking-widest mt-2">ACTIVE CARS</p>
                </div>
                <div class="numItem">
                    <div class="stat-numbers text-4xl sm:text-5xl font-black text-red-500 counter" data-target="47">0</div>
                    <p class="text-xs sm:text-sm tracking-widest mt-2">LOCATIONS</p>
                </div>
                <div class="numItem">
                    <div class="stat-numbers text-4xl sm:text-5xl font-black text-red-500 counter" data-target="12000">0</div>
                    <p class="text-xs sm:text-sm tracking-widest mt-2">HAPPY DRIVERS</p>
                </div>
                <div class="numItem">
                    <div class="stat-numbers text-4xl sm:text-5xl font-black text-red-500 counter" data-target="8">0</div>
                    <p class="text-xs sm:text-sm tracking-widest mt-2">YEARS ELITE</p>
                </div>
            </div>
        </div>
    </section>



<style>
    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #0a0a0a; overflow-x: hidden; margin: 0; padding: 0; }
    
    /* Custom breakpoints */
    @media (min-width: 480px) {
        .xs\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    /* ===== HERO ===== */
    .hero-banner {
        background: linear-gradient(90deg, #000000 0%, rgba(0,0,0,0.5) 50%, transparent 100%),
                    url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        min-height: 100svh;
    }
    @media (max-width: 768px) {
        .hero-banner {
            background: linear-gradient(180deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.65) 100%),
                        url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800&auto=format&fit=crop') no-repeat center center/cover;
            min-height: 100svh;
            min-height: 100vh;
        }
        /* Prevent hero title from overflowing on very small phones */
        .hero-title {
            font-size: clamp(2.5rem, 12vw, 5rem) !important;
            word-break: break-word;
        }
        #bannerContent {
            padding-top: 80px;
            padding-bottom: 40px;
        }
    }

    /* ===== CARDS ===== */
    .feature-card, .service-card, .new-section-card {
        background: rgba(255,255,255,0.02);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.03);
        transition: all 0.3s ease;
    }
    .feature-card:hover, .new-section-card:hover {
        border-color: #ef4444;
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -15px #ef444430;
    }

    /* ===== MARQUEE ===== */
    .scroll-left {
        white-space: nowrap;
        animation: scrollRightToLeft 25s linear infinite;
        display: inline-flex;
        gap: 2rem;
    }
    @keyframes scrollRightToLeft {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-container {
        mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent);
        overflow: hidden;
    }

    /* ===== STAT ITEMS ===== */
    .stat-item {
        border-left: 3px solid #ef4444;
        padding-left: 1rem;
    }

    /* ===== SPEC METERS ===== */
    .spec-meter {
        height: 6px;
        background: rgba(255,255,255,0.1);
        border-radius: 1rem;
        overflow: hidden;
    }
    .spec-fill {
        height: 100%;
        background: linear-gradient(90deg, #ef4444, #f97316);
        border-radius: 1rem;
        width: 0%;
        transition: width 1.2s ease;
    }

    /* ===== PREMIUM BADGE ===== */
    .premium-badge {
        background: linear-gradient(145deg, rgba(239,68,68,0.1), rgba(0,0,0,0.5));
        border: 1px solid rgba(239,68,68,0.2);
        transition: 0.3s;
    }
    .premium-badge:hover {
        border-color: #ef4444;
        background: rgba(239,68,68,0.15);
    }

    /* ===== CONCIERGE ICON ===== */
    .concierge-icon { transition: 0.3s; }
    .concierge-card:hover .concierge-icon {
        transform: scale(1.1);
        color: #f97316;
    }

    /* ===== BRAND LOGOS ===== */
    .brand-logo { filter: grayscale(1); transition: all 0.3s ease; }
    .brand-logo:hover { filter: grayscale(0); transform: scale(1.1); }

    /* ===== COUNTER ===== */
    .counter { font-feature-settings: "tnum"; }

    /* ===== SCROLL TO TOP ===== */
    .scroll-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 44px;
        height: 44px;
        background: #ef4444;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 500;
        opacity: 0;
        transition: opacity 0.3s, transform 0.3s;
        transform: translateY(20px);
    }
    .scroll-top.show { opacity: 1; transform: translateY(0); }
    .scroll-top:hover { background: #dc2626; }

    /* ===== OVERLAY ===== */
    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 800;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
    }
    .overlay.active { opacity: 1; pointer-events: all; }

    /* ===== CONTAINER ===== */
    .container { width: 100%; max-width: 1280px; margin: 0 auto; }

    /* ===== TRANSITION DURATIONS ===== */
    .duration-3000 { transition-duration: 3000ms; }
</style>

<!-- Scripts -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,600;14..32,800;14..32,900&display=swap" rel="stylesheet">
{{-- Font Awesome already loaded in layouts/app.blade.php (v6.5.1) --}}

<script>
// Add to Cart AJAX
function addToCart(productId, btn) {
    @guest
        window.location.href = '{{ route("login") }}';
        return;
    @endguest

    const originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-[10px]"></i>';

    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                title: 'SUCCESS!',
                text: data.message,
                icon: 'success',
                background: '#0a0a0a',
                color: '#ffffff',
                confirmButtonColor: '#ef4444',
                timer: 2000,
                showConfirmButton: false,
                iconColor: '#ef4444'
            });

            // Update Global Badges
            if (typeof updateAllCartBadges === 'function') {
                updateAllCartBadges(data.cartCount);
            }
            
            // Visual feedback on button
            btn.innerHTML = '<i class="fa-solid fa-check text-[10px]"></i>';
            btn.classList.add('!bg-green-600', '!text-white');
            setTimeout(() => {
                btn.innerHTML = originalHtml;
                btn.classList.remove('!bg-green-600', '!text-white');
                btn.disabled = false;
            }, 2000);

        } else {
            Swal.fire({
                title: 'OOPS!',
                text: data.message,
                icon: 'error',
                background: '#0a0a0a',
                color: '#ffffff',
                confirmButtonColor: '#ef4444'
            });
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.innerHTML = originalHtml;
    });
}

(function() {
    // Register GSAP plugins
    gsap.registerPlugin(ScrollTrigger);

    // ===== SCROLL TO TOP =====
    const scrollTopBtn = document.getElementById('scrollTop');
    if (scrollTopBtn) {
        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('show', window.scrollY > 400);
        });
        
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ===== SPEC FILLS =====
    function initSpecFills() {
        const fills = document.querySelectorAll('.spec-fill');
        fills.forEach(fill => {
            const targetWidth = fill.getAttribute('data-width') + '%';
            ScrollTrigger.create({
                trigger: fill,
                start: 'top 85%',
                onEnter: () => { fill.style.width = targetWidth; }
            });
        });
    }

    // ===== COUNTERS =====
    function initCounters() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            let updated = false;
            const updateCount = () => {
                if (updated) return;
                updated = true;
                const target = parseFloat(counter.getAttribute('data-target'));
                const isFloat = target === 3.6;
                let current = 0;
                counter.innerText = isFloat ? '0.0' : '0';
                const steps = 50;
                const increment = target / steps;
                const interval = setInterval(() => {
                    if (current < target) {
                        current = Math.min(current + increment, target);
                        counter.innerText = isFloat ? current.toFixed(1) : Math.ceil(current);
                    } else {
                        counter.innerText = isFloat ? target.toFixed(1) : target;
                        clearInterval(interval);
                    }
                }, 30);
            };
            ScrollTrigger.create({ trigger: counter, start: 'top 85%', onEnter: updateCount });
        });
    }

    // ===== GSAP ANIMATIONS =====
    function initAnimations() {
        // Nav animation
        gsap.from('nav', { y: -40, opacity: 0, duration: 1.2, clearProps: 'all' });
        
        // Banner animation
        gsap.from('#bannerContent', { x: 80, opacity: 0, duration: 1.4, delay: 0.2, clearProps: 'all' });

        const animSets = [
            { selector: '.cardAnim', props: { y: 60, opacity: 0, duration: 0.8, stagger: 0.15 } },
            { selector: '#teaserMedia', props: { x: -70, opacity: 0, duration: 1 } },
            { selector: '.stat-item', props: { x: 40, opacity: 0, duration: 0.9, stagger: 0.2 } },
            { selector: '.premium-badge', props: { y: 40, opacity: 0, duration: 0.8, stagger: 0.1 } },
            { selector: '.concierge-card', props: { y: 60, opacity: 0, duration: 0.8, stagger: 0.1 } },
            { selector: '.how-it-works-step', props: { y: 50, opacity: 0, duration: 0.8, stagger: 0.2 } },
            { selector: '.brand-logo', props: { scale: 0.8, opacity: 0, duration: 0.6, stagger: 0.1 } },
            { selector: '.news-card', props: { y: 40, opacity: 0, duration: 0.8, stagger: 0.15 } },
            { selector: '.leftAnim', props: { x: -80, opacity: 0, duration: 1 } },
            { selector: '.rightAnim', props: { x: 80, opacity: 0, duration: 1 } },
            { selector: '.reviewCard', props: { y: 40, opacity: 0, duration: 1, stagger: 0.2 } }
        ];

        animSets.forEach(({ selector, props }) => {
            const els = document.querySelectorAll(selector);
            if (!els.length) return;
            gsap.from(els, {
                scrollTrigger: { trigger: els[0], start: 'top 85%' },
                ...props,
                clearProps: 'all'
            });
        });
    }

    // ===== PARALLAX EFFECT (desktop only) =====
    if (window.innerWidth > 768) {
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 6;
            const y = (e.clientY / window.innerHeight - 0.5) * 4;
            gsap.to('.hero-banner', { x, y, duration: 1.5, ease: 'power2.out' });
        });
    }

    // ===== INIT ON LOAD =====
    window.addEventListener('load', () => {
        initSpecFills();
        initCounters();
        initAnimations();
    });

    // Fallback visibility
    setTimeout(() => {
        document.querySelectorAll('section, nav, footer').forEach(el => {
            el.style.opacity = '1';
            el.style.visibility = 'visible';
        });
    }, 3000);
})();
</script>

@endsection