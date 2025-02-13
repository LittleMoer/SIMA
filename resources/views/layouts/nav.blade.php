<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
      <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 ">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 me-4">
          <!-- Mobile menu toggle: Start-->
          <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="tf-icons bx bx-menu bx-sm align-middle"></i>
          </button>
          <!-- Mobile menu toggle: End-->
          <a href="landing-page.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset('sneat/assets/img/sima/mini_logo.png') }}" class="d-inline-block align-top mr-2" style="max-width: 100%; height: auto;" alt="logo" />
            </span>
            {{-- <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">Sima Perkasya</span> --}}
          </a>
        </div>
        <!-- Menu logo wrapper: End -->
  
        <!-- Menu wrapper: Start -->
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
          <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="tf-icons bx bx-x bx-sm"></i>
          </button>
          @yield('menu')
        </div>
        <!-- Menu wrapper: End -->
      </div>
    </div>
  </nav>