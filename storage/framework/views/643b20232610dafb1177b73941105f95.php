<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default"
    data-assets-path="<?php echo e(asset('sneat/assets/')); ?>" data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> Sima Perkasya </title>
    <!-- Page CSS -->
    <?php echo $__env->make('layouts.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet"
        href="<?php echo e(asset('sneat/assets/vendor/css/pages/front-page.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(asset('sneat/assets/vendor/css/pages/front-page-dashboard.css')); ?>" />

</head>

<body >

    <!-- Navbar: Start -->
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
                        <img src="<?php echo e(asset('sneat/assets/img/sima/mini_logo.png')); ?>"
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
                        <a class="nav-link fw-medium" href="<?php echo e(url('/admin/dashboard')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(url('/pesanan')); ?>">Data Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(url('/calendar/monthly')); ?>">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(url('/manajemen_akun')); ?>">Manajemen Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(url('/manajemen_armada')); ?>">Manajemen Crew</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="<?php echo e(url('/unit')); ?>">Unit Kendaraan</a>
                    </li>
                </ul>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- navbar button: Start -->
                    <li>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-primary"> <span class="tf-icons bx bx-log-in-circle me-md-1"></span>
                            <span class="d-none d-md-block"> Logout</span></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                            style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div> 
        </div> 
    </div> 
</nav>



    <?php echo $__env->yieldContent('dashboard'); ?>

    <?php echo $__env->yieldContent('data_pesanan'); ?>

    <?php echo $__env->yieldContent('detail_pesanan'); ?>

    <?php echo $__env->yieldContent('manajemen_akun'); ?>

    <?php echo $__env->yieldContent('tambah_akun'); ?>

    <?php echo $__env->yieldContent('rekap_gaji_crew'); ?>

    <?php echo $__env->yieldContent('manajemen_armada'); ?>

    <?php echo $__env->yieldContent('bbm'); ?>
    <?php echo $__env->yieldContent('unit_avail'); ?>
    <?php echo $__env->yieldContent('unit_events'); ?>

    <?php echo $__env->yieldContent('pengeluaran'); ?>
    <?php echo $__env->yieldContent('unit'); ?>


    
    <?php echo $__env->make('layouts.hubungi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <script>
          $(document).ready(function () {
              $('#myTable').DataTable();
          });
  
      </script>
    
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        // JavaScript untuk mendapatkan tanggal saat ini dan menampilkannya
        const dateElement = document.getElementById('current-date');
        const currentDate = new Date();

        // Opsi untuk format tanggal
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        // Mengatur tanggal di elemen HTML
        dateElement.innerHTML = currentDate.toLocaleDateString('id-ID', options);

    </script>
    
</body>

</html>
<?php /**PATH C:\Users\Windows 10 Pro\Documents\work\New folder\SIMA\resources\views/main_owner.blade.php ENDPATH**/ ?>