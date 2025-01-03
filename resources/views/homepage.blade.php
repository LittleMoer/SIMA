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
<link rel="stylesheet" href="global.css?20231021">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.css">
<script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.js"></script>


    
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
@extends('layouts.nav')

@section('menu')
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
      <a class="nav-link fw-medium" aria-current="page" href="#landing">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingFeatures">Tentang</a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingJadwal">Jadwal</a>
    </li> --}}
    <li class="nav-item dropdown">
      <a class="nav-link fw-medium dropdown-toggle" href="#landingBus" id="busDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Bus
      </a>
      <ul class="dropdown-menu" aria-labelledby="busDropdown">
        <li><a class="dropdown-item" href="{{ url('/bus/micro_bus') }}">Micro Bus</a></li>
        <li><a class="dropdown-item" href="{{ url('/bus/medium_bus') }}"> Medium Bus</a></li>
        <li><a class="dropdown-item" href="{{ url('/bus/mediumSE_bus') }}">Medium Bus SE</a></li>
        <li><a class="dropdown-item" href="{{ url('/bus/big_bus') }}"> Big Bus</a></li>
      </ul>
    </li>
    
  
    
    {{-- <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingFAQ">Pertanyaan</a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#Kontak">Kontak</a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link fw-medium" href="#Kontak">Kontak</a>
    </li> --}}
    
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
    <div id="landing" class="section-py landing-hero position-relative">
      <img src="{{ asset('sneat/assets/img/sima/hero-bg.png')}}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class=" text-center">
          <h1 class="text-primary hero-title display-4 fw-bold">Sima Perkasya<br> Dolanmu Mberkahi </h1>
          {{-- <br class="d-none d-lg-block" /> --}}
          <h2 class="hero-sub-title h6 mb-4 pb-1">Starting will do anything
          </h2>
          {{-- <div class="landing-hero-btn d-inline-block position-relative">
            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Lihat Jadwal
              <img src="{{ asset('sneat/assets/img/sima/Join-community-arrow.png') }}" alt="tanda panah" class="scaleX-n1-rtl" /></span>
            <a href="#landingJadwal" class="btn btn-primary">Jadwal tersedia</a>
          </div> --}}
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
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
  <!-- <section id="landingFeatures" class="section-py landing-features">
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
            <p>Berisi visi misi ...... </p>
            {{-- <img src="{{ asset('sneat/assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
          </div> --}} -->
          {{-- <h5 class="mb-3">Quality Code</h5>
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
      </div> --}}
    </div>
  </section>
  <!-- Useful features: End -->

  <!-- Unit Bus: Start -->
  <section id="landingBus" class="section-py landing-team">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Bus</span>
      </div>
      <h3 class="text-center mb-1">Jenis bus </h3>
      <p class="text-center mb-md-5 pb-3">Kebutuhan perjalananmu 🚎</p>
      <div class="row gy-5 mt-2">
        <div class="col-lg-3 col-sm-6">
          <a href="{{ url('/bus/micro_bus') }}" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-info position-relative team-image-box">
                <img src="{{ asset('sneat/assets/img/sima/microbus.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-info text-center">
                <h5 class="card-title mb-0">Micro Bus</h5>
                <p class="text-muted mb-0">17 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="{{ url('/bus/medium_bus') }}" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-danger position-relative team-image-box">
                <img src="{{ asset('sneat/assets/img/sima/mediumbus.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-danger text-center">
                <h5 class="card-title mb-0">Medium Bus</h5>
                <p class="text-muted mb-0">33 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="{{ url('/bus/mediumSE_bus') }}" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-success position-relative team-image-box">
                <img src="{{ asset('sneat/assets/img/sima/SE.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-success text-center">
                <h5 class="card-title mb-0">Medium Bus SE</h5>
                <p class="text-muted mb-0">22 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="{{ url('/bus/big_bus') }}" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-primary position-relative team-image-box">
                <img src="{{ asset('sneat/assets/img/sima/big-bus.png')}}" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-primary text-center">
                <h5 class="card-title mb-0">Big Bus</h5>
                <p class="text-muted mb-0">50 Seat</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      
    </div>
  </section>
  <!-- Unit Bus: End -->

  <!-- Jadwal: Start -->
  {{-- <section id="landingJadwal" class="section-py bg-body landing-jadwal">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Jadwal Tersedia</span>
      </div>
      <h3 class="text-center mb-1">Lihat jadwal untuk mengetahui jadwal bis</h3>
      <p class="text-center mb-4 pb-3">
        Hijau berarti sedang digunakan<br >kuning masih dalam tahap DP(bisa batal kapan saja)<br>putih berarti jadwal kosong yang tersedia
      </p>
      <div class="row">
        <!-- Jadwal: Start -->
        <div class="card" style="display: flex;">
          <div id="calendar"></div>
      </div>
  
      <script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengambil data event dari API
            function createEvents() {
                return fetch('/api/events')
                    .then(response => response.json())
                    .catch(error => {
                        console.error('Error fetching events:', error);
                        return []; // Kembalikan array kosong jika terjadi kesalahan
                    });
            }
    
            // Inisialisasi kalender
            createEvents().then(events => {
                new EventCalendar(document.getElementById('calendar'), {
                    view: 'dayGridMonth', // Setel tampilan default ke tampilan bulan
                    headerToolbar: {
                        start: 'prev,next today',
                        center: 'title',
                        end: ''
                    },
                    editable: false, // Nonaktifkan kemampuan drag and drop
                    eventStartEditable: false, // Nonaktifkan drag pada start event
                    eventDurationEditable: false, // Nonaktifkan resize pada event
                    droppable: false, // Nonaktifkan kemampuan droppable
                    selectable: false, // Nonaktifkan kemampuan selectable
                    events: events, // Menggunakan event yang diambil dari API
                    dayMaxEvents: true, // Batasi jumlah event yang ditampilkan per hari
                    nowIndicator: true, // Tampilkan indikator hari ini
                    eventContent: function(info) {
                        return {
                            html: `<b>${info.event.title}</b>` // Tampilkan title di dalam event
                        };
                    }
                });
            });
        });
    </script>
    
        <!-- Jadwal: End -->
      </div>
    </div>
    
  </section> --}}
  <!-- Jadwal: End -->

  <!-- Fun facts: Start -->
  {{-- <section id="landingFunFacts" class="section-py landing-fun-facts">
        
  </section> --}}
  <!-- Fun facts: End -->

  <!-- FAQ: Start -->
  {{-- <section id="landingFAQ" class="section-py bg-body landing-faq">
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
  </section> --}}
  <!-- FAQ: End -->

  <!-- Contact Us: Start -->
  <section id="Kontak" class="section-py bg-body landing-contact">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Kontak</span>
      </div>
      <h3 class="text-center mb-1">Hubungi kami jika ada pertanyaan</h3>
      <p class="text-center mb-4 mb-lg-5 pb-md-3">Ayo WhatsApp kami!</p>
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
                      <h6 class="mb-0">
                        <a href="mailto:jagadsimaperkasya22@gmail.com" class="text-heading">jagadsimaperkasya22@gmail.com</a>
                      </h6>
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
              <h4 class="mb-1">Kirim WhatsApp</h4>
              <input type="hidden" id="fileUrl" data-url="{{ asset('sneat/assets/img/sima/logo.png') }}">
              <p class="mb-4"> Kirimkan pesanmu terhadap kami.
              </p>
              {{-- <form>
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
              </form> --}}
              <form id="contact-form" onsubmit="sendToWhatsApp(event)">
                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-fullname">Nama</label>
                    <input type="text" class="form-control" id="contact-form-fullname" name="name" placeholder="Nama Anda" required />
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="contact-form-message">Pesan</label>
                    <textarea id="contact-form-message" class="form-control" name="message" rows="9" placeholder="Tuliskan pesan Anda" required></textarea>
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
<script>
  function sendToWhatsApp(event) {
    event.preventDefault(); // Mencegah form dari reload halaman

    // Ambil data dari form
    const name = document.getElementById("contact-form-fullname").value;
    const message = document.getElementById("contact-form-message").value;

    // Nomor WhatsApp tujuan (format internasional tanpa 0 di awal)
    const phoneNumber = "6283169251172"; // Ganti dengan nomor WhatsApp tujuan

    // // Buat pesan yang akan dikirim
    const text = `Halo, saya ${name}.%0A${message}`;

    // // Redirect ke WhatsApp
    const url = `https://wa.me/${phoneNumber}?text=${text}`;
    window.open(url, "_blank");

    
  }
</script>

</body>

</html>
