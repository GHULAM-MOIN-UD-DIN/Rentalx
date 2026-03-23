<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | RentalX Premium</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --rental-red: #E63946; 
            --rental-black: #121212;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            color: #fff;
        }

        /* Video Background - Same as other pages */
        .video-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.35) contrast(1.2);
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, transparent 20%, rgba(0,0,0,0.6));
        }

        /* Layout */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 15px;
            position: relative;
        }

        /* RentalX Branding */
        .brand-text {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
        }

        .brand-x {
            color: var(--rental-red);
        }

        /* RentalX Diamond Logo Style */
        .logo-box {
            width: 50px;
            height: 50px;
            background: var(--rental-red);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(230, 57, 70, 0.4);
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 25px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        /* OTP Input - Special styling */
        .otp-input {
            background: rgba(255,255,255,0.05) !important;
            border: 2px solid rgba(255,255,255,0.15) !important;
            color: #fff !important;
            padding: 18px 16px !important;
            border-radius: 16px !important;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 10px;
            width: 100%;
            transition: all 0.3s ease;
            font-family: 'Orbitron', monospace;
        }

        .otp-input:focus {
            border-color: var(--rental-red) !important;
            box-shadow: 0 0 25px rgba(230, 57, 70, 0.4) !important;
            outline: none;
            background: rgba(255,255,255,0.1) !important;
        }

        .otp-input::placeholder {
            color: rgba(255,255,255,0.3);
            letter-spacing: 2px;
            font-size: 24px;
        }

        .form-label-custom {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: block;
            color: rgba(255,255,255,0.8);
        }

        /* RentalX Button */
        .btn-rental {
            background: var(--rental-red);
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: bold;
            font-family: 'Orbitron', sans-serif;
            color: white;
            width: 100%;
            transition: 0.3s;
            text-transform: uppercase;
            margin-top: 15px;
        }

        .btn-rental:hover {
            transform: scale(1.03);
            box-shadow: 0 0 25px rgba(230, 57, 70, 0.5);
            background: #ff4d5a;
        }

        /* Stats */
        .stat-item h4 {
            color: var(--rental-red);
            font-weight: bold;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
        }

        .stat-item small {
            color: rgba(255,255,255,0.6);
        }

        /* Alerts */
        .alert-custom {
            background: rgba(230, 57, 70, 0.2);
            border: 1px solid var(--rental-red);
            color: white;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .alert-success-custom {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: white;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        /* Links */
        .custom-link {
            color: var(--rental-red);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .custom-link:hover {
            color: #ff4d5a;
            text-shadow: 0 0 10px rgba(230, 57, 70, 0.5);
        }

        .divider {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 20px 0;
        }

        /* Timer */
        .timer-text {
            color: var(--rental-red);
            font-weight: bold;
            font-family: 'Orbitron', monospace;
        }

        /* OTP Info */
        .otp-info {
            background: rgba(230, 57, 70, 0.1);
            border-radius: 50px;
            padding: 10px 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
            border: 1px solid rgba(230, 57, 70, 0.3);
            margin-bottom: 15px;
        }

        /* Email Display */
        .email-display {
            background: rgba(255,255,255,0.03);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .email-display i {
            color: var(--rental-red);
        }

        @media(max-width:991px){
            .hero-section { text-align: center; }
            .brand-logo-container { justify-content: center; }
            .stats-container { justify-content: center; display: flex !important; margin-top: 20px; }
            .otp-input { font-size: 24px; letter-spacing: 5px; }
        }
    </style>
</head>
<body>

    <!-- Video Background - Same as other pages -->
    <div class="video-wrapper">
        <video autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('vedios/cars.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left Content - Branding -->
                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    <div class="brand-logo-container d-flex align-items-center gap-3 mb-3">
                        <div class="logo-box">
                            <i class="fas fa-gem fs-4 text-white"></i>
                        </div>
                        <h1 class="brand-text m-0">RENTAL<span class="brand-x">X</span></h1>
                    </div>
                    
                    <!-- Security Badge -->
                    <div class="otp-info mb-3">
                        <i class="fas fa-shield-check" style="color: var(--rental-red);"></i>
                        <span>Two-Factor Authentication Enabled</span>
                    </div>
                    
                    <p class="lead text-white-50 mb-4" style="font-size: 1.25rem; max-width: 90%;">
                        For your security, we've sent a 6-digit verification code to your email. 
                        Enter it below to verify your identity.
                    </p>
                    
                    <div class="stats-container d-none d-lg-flex gap-4">
                        <div class="stat-item"><h4>6-Digit</h4><small>Secure OTP</small></div>
                        <div class="stat-item"><h4>5 Min</h4><small>Validity</small></div>
                        <div class="stat-item"><h4>100%</h4><small>Encrypted</small></div>
                    </div>
                </div>

                <!-- Right Content - OTP Form -->
                <div class="col-lg-5 animate__animated animate__fadeInRight">
                    <div class="glass-card">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-shield-alt fs-1" style="color: var(--rental-red); opacity: 0.8;"></i>
                            </div>
                            <h3 class="fw-bold">Verify OTP</h3>
                            
                            <!-- Email Display (you can pass this from session) -->
                            @if(session('reset_user'))
                                @php $user = App\Models\User::find(session('reset_user')); @endphp
                                @if($user)
                                    <div class="email-display mt-2">
                                        <i class="fas fa-envelope me-2"></i>
                                        {{ substr($user->email, 0, 3) }}****{{ substr($user->email, strpos($user->email, '@')) }}
                                    </div>
                                @endif
                            @endif
                            
                            <p class="text-white-50 small mt-2">Enter the 6-digit code sent to your email</p>
                        </div>

                        <!-- Error Message -->
                        @if(session('error'))
                            <div class="alert-custom">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert-success-custom">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        @if($errors->any())
                            <div class="alert-custom">
                                @foreach($errors->all() as $error)
                                    <div><i class="fas fa-times me-2"></i> {{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('otp.verify') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label-custom text-center w-100">
                                    <i class="fas fa-key me-2" style="color: var(--rental-red);"></i>
                                    Verification Code
                                </label>
                                <input type="text" 
                                       name="otp" 
                                       class="otp-input @error('otp') is-invalid @enderror" 
                                       placeholder="• • • • • •" 
                                       maxlength="6" 
                                       pattern="[0-9]{6}"
                                       inputmode="numeric"
                                       autocomplete="one-time-code"
                                       autofocus
                                       required>
                                @error('otp')
                                    <div class="text-danger mt-2 small" style="color: var(--rental-red) !important;">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Timer (optional JavaScript countdown) -->
                            <div class="text-center mb-3">
                                <small class="text-white-50">
                                    <i class="far fa-clock me-1"></i>
                                    Code expires in <span class="timer-text" id="timer">5:00</span>
                                </small>
                            </div>

                            <button type="submit" class="btn-rental">
                                <i class="fas fa-check-circle me-2"></i> Verify & Continue
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="divider"></div>

                        <!-- Resend & Back Options -->
                        <div class="text-center">
                            <p class="text-white-50 small mb-2">Didn't receive the code?</p>
                            
                            <!-- Resend OTP (you'll need to add this route) -->
                            <form method="POST" action="{{ route('forgot.send') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('reset_user') ? App\Models\User::find(session('reset_user'))->email ?? '' : '' }}">
                                <button type="submit" class="custom-link bg-transparent border-0">
                                    <i class="fas fa-redo-alt me-2"></i> Resend OTP
                                </button>
                            </form>
                            
                            <div class="mt-3">
                                <a href="{{ route('forgot.form') }}" class="text-white-50 small text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i> Use different email
                                </a>
                            </div>
                            
                            <div class="mt-2">
                                <a href="{{ route('login.form') }}" class="text-white-50 small text-decoration-none">
                                    <i class="fas fa-sign-in-alt me-1"></i> Back to Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Countdown Timer Script -->
    <script>
        // Auto-submit when 6 digits are entered
        document.querySelector('.otp-input').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) {
                // Optional: auto-submit form
                // document.querySelector('form').submit();
            }
        });

        // Simple countdown timer (5 minutes)
        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            const interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = "Expired";
                    display.style.color = "#E63946";
                }
            }, 1000);
        }

        // Start timer on page load
        window.onload = function () {
            const fiveMinutes = 60 * 5;
            const display = document.querySelector('#timer');
            if (display) startTimer(fiveMinutes, display);
        };
    </script>
</body>
</html>