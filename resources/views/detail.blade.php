<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Properti</title>
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Open+Sans:wght@400;500;600&display=swap"
            rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
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
    <div class="container mt-4">
        <div class="row">
            <!-- Gambar Properti -->
            <div class="col-md-8">
            <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $images = json_decode($property->gambar, true); // Decode JSON ke array
                    @endphp
                    
                    @foreach ($images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" 
                                style="max-height: 500px; object-fit: cover;" 
                                alt="Gambar Properti">
                        </div>
                    @endforeach
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
                <!-- Detail Properti -->
                <h3 class="mt-3">{{ $property->nama }}</h3>
                <p><strong>Lokasi:</strong> {{ $property->lokasi }}</p>

                <h4>Detail:</h4>
                <ul>
                    <li><strong>Jenis:</strong> {{ $property->jenis }}</li>
                    <li><strong>Harga:</strong> Rp {{ number_format($property->harga, 0, ',', '.') }}</li>
                    <li><strong>Luas Tanah:</strong> {{ $property->lt }} m²</li>
                    <li><strong>Luas Bangunan:</strong> {{ $property->lb }} m²</li>
                    <li><strong>Kamar Tidur:</strong> {{ $property->kt }} Unit</li>
                    <li><strong>Kamar Mandi:</strong> {{ $property->km }} Unit</li>
                </ul>
            </div>

            <!-- Kontak & Harga -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>HARGA:</h5>
                    <h3>Rp {{ number_format($property->harga, 0, ',', '.') }}</h3>
                    <p><i class="bi bi-geo-alt-fill"></i> {{ $property->lokasi }}</p>

                    <a href="https://wa.me/{{ $property->whatsapp }}" class="btn btn-success w-100 mb-2">
                        <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                    <button class="btn btn-warning w-100">Telp: {{ $property->no_hp }}</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
