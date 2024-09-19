<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> Forgot-Password | Softech MicroFinance</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('assets/images/logos/logo1.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('auth/css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('auth/css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('auth/css/responsive.css')}}">
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
                        <div class="me-2">
								<a href="{{route('login')}}" class="btn btn-icon bg-light rounded-circle">
									<i class="ki-duotone ki-black-left fs-2 text-gray-800"></i>
								</a>
						</div>
                          <div class="sign-in-from">
                              <h1 class="mb-0">Forgot Password</h1>
                              <p class="text-dark">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                               @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                              <form class="mt-4"  action="{{ route('password.email') }}" method="POST">>
                                @csrf
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input name="email"  type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email">
                                  </div>

                                  <div class="d-inline-block w-100">
                                    <button type="submit" class="btn btn-primary float-right">Request Email Link</button>
                                    <a href="{{route('login')}}" class="btn btn-lg btn-light-primary fw-bold" data-kt-translate="password-reset-cancel">Cancel</a>
                                  </div>

                              </form>
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
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
   </body>
</html>
