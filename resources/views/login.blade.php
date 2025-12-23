<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zomac Digital Central Student And Client Management System</title>
    @include('components.links')
    <style>
        :root {
            --brand-blue: #0057b8;
            --brand-blue-light: #e8f1fa;
            --brand-orange: #ff8500;
            --brand-orange-light: #fff7ee;
            --neutral-bg: #f6f8fa;
            --form-bg: #fff;
            --box-shadow: 0 4px 24px rgba(0, 46, 104, 0.08);
        }

        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(-45deg, var(--brand-blue), var(--brand-orange), var(--brand-blue-light), var(--brand-orange-light));
            background-size: 400% 400%;
            animation: gradient 14s ease infinite;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: rgba(0, 87, 184, 0.11);
            border-radius: 50%;
            animation: float 9s infinite;
        }

        .shape:nth-child(even) {
            background: rgba(255, 133, 0, 0.14);
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-32px) rotate(180deg);
            }

            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        body {
            background: var(--neutral-bg);
        }

        .card {
            backdrop-filter: blur(6px);
            background: var(--form-bg) !important;
            border-radius: 14px;
            border: 1.5px solid #e3eaf2;
            box-shadow: var(--box-shadow);
            transition: transform 0.26s cubic-bezier(.34, 1.56, .64, 1), box-shadow .2s;
        }

        .card:hover {
            transform: translateY(-4px) scale(1.013);
            box-shadow: 0 8px 32px rgba(0, 46, 104, 0.13);
        }

        .fw-brand {
            font-family: 'Segoe UI', 'Arial', sans-serif;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--brand-blue), var(--brand-orange));
            border: 0;
            color: #fff !important;
            font-weight: 600;
            transition: all 0.22s cubic-bezier(.42, .87, .58, 1.15);
            box-shadow: 0 2px 10px rgba(0, 87, 184, 0.08);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(45deg, var(--brand-orange), var(--brand-blue));
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 5px 16px rgba(255, 133, 0, 0.15);
            color: #fff !important;
        }

        .form-label {
            color: var(--brand-blue);
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--brand-orange);
            box-shadow: 0 0 0 0.2rem rgba(255, 133, 0, 0.08);
        }

        .login-header-title {
            background: linear-gradient(90deg, var(--brand-blue) 45%, var(--brand-orange) 60%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .forgot-link {
            color: var(--brand-blue);
            text-decoration: underline dotted;
            font-size: 0.98em;
            font-weight: 500;
            transition: color 0.16s;
        }

        .forgot-link:hover {
            color: var(--brand-orange);
        }

        @media (max-width: 575.98px) {
            .card-body {
                padding: 2rem 1rem !important;
            }
        }
    </style>
</head>

<body>
    <div class="animated-background"></div>
    <div class="floating-shapes" id="shapes"></div>

    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/logos/logo.png') }}" alt="Olimen Logo"
                                class="img-fluid mb-3" style="max-height: 64px;">
                            <h2 class="fw-brand login-header-title mb-1">
                                Welcome
                            </h2>
                            <p class="text-muted" style="font-size:1.03em;">Sign in to your account</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" name="remember" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox
                                    input</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="#" class="forgot-link">Forgot your password?</a>
                        </div>

                        <hr class="my-4">

                        {{-- <div class="text-center">
                            <p class="text-muted">Don't have an account?</p>
                            <a href="{{ url('register') }}" class="btn btn-outline-primary"
                                style="border-color: var(--brand-blue); color: var(--brand-blue);">Register new account</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.scripts')

    <script>
        // Create floating shapes
        function createShapes() {
            const shapesContainer = document.getElementById('shapes');
            const numberOfShapes = 12;

            for (let i = 0; i < numberOfShapes; i++) {
                const shape = document.createElement('div');
                shape.className = 'shape';

                // Corporate: subtle variation in blue/orange size
                const size = Math.random() * 60 + 28;
                shape.style.width = `${size}px`;
                shape.style.height = `${size}px`;

                // Random position, keeping top/bottom moderate for professional look
                shape.style.left = `${Math.random() * 100}%`;
                shape.style.top = `${Math.random() * 80 + 10}%`;

                // Subtle animation delay
                shape.style.animationDelay = `${Math.random() * 3}s`;

                shapesContainer.appendChild(shape);
            }
        }

        // Initialize shapes when the page loads
        document.addEventListener('DOMContentLoaded', createShapes);
    </script>
</body>

</html>
