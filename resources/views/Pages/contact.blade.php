@extends('layouts.app')

@section('content')


<!-- ===== HERO ===== -->
<section class="contact-hero flex items-center pt-20" style="margin-top: 0;">
    <div class="container mx-auto px-4 sm:px-6 md:px-12 py-16 sm:py-24">
        <div class="max-w-3xl heroContent">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em] font-semibold border-l-4 border-red-500 pl-4">GET IN TOUCH // 24/7</span>
            <h1 class="text-5xl sm:text-7xl md:text-8xl font-black italic leading-[0.9] mt-5 sm:mt-6">CONTACT <span class="text-red-500">US</span></h1>
            <p class="text-gray-300 text-base sm:text-xl mt-5 max-w-xl leading-relaxed">Whether it's a question, a booking, or a dream — our concierge team is ready. Reach us anytime, anywhere.</p>
            <div class="flex items-center gap-3 mt-6">
                <div class="pulse-dot"></div>
                <span class="text-xs text-gray-400">Concierge team online — avg. response: <span class="text-green-400 font-bold">4 minutes</span></span>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACT INFO CARDS ===== -->
<section class="py-12 sm:py-16 px-4 sm:px-6 bg-black border-b border-white/5">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5">

            <div class="contact-info-card p-5 sm:p-6 text-center infoCard">
                <div class="card-icon text-3xl sm:text-4xl text-red-500 mb-3 sm:mb-4"><i class="fa-solid fa-phone"></i></div>
                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">Call Us</p>
                <p class="font-black text-sm sm:text-base">+1 800 RENTALX</p>
                <p class="text-xs text-gray-500 mt-1">24 / 7 available</p>
            </div>

            <div class="contact-info-card p-5 sm:p-6 text-center infoCard">
                <div class="card-icon text-3xl sm:text-4xl text-red-500 mb-3 sm:mb-4"><i class="fa-regular fa-envelope"></i></div>
                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">Email Us</p>
                <p class="font-black text-sm sm:text-base">elite@rentalx.com</p>
                <p class="text-xs text-gray-500 mt-1">Reply within 4 mins</p>
            </div>

            <div class="contact-info-card p-5 sm:p-6 text-center infoCard">
                <div class="card-icon text-3xl sm:text-4xl text-red-500 mb-3 sm:mb-4"><i class="fa-brands fa-whatsapp"></i></div>
                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">WhatsApp</p>
                <p class="font-black text-sm sm:text-base">+1 212 555 0190</p>
                <p class="text-xs text-gray-500 mt-1">Instant messaging</p>
            </div>

            <div class="contact-info-card p-5 sm:p-6 text-center infoCard">
                <div class="card-icon text-3xl sm:text-4xl text-red-500 mb-3 sm:mb-4"><i class="fa-solid fa-location-dot"></i></div>
                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">HQ</p>
                <p class="font-black text-sm sm:text-base">Dubai, UAE</p>
                <p class="text-xs text-gray-500 mt-1">47 global offices</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== MAIN CONTACT SECTION ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-[#070707]">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-10 sm:gap-14 items-start">

            <!-- LEFT: FORM -->
            <div class="formSection">
                <span class="text-red-400 text-xs tracking-[0.4em]">SEND A MESSAGE</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black italic mt-3">LET'S <span class="text-red-500">TALK</span></h2>
                <p class="text-gray-400 mt-3 text-sm sm:text-base">Fill out the form and our concierge team will get back to you faster than a Quattro launch.</p>

                <form id="contactForm" class="mt-8 space-y-5" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    
                    @guest
                        <div class="p-6 bg-red-600/10 border border-red-500/20 rounded-2xl mb-8 flex items-center justify-between gap-4">
                            <div>
                                <h4 class="text-white font-black text-sm uppercase tracking-widest italic leading-none">Access Restricted</h4>
                                <p class="text-zinc-500 text-xs mt-1.5 leading-relaxed italic">You must be logged in to access our concierge direct services.</p>
                            </div>
                            <a href="{{ route('login.form') }}" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] font-black rounded-full transition-all uppercase tracking-widest">Login Now</a>
                        </div>
                    @endguest

                    <!-- Name + Email -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="form-input @error('name') border-red-500 @enderror @guest opacity-50 @endguest" placeholder="Alex Jordan" value="{{ Auth::check() ? Auth::user()->name : old('name') }}" required @guest readonly @endguest>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="form-label">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" class="form-input @error('email') border-red-500 @enderror @guest opacity-50 @endguest" placeholder="you@email.com" value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required @guest readonly @endguest>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Phone + Subject -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-input @guest opacity-50 @endguest" placeholder="+1 212 000 0000" value="{{ old('phone') }}" @guest readonly @endguest>
                        </div>
                        <div>
                            <label class="form-label">Subject</label>
                            <div class="relative">
                                <select name="subject" class="form-select @error('subject') border-red-500 @enderror @guest opacity-50 pointer-events-none @endguest" @guest disabled @endguest>
                                    <option value="">Select topic</option>
                                    <option value="Booking Enquiry" {{ old('subject') == 'Booking Enquiry' ? 'selected' : '' }}>Booking Enquiry</option>
                                    <option value="Fleet Information" {{ old('subject') == 'Fleet Information' ? 'selected' : '' }}>Fleet Information</option>
                                    <option value="Membership" {{ old('subject') == 'Membership' ? 'selected' : '' }}>Membership</option>
                                    <option value="Concierge Service" {{ old('subject') == 'Concierge Service' ? 'selected' : '' }}>Concierge Service</option>
                                    <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Preferred Vehicle -->
                    <div>
                        <label class="form-label">Preferred Vehicle (Optional)</label>
                        <div class="grid grid-cols-3 sm:grid-cols-6 gap-2 @guest opacity-50 pointer-events-none @endguest" id="vehiclePicker">
                            <input type="hidden" name="preferred_vehicle" id="selectedVehicle" value="{{ old('preferred_vehicle') }}">
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'RS6' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'RS6')" @guest disabled @endguest>RS6</button>
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'Taycan' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'Taycan')" @guest disabled @endguest>Taycan</button>
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'Huracán' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'Huracán')" @guest disabled @endguest>Huracán</button>
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'GT-R' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'GT-R')" @guest disabled @endguest>GT-R</button>
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'M8' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'M8')" @guest disabled @endguest>M8</button>
                            <button type="button" class="vehicle-btn py-2 px-2 text-xs border border-white/10 rounded-xl hover:border-red-500 transition text-center {{ old('preferred_vehicle') == 'Other' ? 'bg-red-600 border-red-500 text-white' : '' }}" onclick="selectVehicle(this, 'Other')" @guest disabled @endguest>Other</button>
                        </div>
                    </div>

                    <!-- Date Range -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Rental Start Date</label>
                            <input type="date" name="start_date" class="form-input @guest opacity-50 @endguest" value="{{ old('start_date') }}" @guest readonly @endguest>
                        </div>
                        <div>
                            <label class="form-label">Rental End Date</label>
                            <input type="date" name="end_date" class="form-input @guest opacity-50 @endguest" value="{{ old('end_date') }}" @guest readonly @endguest>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="form-label">Your Message <span class="text-red-500">*</span></label>
                        <textarea name="message" class="form-input @error('message') border-red-500 @enderror @guest opacity-50 @endguest" rows="4" placeholder="Tell us about your dream drive, event, or any special requirements..." required @guest readonly @endguest>{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit -->
                    @auth
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-4 rounded-full font-black tracking-widest text-sm uppercase transition-all flex items-center justify-center gap-3 shadow-2xl shadow-red-600/20 group">
                            <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                            SEND MESSAGE
                        </button>
                    @else
                        <a href="{{ route('login.form') }}" class="w-full bg-zinc-800 hover:bg-zinc-700 py-4 rounded-full font-black tracking-widest text-sm uppercase transition-all flex items-center justify-center gap-3 group">
                            <i class="fa-solid fa-lock text-red-500"></i>
                            LOGIN TO SEND MESSAGE
                        </a>
                    @endauth

                </form>

                </form>

                <!-- Loading Overlay (for AJAX) -->
                <div id="loadingOverlay" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-20 h-20 border-4 border-red-600 border-t-transparent rounded-full animate-spin mx-auto"></div>
                        <p class="text-white mt-4 text-lg font-bold">Sending your message...</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT: INFO + MAP + SOCIAL -->
            <div class="space-y-6 rightSection">

                <!-- MAP PLACEHOLDER -->
                <div class="map-placeholder h-52 sm:h-64 flex flex-col items-center justify-center gap-3">
                    <div class="relative">
                        <i class="fa-solid fa-location-dot text-red-500 text-5xl sm:text-6xl"></i>
                        <div class="absolute -inset-4 rounded-full border border-red-500/20 animate-ping"></div>
                    </div>
                    <p class="text-sm font-bold mt-2">RENTALX Global HQ</p>
                    <p class="text-xs text-gray-400">Sheikh Zayed Road, Dubai, UAE</p>
                    <a href="#" class="mt-2 text-xs border border-red-500/30 text-red-400 px-4 py-2 rounded-full hover:bg-red-600/10 transition">
                        <i class="fa-solid fa-map mr-1"></i> View on Map
                    </a>
                </div>

                <!-- OFFICE HOURS -->
                <div class="contact-info-card p-6 sm:p-7">
                    <h4 class="font-black text-base sm:text-lg mb-4 flex items-center gap-2"><i class="fa-regular fa-clock text-red-400"></i> OFFICE HOURS</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-gray-400">Monday — Friday</span>
                            <span class="font-bold text-green-400">08:00 — 22:00</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-gray-400">Saturday</span>
                            <span class="font-bold text-green-400">09:00 — 20:00</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/5">
                            <span class="text-gray-400">Sunday</span>
                            <span class="font-bold text-yellow-400">10:00 — 18:00</span>
                        </div>
                        <div class="flex justify-between items-center pt-1">
                            <span class="text-gray-400">Emergency Concierge</span>
                            <span class="font-bold text-red-400">24 / 7</span>
                        </div>
                    </div>
                </div>

                <!-- SOCIAL CHANNELS -->
                <div class="contact-info-card p-6 sm:p-7">
                    <h4 class="font-black text-base sm:text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-share-nodes text-red-400"></i> FIND US ONLINE</h4>
                    <div class="space-y-3">
                        <a href="#" class="social-btn">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center flex-shrink-0"><i class="fa-brands fa-instagram text-sm"></i></div>
                            <div><p class="font-bold text-sm">Instagram</p><p class="text-xs text-gray-400">@rentalx.official</p></div>
                            <i class="fa-solid fa-arrow-right ml-auto text-xs text-gray-500"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <div class="w-9 h-9 rounded-full bg-black border border-white/10 flex items-center justify-center flex-shrink-0"><i class="fa-brands fa-x-twitter text-sm"></i></div>
                            <div><p class="font-bold text-sm">X / Twitter</p><p class="text-xs text-gray-400">@rentalx</p></div>
                            <i class="fa-solid fa-arrow-right ml-auto text-xs text-gray-500"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <div class="w-9 h-9 rounded-full bg-red-600 flex items-center justify-center flex-shrink-0"><i class="fa-brands fa-youtube text-sm"></i></div>
                            <div><p class="font-bold text-sm">YouTube</p><p class="text-xs text-gray-400">RENTALX Channel</p></div>
                            <i class="fa-solid fa-arrow-right ml-auto text-xs text-gray-500"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <div class="w-9 h-9 rounded-full bg-green-600 flex items-center justify-center flex-shrink-0"><i class="fa-brands fa-whatsapp text-sm"></i></div>
                            <div><p class="font-bold text-sm">WhatsApp</p><p class="text-xs text-gray-400">Chat with concierge</p></div>
                            <i class="fa-solid fa-arrow-right ml-auto text-xs text-gray-500"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ===== GLOBAL OFFICES ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-black border-y border-white/5">
    <div class="container mx-auto">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">WORLDWIDE PRESENCE</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-black italic mt-3">OUR <span class="text-red-500">LOCATIONS</span></h2>
            <p class="text-gray-400 max-w-xl mx-auto mt-4 text-sm sm:text-base">47 cities. One standard — elite.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-building"></i></div>
                <p class="font-black text-sm sm:text-base">Dubai</p>
                <p class="text-xs text-gray-400 mt-1">HQ · Main Showroom</p>
                <span class="inline-block mt-2 text-[10px] bg-red-600/20 text-red-400 px-2 py-0.5 rounded-full">HQ</span>
            </div>
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-city"></i></div>
                <p class="font-black text-sm sm:text-base">New York</p>
                <p class="text-xs text-gray-400 mt-1">Manhattan Lounge</p>
                <span class="inline-block mt-2 text-[10px] bg-white/10 text-gray-400 px-2 py-0.5 rounded-full">USA</span>
            </div>
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-monument"></i></div>
                <p class="font-black text-sm sm:text-base">London</p>
                <p class="text-xs text-gray-400 mt-1">Mayfair · Knightsbridge</p>
                <span class="inline-block mt-2 text-[10px] bg-white/10 text-gray-400 px-2 py-0.5 rounded-full">UK</span>
            </div>
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-wine-glass"></i></div>
                <p class="font-black text-sm sm:text-base">Paris</p>
                <p class="text-xs text-gray-400 mt-1">Champs-Élysées</p>
                <span class="inline-block mt-2 text-[10px] bg-white/10 text-gray-400 px-2 py-0.5 rounded-full">FR</span>
            </div>
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-crown"></i></div>
                <p class="font-black text-sm sm:text-base">Monaco</p>
                <p class="text-xs text-gray-400 mt-1">Monte Carlo Circuit</p>
                <span class="inline-block mt-2 text-[10px] bg-white/10 text-gray-400 px-2 py-0.5 rounded-full">MC</span>
            </div>
            <div class="location-card p-4 sm:p-5 locCard">
                <div class="text-red-500 text-2xl mb-2"><i class="fa-solid fa-map-location-dot"></i></div>
                <p class="font-black text-sm sm:text-base">+42 More</p>
                <p class="text-xs text-gray-400 mt-1">Across 6 continents</p>
                <span class="inline-block mt-2 text-[10px] bg-red-600/20 text-red-400 px-2 py-0.5 rounded-full">Global</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== MARQUEE ===== -->
<section class="py-10 sm:py-14 overflow-hidden bg-[#070707]">
    <div class="marquee-container">
        <div class="scroll-left text-4xl sm:text-6xl font-black italic text-red-600/20">
            <span>CONTACT</span><span class="text-white/20">✦</span><span>BOOK NOW</span><span class="text-white/20">✦</span><span>CALL US</span><span class="text-white/20">✦</span><span>24/7 SUPPORT</span><span class="text-white/20">✦</span><span>CONTACT</span><span class="text-white/20">✦</span><span>BOOK NOW</span><span class="text-white/20">✦</span><span>CALL US</span><span class="text-white/20">✦</span><span>24/7 SUPPORT</span><span class="text-white/20">✦</span>
        </div>
    </div>
</section>

<!-- ===== FAQ ===== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 bg-black">
    <div class="container mx-auto max-w-3xl">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-400 text-xs sm:text-sm tracking-[0.4em]">QUICK ANSWERS</span>
            <h2 class="text-4xl sm:text-5xl font-black italic mt-3">FAQ <span class="text-red-500">CENTRE</span></h2>
            <p class="text-gray-400 mt-4 text-sm sm:text-base">Common questions, answered by our team</p>
        </div>
        <div class="space-y-1 faqSection">

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">How do I book a vehicle with RENTALX?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">You can book directly through our website, call our 24/7 concierge line, or send us a WhatsApp message. Elite members get priority booking with a dedicated account manager.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">What is the minimum rental period?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">Our minimum rental period is 24 hours. For special events or experiences, we also offer half-day and hourly packages through our concierge service. Contact us for custom arrangements.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">Do you offer vehicle delivery to my location?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">Yes! We offer complimentary delivery and pickup for Elite members. Standard members can add this as a concierge service. We deliver to hotels, airports, private residences, and event venues.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">What insurance is included with my rental?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">All rentals include comprehensive third-party liability and collision damage waiver (CDW). Elite members receive full zero-excess insurance at no additional charge. Additional coverage options are available at checkout.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">Can I cancel or modify my booking?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">Absolutely. Free cancellation is available up to 48 hours before pickup. Modifications can be made up to 24 hours in advance. Elite members enjoy flexible same-day changes through their dedicated account manager.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span class="font-bold text-sm sm:text-base pr-4">What are the requirements to rent a vehicle?</span>
                    <i class="fa-solid fa-plus faq-arrow text-red-400 flex-shrink-0"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 text-sm leading-relaxed">You must be at least 25 years old with a valid driving license held for 2+ years. A credit card is required for the security deposit. International licenses are accepted with a valid passport. Some high-performance models may require additional verification.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* PAGE-SPECIFIC STYLES — Global nav/menu/sidebar handled by app.blade.php */

    /* HERO */
    .contact-hero {
        background: linear-gradient(135deg, rgba(0,0,0,0.97) 0%, rgba(0,0,0,0.75) 60%, rgba(239,68,68,0.07) 100%),
                    url('https://images.unsplash.com/photo-1544636331-e26879cd4d9b?q=80&w=2074&auto=format&fit=crop') no-repeat center center/cover;
        min-height: 55vh;
    }
    @media (max-width: 768px) {
        .contact-hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.97) 0%, rgba(0,0,0,0.85) 100%),
                        url('https://images.unsplash.com/photo-1544636331-e26879cd4d9b?q=80&w=2074&auto=format&fit=crop') no-repeat center center/cover;
        }
    }

    /* FORM */
    .form-input {
        width: 100%;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        color: white;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s;
    }
    .form-input::placeholder { color: rgba(255,255,255,0.3); }
    .form-input:focus { border-color: #ef4444; background: rgba(239,68,68,0.04); box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }
    .form-input:hover { border-color: rgba(255,255,255,0.15); }
    .form-input.border-red-500 { border-color: #ef4444; }

    .form-label { display: block; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.15em; color: rgba(255,255,255,0.5); margin-bottom: 0.5rem; text-transform: uppercase; }

    .form-select {
        width: 100%;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        color: white;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s;
        appearance: none;
        cursor: pointer;
    }
    .form-select option { background: #111; color: white; }
    .form-select:focus { border-color: #ef4444; background: rgba(239,68,68,0.04); box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }
    .form-select.border-red-500 { border-color: #ef4444; }

    /* CONTACT CARDS */
    .contact-info-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        transition: all 0.4s ease;
    }
    .contact-info-card:hover {
        border-color: #ef4444;
        transform: translateY(-6px);
        box-shadow: 0 25px 35px -15px rgba(239,68,68,0.2);
    }
    .contact-info-card:hover .card-icon { color: #ef4444; transform: scale(1.1); }
    .card-icon { transition: all 0.3s; }

    /* LOCATION CARD */
    .location-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 1.5rem;
        overflow: hidden;
        transition: all 0.4s;
    }
    .location-card:hover { border-color: #ef4444; transform: translateY(-5px); box-shadow: 0 20px 30px -10px rgba(239,68,68,0.2); }

    /* SOCIAL */
    .social-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 1rem;
        transition: all 0.3s;
        text-decoration: none;
        color: white;
    }
    .social-btn:hover { border-color: #ef4444; background: rgba(239,68,68,0.08); transform: translateX(5px); }

    /* FAQ */
    .faq-item { border-bottom: 1px solid rgba(255,255,255,0.06); }
    .faq-question { cursor: pointer; padding: 1.25rem 0; display: flex; justify-content: space-between; align-items: center; transition: color 0.3s; }
    .faq-question:hover { color: #ef4444; }
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.3s; }
    .faq-answer.open { max-height: 200px; padding-bottom: 1.25rem; }
    .faq-arrow { transition: transform 0.3s; flex-shrink: 0; }
    .faq-arrow.rotated { transform: rotate(45deg); color: #ef4444; }

    /* MARQUEE */
    .scroll-left { white-space: nowrap; animation: scrollRTL 30s linear infinite; display: inline-flex; gap: 2rem; }
    @keyframes scrollRTL { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .marquee-container { mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent); overflow: hidden; }

    /* SCROLL TOP */
    .scroll-top { position: fixed; bottom: 2rem; right: 2rem; width: 44px; height: 44px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 500; opacity: 0; transition: opacity 0.3s, transform 0.3s; transform: translateY(20px); }
    .scroll-top.show { opacity: 1; transform: translateY(0); }
    .scroll-top:hover { background: #dc2626; }

    /* SUCCESS MESSAGE */
    .success-msg { display: none; background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(0,0,0,0.5)); border: 1px solid rgba(34,197,94,0.3); border-radius: 1rem; padding: 1.5rem; text-align: center; }
    .success-msg.show { display: block; animation: fadeIn 0.5s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* MAP PLACEHOLDER */
    .map-placeholder {
        background: linear-gradient(135deg, rgba(239,68,68,0.05), rgba(0,0,0,0.8));
        border: 1px solid rgba(239,68,68,0.15);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .map-placeholder::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(239,68,68,0.08) 0%, transparent 70%);
    }

    /* PULSE DOT */
    .pulse-dot { width: 12px; height: 12px; background: #ef4444; border-radius: 50%; position: relative; display: inline-block; }
    .pulse-dot::before { content: ''; position: absolute; inset: -6px; border: 2px solid rgba(239,68,68,0.4); border-radius: 50%; animation: pulseDot 1.5s ease-in-out infinite; }
    @keyframes pulseDot { 0%,100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.4); opacity: 0.4; } }

    /* SWEET ALERT CUSTOM */
    .swal2-popup { background: #111 !important; border: 1px solid #ef4444 !important; border-radius: 2rem !important; color: white !important; }
    .swal2-title { color: white !important; }
    .swal2-content { color: #aaa !important; }
    .swal2-confirm { background: #ef4444 !important; border-radius: 9999px !important; padding: 0.75rem 2rem !important; font-weight: bold !important; }
    .swal2-confirm:hover { background: #dc2626 !important; }

    .container { width: 100%; max-width: 1280px; margin: 0 auto; }
</style>

<!-- Sweet Alert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
(function() {
    if (typeof gsap !== 'undefined') {
        if (typeof ScrollTrigger !== 'undefined') gsap.registerPlugin(ScrollTrigger);
    }

    // NOTE: Mobile menu, hamburger, overlay all handled globally by app.blade.php

    // VEHICLE PICKER
    window.selectVehicle = function(btn, vehicle) {
        document.querySelectorAll('.vehicle-btn').forEach(b => {
            b.classList.remove('bg-red-600', 'border-red-500', 'text-white');
            b.classList.add('border-white/10');
        });
        btn.classList.add('bg-red-600', 'border-red-500', 'text-white');
        btn.classList.remove('border-white/10');
        document.getElementById('selectedVehicle').value = vehicle;
    };

    // FAQ TOGGLE
    window.toggleFaq = function(el) {
        const answer = el.nextElementSibling;
        const arrow = el.querySelector('.faq-arrow');
        const isOpen = answer.classList.contains('open');
        document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
        document.querySelectorAll('.faq-arrow').forEach(a => a.classList.remove('rotated'));
        if (!isOpen) { answer.classList.add('open'); arrow.classList.add('rotated'); }
    };

    // CHECK FOR SUCCESS MESSAGE FROM SESSION
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Message Sent!',
            text: '{{ session('success') }}',
            background: '#111',
            color: 'white',
            confirmButtonColor: '#ef4444',
            iconColor: '#22c55e',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            background: '#111',
            color: 'white',
            confirmButtonColor: '#ef4444'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            background: '#111',
            color: 'white',
            confirmButtonColor: '#ef4444'
        });
    @endif

    // ANIMATIONS
    window.addEventListener('load', () => {
        gsap.from('.heroContent', { x: -60, opacity: 0, duration: 1.2, delay: 0.2, clearProps: 'all' });

        const sets = [
            ['.infoCard', { y: 40, opacity: 0, stagger: 0.12, duration: 0.8 }],
            ['.formSection', { x: -50, opacity: 0, duration: 1 }],
            ['.rightSection', { x: 50, opacity: 0, duration: 1 }],
            ['.locCard', { y: 40, opacity: 0, stagger: 0.1, duration: 0.7 }],
            ['.faqSection', { y: 30, opacity: 0, duration: 0.8 }]
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