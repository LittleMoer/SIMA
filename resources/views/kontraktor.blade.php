<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
    <title> Ar Rayyan Property</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/arrayyan.png') }}" />
    
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('template/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('template/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('template/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/lib/lightbox/js/lightbox.min.js') }}"></script>
    
    <!-- Template Javascript -->
    <script src="{{ asset('template/js/main.js') }}"></script>
    <!-- Favicon -->
    <link href="{{ asset('img/arrayyan.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Open+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('template/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <style>
        .kontraktor {
            background-image: url('img/header20.png');
            background-size: cover; /* Make sure it covers the whole section */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent tiling */
            padding: 50px 0; /* Add padding for spacing */
            /* add blur backgroun except the text */
            background-color: rgba(255, 255, 255, 0.5); /* Fallback for browsers that don't support backdrop-filter */
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
        }   
        .range-container {
            position: relative;
            height: 40px;
            padding-top: 16px;
            /* Add padding to center the sliders */
        }

        .range-container input[type="range"] {
            position: absolute;
            width: 100%;
            pointer-events: none;
            -webkit-appearance: none;
            appearance: none;
            background: none;
            top: 0;
            z-index: 1;
        }

        /* Make the second range slider visible on top */
        .range-container input[type="range"]:nth-child(2) {
            z-index: 2;
        }

        .img-fixed {
            width: 250px;
            height: 150px;
            object-fit: cover;
        }

        /* Thumb styles */
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            height: 20px;
            width: 20px;
            background-color: #003580;
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
            margin-top: -6px;
            /* Adjust to align with track */
            position: relative;
            z-index: 3;
            pointer-events: auto;
        }

        /* Track styles */
        input[type="range"]::-webkit-slider-runnable-track {
            height: 8px;
            background: #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Firefox specific styles */
        input[type="range"]::-moz-range-thumb {
            height: 20px;
            width: 20px;
            background-color: #003580;
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
            z-index: 3;
            pointer-events: auto;
        }

        input[type="range"]::-moz-range-track {
            height: 8px;
            background: #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Active track color */
        .range-container input[type="range"]:nth-child(1)::-webkit-slider-runnable-track {
            background: linear-gradient(to right, #ccc 0%, #003580 100%);
        }

        .range-container input[type="range"]:nth-child(2)::-webkit-slider-runnable-track {
            background: linear-gradient(to right, #003580 0%, #ccc 100%);
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img class="w-auto" style="max-width: 40%;" src="{{ asset('img/arrayyan.png') }}" alt="Image">
        </a>
        <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="/about" class="nav-item nav-link">About</a>
                <a href="/list" class="nav-item nav-link">Property</a>
                <a href="/kontraktor" class="nav-item nav-link">Kontraktor</a>
                <a href="/" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- section brand kontraktor -->
    <div class=" kontraktor" style="position: relative; overflow: hidden;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center" style="color: white; position: relative; z-index: 2;">
                    Jasa Kontraktor 
                </h1>
                <br>
                <h4 class="text-center" style="color: white; position: relative; z-index: 2;">
                    (Bangun Dan Renovasi Rumah)
                </h4>
                <br>
                <div class="text-center" style="color: white; position: relative; z-index: 2;">
                    Jasa Kontraktor Rumah, Ruko, Kos-kosan, dan Bangunan Lainnya. Profesional & Tanpa Biaya Tersembunyi.
                </div>
                <br>
                <div class="text-center" style="position: relative; z-index: 2;">
                    <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#consultationModal">Mulai Konsultasi</button>
                </div>
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px); z-index: 1;"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="container mt-5">
        <h3 class="mt-3 text-center" style=" position: relative; z-index: 2;">Kenapa memilih Kontraktor Ar Rayyan Kontraktor ?</h3>
        </div>
        <br>
        <div class="container mt-4">
        <div class="d-flex justify-content-around flex-wrap mt-4">
            <div class="d-flex flex-column align-items-center p-3 shadow rounded m-2" style="flex: 1 1 200px; max-width: 250px;">
            <i class="fa fa-users fa-3x mb-3" style="color: #003580;"></i>
            <p class="text-center">Profesional dan Berpengalaman</p>
            </div>
            <div class="d-flex flex-column align-items-center p-3 shadow rounded m-2" style="flex: 1 1 200px; max-width: 250px;">
            <i class="fa fa-handshake fa-3x mb-3" style="color: #003580;"></i>
            <p class="text-center">Transparan dan Terpercaya</p>
            </div>
            <div class="d-flex flex-column align-items-center p-3 shadow rounded m-2" style="flex: 1 1 200px; max-width: 250px;">
            <i class="fa fa-clock fa-3x mb-3" style="color: #003580;"></i>
            <p class="text-center">Tepat Waktu dan Efisien</p>
            </div>
            <div class="d-flex flex-column align-items-center p-3 shadow rounded m-2" style="flex: 1 1 200px; max-width: 250px;">
            <i class="fa fa-thumbs-up fa-3x mb-3" style="color: #003580;"></i>
            <p class="text-center">Kualitas Terbaik</p>
            </div>
        </div>
    </div>
    <div style="background-color: #003580; padding: 50px; margin-top: 50px;">
        <div class="container">
            <h3 class="text-center" style="color: white;">Pencapaian Ar Rayyan Kontraktor</h3>
            <br>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h4 style="color: white;">1. Pencapaian</h4>
                    <p style="color: white;">lorep ipsum</p>
                </div>
                <div class="col-md-4">
                    <h4 style="color: white;">2. Pencapaian</h4>
                    <p style="color: white;">lorep ipsum</p>
                </div>
                <div class="col-md-4">
                    <h4 style="color: white;">3. Pencapaian</h4>
                    <p style="color: white;">lorep ipsum</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container mt-4">
            <h3 class="mt-3 text-center" style="position: relative; z-index: 2;">Testimoni</h3>
            <div class="row mt-4">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card shadow-sm w-100">
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">"Pelayanan yang sangat memuaskan. Hasil kerja sangat rapi dan sesuai dengan keinginan saya. Terima kasih Ar Rayyan Kontraktor!"</p>
                    <h5 class="card-title mt-3">- Budi, Jakarta</h5>
                </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card shadow-sm w-100">
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">"Proses pengerjaan cepat dan tepat waktu. Tim yang sangat profesional dan berpengalaman."</p>
                    <h5 class="card-title mt-3">- Siti, Bandung</h5>
                </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card shadow-sm w-100">
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">"Harga yang ditawarkan sangat kompetitif dengan kualitas yang sangat baik. Sangat direkomendasikan!"</p>
                    <h5 class="card-title mt-3">- Andi, Surabaya</h5>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <div class="container mt-4">
            <h3 class="mt-3 text-center" style="position: relative; z-index: 2;">Proses Layanan Kami</h3>
            <br>
            <div class="row mt-4 position-relative">
            <div class="col-md-3 text-center">
                <i class="fa fa-phone fa-3x mb-3" style="color: #003580;"></i>
                <h5>Konsultasi</h5>
                <!-- <br> -->
                <p>Hubungi kami untuk konsultasi awal mengenai kebutuhan dan keinginan Anda.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-pencil-alt fa-3x mb-3" style="color: #003580;"></i>
                <h5>Perencanaan</h5>
                <!-- <br> -->
                <p>Kami akan membantu Anda dalam merencanakan desain dan anggaran yang sesuai.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-tools fa-3x mb-3" style="color: #003580;"></i>
                <h5>Pelaksanaan</h5>
                <!-- <br> -->
                <p>Tim kami akan melaksanakan pembangunan sesuai dengan rencana yang telah disepakati.</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-check fa-3x mb-3" style="color: #003580;"></i>
                <h5>Serah Terima</h5>
                <!-- <br> -->
                <p>Setelah selesai, kami akan melakukan serah terima proyek kepada Anda dengan hasil yang memuaskan.</p>
            </div>
        </div>
    </div>
</body>
<!-- Modal -->
<!-- <div class="modal fade" id="consultationModal" tabindex="-1" aria-labelledby="consultationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultationModalLabel">Daftar / Konsultasi Renovasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="buildingType" class="form-label">Tipe Bangunan</label>
                        <input type="text" class="form-control" id="buildingType" required>
                    </div>
                    <div class="mb-3">
                        <label for="landArea" class="form-label">Est. Luas Tanah</label>
                        <input type="text" class="form-control" id="landArea" required>
                    </div>
                    <div class="mb-3">
                        <label for="buildingArea" class="form-label">Est. Luas Bangunan</label>
                        <input type="text" class="form-control" id="buildingArea" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectBudget" class="form-label">Est. Budget Proyek</label>
                        <input type="text" class="form-control" id="projectBudget" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectDescription" class="form-label">Deskripsi Singkat Kebutuhan Proyek</label>
                        <textarea class="form-control" id="projectDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="projectImage" class="form-label">Upload Gambar Terkait Proyek</label>
                        <input type="file" class="form-control" id="projectImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No. HP / WA</label>
                        <input type="text" class="form-control" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="province" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="city" required>
                    </div>
                    <div class="mb-3">
                        <p>Data hanya akan digunakan Tim Ar Rayyan untuk memproses kebutuhan pengguna dan evaluasi pengembangan layanan</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <p>Dengan mengklik tombol "Submit", maka pengguna menyetujui akurasi data yang diunggah. Penawaran final akan diberikan berdasarkan kebutuhan detail yang didapat saat proses konsultasi.</p>
            </div>
        </div>
    </div>
</div>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#consultationModal">
    Konsultasi Renovasi
</button> -->
</html>


