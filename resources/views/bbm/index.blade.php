<!DOCTYPE html>
<html>

<head>
    <title>Konsumsi BBM</title>
    <!-- Include Bootstrap CSS (optional if you want the alerts styled) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @section('bbm')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
        <h3 class="text-center"> Laporan isi BBM </h3>
        <h5 class="text-center px-3 mb-0">Catatan Pengisian bensin unit</h5>
    </section>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section>
        <div class="container">
            <h2>Konsumsi Bbm</h2>

            <!-- Button to Create a New Record -->
            <a href="{{ route('bbm.create', ['id_spj' => $spj->id_spj]) }}" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCentercreate">Isi Bensin</a>

            @if($bbms->count())
                <table class="datatables-basic table border-top">
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
                        @foreach($bbms as $bbm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bbm->isiBBM }}</td>
                                <td>{{ $bbm->tanggal }}</td>
                                <td>{{ $bbm->lokasiisi }}</td>
                                <td>{{ $bbm->totalbayar }}</td>
                                <td>
                                    <form>
                                        <button type="submit" class="btn btn-warning">Cek</button>
                                    </form>
                                </td>
                                <td>
                                    @if($bbm->isvalid == 0)
                                        <span class="badge bg-label-warning me-1">Belum Valid</span>
                                    @elseif($bbm->isvalid == 1)
                                        <span class="badge bg-label-success me-1">Sudah Valid</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" button type="button" class="btn btn-sm btn-primary" 
                                    data-bs-target="#modalCenteredit"
                                    href="{{ route('bbm.edit',$bbm->idkonsumbbm) }}"
                                    data-isibbm="{{ $bbm->isiBBM }}" data-tanggal="{{ $bbm->tanggal }}"
                                    data-lokasiisi="{{ $bbm->lokasiisi }}" data-totalbayar="{{ $bbm->totalbayar }}" data-fotostruk="{{ $bbm->foto_struk }}" data-isvalid="{{ $bbm->isvalid }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('bbm.destroy', $bbm->idkonsumbbm) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus data ini?')">Delete</button>
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
    </section>

@include('main_owner')

<!-- Include Bootstrap JS for dismissible alerts (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@include('main_owner')

<!-- Modal Edit -->
<div class="modal fade" id="modalCenteredit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bbm.edit', ['idkonsumbbm' => $bbm->idkonsumbbm]) }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" id="fotostruk" name="fotostruk" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">Status</label>
                            <select id="isvalid" name="isvalid" class="form-control">
                                <option value=0>Belum Valid</option>
                                <option value=1>Sudah Valid</option>
                            </select>
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
                <h5 class="modal-title" id="modalCenterTitle">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bbm.create', ['id_spj' => $spj->id_spj]) }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" id="fotostruk" name="fotostruk" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">Status</label>
                            <select id="isvalid" name="isvalid" class="form-control">
                                <option value=0>Belum Valid</option>
                                <option value=1>Sudah Valid</option>
                            </select>
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
 </body>
</html>
