<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Forgot Password - EdTech</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <!-- Your logo SVG here -->
                                </span>
                                <span class="app-brand-text text-body fw-bolder">EdTech</span>
                            </a>
                        </div>

                        <!-- Email Step -->
                        @if(!session()->has('step2') && !session()->has('step3'))
                        <div id="emailStep" >
                            <h4 class="mb-2">Forgot Password? 🔒</h4>
                            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                            <div id="errorAlert" class="alert alert-danger" style="display: none;"></div>
                            <div id="successAlert" class="alert alert-success" style="display: none;"></div>

                            <form class="mb-3" id="emailForm" action="{{route('send_otp')}}">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="Enter your email" required autofocus />
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                                <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
                            </form>
                        </div>
                        @endif

                        <!-- OTP Step -->
                        @if(!session()->has('step1') && !session()->has('step3'))
                        <div id="otpStep" >
                            <h4 class="mb-2">Enter OTP 🔒</h4>
                            <p class="mb-4">We've sent a verification code to your email</p>

                            <form class="mb-3" id="otpForm">
                                <div class="mb-3">
                                    <label for="otp" class="form-label">OTP Code</label>
                                    <input type="text" class="form-control" id="otp" name="otp" 
                                           placeholder="Enter OTP" required />
                                    <span class="text-danger" id="otpError"></span>
                                </div>
                                <button type="submit" class="btn btn-primary d-grid w-100">Verify OTP</button>
                            </form>
                        </div>
                        
                        @endif
                        <!-- Reset Password Step -->
                        @if(!session()->has('step1') && !session()->has('step2'))
                        <div id="resetStep" >
                            <h4 class="mb-2">Reset Password 🔒</h4>
                            <p class="mb-4">Set your new password</p>

                            <form class="mb-3" id="resetForm">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Enter new password" required />
                                    <span class="text-danger" id="passwordError"></span>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation" placeholder="Confirm new password" required />
                                </div>

                                <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
                            </form>
                        </div>
                        @endif
                        <p class="text-center">
                            <a href="/login">
                                <span>Back to login</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>

    {{-- <script>
        // Store email for use across steps
        let userEmail = '';
        let token = '';

        // Show step function
        function showStep(step) {
            document.getElementById('emailStep').style.display = 'none';
            document.getElementById('otpStep').style.display = 'none';
            document.getElementById('resetStep').style.display = 'none';

            document.getElementById(step + 'Step').style.display = 'block';
        }

        // Show alert function
        function showAlert(type, message) {
            const alertElement = document.getElementById(type + 'Alert');
            alertElement.textContent = message;
            alertElement.style.display = 'block';
            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 5000);
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Start with email step
            showStep('email');

            // Email form submission
            document.getElementById('emailForm').addEventListener('submit', async function(e) {
                // e.preventDefault();
                const email = document.getElementById('email').value;
                
                // try {
                //     const response = await fetch('{{route('send_otp')}}', {
                //         method: 'POST',
                //         headers: {
                //             'Content-Type': 'application/json',
                //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                //         },
                //         body: JSON.stringify({ email })
                //     });

                //     const data = await response.json();
                //     console.log(data);
                //     if (response.ok) {
                //         userEmail = email;
                //         showAlert('success', 'OTP sent to your email');
                //         showStep('otp');
                //     } else {
                //         showAlert('error', data.message || 'Error sending OTP');
                //     }
                // } catch (error) {
                //     showAlert('error', 'Something went wrong. Please try again.');
                // }
            });

            // OTP form submission
            document.getElementById('otpForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const otp = document.getElementById('otp').value;
                
                try {
                    const response = await fetch('/verify-otp', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ 
                            email: userEmail,
                            otp: otp 
                        })
                    });

                    const data = await response.json();
                    
                    if (response.ok) {
                        token = data.token;
                        showStep('reset');
                    } else {
                        showAlert('error', data.message || 'Invalid OTP');
                    }
                } catch (error) {
                    showAlert('error', 'Something went wrong. Please try again.');
                }
            });

            // Reset password form submission
            document.getElementById('resetForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const password = document.getElementById('password').value;
                const password_confirmation = document.getElementById('password_confirmation').value;
                
                try {
                    const response = await fetch('/password/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            email: userEmail,
                            token: token,
                            password,
                            password_confirmation
                        })
                    });

                    const data = await response.json();
                    
                    if (response.ok) {
                        showAlert('success', 'Password reset successfully');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                    } else {
                        showAlert('error', data.message || 'Error resetting password');
                    }
                } catch (error) {
                    showAlert('error', 'Something went wrong. Please try again.');
                }
            });
        });
    </script> --}}
</body>
</html>