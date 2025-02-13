@section('unit')



    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
        <h3 class="text-center">Unit Kendaraan</h3>
        <h5 class="text-center px-3 mb-0">Cek dan Tambah Unit Kendaraan</h5>
    </section>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section>
        <div class="container">
           

            <!-- Tampilkan pesan sukses -->
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

            <!-- Form tambah unit -->
            <form action="{{ route('unit.store') }}" method="POST">
                @csrf
                <div class="form-group mt-3" style="text-align: center;">
                    <label for="seri_unit" class="mb-2">Tambah Seri Unit</label>
                    <div class="d-flex align-items-center justify-content-center">
                        <select class="form-control" name="seri_unit" id="seri_unit" required style="max-width: 200px;"> 
                            <option value="">-- Pilih Seri --</option> 
                            <option value="1">Seri 1</option>
                            <option value="2">Seri 2</option>
                            <option value="3">Seri 3</option>
                        </select>
                        <button type="submit" class="btn btn-primary ml-2">Tambah Unit</button>
                    </div>
                </div>
                
                
            </form>
            


            <!-- Tabel daftar unit -->
            <h2>Daftar Unit</h2>
            <table id="myTable" class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID Unit</th>
                        <th>Nama Unit</th>
                        <th>Seri Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->id_unit }}</td>
                            <td>{{ $unit->nama_unit }}</td>
                            <td>{{ $unit->seri_unit }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCenteredit" href="{{ route('unit.update', $unit->id_unit) }}"
                                    data-id="{{ $unit->id_unit }}" data-nama="{{ $unit->nama_unit }}"
                                    data-seri="{{ $unit->seri_unit }}">
                                    Edit Unit
                                </button>
                                <form action="{{ route('unit.destroy', $unit->id_unit) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




    </section>

    @include('main_owner')
    <!-- Modal Edit -->
    <div class="modal fade" id="modalCenteredit" tabindex="-1" aria-hidden="true">
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-primary[data-bs-target="#modalCenteredit"]');
            const modalEdit = document.getElementById('modalCenteredit');
            const formEdit = modalEdit.querySelector('form');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const namaUnit = this.getAttribute('data-nama');
                    const seriUnit = this.getAttribute('data-seri');
                    const id = this.getAttribute('data-id');

                    modalEdit.querySelector('#nama_unit').value = namaUnit;
                    modalEdit.querySelector('#seri_unit').value = seriUnit;

                    formEdit.action = `{{ route('unit.update', ':id') }}`.replace(':id', id);
                });
            });
        });

        const createButton = document.querySelector('.create-btn');
        const modalCreate = document.getElementById('modalCentercreate');
        const formCreate = modalCreate.querySelector('form');

        createButton.addEventListener('click', function() {
            // Reset the form fields
            modalCreate.querySelector('#nama_unit').value = '';
            modalCreate.querySelector('#seri_unit').value = '';

            formCreate.action = `{{ route('unit.store') }}`;
        });
    </script>

    <link href="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.js"></script>

    <!-- Script for DataTables and Role Mapping -->
    <!-- DataTable Script -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable({
                "order": [
                    [2, "asc"]
                ], // Default ascending
                "language": { // Pengaturan bahasa
                    info: 'Halaman _PAGE_ dari _PAGES_',
                    infoEmpty: 'Data tidak ditemukan',
                    infoFiltered: '(filter dari _MAX_ total data)',
                    lengthMenu: 'Filter _MENU_ ',
                    zeroRecords: 'Tidak ditemukan'
                },

            });
        });
    </script>
