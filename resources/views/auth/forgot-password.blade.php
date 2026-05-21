<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Forgot Password Backend</title>
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


                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow-sm">
                            <div class="card-body" id="forgot-password-box">

                                <div id="step-email">
                                    <h5 class="mb-3">Reset Password</h5>
                                    <p class="text-muted small">Enter your email to receive a 6-digit OTP.</p>
                                    <div class="mb-3">
                                        <input type="email" id="email_input" class="form-control"
                                            placeholder="Email address">
                                    </div>
                                    <button class="btn btn-primary w-100" onclick="sendOtp()">Send OTP</button>
                                </div>

                                <div id="step-otp" class="d-none">
                                    <h5 class="mb-3">Verify OTP</h5>
                                    <p class="text-muted small">Enter the 6-digit code sent to your email.</p>
                                    <div class="mb-3">
                                        <input type="text" id="otp_input" class="form-control text-center"
                                            maxlength="6" placeholder="000000">
                                    </div>
                                    <button class="btn btn-primary w-100" onclick="verifyOtp()">Verify Code</button>
                                </div>

                                <div id="step-reset" class="d-none">
                                    <h5 class="mb-3">Create New Password</h5>
                                    <div class="mb-3">
                                        <input type="password" id="new_password" class="form-control"
                                            placeholder="New Password">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" id="confirm_password" class="form-control"
                                            placeholder="Confirm Password">
                                    </div>
                                    <button class="btn btn-success w-100" onclick="resetPassword()">Update
                                        Password</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function sendOtp() {
            const email = document.getElementById('email_input').value;

            fetch('{{ url("backend/forgot-password/send-otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(res => res.ok ? toggleStep('step-otp') : alert('Email not found.'));
        }

        function verifyOtp() {
            const otp = document.getElementById('otp_input').value;

            fetch('{{url("backend/forgot-password/verify-otp")}}/', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        otp: otp
                    })
                })
                .then(res => res.ok ? toggleStep('step-reset') : alert('Invalid OTP.'));
        }

        function resetPassword() {
            const password = document.getElementById('new_password').value;
            const password_confirmation = document.getElementById('confirm_password').value;

            fetch('{{url("backend/forgot-password/reset")}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        password: password,
                        password_confirmation: password_confirmation
                    })
                })
                .then(res => {
                    if (res.ok) {
                        alert('Password changed! Please login.');
                        window.location.href = '/login';
                    } else {
                        alert('Passwords do not match or error occurred.');
                    }
                });
        }

        function toggleStep(nextStepId) {
            document.getElementById('step-email').classList.add('d-none');
            document.getElementById('step-otp').classList.add('d-none');
            document.getElementById('step-reset').classList.add('d-none');
            document.getElementById(nextStepId).classList.remove('d-none');
        }
    </script>


</body>

</html>
