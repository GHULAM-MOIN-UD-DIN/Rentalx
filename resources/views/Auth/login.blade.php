<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RentalX Premium</title>

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

        /* Video Background - Same as Signup */
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

        /* Inputs */
        .custom-input {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.15) !important;
            color: #fff !important;
            padding: 12px 16px !important;
            border-radius: 12px !important;
            width: 100%;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            border-color: var(--rental-red) !important;
            box-shadow: 0 0 15px rgba(230, 57, 70, 0.3) !important;
            outline: none;
        }

        .custom-input::placeholder {
            color: rgba(255,255,255,0.5);
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

        .btn-outline-rental {
            background: transparent;
            border: 2px solid var(--rental-red);
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: 0.3s;
        }

        .btn-outline-rental:hover {
            background: var(--rental-red);
            box-shadow: 0 0 20px rgba(230, 57, 70, 0.3);
        }

        .btn-outline-social {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .btn-outline-social:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.2);
            color: white;
            transform: translateY(-2px);
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

        @media(max-width:991px){
            .hero-section { text-align: center; }
            .brand-logo-container { justify-content: center; }
            .stats-container { justify-content: center; display: flex !important; margin-top: 20px; }
        }
    </style>
</head>
<body>

    <!-- Video Background - Same as Signup -->
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
                    <p class="lead text-white-50 mb-4" style="font-size: 1.25rem; max-width: 90%;">
                        Welcome back to the world's most exclusive car rental experience. Access premium vehicles with just one click.
                    </p>
                    
                    <div class="stats-container d-none d-lg-flex gap-4">
                        <div class="stat-item"><h4>50K+</h4><small>Happy Members</small></div>
                        <div class="stat-item"><h4>200+</h4><small>Luxury Cars</small></div>
                        <div class="stat-item"><h4>24/7</h4><small>Concierge</small></div>
                    </div>
                </div>

                <!-- Right Content - Login Form -->
                <div class="col-lg-5 animate__animated animate__fadeInRight">
                    <div class="glass-card">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Welcome Back</h3>
                            <p class="text-white-50">Login to your RentalX account</p>
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

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label-custom">
                                    <i class="far fa-envelope me-2" style="color: var(--rental-red);"></i>Email Address
                                </label>
                                <input type="email" name="email" class="custom-input" placeholder="your@email.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">
                                    <i class="fas fa-lock me-2" style="color: var(--rental-red);"></i>Password
                                </label>
                                <input type="password" name="password" class="custom-input" placeholder="••••••••" required>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="border-color: var(--rental-red);">
                                    <label class="form-check-label text-white-50 small" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <a href="{{ route('forgot.form') }}" class="custom-link small">
                                    Forgot Password?
                                </a>
                            </div>

                            <button type="submit" class="btn-rental">
                                <i class="fas fa-sign-in-alt me-2"></i> Sign In
                            </button>
                        </form>

                            <div class="divider"></div>

                            <!-- Social Login Buttons -->
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <a href="{{ route('social.login', 'google') }}" class="btn-outline-social w-100 d-flex align-items-center justify-content-center gap-2">
                                        <img src="https://www.google.com/favicon.ico" width="16" alt="Google"> Google
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('social.login', 'facebook') }}" class="btn-outline-social w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="fab fa-facebook-f text-primary"></i> Facebook
                                    </a>
                                </div>
                            </div>

                        <!-- Sign Up Link -->
                        <div class="text-center">
                            <p class="text-white-50 small mb-0">Don't have an account?</p>
                            <a href="{{ route('signup.form') }}" class="custom-link fw-bold">
                                Create Account <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>