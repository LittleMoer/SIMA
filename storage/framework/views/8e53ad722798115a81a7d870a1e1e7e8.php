<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default" data-assets-path="<?php echo e(asset('sneat/assets/')); ?>" data-template="front-pages">

<head>
    <title>Homepage</title>
    <!-- Page CSS -->
    <?php echo $__env->make('layouts.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('sneat/assets/vendor/css/pages/front-page.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('sneat/assets/vendor/css/pages/front-page-landing.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('sneat/assets/vendor/css/pages/auth.css')); ?>" />
    <script src="<?php echo e(asset('sneat/assets/js/front-config.js')); ?>"></script>
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





<?php $__env->startSection('menu'); ?>
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
      <a class="nav-link fw-medium" aria-current="page" href="#landing">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#landingFeatures">Tentang</a>
    </li>
    
    <li class="nav-item dropdown">
      <a class="nav-link fw-medium dropdown-toggle" href="#landingBus" id="busDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Bus
      </a>
      <ul class="dropdown-menu" aria-labelledby="busDropdown">
        <li><a class="dropdown-item" href="<?php echo e(url('/bus/micro_bus')); ?>">Micro Bus</a></li>
        <li><a class="dropdown-item" href="<?php echo e(url('/bus/medium_bus')); ?>"> Medium Bus</a></li>
        <li><a class="dropdown-item" href="<?php echo e(url('/bus/mediumSE_bus')); ?>">Medium Bus SE</a></li>
        <li><a class="dropdown-item" href="<?php echo e(url('/bus/big_bus')); ?>"> Big Bus</a></li>
      </ul>
    </li>
    
  
    
    
    <li class="nav-item">
      <a class="nav-link fw-medium" href="#Kontak">Kontak</a>
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
<?php $__env->stopSection(); ?>







<!-- Sections:Start -->
<div data-bs-spy="scroll" class="scrollspy-example">
  <!-- Hero: Start -->
  <section id="hero-animation">
    <div id="landing" class="section-py landing-hero position-relative">
      <img src="<?php echo e(asset('sneat/assets/img/sima/hero-bg.png')); ?>" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class=" text-center">
          <h1 class="text-primary hero-title display-4 fw-bold">Sima Perkasya<br> Dolanmu Mberkahi </h1>
          
          <h2 class="hero-sub-title h6 mb-4 pb-1">Starting will do anything
          </h2>
          
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
              <img src="<?php echo e(asset('sneat/assets/img/sima/bus-hd.png')); ?>" alt="hero dashboard" class="animation-img" />
              <img src="<?php echo e(asset('sneat/assets/img/sima/bus-hd.png')); ?>" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" />
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
             -->
          
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
          <a href="<?php echo e(url('/bus/micro_bus')); ?>" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-info position-relative team-image-box">
                <img src="<?php echo e(asset('sneat/assets/img/sima/microbus.png')); ?>" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-info text-center">
                <h5 class="card-title mb-0">Micro Bus</h5>
                <p class="text-muted mb-0">17 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="<?php echo e(url('/bus/medium_bus')); ?>" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-danger position-relative team-image-box">
                <img src="<?php echo e(asset('sneat/assets/img/sima/mediumbus.png')); ?>" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-danger text-center">
                <h5 class="card-title mb-0">Medium Bus</h5>
                <p class="text-muted mb-0">33 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="<?php echo e(url('/bus/mediumSE_bus')); ?>" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-success position-relative team-image-box">
                <img src="<?php echo e(asset('sneat/assets/img/sima/SE.png')); ?>" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
              </div>
              <div class="card-body border border-top-0 border-label-success text-center">
                <h5 class="card-title mb-0">Medium Bus SE</h5>
                <p class="text-muted mb-0">22 Seat</p>
              </div>
            </div>
          </a>
        </div>
      
        <div class="col-lg-3 col-sm-6">
          <a href="<?php echo e(url('/bus/big_bus')); ?>" class="text-decoration-none">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-primary position-relative team-image-box">
                <img src="<?php echo e(asset('sneat/assets/img/sima/big-bus.png')); ?>" alt="hero dashboard" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" />
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
  
  <!-- Jadwal: End -->

  <!-- Fun facts: Start -->
  
  <!-- Fun facts: End -->

  <!-- FAQ: Start -->
  
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
            <img src="<?php echo e(asset('sneat/assets/img/sima/contact-border.png')); ?>" alt="contact border" class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
            <img src="<?php echo e(asset('sneat/assets/img/sima/contact-customer-service.jpg')); ?>" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
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
              <input type="hidden" id="fileUrl" data-url="<?php echo e(asset('sneat/assets/img/sima/logo.png')); ?>">
              <p class="mb-4"> Kirimkan pesanmu terhadap kami.
              </p>
              
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


<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    const phoneNumber = "6281237888789"; // Ganti dengan nomor WhatsApp tujuan

    // // Buat pesan yang akan dikirim
    const text = `Halo, saya ${name}.%0A${message}`;

    // // Redirect ke WhatsApp
    const url = `https://wa.me/${phoneNumber}?text=${text}`;
    window.open(url, "_blank");

    
  }
</script>

</body>

</html>

<?php echo $__env->make('login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Windows 10 Pro\Documents\work\simapush\SIMA\resources\views/homepage.blade.php ENDPATH**/ ?>