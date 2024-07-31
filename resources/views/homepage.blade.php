<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat/assets/') }}" data-template="front-pages">

<head>
    <title>Homepage</title>
    <!-- Page CSS -->
    @include('layouts.style')
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page-landing.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/auth.css') }}" />
    <script src="{{ asset('sneat/assets/js/front-config.js') }}"></script>
</head>
<body>


{{-- Nav Start --}}
@extends('layouts.nav')

@section('menu')
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
      <a class="nav-link fw-medium" aria-current="page" href="#landingHero">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingFeatures">Tentang</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingPricing">Jadwal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingTeam">Bus</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingFAQ">Pertanyaan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingContact">Kontak</a>
    </li>
  </ul>
   <!-- Toolbar: Start -->
   <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- navbar button: Start -->
    <li>
      <a href="" class="btn btn-primary" 
    type="button"
    data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasEnd"
    aria-controls="offcanvasEnd"
      
      ><span class="tf-icons bx bx-user me-md-1"></span><span class="d-none d-md-block">Login</span></a>
    </li>
    <!-- navbar button: End -->
  </ul>
  <!-- Toolbar: End -->
@endsection
{{-- Nav End --}}


{{-- Login --}}
@extends('login')
{{-- Login End --}}

<!-- Sections:Start -->
<div data-bs-spy="scroll" class="scrollspy-example">
  <!-- Hero: Start -->
  <section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('sneat/assets/img/sima/hero-bg.png')}}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class=" text-center">
          <h1 class="text-primary hero-title display-4 fw-bold">Sewa Bus Pariwisata<br> Nyaman, Aman, Berkesan </h1>
          {{-- <br class="d-none d-lg-block" /> --}}
          <h2 class="hero-sub-title h6 mb-4 pb-1">
            ✧ Bus pariwisata terpercaya & terjangkau <br>Sima Perkasya siap menemani perjalananmu ✧
          </h2>
          <div class="landing-hero-btn d-inline-block position-relative">
            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Lihat Jadwal
              <img src="{{ asset('sneat/assets/img/sima/Join-community-arrow.png') }}" alt="tanda panah" class="scaleX-n1-rtl" /></span>
            <a href="#landingPricing" class="btn btn-primary">Jadwal tersedia</a>
          </div>
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
          <a href="../vertical-menu-template/app-ecommerce-dashboard.html" target="_blank">
            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero dashboard" class="animation-img" />
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" />
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="landing-hero-blank"></div>
  </section>
  <!-- Hero: End -->

  <!-- Tentang -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Tentang</span>
      </div>
      <h3 class="text-center mb-1">Visi Misi Perusahaan</h3>
      <p class="text-center mb-3 mb-md-5 pb-3">
        Informasi mengenai visi misi Sima Perkasya 
      </p>
      <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
          </div>
          <h5 class="mb-3">Quality Code</h5>
          <p class="features-icon-description">
            Code structure that all developers will easily understand and fall in love with.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/rocket.png')}}" alt="transition up" />
          </div>
          <h5 class="mb-3">Continuous Updates</h5>
          <p class="features-icon-description">
            Free updates for the next 12 months, including new demos and features.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/paper.png')}}" alt="edit" />
          </div>
          <h5 class="mb-3">Stater-Kit</h5>
          <p class="features-icon-description">
            Start your project quickly without having to remove unnecessary features.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/check') }}" alt="3d select solid" />
          </div>
          <h5 class="mb-3">API Ready</h5>
          <p class="features-icon-description">
            Just change the endpoint and see your own data loaded within seconds.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/user') }}" alt="lifebelt" />
          </div>
          <h5 class="mb-3">Excellent Support</h5>
          <p class="features-icon-description">An easy-to-follow doc with lots of references and code examples.</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/keyboard') }}" alt="google docs" />
          </div>
          <h5 class="mb-3">Well Documented</h5>
          <p class="features-icon-description">An easy-to-follow doc with lots of references and code examples.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful features: End -->

  <!-- Unit Bus: Start -->
  <section id="landingTeam" class="section-py landing-team">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Bus</span>
      </div>
      <h3 class="text-center mb-1">Jenis bus </h3>
      <p class="text-center mb-md-5 pb-3">Pilih bus kebutuhan perjalananmu 🚎</p>
      <div class="row gy-5 mt-2">
        
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-info position-relative team-image-box">
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
            </div>
            <div class="card-body border border-top-0 border-label-info text-center">
              <h5 class="card-title mb-0">Micro Bus</h5>
              <p class="text-muted mb-0">17 Seat</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-danger position-relative team-image-box">
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
            </div>
            <div class="card-body border border-top-0 border-label-danger text-center">
              <h5 class="card-title mb-0">Medium Bus</h5>
              <p class="text-muted mb-0">33 Seat</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-success position-relative team-image-box">
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
            </div>
            <div class="card-body border border-top-0 border-label-success text-center">
              <h5 class="card-title mb-0">Medium Bus SE</h5>
              <p class="text-muted mb-0">22 Seat</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-primary position-relative team-image-box">
              <img src="{{ asset('sneat/assets/img/sima/bus-hd.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
            </div>
            <div class="card-body border border-top-0 border-label-primary text-center">
              <h5 class="card-title mb-0">Big Bus</h5>
              <p class="text-muted mb-0">50 Seat</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Unit Bus: End -->

  <!-- Pricing plans: Start -->
  <section id="landingPricing" class="section-py bg-body landing-pricing">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Pricing Plans</span>
      </div>
      <h3 class="text-center mb-1">Tailored pricing plans designed for you</h3>
      <p class="text-center mb-4 pb-3">
        All plans include 40+ advanced tools and features to boost your product.<br />Choose the best plan to fit
        your needs.
      </p>
      <div class="text-center mb-5">
        <div class="position-relative d-inline-block pt-3 pt-md-0">
          <label class="switch switch-primary me-0">
            <span class="switch-label">Pay Monthly</span>
            <input type="checkbox" class="switch-input price-duration-toggler" checked />
            <span class="switch-toggle-slider">
              <span class="switch-on"></span>
              <span class="switch-off"></span>
            </span>
            <span class="switch-label">Pay Annual</span>
          </label>
          <div class="pricing-plans-item position-absolute d-flex">
            <img src="{{ asset('sneat/assets/img/front-pages/icons/pricing-plans-arrow.png') }}"" alt="pricing plans arrow" class="scaleX-n1-rtl" />
            <span class="fw-medium mt-2 ms-1"> Save 25%</span>
          </div>
        </div>
      </div>
      <div class="row gy-4 pt-lg-3">
        <!-- Basic Plan: Start -->
        <div class="col-xl-4 col-lg-6">
          <div class="card">
            <div class="card-header">
              <div class="text-center">
                <img src="{{ asset('sneat/assets/img/front-pages/icons/paper-airplane.png') }}"" alt="paper airplane icon" class="mb-4 pb-2 scaleX-n1-rtl" />
                <h4 class="mb-1">Basic</h4>
                <div class="d-flex align-items-center justify-content-center">
                  <span class="price-monthly h1 text-primary fw-bold mb-0">$19</span>
                  <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$14</span>
                  <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                </div>
                <div class="position-relative pt-2">
                  <div class="price-yearly text-muted price-yearly-toggle d-none">$ 168 / year</div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Timeline
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Basic search
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Live chat widget
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Email marketing
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Custom Forms
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Traffic analytics
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Basic Support
                  </h5>
                </li>
              </ul>
              <div class="d-grid mt-4 pt-3">
                <a href="payment-page.html" class="btn btn-label-primary">Get Started</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Basic Plan: End -->

        <!-- Favourite Plan: Start -->
        <div class="col-xl-4 col-lg-6">
          <div class="card border border-primary shadow-lg">
            <div class="card-header">
              <div class="text-center">
                <img src="{{ asset('sneat/assets/img/front-pages/icons/plane.png') }}"" alt="plane icon" class="mb-4 pb-2 scaleX-n1-rtl" />
                <h4 class="mb-1">Team</h4>
                <div class="d-flex align-items-center justify-content-center">
                  <span class="price-monthly h1 text-primary fw-bold mb-0">$29</span>
                  <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$22</span>
                  <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                </div>
                <div class="position-relative pt-2">
                  <div class="price-yearly text-muted price-yearly-toggle d-none">$ 264 / year</div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Everything in basic
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Timeline with database
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Advanced search
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Marketing automation
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Advanced chatbot
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Campaign management
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Collaboration tools
                  </h5>
                </li>
              </ul>
              <div class="d-grid mt-4 pt-3">
                <a href="payment-page.html" class="btn btn-primary">Get Started</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Favourite Plan: End -->

        <!-- Standard Plan: Start -->
        <div class="col-xl-4 col-lg-6">
          <div class="card">
            <div class="card-header">
              <div class="text-center">
                <img src="{{ asset('sneat/assets/img/front-pages/icons/shuttle-rocket.png') }}"" alt="shuttle rocket icon" class="mb-4 pb-2 scaleX-n1-rtl" />
                <h4 class="mb-1">Enterprise</h4>
                <div class="d-flex align-items-center justify-content-center">
                  <span class="price-monthly h1 text-primary fw-bold mb-0">$49</span>
                  <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$37</span>
                  <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                </div>
                <div class="position-relative pt-2">
                  <div class="price-yearly text-muted price-yearly-toggle d-none">$ 444 / year</div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Everything in premium
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Timeline with database
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Fuzzy search
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    A/B testing sanbox
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Custom permissions
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Social media automation
                  </h5>
                </li>
                <li>
                  <h5>
                    <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i class="bx bx-check bx-xs"></i></span>
                    Sales automation tools
                  </h5>
                </li>
              </ul>
              <div class="d-grid mt-4 pt-3">
                <a href="payment-page.html" class="btn btn-label-primary">Get Started</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Standard Plan: End -->
      </div>
    </div>
  </section>
  <!-- Pricing plans: End -->

  <!-- Fun facts: Start -->
  <section id="landingFunFacts" class="section-py landing-fun-facts">
    <div class="container">
      <div class="row gy-3">
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-primary shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/front-pages/icons/laptop.png') }}"" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">7.1k+</h5>
              <p class="fw-medium mb-0">
                Support Tickets<br />
                Resolved
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-success shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/front-pages/icons/user-success.png') }}"" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">50k+</h5>
              <p class="fw-medium mb-0">
                Join creatives<br />
                community
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-info shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/front-pages/icons/diamond-info.png') }}"" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">4.8/5</h5>
              <p class="fw-medium mb-0">
                Highly Rated<br />
                Products
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-warning shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/front-pages/icons/check-warning.png') }}"" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">100%</h5>
              <p class="fw-medium mb-0">
                Money Back<br />
                Guarantee
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Fun facts: End -->

  <!-- FAQ: Start -->
  <section id="landingFAQ" class="section-py bg-body landing-faq">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Pertanyaan Populer</span>
      </div>
      <h3 class="text-center mb-1">Pertanyaan yang sering ditemui</h3>
      <p class="text-center mb-5 pb-3">Jelajahi pertanyaan ini untuk menemukan jawaban atas hal yang igin diketahui.
      </p>
      <div class="row gy-5">
        <div class="col-lg-5">
          <div class="text-center">
            <img src="{{ asset('sneat/assets/img/sima/faq.png') }}"" alt="faq boy with logos" class="faq-image" />
          </div>
        </div>
        <div class="col-lg-7">
          <div class="accordion" id="accordionExample">
            <div class="card accordion-item active">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                  Bagaimana cara melakukan sewa bus pariwisata sima perkasya?
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                  marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                  soufflé. Wafer gummi bears marshmallow pastry pie.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                  Bagaimana cara melakukan pembayaran?
                </button>
              </h2>
              <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                  dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies. Jelly
                  beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                 Minimal berapa hari untuk melakukan booking bus?
                </button>
              </h2>
              <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Regular license can be used for end products that do not charge users for access or service(access
                  is free and there will be no monthly subscription fee). Single regular license can be used for
                  single end product and end product can be used by you or your client. If you want to sell end
                  product to multiple clients then you will need to purchase separate license for each client. The
                  same rule applies if you want to use the same end product on multiple domains(unique setup). For
                  more info on regular license you can check official description.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                  Apakah pembayaran dapat dilakukan secara berkala?
                </button>
              </h2>
              <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid quaerat possimus maxime!
                  Mollitia reprehenderit neque repellat delenibx delectus architecto dolorum maxime, blanditiis
                  earum ea, incidunt quam possimus cumque.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                  Sejauh mana saja bus pariwisata ini beroperasi?
                </button>
              </h2>
              <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias exercitationem ab cum
                  nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia ipsam quasi
                  labore enim architecto non!
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- FAQ: End -->

  <!-- Contact Us: Start -->
  <section id="landingContact" class="section-py bg-body landing-contact">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Kontak</span>
      </div>
      <h3 class="text-center mb-1">Hubungi kami jika ada pertanyaan</h3>
      <p class="text-center mb-4 mb-lg-5 pb-md-3">Dapat melalui email ataupun WhatsApp</p>
      <div class="row gy-4">
        <div class="col-lg-5">
          <div class="contact-img-box position-relative border p-2 h-100">
            <img src="{{ asset('sneat/assets/img/sima/contact-border.png') }}" alt="contact border" class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
            <img src="{{ asset('sneat/assets/img/sima/contact-customer-service.jpg') }}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
            <div class="pt-3 px-4 pb-1">
              <div class="row gy-3 gx-md-4">
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-primary rounded p-2 me-2"><i class="bx bx-envelope bx-sm"></i></div>
                    <div>
                      <p class="mb-0">Email</p>
                      <h5 class="mb-0">
                        <a href="mailto:example@gmail.com" class="text-heading">example@gmail.com</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-success rounded p-2 me-2">
                    <a href="https://wa.me/6281237888789" ><i class="bx bxl-whatsapp bx-sm"></i></a>  
                    </div>
                    <div>
                      <p class="mb-0"><a href="https://wa.me/6281237888789">WhatsApp</a></p>
                      <h5 class="mb-0"><a href="https://wa.me/6281237888789" class="text-heading">081237888789</a></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-1">Kirim Pesan</h4>
              <p class="mb-4"> Jika Anda ingin mendiskusikan apa pun yang berkaitan dengan pembayaran, pemesanan atau memiliki pertanyaan .
              </p>
              <form>
                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-fullname">Nama</label>
                    <input type="text" class="form-control" id="contact-form-fullname" placeholder="john" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-email">Email</label>
                    <input type="text" id="contact-form-email" class="form-control" placeholder="johndoe@gmail.com" />
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="contact-form-message">Pesan</label>
                    <textarea id="contact-form-message" class="form-control" rows="9" placeholder="Write a message"></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us: End -->
</div>
<!-- / Sections:End -->

{{-- <Footer> --}}
@include('layouts.footer')
{{-- <script> --}}
@include('layouts.script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
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

