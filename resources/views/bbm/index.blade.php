<!DOCTYPE html>
<html>

<head>
    <title>Konsumsi BBM</title>
</head>

<body>
    @section('bbm')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
            alt="Help center header">
        <h3 class="text-center"> Laporan isi BBM </h3>
        <h5 class="text-center px-3 mb-0">Catatan Pengisian bensin unit</h5>
    </section>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        <div class="container">
            <h2>Konsumsi Bbm</h2>
        
            <a href="{{ route('unit.store') }}" class="btn btn-primary mb-3" data-bs-toggle="modal"
                data-bs-target="#modalCentercreate">Isi Bensin</a>

            @if($bbms->count())
                <table class="datatables-basic table border-top">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>jumlah Isi Bbm</th>
                            <th>tanggal</th>
                            <th>Lokasi isi</th>
                            <th>Harga isi</th>
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
                                <td>{{ $bbm->foto_struk }}</td>
                                <td>{{ $bbm->isvalid }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal">
                                        Edit
                                    </button>

                                    <form action="{{ route('bbm.destroy', $bbm->idkonsumbbm) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Unit Kendaraan tidak ditemukan.</div>
            @endif
        </div>
    </section>


@include('main_owner')

<!-- Modal Edit -->
<!-- <div class="modal fade" id="modalCenteredit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">Nama unit</label>
                            <input type="text" id="nama_unit" name="nama_unit" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">Seri unit</label>
                            <select id="seri_unit" name="seri_unit" class="form-control">
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
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
</div> -->
<!-- Modal Create -->
<!-- <div class="modal fade" id="modalCentercreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Unit Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('unit.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-6">
                            <label for="nama_unit" class="form-label">Nama Unit</label>
                            <input type="text" id="nama_unit" name="nama_unit" class="form-control"
                                   placeholder="Masukkan Nama Unit" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-6">
                            <label for="seri_unit" class="form-label">Seri Unit</label>
                            <select id="seri_unit" name="seri_unit" class="form-control" required>
                                <option value="" disabled selected>Pilih Seri Unit</option>
                                @for ($i = 1; $i <= 3; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Unit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
 </body>
</html>
