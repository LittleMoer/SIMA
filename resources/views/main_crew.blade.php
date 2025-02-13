<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat/assets/') }}" data-template="front-pages">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> Halaman Pemilik </title>
   <!-- Page CSS -->

   @include('layouts.style')
   <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page.css') }}" />
   <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/front-page-dashboard.css') }}" />
   <script src="{{ asset('sneat/assets/js/ui-modals.js') }}"></script>
    
</head>

<body>

<!-- Navbar: Start -->
<nav class="layout-navbar"   style="position: absolute; top: 0; left: 0; width: 100%; z-index: 1000;">
  <div class="container"> 
      <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 "> 
          <!-- Menu logo wrapper: Start --> 
          <div class="navbar-brand app-brand demo d-flex py-0 me-4">
              <!-- Mobile menu toggle: Start-->
              <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <i class="tf-icons bx bx-menu bx-sm align-middle"></i>
              </button>
              <!-- Mobile menu toggle: End-->
              <a href="landing-page.html" class="app-brand-link">
                  <span class="app-brand-logo demo">
                      <img src="{{ asset('sneat/assets/img/sima/mini_logo.png') }}"
                          class="d-inline-block align-top mr-2" style="max-width: 100%; height: auto;"
                          alt="logo" />
                  </span>
              </a>
          </div>
          <!-- Menu logo wrapper: End -->
          <!-- Menu wrapper: Start -->
          <div class="collapse navbar-collapse landing-nav-menu sticky-top" id="navbarSupportedContent">
              <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="tf-icons bx bx-x bx-sm"></i>
              </button>
              <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                      <a class="nav-link fw-medium" href="{{ url('/crew/dashboard') }}">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fw-medium" href="{{ url('/crew/pesanan') }}">Data Pesanan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fw-medium" href="{{ url('/crew/events') }}">Jadwal Crew</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fw-medium" href="{{ url('crew/calendar') }}">Jadwal Ketersediaan Unit</a>
                  </li>
              </ul>
              <!-- Menu wrapper: End -->
              <!-- Toolbar: Start -->
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <!-- navbar button: Start -->
                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                          class="btn btn-primary"> <span class="tf-icons bx bx-log-in-circle me-md-1"></span>
                          <span class="d-none d-md-block"> Logout</span></a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                          @csrf
                      </form>
                  </li>
                  <!-- navbar button: End -->
              </ul>
              <!-- Toolbar: End -->
          </div> 
      </div> 
  </div> 
</nav>


<!-- Sections dashboard:Start -->
@yield('dashboard_crew')
@yield('data_pesanan_crew')
@yield('detail_pesanan_crew')
@yield('bbm_crew')
@yield('pengeluaran_crew')
@yield('jadwal_crew')
@yield('crew_jadwalunit')
<!-- / Sections dashboard:End -->
<!-- Sections:Start -->



{{-- <Footer> --}}
  @include('layouts.footer')
{{-- <script> --}}
  @include('layouts.script')
  <script>
    // JavaScript untuk mendapatkan tanggal saat ini dan menampilkannya
    const dateElement = document.getElementById('current-date');
    const currentDate = new Date();
    
    // Opsi untuk format tanggal
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    
    // Mengatur tanggal di elemen HTML
    dateElement.innerHTML = currentDate.toLocaleDateString('id-ID', options);
  </script>

{{-- 
<script src="{{ asset('sneat/assets/vendor/js/tables-datatables-basic.js') }}"></script>
   --}}
</body>

</html>