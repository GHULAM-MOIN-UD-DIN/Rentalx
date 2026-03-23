@extends('layouts.app')

@section('content')


<!-- ===== HERO ===== -->
<section class="about-hero flex items-center pt-20" style="margin-top: 0;">
    <div class="container mx-auto px-4 sm:px-6 md:px-12 py-20 sm:py-28">
        <div class="max-w-3xl heroContent">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em] font-semibold border-l-4 border-red-500 pl-4">OUR STORY // SINCE 2017</span>
            <h1 class="text-5xl sm:text-7xl md:text-8xl font-black italic leading-[0.9] mt-5 sm:mt-6">ABOUT <span class="text-red-500">US</span></h1>
            <p class="text-gray-300 text-base sm:text-xl mt-5 sm:mt-6 max-w-xl leading-relaxed">We didn't just build a car rental company. We built a movement — for those who believe that how you arrive matters as much as where you're going.</p>
            <div class="flex flex-wrap gap-4 mt-8 sm:mt-10">
                <button class="bg-red-600 hover:bg-red-700 px-7 sm:px-10 py-3 sm:py-4 rounded-full font-bold tracking-wide text-sm transition-all flex items-center gap-2 shadow-2xl shadow-red-600/20"><i class="fa-solid fa-bolt"></i> OUR FLEET</button>
                <button class="border border-white/20 hover:border-red-500 px-7 sm:px-10 py-3 sm:py-4 rounded-full text-sm font-bold tracking-wide transition">MEET THE TEAM</button>
            </div>
        </div>
        <!-- Floating badges -->
        <div class="hidden md:flex gap-4 mt-14 flex-wrap">
            <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-3 flex items-center gap-3 backdrop-blur-sm heroBadge">
                <i class="fa-solid fa-award text-red-400 text-xl"></i>
                <div><p class="text-xs text-gray-400">Best Premium Rental</p><p class="font-bold text-sm">2025 Award</p></div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-3 flex items-center gap-3 backdrop-blur-sm heroBadge">
                <i class="fa-solid fa-map-location-dot text-red-400 text-xl"></i>
                <div><p class="text-xs text-gray-400">Locations worldwide</p><p class="font-bold text-sm">47 Cities</p></div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-3 flex items-center gap-3 backdrop-blur-sm heroBadge">
                <i class="fa-solid fa-users text-red-400 text-xl"></i>
                <div><p class="text-xs text-gray-400">Happy drivers</p><p class="font-bold text-sm">12,000+</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MISSION & VISION ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-[#070707]">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
            <div class="value-card p-8 sm:p-10 missionCard">
                <div class="w-14 h-14 bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-6"><i class="fa-solid fa-crosshairs"></i></div>
                <span class="text-red-400 text-xs tracking-[0.3em]">WHAT WE STAND FOR</span>
                <h2 class="text-3xl sm:text-4xl font-black italic mt-3">OUR <span class="text-red-500">MISSION</span></h2>
                <p class="text-gray-300 mt-5 leading-relaxed text-sm sm:text-base">To redefine automotive luxury — making the world's most extraordinary vehicles accessible to those who demand the extraordinary. Every rental is a curated experience, not just a transaction.</p>
                <div class="mt-8 space-y-3">
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Premium fleet, maintained to perfection</span></div>
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Concierge-level service, always</span></div>
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Zero compromise on quality</span></div>
                </div>
            </div>
            <div class="value-card p-8 sm:p-10 missionCard">
                <div class="w-14 h-14 bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl text-red-500 mb-6"><i class="fa-solid fa-eye"></i></div>
                <span class="text-red-400 text-xs tracking-[0.3em]">WHERE WE'RE GOING</span>
                <h2 class="text-3xl sm:text-4xl font-black italic mt-3">OUR <span class="text-red-500">VISION</span></h2>
                <p class="text-gray-300 mt-5 leading-relaxed text-sm sm:text-base">To become the world's most iconic premium car rental brand — recognized not just for our fleet, but for the emotion, thrill, and unforgettable memories we create for every driver.</p>
                <div class="mt-8 space-y-3">
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Global expansion to 100+ cities by 2028</span></div>
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Full EV luxury fleet integration</span></div>
                    <div class="flex items-center gap-3 text-sm"><i class="fa-solid fa-check text-red-400 w-5"></i><span>Redefining the rental experience globally</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="py-14 sm:py-20 px-4 sm:px-6 bg-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-center">
            <div class="numItem">
                <div class="text-4xl sm:text-5xl font-black text-red-500 counter" data-target="8">0</div>
                <p class="text-xs sm:text-sm tracking-widest mt-2 text-gray-400">YEARS IN BUSINESS</p>
            </div>
            <div class="numItem">
                <div class="text-4xl sm:text-5xl font-black text-red-500 counter" data-target="1500">0</div>
                <p class="text-xs sm:text-sm tracking-widest mt-2 text-gray-400">PREMIUM VEHICLES</p>
            </div>
            <div class="numItem">
                <div class="text-4xl sm:text-5xl font-black text-red-500 counter" data-target="47">0</div>
                <p class="text-xs sm:text-sm tracking-widest mt-2 text-gray-400">GLOBAL LOCATIONS</p>
            </div>
            <div class="numItem">
                <div class="text-4xl sm:text-5xl font-black text-red-500 counter" data-target="12000">0</div>
                <p class="text-xs sm:text-sm tracking-widest mt-2 text-gray-400">HAPPY DRIVERS</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== OUR STORY / TIMELINE ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-b from-[#0a0a0a] to-black">
    <div class="container mx-auto">
        <div class="text-center mb-12 sm:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">HOW WE GOT HERE</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">OUR <span class="text-red-500">JOURNEY</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base">Eight years of passion, precision and pursuit of perfection</p>
        </div>

        <div class="relative max-w-4xl mx-auto">
            <div class="timeline-line hidden md:block"></div>

            <!-- Timeline items -->
            <div class="space-y-8 sm:space-y-12">

                <!-- 2017 -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 sm:gap-8 timelineItem">
                    <div class="md:w-1/2 md:text-right md:pr-12">
                        <span class="text-red-500 text-xs tracking-[0.3em] font-bold">2017</span>
                        <h3 class="text-xl sm:text-2xl font-black italic mt-1">THE BEGINNING</h3>
                        <p class="text-gray-400 mt-2 text-sm sm:text-base">Founded in Dubai with just 3 vehicles and an obsession with delivering the perfect driving experience. Our founder Alex Jordan rented his personal RS6 to a stranger — and never looked back.</p>
                    </div>
                    <div class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 hidden md:flex">
                        <div class="w-5 h-5 rounded-full bg-red-500 border-4 border-black relative">
                            <div class="glow-ring"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 md:pl-12">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5">
                            <i class="fa-solid fa-flag-checkered text-red-400 text-2xl"></i>
                            <p class="text-xs text-gray-400 mt-2">Dubai, UAE · 3 vehicles · 1 dream</p>
                        </div>
                    </div>
                </div>

                <!-- 2019 -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 sm:gap-8 timelineItem">
                    <div class="md:w-1/2 md:text-right md:pr-12 md:order-1">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5">
                            <i class="fa-solid fa-globe text-red-400 text-2xl"></i>
                            <p class="text-xs text-gray-400 mt-2">Europe expansion · 12 cities · 200+ vehicles</p>
                        </div>
                    </div>
                    <div class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 hidden md:flex md:order-2">
                        <div class="w-5 h-5 rounded-full bg-red-500 border-4 border-black relative">
                            <div class="glow-ring"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 md:pl-12 md:order-3">
                        <span class="text-red-500 text-xs tracking-[0.3em] font-bold">2019</span>
                        <h3 class="text-xl sm:text-2xl font-black italic mt-1">GOING GLOBAL</h3>
                        <p class="text-gray-400 mt-2 text-sm sm:text-base">Expanded into Europe with offices in London, Paris, and Monaco. Launched the RENTALX Elite Membership program, welcoming our first 500 prestige members.</p>
                    </div>
                </div>

                <!-- 2021 -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 sm:gap-8 timelineItem">
                    <div class="md:w-1/2 md:text-right md:pr-12">
                        <span class="text-red-500 text-xs tracking-[0.3em] font-bold">2021</span>
                        <h3 class="text-xl sm:text-2xl font-black italic mt-1">THE ELECTRIC ERA</h3>
                        <p class="text-gray-400 mt-2 text-sm sm:text-base">Introduced our first all-electric luxury fleet — Taycan, Model S Plaid, and the Rimac Nevera. Proved that sustainability and performance are not opposites.</p>
                    </div>
                    <div class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 hidden md:flex">
                        <div class="w-5 h-5 rounded-full bg-red-500 border-4 border-black relative">
                            <div class="glow-ring"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 md:pl-12">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5">
                            <i class="fa-solid fa-bolt text-red-400 text-2xl"></i>
                            <p class="text-xs text-gray-400 mt-2">EV fleet · Zero emissions · Full charge</p>
                        </div>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 sm:gap-8 timelineItem">
                    <div class="md:w-1/2 md:text-right md:pr-12 md:order-1">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5">
                            <i class="fa-solid fa-trophy text-red-400 text-2xl"></i>
                            <p class="text-xs text-gray-400 mt-2">47 locations · 1,500 vehicles · 10K+ members</p>
                        </div>
                    </div>
                    <div class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 hidden md:flex md:order-2">
                        <div class="w-5 h-5 rounded-full bg-orange-500 border-4 border-black relative">
                            <div class="glow-ring"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 md:pl-12 md:order-3">
                        <span class="text-orange-400 text-xs tracking-[0.3em] font-bold">2023</span>
                        <h3 class="text-xl sm:text-2xl font-black italic mt-1">INDUSTRY LEADERS</h3>
                        <p class="text-gray-400 mt-2 text-sm sm:text-base">Named the #1 Premium Car Rental brand globally. Surpassed 10,000 active members and opened our flagship RENTALX Lounge in New York City.</p>
                    </div>
                </div>

                <!-- 2025 -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 sm:gap-8 timelineItem">
                    <div class="md:w-1/2 md:text-right md:pr-12">
                        <span class="text-red-500 text-xs tracking-[0.3em] font-bold">2025 · NOW</span>
                        <h3 class="text-xl sm:text-2xl font-black italic mt-1">THE FUTURE IS HERE</h3>
                        <p class="text-gray-400 mt-2 text-sm sm:text-base">12,000+ elite members. 47 cities. Partnerships with IWC, Bang & Olufsen, and Moët. And we're just getting started. The RS6 era is only the beginning.</p>
                    </div>
                    <div class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 hidden md:flex">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-red-500 to-orange-500 border-4 border-black relative shadow-lg shadow-red-500/50">
                            <div class="glow-ring"></div>
                            <div class="glow-ring-2"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 md:pl-12">
                        <div class="bg-gradient-to-br from-red-600/10 to-orange-600/10 border border-red-500/20 rounded-2xl p-4 sm:p-5">
                            <i class="fa-solid fa-gem text-red-400 text-2xl"></i>
                            <p class="text-xs text-gray-400 mt-2">Best Premium Rental 2025 · Global icon</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ===== MARQUEE ===== -->
<section class="py-10 sm:py-16 overflow-hidden bg-black">
    <div class="marquee-container">
        <div class="scroll-left text-4xl sm:text-6xl font-black italic text-red-600/20">
            <span>PASSION</span><span class="text-white/20">✦</span><span>PERFORMANCE</span><span class="text-white/20">✦</span><span>PRESTIGE</span><span class="text-white/20">✦</span><span>PRECISION</span><span class="text-white/20">✦</span><span>PASSION</span><span class="text-white/20">✦</span><span>PERFORMANCE</span><span class="text-white/20">✦</span><span>PRESTIGE</span><span class="text-white/20">✦</span><span>PRECISION</span><span class="text-white/20">✦</span><span>PASSION</span><span class="text-white/20">✦</span><span>PERFORMANCE</span><span class="text-white/20">✦</span>
        </div>
    </div>
</section>

<!-- ===== TEAM ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-[#070707]">
    <div class="container mx-auto">
        <div class="text-center mb-12 sm:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">THE PEOPLE BEHIND THE WHEEL</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">MEET THE <span class="text-red-500">TEAM</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mt-4 text-sm sm:text-base">Driven by passion, united by excellence</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">

            <!-- Member 1 -->
            <div class="team-card teamCard">
                <div class="relative">
                    <div class="h-48 sm:h-64 bg-gradient-to-b from-red-900/30 to-black/80 flex items-center justify-center">
                        <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center text-2xl sm:text-4xl font-black">AJ</div>
                    </div>
                    <div class="team-overlay"><span class="text-xs font-bold">Founder & CEO</span></div>
                </div>
                <div class="p-4 sm:p-5">
                    <h4 class="font-black text-sm sm:text-base">Alex Jordan</h4>
                    <p class="text-xs text-red-400 mt-1">Founder & CEO</p>
                    <p class="text-xs text-gray-400 mt-2 hidden sm:block">The visionary who turned 3 cars into a global brand.</p>
                    <div class="flex gap-2 mt-3">
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Member 2 -->
            <div class="team-card teamCard">
                <div class="relative">
                    <div class="h-48 sm:h-64 bg-gradient-to-b from-orange-900/30 to-black/80 flex items-center justify-center">
                        <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-orange-600 to-red-500 flex items-center justify-center text-2xl sm:text-4xl font-black">SK</div>
                    </div>
                    <div class="team-overlay"><span class="text-xs font-bold">Chief Operations</span></div>
                </div>
                <div class="p-4 sm:p-5">
                    <h4 class="font-black text-sm sm:text-base">Sofia Kessler</h4>
                    <p class="text-xs text-red-400 mt-1">COO</p>
                    <p class="text-xs text-gray-400 mt-2 hidden sm:block">The operational genius who keeps 47 cities running flawlessly.</p>
                    <div class="flex gap-2 mt-3">
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Member 3 -->
            <div class="team-card teamCard">
                <div class="relative">
                    <div class="h-48 sm:h-64 bg-gradient-to-b from-red-900/30 to-black/80 flex items-center justify-center">
                        <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-red-700 to-rose-500 flex items-center justify-center text-2xl sm:text-4xl font-black">MR</div>
                    </div>
                    <div class="team-overlay"><span class="text-xs font-bold">Head of Fleet</span></div>
                </div>
                <div class="p-4 sm:p-5">
                    <h4 class="font-black text-sm sm:text-base">Marco Russo</h4>
                    <p class="text-xs text-red-400 mt-1">Head of Fleet</p>
                    <p class="text-xs text-gray-400 mt-2 hidden sm:block">Former F1 engineer. Every car is his masterpiece.</p>
                    <div class="flex gap-2 mt-3">
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Member 4 -->
            <div class="team-card teamCard">
                <div class="relative">
                    <div class="h-48 sm:h-64 bg-gradient-to-b from-orange-900/30 to-black/80 flex items-center justify-center">
                        <div class="w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-amber-600 to-red-600 flex items-center justify-center text-2xl sm:text-4xl font-black">LP</div>
                    </div>
                    <div class="team-overlay"><span class="text-xs font-bold">Head of Experience</span></div>
                </div>
                <div class="p-4 sm:p-5">
                    <h4 class="font-black text-sm sm:text-base">Lena Park</h4>
                    <p class="text-xs text-red-400 mt-1">Head of Experience</p>
                    <p class="text-xs text-gray-400 mt-2 hidden sm:block">Designs the moments that make our drivers feel elite.</p>
                    <div class="flex gap-2 mt-3">
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-7 h-7 rounded-full border border-white/20 flex items-center justify-center text-xs hover:bg-red-600 transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== CORE VALUES ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-black">
    <div class="container mx-auto">
        <div class="text-center mb-12 sm:mb-16">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">WHAT DRIVES US</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">CORE <span class="text-red-500">VALUES</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="value-card p-6 sm:p-8 text-center valueCard">
                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl sm:text-3xl text-red-500 mb-4 sm:mb-5"><i class="fa-solid fa-gem"></i></div>
                <h4 class="text-base sm:text-xl font-black">EXCELLENCE</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-2 sm:mt-3">We never settle. Every detail is crafted to perfection, from the vehicles to the service.</p>
            </div>
            <div class="value-card p-6 sm:p-8 text-center valueCard">
                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl sm:text-3xl text-red-500 mb-4 sm:mb-5"><i class="fa-solid fa-handshake"></i></div>
                <h4 class="text-base sm:text-xl font-black">TRUST</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-2 sm:mt-3">Transparent pricing, honest service. Our members trust us with their most important moments.</p>
            </div>
            <div class="value-card p-6 sm:p-8 text-center valueCard">
                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl sm:text-3xl text-red-500 mb-4 sm:mb-5"><i class="fa-solid fa-rocket"></i></div>
                <h4 class="text-base sm:text-xl font-black">INNOVATION</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-2 sm:mt-3">First to electric, first to concierge, first to redefine what luxury rental means globally.</p>
            </div>
            <div class="value-card p-6 sm:p-8 text-center valueCard">
                <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto bg-red-600/10 rounded-2xl flex items-center justify-center text-2xl sm:text-3xl text-red-500 mb-4 sm:mb-5"><i class="fa-solid fa-heart"></i></div>
                <h4 class="text-base sm:text-xl font-black">PASSION</h4>
                <p class="text-xs sm:text-sm text-gray-400 mt-2 sm:mt-3">Cars are not just machines. They are emotion, freedom, and identity. We live and breathe this.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-r from-red-900/20 via-black to-orange-900/10 border-y border-red-500/10">
    <div class="container mx-auto text-center">
        <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">JOIN THE MOVEMENT</span>
        <h2 class="text-4xl sm:text-6xl md:text-7xl font-black italic mt-4">BECOME <span class="text-red-500">ELITE</span></h2>
        <p class="text-gray-300 max-w-xl mx-auto mt-5 text-sm sm:text-base">Exclusive access. Priority fleet. Concierge service. Join 12,000+ drivers who've already elevated their journey.</p>
        <div class="flex flex-wrap gap-4 justify-center mt-8 sm:mt-10">
            <button class="bg-red-600 hover:bg-red-700 px-8 sm:px-12 py-4 rounded-full font-bold tracking-wide text-sm transition-all flex items-center gap-2 shadow-2xl shadow-red-600/30"><i class="fa-solid fa-crown"></i> JOIN ELITE NOW</button>
            <button class="border border-white/20 hover:border-red-500 px-8 sm:px-12 py-4 rounded-full text-sm font-bold tracking-wide transition">EXPLORE FLEET →</button>
        </div>
    </div>
</section>

<style>
    /* PAGE-SPECIFIC STYLES — Global nav/menu/sidebar handled by app.blade.php */

    /* HERO */
    .about-hero {
        background: linear-gradient(135deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.7) 50%, rgba(239,68,68,0.08) 100%),
                    url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        min-height: 80vh;
        position: relative;
    }
    @media (max-width: 768px) {
        .about-hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 100%),
                        url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop') no-repeat center center/cover;
        }
    }

    /* CARDS */
    .value-card { background: rgba(255,255,255,0.02); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.04); border-radius: 1.5rem; transition: all 0.4s ease; }
    .value-card:hover { border-color: #ef4444; transform: translateY(-8px); box-shadow: 0 30px 40px -20px rgba(239,68,68,0.3); }

    .team-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.04); border-radius: 1.5rem; overflow: hidden; transition: all 0.4s ease; }
    .team-card:hover { border-color: #ef4444; transform: translateY(-6px); box-shadow: 0 25px 35px -15px rgba(239,68,68,0.25); }
    .team-card:hover .team-overlay { opacity: 1; }

    .team-overlay { position: absolute; inset: 0; background: linear-gradient(0deg, rgba(239,68,68,0.7), transparent); opacity: 0; transition: opacity 0.4s; display: flex; align-items: flex-end; padding: 1.5rem; }

    .milestone-card { border-left: 3px solid #ef4444; padding-left: 1.5rem; transition: all 0.3s; }
    .milestone-card:hover { border-color: #f97316; transform: translateX(8px); }

    /* STAT */
    .stat-item { border-left: 3px solid #ef4444; padding-left: 1rem; }

    /* MARQUEE */
    .scroll-left { white-space: nowrap; animation: scrollRTL 30s linear infinite; display: inline-flex; gap: 2rem; }
    @keyframes scrollRTL { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .marquee-container { mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent); overflow: hidden; }

    /* NEW SECTION CARD */
    .new-section-card { background: rgba(255,255,255,0.02); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.03); transition: all 0.4s ease; padding: 2rem; border-radius: 2rem; }
    .new-section-card:hover { border-color: #ef4444; transform: scale(1.02) translateY(-5px); box-shadow: 0 30px 40px -20px #ef4444; }

    /* TIMELINE LINE */
    .timeline-line { position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: linear-gradient(180deg, transparent, #ef4444 20%, #ef4444 80%, transparent); transform: translateX(-50%); }
    @media (max-width: 768px) { .timeline-line { left: 1.5rem; } }

    /* GLOWING RING */
    .glow-ring { position: absolute; inset: -20px; border-radius: 50%; border: 1px solid rgba(239,68,68,0.15); animation: pulseRing 3s ease-in-out infinite; }
    .glow-ring-2 { position: absolute; inset: -40px; border-radius: 50%; border: 1px solid rgba(239,68,68,0.08); animation: pulseRing 3s ease-in-out infinite 1.5s; }
    @keyframes pulseRing { 0%,100% { opacity: 0.3; transform: scale(1); } 50% { opacity: 1; transform: scale(1.05); } }

    /* COUNTER */
    .counter { font-feature-settings: "tnum"; }

    .container { width: 100%; max-width: 1280px; margin: 0 auto; }
</style>

<script>
(function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // NOTE: Sidebar, mobile menu, overlay all handled by app.blade.php globally

    // COUNTERS
    function initCounters() {
        document.querySelectorAll('.counter').forEach(counter => {
            let done = false;
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.create({ 
                    trigger: counter, 
                    start: 'top 85%', 
                    onEnter: () => {
                        if (done) return; done = true;
                        const target = parseFloat(counter.getAttribute('data-target'));
                        let current = 0;
                        const steps = 60, inc = target / steps;
                        const iv = setInterval(() => {
                            current = Math.min(current + inc, target);
                            counter.innerText = Math.ceil(current);
                            if (current >= target) { 
                                counter.innerText = target; 
                                clearInterval(iv); 
                            }
                        }, 25);
                    }
                });
            }
        });
    }

    // ANIMATIONS
    window.addEventListener('load', () => {
        if (typeof gsap === 'undefined') return;
        gsap.from('.heroContent', { x: -60, opacity: 0, duration: 1.2, delay: 0.2, clearProps: 'all' });
        gsap.from('.heroBadge', { y: 30, opacity: 0, duration: 0.8, stagger: 0.15, delay: 0.5, clearProps: 'all' });

        const sets = [
            ['.missionCard', { y: 50, opacity: 0, stagger: 0.2, duration: 0.9 }],
            ['.numItem', { y: 30, opacity: 0, stagger: 0.15, duration: 0.8 }],
            ['.timelineItem', { x: -40, opacity: 0, stagger: 0.2, duration: 0.9 }],
            ['.teamCard', { y: 50, opacity: 0, stagger: 0.15, duration: 0.8 }],
            ['.valueCard', { y: 40, opacity: 0, stagger: 0.15, duration: 0.8 }]
        ];
        sets.forEach(([sel, props]) => {
            const els = document.querySelectorAll(sel);
            if (!els.length) return;
            gsap.from(els, { scrollTrigger: { trigger: els[0], start: 'top 85%' }, ...props, clearProps: 'all' });
        });

        initCounters();
    });

})();
</script>

@endsection