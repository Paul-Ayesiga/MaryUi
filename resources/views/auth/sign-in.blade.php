<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login - Softech_MicroFinance</title>
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

      	{{-- <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script> --}}
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
      {{-- <div id="loading">
        <div id="loading-center">
        </div>
      </div> --}}
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
                      <div class="col-md-5 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                              <img src="{{asset('assets/images/logos/logo.png')}}" alt="SMF" width="200" height="150">
                            <div  style="overflow-y: hidden; height:450px; overflow-x:hidden;">
                              <h1 class="mb-0 text-center">Sign in</h1>
                              <p class="text-center text-dark">Enter your email address and password to access admin panel.</p>
                              <form class="mt-4" id="loginUser">
                                @csrf
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email" name="email">
                                      <div class="invalid-feedback email-error"></div>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Password</label>
                                        @if (Route::has('password.request'))
										    <a href="{{route('password.request')}}" class="float-right">Forgot Password ?</a>
                                        @endif

                                       <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" name="password" >
                                       <div class="invalid-feedback password-error"></div>
                                  </div>
                                  <div class="d-inline-block w-100">
                                      <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1" name="remember">{{ __('Remember me') }}</label>
                                      </div>
                                  </div>
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-primary d-block w-100 mb-2">Sign in</button>
                                      <span class="text-dark dark-color d-inline-block line-height-2">Don't have an account? <a href="{{route('register')}}">Sign up</a></span>
                                  </div>
                              </form>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6 text-center sign-in-page-image">
                          <div class="sign-in-detail text-white">
                              <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                  <div class="item" style="width: 100%">
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                function showError(field, message) {
                    $(field).text(message).show();
                }

                function hideError(field) {
                    $(field).hide();
                }
                // Check for flash message from password reset
                @if (session('status') === 'PasswordResetSuccessful')
                    Swal.fire({
                        title: 'Password Reset Successful',
                        text: 'Your password has been reset successfully. You can now log in with your new password.',
                        icon: 'success',
                        confirmButtonText: 'Login'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Optionally, redirect to the login form if needed
                        }
                    });
                @endif

                    $('#loginUser').on('submit', function(e) {
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

                            if (response.success) {
                                window.location.href = response.redirect;
                            } else {
                                 Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Couldn\'t redirect to the dashboard, reload the page',
                                    icon: 'info',
                                    confirmButtonText: 'OK'
                                });
                            }

                        },
                        error: function(response) {
                            $('.indicator-label').show();
                            $('.indicator-progress').hide();


                            if(response.responseJSON.errors) {
                                // Show SweetAlert for other errors
                                $.each(response.responseJSON.errors, function(field, messages) {
                                    showError('.' + field + '-error', messages[0]);
                                });
                            }
                                Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Login failed, Try again',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            // }
                        }
                    });
                });
            });
        </script>
   </body>
</html>
