<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Signin - Gravity It Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/styles.css') }}">



</head>

<body>


    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card " style="max-width:420px; width:100%;">
            <div class="card-body p-5">
                <div class="text-center mb-3">
                    <span class=" ms-2"> <img
                            src="https://www.gravityitsolutions.com/assets/images/gravity-it-solutions-logo.png"
                            alt="" class="img-fluid mb-3" width="180"></span>

                    <h1 class="card-title mb-5 h5">Sign in to your account</h1>

                </div>

                <form class="mt-3" action="{{ url('backend/login-post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" class="form-control"
                            placeholder="name@example.com" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label d-flex justify-content-between">
                            <span>Password</span>
                            <a href="{{ url('backend/forgot-password') }}" class="small link-primary">Forgot Password?</a>
                        </label>
                        <input id="password" name="password" type="password" class="form-control"
                            placeholder="Password" required minlength="6">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input id="remember" name="remember" class="form-check-input" type="checkbox">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        @error('remember')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Sign in</button>
                </form>

                {{-- <div class="text-center mt-3 small text-muted">
                    Don't have an account? <a href="signup.html" class="link-primary">Sign up</a>
                </div> --}}
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    {{-- <script src="./assets/js/main.js" type="module"></script> --}}


</body>

</html>
