@section('pengeluaran_crew')
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
                    <a href="javascript:void(0);">Pengeluaran Uang Saku</a>
                </li>
            </ol>
        </nav>
    </div>
  </section>
  
<div class="container">
    {{-- <h1>Pengeluaran Uang Saku</h1>
    <h3>SPJ: {{ $spj->id_spj }}</h3> --}}
    <br>
    
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Pengeluaran</button>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengeluaran as $item)
                <tr>
                    <td>Rp {{ number_format($item->nominal, 2, ',', '.') }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"
                            data-id="{{ $item->id_pengeluaran }}"
                            data-nominal="{{ $item->nominal }} "
                            data-catatan="{{ $item->catatan }}"
                            data-deskripsi="{{ $item->deskripsi }}">
                            Edit
                        </button>
                        <form action="{{ route('crew.pengeluaran.destroy', $item->id_pengeluaran) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pengeluaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('crew.pengeluaran.store', $spj->id_spj) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" required>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNominal" class="form-label">Nominal</label>
                        <input type="number" class="form-control" id="editNominal" name="nominal" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCatatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" id="editCatatan" name="catatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const modalEdit = document.getElementById('modalEdit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const nominal = button.getAttribute('data-nominal');
        const catatan = button.getAttribute('data-catatan');
        const deskripsi = button.getAttribute('data-deskripsi');

        const formEdit = document.getElementById('formEdit');
        formEdit.action = `/pengeluaran/${button.getAttribute('data-id')}`;

        document.getElementById('editNominal').value = nominal;
        document.getElementById('editCatatan').value = catatan;
        document.getElementById('editDeskripsi').value = deskripsi || '';
    });
});
document.getElementById('editNominal').value = 'Rp ' + nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');


</script>
@endsection

@include('main_crew')