<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Ar Rayyan Property</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/arrayyan.png') }}" />

    <!-- Favicon -->
    <link href="{{ asset('img/arrayyan.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Open+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> --}}

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('template/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <style>
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


    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div style="width: 100%; overflow: hidden;">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('img/header2.png') }}"
                            alt="Image">
                    </div>

                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <h1 class="display-1 text-white mb-5 animated slideInRight"
                                        style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); transform: translateY(-10px); transition: transform 0.3s ease;">
                                        Daftar Properti
                                    </h1>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Team Start -->
    <div id="property" class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3"> Properti</p>
                <h1 class="mb-5">List Properti Terbaru</h1>
            </div>
            <div class="filter-container">
                <form class="filter-form">
                    <!-- Dropdown Section -->
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <select class="form-select">
                                <option selected>Semua Lokasi</option>
                                <option>Lokasi 1</option>
                                <option>Lokasi 2</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select">
                                <option selected>Pilih Jenis</option>
                                <option>Rumah</option>
                                <option>Apartemen</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select">
                                <option selected>Disewakan/Dijual</option>
                                <option>Disewakan</option>
                                <option>Dijual</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Cari properti di sini" />
                        </div>
                    </div>

                    <!-- Range Section -->
                    <div class="row g-2 align-items-center mt-3">
                        <div class="col">
                            <label for="luasTanah" class="form-label">Luas Tanah:</label>
                            <div class="range-container">
                                <input type="range" id="minLuasTanah" min="0" max="1000000"
                                    value="0" step="1000" />
                                <input type="range" id="maxLuasTanah" min="0" max="1000000"
                                    value="1000000" step="1000" />
                            </div>
                            <div class="d-flex gap-2 mt-1">
                                <input type="number" id="inputMinLuasTanah" value="0"
                                    class="form-control w-50" />
                                <input type="number" id="inputMaxLuasTanah" value="1000000"
                                    class="form-control w-50" />
                            </div>
                        </div>
                        <div class="col">
                            <label for="luasBangunan" class="form-label">Luas Bangunan:</label>
                            <div class="range-container">
                                <input type="range" id="minLuasBangunanSlider" min="0" max="1000000"
                                    value="0" step="1000" />
                                <input type="range" id="maxLuasBangunanSlider" min="0" max="1000000"
                                    value="1000000" step="1000" />
                            </div>
                            <div class="d-flex gap-2 mt-1">
                                <input type="number" id="minLuasBangunan" value="0"
                                    class="form-control w-50" />
                                <input type="number" id="maxLuasBangunan" value="1000000"
                                    class="form-control w-50" />
                            </div>
                        </div>

                        <!-- Harga -->
                        <div class="col">
                            <label for="harga" class="form-label">Harga:</label>
                            <div class="range-container">
                                <input type="range" id="minHargaSlider" min="0" max="125000045000"
                                    value="0" step="1000000" />
                                <input type="range" id="maxHargaSlider" min="0" max="125000045000"
                                    value="125000045000" step="1000000" />
                            </div>
                            <div class="d-flex gap-2 mt-1">
                                <input type="number" id="minHarga" value="0" class="form-control w-50" />
                                <input type="number" id="maxHarga" value="125000045000"
                                    class="form-control w-50" />
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="d-flex justify-content-end mt-3 mb-4">
                        <button type="submit" class="btn btn-primary px-4">Cari</button>
                    </div>
                </form>
            </div>

            <div class="row g-4">
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            {{-- Tombol Previous --}}
                            @if ($properties->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo; Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $properties->previousPageUrl() }}">&laquo; Previous</a>
                                </li>
                            @endif
    
                            {{-- Nomor Halaman --}}
                            @foreach ($properties->links()->elements[0] as $page => $url)
                                <li class="page-item {{ $properties->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
    
                            {{-- Tombol Next --}}
                            @if ($properties->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $properties->nextPageUrl() }}">Next &raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next &raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @foreach ($properties as $property)
                    <div class="col-md-3 mb-4 mt-4">
                        <div class="card h-100 shadow-sm">
                        @php
                            // Decode JSON gambar menjadi array
                            $gambarArray = json_decode($property->gambar, true);
                        @endphp

                        @if ($gambarArray && count($gambarArray) > 0)
                            <!-- Carousel -->
                            <div id="carousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($gambarArray as $index => $gambar)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $gambar) }}" class="d-block w-100" style="height: 200px; object-fit: cover;" alt="{{ $property->nama }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        @else
                            <!-- Gambar default jika tidak ada gambar -->
                            <img src="{{ asset('storage/default.jpg') }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="Default Image">
                        @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $property->nama }}</h5>
                                <p class="card-text">
                                    <strong>Lokasi:</strong> {{ $property->lokasi }} <br>
                                    <strong>Harga:</strong> Rp {{ number_format($property->harga, 0, ',', '.') }}
                                </p>
                                <a href="https://wa.me/08123456789" class="btn btn-success btn-sm">WhatsApp</a>
                                <a href="{{ route('properties.show', $property->id) }}"
                                    class="btn btn-warning btn-sm" id="detailBtn{{ $property->id }}">Lihat Detail</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">
                        {{-- Tombol Previous --}}
                        @if ($properties->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo; Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $properties->previousPageUrl() }}">&laquo; Previous</a>
                            </li>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($properties->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $properties->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Tombol Next --}}
                        @if ($properties->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $properties->nextPageUrl() }}">Next &raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next &raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <!-- Team End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Our Office</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-secondary rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Business Hours</h5>
                    <p class="mb-1">Monday - Friday</p>
                    <h6 class="text-light">09:00 am - 07:00 pm</h6>
                    <p class="mb-1">Saturday</p>
                    <h6 class="text-light">09:00 am - 12:00 pm</h6>
                    <p class="mb-1">Sunday</p>
                    <h6 class="text-light">Closed</h6>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-secondary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid bg-secondary text-body copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-semi-bold" href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="fw-semi-bold" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('template/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('template/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('template/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('template/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('template/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('template/vendors/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('template/js/main.js') }}"></script>

    <script>
        // Function to handle all range sliders
        function setupRangeSliders(minSliderId, maxSliderId, minInputId, maxInputId, minValue, maxValue, step) {
            const minSlider = document.getElementById(minSliderId);
            const maxSlider = document.getElementById(maxSliderId);
            const minInput = document.getElementById(minInputId);
            const maxInput = document.getElementById(maxInputId);

            // Set initial values
            minSlider.value = minValue;
            maxSlider.value = maxValue;
            minInput.value = minValue;
            maxInput.value = maxValue;

            // Update min slider
            minSlider.addEventListener('input', () => {
                const min = parseInt(minSlider.value);
                const max = parseInt(maxSlider.value);

                if (min + step > max) {
                    minSlider.value = max - step;
                }
                minInput.value = minSlider.value;
            });

            // Update max slider
            maxSlider.addEventListener('input', () => {
                const min = parseInt(minSlider.value);
                const max = parseInt(maxSlider.value);

                if (max - step < min) {
                    maxSlider.value = min + step;
                }
                maxInput.value = maxSlider.value;
            });

            // Update from min input
            minInput.addEventListener('input', () => {
                let value = parseInt(minInput.value);
                if (isNaN(value)) value = minValue;

                if (value < minValue) value = minValue;
                if (value > parseInt(maxSlider.value) - step) {
                    value = parseInt(maxSlider.value) - step;
                }

                minSlider.value = value;
                minInput.value = value;
            });

            // Update from max input
            maxInput.addEventListener('input', () => {
                let value = parseInt(maxInput.value);
                if (isNaN(value)) value = maxValue;

                if (value > maxValue) value = maxValue;
                if (value < parseInt(minSlider.value) + step) {
                    value = parseInt(minSlider.value) + step;
                }

                maxSlider.value = value;
                maxInput.value = value;
            });
        }

        // Setup all range sliders
        setupRangeSliders(
            'minLuasTanah', 'maxLuasTanah',
            'inputMinLuasTanah', 'inputMaxLuasTanah',
            0, 1000000, 1000
        );

        setupRangeSliders(
            'minLuasBangunanSlider', 'maxLuasBangunanSlider',
            'minLuasBangunan', 'maxLuasBangunan',
            0, 1000000, 1000
        );

        setupRangeSliders(
            'minHargaSlider', 'maxHargaSlider',
            'minHarga', 'maxHarga',
            0, 125000045000, 1000000
        );
    </script>
</body>

</html>
