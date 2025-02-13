<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Ar Rayyan Property</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/arrayyan.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Favicon -->
    <link href="{{ asset('img/arrayyan.ico') }}" rel="icon">
    <!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />
<!-- Vendors CSS -->
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
</head>

<body>
<div class="container mt-5">
    @if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
 
    <h2>Daftar Properti</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPropertyModal">
        Tambah Properti
    </button>
        <!-- Modal Tambah Properti -->
        <div class="modal fade" id="addPropertyModal" tabindex="-1" aria-labelledby="addPropertyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPropertyModalLabel">Tambah Properti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Input Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <!-- Input Jenis -->
                            <div class="mb-3">
                              <label for="jenis" class="form-label">Jenis:</label>
                              <select name="jenis" id="jenis" class="form-control" required>
                                <option value="Rumah">Rumah</option>
                                <option value="Apartemen">Apartemen</option>
                              </select>
                            </div>
                            <!-- Input Luas Tanah -->
                            <div class="mb-3">
                                <label for="lt" class="form-label">Luas Tanah:</label>
                                <input type="number" name="lt" class="form-control" required>
                            </div>
                            <!-- Input Luas Bangunan -->
                            <div class="mb-3">
                                <label for="lb" class="form-label">Luas Bangunan:</label>
                                <input type="number" name="lb" class="form-control" required>
                            </div>
                            <!-- Input Jumlah Kamar Mandi -->
                            <div class="mb-3">
                                <label for="km" class="form-label">Jumlah Kamar Mandi:</label>
                                <input type="number" name="km" class="form-control" required>
                            </div>
                            <!-- Input Jumlah Kamar Tidur -->
                            <div class="mb-3">
                                <label for="kt" class="form-label">Jumlah Kamar Tidur:</label>
                                <input type="number" name="kt" class="form-control" required>
                            </div>
                            <!-- Input Lokasi -->
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi:</label>
                                <input type="text" name="lokasi" class="form-control" required>
                            </div>
                            <!-- Input Harga -->
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga:</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <!-- Input No HP -->
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP:</label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                            <!-- Input WhatsApp -->
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp:</label>
                                <input type="text" name="whatsapp" class="form-control">
                            </div>
                            <!-- Input Gambar -->
                            <!-- Input Gambar (Multiple Upload) -->
                          <div class="mb-3">
                              <label for="gambar" class="form-label">Gambar:</label>
                              <input type="file" name="gambar[]" class="form-control" multiple>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>LT</th>
                <th>LB</th>
                <th>KM</th>
                <th>KT</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>No HP</th>
                <th>WhatsApp</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if ($properties->isEmpty())
    <tr><td colspan="13" class="text-center">Tidak ada data properti</td></tr>
        @else
            @foreach ($properties as $property)
            <tr>
                <td>{{ $property->id }}</td>
                <td>{{ $property->nama }}</td>
                <td>{{ $property->jenis }}</td>
                <td>{{ $property->lt }}</td>
                <td>{{ $property->lb }}</td>
                <td>{{ $property->km }}</td>
                <td>{{ $property->kt }}</td>
                <td>{{ $property->lokasi }}</td>
                <td>{{ $property->harga }}</td>
                <td>{{ $property->no_hp }}</td>
                <td>{{ $property->whatsapp }}</td>
                <td>
                    @foreach (json_decode($property->gambar) as $gambar)
                      <img src="{{ Storage::url($gambar) }}" alt="Gambar Properti" width="100">
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $property->id }}">Edit</button>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
@foreach ($properties as $property)
<!-- Modal Edit untuk Properti -->
<div class="modal fade" id="editModal{{ $property->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $property->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel{{ $property->id }}">Edit Properti</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="nama{{ $property->id }}" class="form-label">Nama Properti</label>
            <input type="text" name="nama" id="nama{{ $property->id }}" class="form-control" value="{{ old('nama', $property->nama) }}" required>
          </div>

            <div class="mb-3">
            <label for="jenis{{ $property->id }}" class="form-label">Jenis Properti</label>
            <select name="jenis" id="jenis{{ $property->id }}" class="form-control" required>
              <option value="Rumah" {{ old('jenis', $property->jenis) == 'Rumah' ? 'selected' : '' }}>Rumah</option>
              <option value="Apartemen" {{ old('jenis', $property->jenis) == 'Apartemen' ? 'selected' : '' }}>Apartemen</option>
            </select>
            </div>

          <div class="mb-3">
            <label for="lt{{ $property->id }}" class="form-label">Luas Tanah (m²)</label>
            <input type="number" name="lt" id="lt{{ $property->id }}" class="form-control" value="{{ old('lt', $property->lt) }}">
          </div>

          <div class="mb-3">
            <label for="lb{{ $property->id }}" class="form-label">Luas Bangunan (m²)</label>
            <input type="number" name="lb" id="lb{{ $property->id }}" class="form-control" value="{{ old('lb', $property->lb) }}">
          </div>

          <div class="mb-3">
            <label for="km{{ $property->id }}" class="form-label">Jumlah Kamar Mandi</label>
            <input type="number" name="km" id="km{{ $property->id }}" class="form-control" value="{{ old('km', $property->km) }}">
          </div>

          <div class="mb-3">
            <label for="kt{{ $property->id }}" class="form-label">Jumlah Kamar Tidur</label>
            <input type="number" name="kt" id="kt{{ $property->id }}" class="form-control" value="{{ old('kt', $property->kt) }}">
          </div>

          <div class="mb-3">
            <label for="lokasi{{ $property->id }}" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi{{ $property->id }}" class="form-control" value="{{ old('lokasi', $property->lokasi) }}" required>
          </div>

          <div class="mb-3">
            <label for="harga{{ $property->id }}" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga{{ $property->id }}" class="form-control" value="{{ old('harga', $property->harga) }}" required>
          </div>

          <div class="mb-3">
            <label for="no_hp{{ $property->id }}" class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp{{ $property->id }}" class="form-control" value="{{ old('no_hp', $property->no_hp) }}" required>
          </div>

          <div class="mb-3">
            <label for="whatsapp{{ $property->id }}" class="form-label">WhatsApp</label>
            <input type="text" name="whatsapp" id="whatsapp{{ $property->id }}" class="form-control" value="{{ old('whatsapp', $property->whatsapp) }}" required>
          </div>

          <div class="mb-3">
            <label for="gambar{{ $property->id }}" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar{{ $property->id }}" class="form-control">
            @if ($property->gambar)
                <img src="{{ asset('storage/' . $property->gambar) }}" alt="Gambar Properti" class="img-fluid mt-3" style="max-width: 200px;">
            @endif
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach


</body>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
