<!DOCTYPE html>
<html>

<head>
    <title>Konsumsi BBM</title>
    <!-- Include Bootstrap CSS (optional if you want the alerts styled) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @section('bbm_crew')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header"
                style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
            <div class="container">
                <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item ">
                            <a href="{{ url('crew/pesanan') }}">Data Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ url('crew/pesanan/detail_pesanan/' . $id_sp) }}">Detail Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ url('crew/pesanan/detail_pesanan/' . $id_sp . '/#SuratPerintahJalan') }}">Surat Perintah Jalan</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0);">Konsum BBM</a>
                        </li>
                    </ol>
                </nav>
            </div>
            @if (session('success'))
                <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                    <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="me-auto fw-semibold"> ✓ Data Pesanan</div>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>

                <!-- Script untuk menghilangkan toast setelah beberapa detik -->
                <script>
                    setTimeout(function() {
                        var toastElement = document.getElementById('successToast');
                        if (toastElement) {
                            toastElement.style.display = 'none'; // Menghilangkan toast
                        }
                    }, 2500);
                </script>
            @endif
        </section>

        <section>

            <div class="card">
                <div class="container"  style="padding: 30px 30px">
                    <h2>Konsumsi Bbm</h2>

                    <!-- Button to Create a New Record -->
                    <a href="{{ route('bbm.create', ['id_spj' => $spj->id_spj]) }}" class="btn btn-primary mb-3"
                        data-bs-toggle="modal" data-bs-target="#modalCentercreate"> <i class='bx bx-gas-pump' > </i>   Isi Bensin</a>

                    @if ($bbms->count() > 0)
                        {{-- Pindahkan pengecekan ke sini --}}
                        <table class="datatables-basic table border-top" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jumlah Isi Bbm</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi Isi</th>
                                    <th>Harga Isi</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bbms as $bbm)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bbm->isiBBM }}</td>
                                        <td>{{ $bbm->tanggal }}</td>
                                        <td>{{ $bbm->lokasiisi }}</td>
                                        <td>{{ $bbm->totalbayar }}</td>
                                        <td>
                                            @if ($bbm->foto_struk)
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalViewStruk"
                                                    data-struk="{{ Storage::url($bbm->foto_struk) }}">Cek</button>
                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bbm->isvalid == 0)
                                                <span class="badge bg-label-warning me-1">Belum Valid</span>
                                            @elseif($bbm->isvalid == 1)
                                                <span class="badge bg-label-success me-1">Sudah Valid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalCenteredit" data-id="{{ $bbm->idkonsumbbm }}"
                                                data-isibbm="{{ $bbm->isiBBM }}" data-tanggal="{{ $bbm->tanggal }}"
                                                data-lokasiisi="{{ $bbm->lokasiisi }}"
                                                data-totalbayar="{{ $bbm->totalbayar }}"
                                                data-isvalid="{{ $bbm->isvalid }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('crew.bbm.destroy', $bbm->idkonsumbbm) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">Data tidak ditemukan.</div>
                    @endif
                </div>

            </div>
        </section>




        <!-- Modal Edit -->
        <div class="modal fade" id="modalCenteredit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Isi Bensin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Isi BBM</label>
                                    <input type="text" id="edit_isiBBM" name="isiBBM" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Tanggal</label>
                                    <input type="date" id="edit_tanggal" name="tanggal" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Lokasi Isi</label>
                                    <input type="text" id="edit_lokasiisi" name="lokasiisi" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Total Bayar</label>
                                    <input type="text" id="edit_totalbayar" name="totalbayar" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Foto Struk</label>
                                    <input type="file" id="edit_foto_struk" name="foto_struk" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal create -->
        <div class="modal fade" id="modalCentercreate" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Isi Bensin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('crew.bbm.create', ['id_spj' => $spj->id_spj]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Isi BBM</label>
                                    <input type="text" id="isiBBM" name="isiBBM" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Lokasi Isi</label>
                                    <input type="text" id="lokasiisi" name="lokasiisi" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Total Bayar</label>
                                    <input type="text" id="totalbayar" name="totalbayar" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="nameWithTitle" class="form-label">Foto Struk</label>
                                    <input type="file" id="foto_struk" name="foto_struk" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal untuk menampilkan gambar -->
        <div class="modal fade" id="modalViewStruk" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tempat untuk menampilkan gambar -->
                        <img id="strukImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @include('main_crew')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua tombol edit
            const editButtons = document.querySelectorAll('[data-bs-target="#modalCenteredit"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    const idkonsumbbm = this.getAttribute('data-id');
                    const isibbm = this.getAttribute('data-isibbm');
                    const tanggal = this.getAttribute('data-tanggal');
                    const lokasiisi = this.getAttribute('data-lokasiisi');
                    const totalbayar = this.getAttribute('data-totalbayar');
                    const isvalid = this.getAttribute('data-isvalid');

                    // Set action URL form
                    document.getElementById('editForm').action = `{{ url('crew/pesanan/detail_pesanan/bbm') }}/${idkonsumbbm}/edit`;

                    // Isi form dengan data
                    document.getElementById('edit_isiBBM').value = isibbm;
                    document.getElementById('edit_tanggal').value = tanggal;
                    document.getElementById('edit_lokasiisi').value = lokasiisi;
                    document.getElementById('edit_totalbayar').value = totalbayar;
                    document.getElementById('edit_isvalid').value = isvalid;
                });
            });
        });
    </script>
    <script>
        var modalViewStruk = document.getElementById('modalViewStruk');
        modalViewStruk.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Tombol yang diklik
            var strukUrl = button.getAttribute('data-struk'); // Ambil URL gambar dari data-struk

            var modalImage = document.getElementById('strukImage'); // Ambil elemen img di modal
            modalImage.src = strukUrl; // Set gambar dengan URL struk
        });
    </script>


</body>

</html>