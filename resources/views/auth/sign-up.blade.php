<!Doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Register - Softech_MicroFinance</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('assets/images/logos/logo1.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('auth/css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('auth/css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('auth/css/responsive.css')}}">

        <style>
            .feedback-message {
                display: none;
                font-size: 0.875em;
                margin-top: 0.25em;
            }

            .invalid-feedback {
                color: #dc3545;
            }

            .valid-feedback {
                color: #28a745;
            }

        </style>
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div id="container-inside">
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
          </div>
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center bg-primary rounded">
                    <div class="row m-0">
                      <div class="col-md-6 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                            <img src="{{asset('assets/images/logos/logo.png')}}" alt="SMF" width="200" height="150">
                            <div  style="overflow-y: scroll; height:450px; overflow-x:hidden;">
                                <h1 class="mb-0 mt-0 text-center text-pretty">Sign Up</h1>
                              <p class="text-center text-dark">Create an account to enjoy our services</p>
                              <form id="registerUser" class="mt-4"  action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control mb-0" id="first_name" placeholder="Your First Name" name="first_name">
                                        <div class="invalid-feedback first_name-error"></div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control mb-0" id="last_name" placeholder="Your Last Name" name="last_name">
                                        <div class="invalid-feedback last_name-error"></div>
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <label for="email">Email address</label>
                                      <input type="email" class="form-control mb-0" id="email" placeholder="Enter email" name="email">
                                      <div class="invalid-feedback email-error"></div>
                                  </div>
                                  <div class="form-group">
                                      <label for="password">Password</label>
                                      <input type="password" class="form-control mb-0" id="password" placeholder="Password" name="password">
                                      <div class="invalid-feedback password-error"></div>

                                  </div>
                                   <div class="form-group">
                                      <label for="confirmPassword">Confirm Password</label>
                                      <input type="password" class="form-control mb-0" id="confirmPassword" placeholder="Confirm Password" name="password_confirmation">
                                      <div class="invalid-feedback confirm-password-error"></div>
                                  </div>
                                  {{-- <div class="d-inline-block w-100">
                                      <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                      </div>
                                  </div> --}}
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-primary d-block w-100 mb-2">Sign Up</button>
                                      <span class="text-dark d-inline-block line-height-2">Already Have Account ? <a href="{{route('login')}}">Log In</a></span>
                                  </div>
                              </form>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6 text-center sign-in-page-image">
                          <div class="sign-in-detail text-white">
                              <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                  <div class="item">
                                      <img src="{{asset('banners/banner5.png')}}" class="img-fluid mb-4" alt="logo">
                                      <h4 class="mb-1 text-white">Manage your orders</h4>
                                      <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                  </div>
                                  <div class="item">
                                      <img src="{{asset('banners/banner1.png')}}" class="img-fluid mb-4" alt="logo">
                                      <h4 class="mb-1 text-white">Manage your orders</h4>
                                      <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                  </div>
                                  <div class="item">
                                      <img src="{{asset('banners/banner2.png')}}" class="img-fluid mb-4" alt="logo">
                                      <h4 class="mb-1 text-white">Manage your orders</h4>
                                      <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                  </div>
                              </div>
                          </div>
                      </div>


                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->

      <!-- Optional JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- jQuery then Popper.js, then Bootstrap JS -->
      <script src="{{asset('auth/js/jquery.min.js')}}"></script>
      <script src="{{asset('auth/js/popper.min.js')}}"></script>
      <script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
      <!-- Appear 'auth/avaScript -->
      <script src="{{asset('auth/js/jquery.appear.js')}}"></script>
      <!-- Countdowauth/n JavaScript -->
      <script src="{{asset('auth/js/countdown.min.js')}}"></script>
      <!-- Counteruauth/p JavaScript -->
      <script src="{{asset('auth/js/waypoints.min.js')}}"></script>
      <script src="{{asset('auth/js/jquery.counterup.min.js')}}"></script>
      <!-- Wow Javaauth/Script -->
      <script src="{{asset('auth/js/wow.min.js')}}"></script>
      <!-- lottie 'auth/avaScript -->
      <script src="{{asset('auth/js/lottie.js')}}"></script>
      <!-- Apexcharauth/ts JavaScript -->
      <script src="{{asset('auth/js/apexcharts.js')}}"></script>
      <!-- Slick Jaauth/vaScript -->
      <script src="{{asset('auth/js/slick.min.js')}}"></script>
      <!-- Select2 auth/JavaScript -->
      <script src="{{asset('auth/js/select2.min.js')}}"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="{{asset('auth/js/owl.carousel.min.js')}}"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{asset('auth/js/jquery.magnific-popup.min.js')}}"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{asset('auth/js/smooth-scrollbar.js')}}"></script>
      <!-- Style Customizer -->
      <script src="{{asset('auth/js/style-customizer.js')}}"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{asset('auth/js/chart-custom.js')}}"></script>
      <!-- Custom JavaScript -->
      <script src="{{asset('auth/js/custom.js')}}"></script>

        <script>
            $(document).ready(function() {
                function showError(field, message) {
                    $(field).text(message).show();
                }

                function hideError(field) {
                    $(field).hide();
                }

                $('input[name="email"]').on('input', function() {
                    var email = $(this).val();
                    $.ajax({
                        url: '{{ route("validate.email") }}',
                        method: 'POST',
                        data: {
                            email: email,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.exists) {
                                showError('.email-error', 'Email is already in use.');
                            } else {
                                hideError('.email-error');
                            }
                        }
                    });
                });

                $('input[name="password_confirmation"]').on('keyup', function() {
                    let password = $('input[name="password"]').val();
                    let confirmPassword = $(this).val();
                    let confirmationFeedback = $('#password-confirmation-feedback');

                    if (password !== confirmPassword) {
                        $(this).addClass('is-invalid');
                        confirmationFeedback.addClass('invalid-feedback').text('Passwords do not match').show();
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                        confirmationFeedback.removeClass('invalid-feedback').addClass('valid-feedback').text('Passwords match').show();
                    }
                });

                $('#registerUser').on('submit', function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        beforeSend: function() {
                            $('.indicator-label').hide();
                            $('.indicator-progress').show();
                        },
                        success: function(response) {
                            $('.indicator-label').show();
                            $('.indicator-progress').hide();
                            // Handle success response
                            Swal.fire({
                                title: 'Registration Successful',
                                text: 'Your account has been created successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(response) {
                            $('.indicator-label').show();
                            $('.indicator-progress').hide();

                            // if(response.status === 500 && response.message === 'Connection could not be established with host "sandbox.smtp.mailtrap.io:2525": stream_socket_client(): php_network_getaddresses: getaddrinfo for sandbox.smtp.mailtrap.io failed: nodename nor servname provided, or not known'){
                            //      Swal.fire({
                            //         title: 'info,
                            //         text: 'Account created successfully but verication email was not sent, endeavor to request for another email',
                            //         icon: 'info',
                            //         confirmButtonText: 'OK'
                            //     });
                            // }
                            if(response.status === 422 && response.message === 'The email has already been taken.'){
                                 Swal.fire({
                                    title: 'error',
                                    text: 'Email already in use',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                            // Check if the error is related to email verification
                            if(response.status === 403 || response.status === 302 && response.responseJSON.message === 'Your email address is not verified.') {
                                // Redirect to verification page
                                window.location.href = '{{ route('verification.notice') }}';
                            } else if(response.responseJSON.errors) {
                                // Show SweetAlert for other errors
                                $.each(response.responseJSON.errors, function(field, messages) {
                                    showError('.' + field + '-error', messages[0]);
                                });
                            } else {
                                // Show a general error message
                                Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

            });

        </script>
   </body>
</html>
