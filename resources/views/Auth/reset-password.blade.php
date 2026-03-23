<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | RentalX Premium</title>

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

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 15px;
            position: relative;
        }

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

        .custom-input.is-invalid {
            border-color: var(--rental-red) !important;
        }

        .form-label-custom {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: block;
            color: rgba(255,255,255,0.8);
        }

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

        .stat-item h4 {
            color: var(--rental-red);
            font-weight: bold;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
        }

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

        /* Email Display */
        .email-display {
            background: rgba(255,255,255,0.03);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 15px;
        }

        .email-display i {
            color: var(--rental-red);
        }

        @media(max-width:991px){
            .hero-section { text-align: center; }
            .brand-logo-container { justify-content: center; }
            .stats-container { justify-content: center; display: flex !important; margin-top: 20px; }
        }
    </style>
</head>
<body>

    <div class="video-wrapper">
        <video autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('vedios/cars.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    <div class="brand-logo-container d-flex align-items-center gap-3 mb-3">
                        <div class="logo-box">
                            <i class="fas fa-gem fs-4 text-white"></i>
                        </div>
                        <h1 class="brand-text m-0">RENTAL<span class="brand-x">X</span></h1>
                    </div>
                    
                    <span class="badge bg-danger bg-opacity-25 text-white border border-danger px-3 py-2 rounded-pill mb-3">
                        <i class="fas fa-shield-check me-2" style="color: var(--rental-red);"></i>
                        Final Step: Set New Password
                    </span>
                    
                    <p class="lead text-white-50 mb-4" style="font-size: 1.25rem; max-width: 90%;">
                        Your OTP has been verified. Now create a strong password for your account.
                    </p>
                    
                    <div class="stats-container d-none d-lg-flex gap-4">
                        <div class="stat-item"><h4>OTP</h4><small>Verified ✓</small></div>
                        <div class="stat-item"><h4>Secure</h4><small>Encryption</small></div>
                        <div class="stat-item"><h4>Update</h4><small>Password</small></div>
                    </div>
                </div>

                <div class="col-lg-5 animate__animated animate__fadeInRight">
                    <div class="glass-card">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-user-lock fs-1" style="color: var(--rental-red); opacity: 0.8;"></i>
                            </div>
                            <h3 class="fw-bold">Set New Password</h3>
                            
                            <!-- Show email if available in session -->
                            @if(session('reset_user'))
                                @php $resetUser = App\Models\User::find(session('reset_user')); @endphp
                                @if($resetUser)
                                    <div class="email-display">
                                        <i class="fas fa-envelope me-2"></i>
                                        {{ substr($resetUser->email, 0, 3) }}****{{ substr($resetUser->email, strpos($resetUser->email, '@')) }}
                                    </div>
                                @endif
                            @endif
                            
                            <p class="text-white-50 small">Create a new password for your account</p>
                        </div>

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert-success-custom">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if(session('error'))
                            <div class="alert-custom">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
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

                        <!-- Check if reset_user exists in session -->
                        @if(!session('reset_user'))
                            <div class="alert-custom">
                                <i class="fas fa-exclamation-triangle me-2"></i> 
                                Session expired. Please start the password reset process again.
                            </div>
                            <div class="text-center">
                                <a href="{{ route('forgot.form') }}" class="btn-rental" style="text-decoration: none;">
                                    <i class="fas fa-redo-alt me-2"></i> Start Over
                                </a>
                            </div>
                        @else
                            <form method="POST" action="{{ route('reset.password') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label-custom">
                                        <i class="fas fa-lock me-2" style="color: var(--rental-red);"></i>
                                        New Password
                                    </label>
                                    <input type="password" 
                                           name="password" 
                                           class="custom-input @error('password') is-invalid @enderror" 
                                           placeholder="Enter new password" 
                                           minlength="6"
                                           required>
                                    @error('password')
                                        <div class="text-danger mt-2 small" style="color: var(--rental-red) !important;">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="text-white-50 mt-1 d-block">
                                        <i class="fas fa-info-circle me-1" style="color: var(--rental-red);"></i>
                                        Minimum 6 characters
                                    </small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label-custom">
                                        <i class="fas fa-check-double me-2" style="color: var(--rental-red);"></i>
                                        Confirm Password
                                    </label>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           class="custom-input" 
                                           placeholder="Confirm new password" 
                                           minlength="6"
                                           required>
                                </div>

                                <button type="submit" class="btn-rental">
                                    <i class="fas fa-sync-alt me-2"></i> Update Password
                                </button>
                            </form>
                        @endif

                        <div class="divider"></div>

                        <div class="text-center">
                            <a href="{{ route('login.form') }}" class="text-white-50 small text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i> Return to Login
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Simple password match validation -->
    <script>
        const password = document.querySelector('input[name="password"]');
        const confirm = document.querySelector('input[name="password_confirmation"]');
        
        if (password && confirm) {
            confirm.addEventListener('input', function() {
                if (this.value.length > 0) {
                    if (password.value === this.value) {
                        this.style.borderColor = '#28a745';
                    } else {
                        this.style.borderColor = '#E63946';
                    }
                } else {
                    this.style.borderColor = '';
                }
            });
        }
    </script>
</body>
</html>