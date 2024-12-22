<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat/assets/') }}" data-template="front-pages">
  <head>
    <title>Big Bus</title>
    <!-- Page CSS --> @include('layouts.style')
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page-landing.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/auth.css') }}" />
    <script src="{{ asset('sneat/assets/js/front-config.js') }}"></script>
    <script>
      // JavaScript to handle scroll event
      window.addEventListener('scroll', function() {
        var navbar = document.getElementById('navbar');
        if (window.scrollY > 0) {
          navbar.classList.remove('transparent-nav');
          navbar.classList.add('solid-nav');
        } else {
          navbar.classList.remove('solid-nav');
          navbar.classList.add('transparent-nav');
        }
      });
    </script>
  </head>
  <body>
       {{-- Nav Start --}} 
       @extends('layouts.nav') @section('menu') <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link fw-medium" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="/#landingFeatures">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="/#landingJadwal">Jadwal</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link fw-medium dropdown-toggle" href="#landingBus" id="busDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Bus </a>
          <ul class="dropdown-menu" aria-labelledby="busDropdown">
            <li>
              <a class="dropdown-item" href="{{ url('/bus/micro_bus') }}">Micro Bus</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url('/bus/medium_bus') }}"> Medium Bus</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url('/bus/mediumSE_bus') }}">Medium Bus SE</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url('/bus/big_bus') }}"> Big Bus</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="#landingFAQ">Pertanyaan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-medium" href="#Kontak">Kontak</a>
        </li>
      </ul>
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- navbar button: Start -->
        <li>
          <a href="" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
            <span class="tf-icons bx bx-user me-md-1"></span>
            <span class="d-none d-md-block">Login</span>
          </a>
        </li>
        <!-- navbar button: End -->
      </ul>
    <!-- Toolbar: End --> @endsection {{-- Nav End --}}
    {{-- Login --}} @extends('login') {{-- Login End --}}
    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example mb-4" >
      <section id="landingBus" class="mb-0">
        <div id="landing" class="section-py landing-team position-relative" style="position: relative; z-index: 2; ">
          <div class="position-absolute top-0 start-0 w-100" style="background: linear-gradient(to right, #f1d9ed, #eff7f7); height: 50%; z-index: 1; border-radius: 0 0 50% 50%;); 
                background-repeat: no-repeat; background-position: bottom; background-size: cover;"></div>
          <div class="container d-flex justify-content-center position-relative" style="position: relative; z-index: 2; ">
            <img src="{{ asset('sneat/assets/img/sima/big-bus.png')}}" alt="hero dashboard" style="max-width: 66%; height: auto; margin-top:40px;" />
            
          </div>
          <div class=" text-center">
            <h1 class="text-primary hero-title display-4 fw-bold">Big Bus <br> Sima Perkasya</h1>
            {{-- <br class="d-none d-lg-block" /> --}}
            <h2 class="hero-sub-title h6 pb-1">Siap menemani perjalananmu
            </h2>
          </div>
        </div>
        <div class="container" style="margin-bottom: 40px" >
          <div class="text-center">
            <span class="badge bg-label-primary">Fasilitas dan Spesifikasi</span>
            <p class="text-center mb-1">Kenyamanan dalam perjalananmu</p>
          </div>
          <div class="row">
            <div class="col-lg-4 col-sm-6">
              <div class="card mt-3 mt-lg-0 shadow-none">
                <!-- Bootstrap carousel -->
                <div class="contact-img-box position-relative border p-2 h-100"  style="border-radius: 15px;">
                  <div class="col-md">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="5" aria-label="Slide 6"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="6" aria-label="Slide 7"></button>
                      </div>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/kursi.jpg')}}" alt="First slide"   style="border-radius: 10px;"/>
                        </div>
                       
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/dispen.jpg')}}"  style="border-radius: 10px;" alt="Third slide" />
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/coobox.jpg')}}"  style="border-radius: 10px;" alt="Fourthslide" />
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/AC.jpg')}}" alt="Second slide"  style="border-radius: 10px;"/>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/TV.jpg')}}"  style="border-radius: 10px;" alt="Fifth slide" />
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/keranjang.jpg')}}"  style="border-radius: 10px;" alt="Fifth slide" />
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('sneat/assets/img/sima/Bigbus/bagasi.jpg')}}"  style="border-radius: 10px;" alt="Fifth slide" />
                        </div>

                      </div>
                      <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="col-lg-8 col-sm-6">
              <div class="card mt-3 mt-lg-0 shadow-none">
                <div class="col-lg-12">
                  <h3 class=" fw-medium">Big Bus</h3>
                  <div class="mt-3">
                    <ul class="list-group">
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-bus me-3"></i> Unit tahun 2024 JB5
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-coin-stack me-3"></i> Sasis RM280 Air Suspension
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-handicap me-3"></i> Seat 50 + TL
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-box me-3"></i> Alldila seat (Seat 2-2, recleaning, safety belt, keranjang barang, cup holder)
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-wind me-3"></i> AC duckting
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-usb me-3"></i> Charger Usb tiap lower AC
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-coffee me-3"></i>Dispenser (include kopi, teh, gula)
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bxs-inbox me-3"></i> Coolbox depan belakang (include air mineral)
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class='bx bx-music me-3 '></i> Audio (karaoke, mic wireless, koneksi internet)
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bx-tv me-3"></i> TV 3 buah
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <i class="bx bxs-briefcase-alt me-3"></i> Bagasi space frame
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
         </div>
        </div>
        </section>
      
      
      
    </div>
    
      
      <!-- Unit Bus: End -->
      {{-- <Footer> --}} @include('layouts.footer') {{-- <script> --}} @include('layouts.script') <script>
        document.addEventListener('DOMContentLoaded', function() {
          const loginButton = document.getElementById('loginButton');
          const usernameInput = document.getElementById('username');
          const passwordInput = document.getElementById('password');

          function updateButtonState() {
            if (usernameInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
              loginButton.disabled = false;
              loginButton.classList.remove('btn-not-allowed');
            } else {
              loginButton.disabled = true;
              loginButton.classList.add('btn-not-allowed');
            }
          }
          usernameInput.addEventListener('input', updateButtonState);
          passwordInput.addEventListener('input', updateButtonState);
        });
      </script>
  </body>
</html>