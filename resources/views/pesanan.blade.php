@section('data_pesanan')
    <script>
        function toggleCustomMethod() {
            const select = document.getElementById('metode-pembayaran');
            const customMethod = document.getElementById('custom-method');
            const selectedValue = select.options[select.selectedIndex].value;
            if (selectedValue === 'lainnya') {
                customMethod.style.display = 'block';
                select.style.display = 'none';
            } else {
                customMethod.style.display = 'none';
                select.style.display = 'block';
            }
        }
    </script>
    <!-- Header : Start -->
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
        <h3 class="text-center"> Data Pesanan</h3>
        <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan data pesanan</h5>
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
    <!-- Header: End -->
    <!-- Manajemen Akun: Start -->
    <section class="landingFunFacts">
        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-xl-12">
                <div class="container" style="padding: 10px 0px">
                    <!--  Centered Modal -->
                    <div class="col-lg-4 col-md-6">
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <div class="table-controls">
                                <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter"><i class="tf-icons bx bxs-user-plus"></i> Tambah Pesanan
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true"
                                data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header ">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body" style=" padding-top: 0px;">

                                            <div class="card">
                                                <div class="card-body" id="modalContent">
                                                    <h4 class="ms-auto" id="modalCenterTitle">Tambah Pesanan</h4>
                                                    <div class="text-end mb-3">
                                                        <!-- Tombol Refresh -->
                                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                            id="resetButton">
                                                            <i class='bx bx-refresh'></i> Refresh Data
                                                        </button>
                                                    </div>
                                                    <form id="createorder" action="{{ route('order.store') }}"
                                                        method="POST"> @csrf <div id="alerts"></div>
                                                        <div class="row  mb-1">
                                                            <label class="col-sm-4 col-form-label" for="nama_pemesan">Nama
                                                                Pemesan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text"
                                                                    class="form-control  @error('nama_pemesan') is-invalid @enderror"
                                                                    name="nama_pemesan" id="nama_pemesan"
                                                                    placeholder="Masukkan Nama Pemesan"
                                                                    value="{{ old('nama_pemesan') }}" >
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label" for="no_telppn">No
                                                                Telp Pemesan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="no_telppn" minlength="10"
                                                                    maxlength="13" id="no_telppn"
                                                                    class="form-control"
                                                                    value="{{ old('no_telppn') }}"
                                                                    placeholder="Masukkan No Telp Pemesan"  required
                                                                    pattern="[0-9]*"
                                                                    title="Hanya angka yang diperbolehkan dan minimal 10 digit">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label" for="pj_rombongan">PJ
                                                                Rombongan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="pj_rombongan" id="pj_rombongan"
                                                                    class="form-control "
                                                                    placeholder="Masukkan Nama Pj Rombongan"
                                                                    value="{{ old('pj_rombongan') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label" for="no_telpps">No
                                                                Telp PJ</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="no_telpps" minlength="10"
                                                                    maxlength="13" placeholder="Masukkan No Telp PJ"
                                                                    id="no_telpps" class="form-control"
                                                                    value="{{ old('no_telpps') }}" required
                                                                    pattern="[0-9]*"
                                                                    title="Hanya angka yang diperbolehkan min 10 digit max 13 digit">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="tgl_keberangkatan_full">Keberangkatan</label>
                                                            <div class="col-sm-8">
                                                                <input type="datetime-local" name="tgl_keberangkatan_full"
                                                                    id="tgl_keberangkatan_full" class="form-control"
                                                                    value="{{ old('tgl_keberangkatan_full') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="tgl_kepulangan_full">Kepulangan</label>
                                                            <div class="col-sm-8">
                                                                <input type="datetime-local" name="tgl_kepulangan_full"
                                                                    id="tgl_kepulangan_full" class="form-control"
                                                                    value="{{ old('tgl_kepulangan_full') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="tujuan">Tujuan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="tujuan" id="tujuan"
                                                                    class="form-control" placeholder="Masukkan tujuan"
                                                                    value="{{ old('tujuan') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="alamat_penjemputan">Penjemputan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="alamat_penjemputan"
                                                                    id="alamat_penjemputan" class="form-control"
                                                                    placeholder="Masukkan alamat penjemputan"
                                                                    value="{{ old('alamat_penjemputan') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="jumlah_armada">Jumlah Armada</label>
                                                            <div class="col-sm-8">
                                                                <input type="number" name="jumlah_armada"
                                                                    id="jumlah_armada" min="1" max="2"
                                                                    class="form-control"
                                                                    placeholder="Masukkan jumlah armada"
                                                                    value="{{ old('jumlah_armada') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="nilai_kontrak1">Nilai Kontrak 1</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="nilai_kontrak1"
                                                                    id="nilai_kontrak1" class="form-control currency-input"
                                                                    placeholder="Masukkan nilai kontrak 1" min="1"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('nilai_kontrak1') }}" required> --}}
                                                                <input type="text" id="nilai_kontrak1"
                                                                    class="form-control currency-input"
                                                                    placeholder="Masukkan nilai kontrak" required>
                                                                <input type="hidden" name="nilai_kontrak1"
                                                                    id="nilai_kontrak1_hidden" min="1"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('nilai_kontrak1') }}" required>
                                                            </div>

                                                        </div>

                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="nilai_kontrak2">Nilai Kontrak 2</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="nilai_kontrak2"
                                                                    id="nilai_kontrak2" class="form-control"
                                                                    placeholder="Masukkan nilai kontrak 2" min="1"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('nilai_kontrak2') }}" disabled> --}}
                                                                <input type="text" id="nilai_kontrak2"
                                                                    class="form-control currency-input"
                                                                    placeholder="Masukkan nilai kontrak" required>
                                                                <input type="hidden" name="nilai_kontrak2"
                                                                    id="nilai_kontrak2_hidden" min="1"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('nilai_kontrak2') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="biaya_tambahan">Biaya Tambahan *</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="biaya_tambahan"
                                                                    id="biaya_tambahan" class="form-control"
                                                                    placeholder="Masukkan biaya tambahan"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('biaya_tambahan') }}"> --}}
                                                                <input type="text" id="biaya_tambahan"
                                                                    class="form-control currency-input"
                                                                    placeholder="Masukkan biaya tambahan">
                                                                <input type="hidden" name="biaya_tambahan"
                                                                    id="biaya_tambahan_hidden"
                                                                    title="Angka tidak boleh negatif."
                                                                    value="{{ old('biaya_tambahan') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label" for="total_biaya">Total
                                                                Biaya</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="total_biaya" id="total_biaya"
                                                                    class="form-control"
                                                                    placeholder="Masukkan total biaya"
                                                                    value="{{ old('total_biaya') }}" required
                                                                    min="1000"
                                                                    title="Angka minimal 4 digit dan tidak boleh negatif."> --}}
                                                                <input type="text" id="total_biaya" class="form-control currency-input"
                                                                    required>
                                                                <input type="hidden" name="total_biaya" id="total_biaya_hidden"
                                                                value="{{ old('total_biaya') }}" required
                                                                min="1000"
                                                                title="Angka minimal 4 digit dan tidak boleh negatif.">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label" for="uang_muka">Uang
                                                                Muka</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="uang_muka" id="uang_muka"
                                                                    class="form-control" placeholder="Masukkan uang muka"
                                                                    min="1000"
                                                                    title="Angka minimal 4 digit dan tidak boleh negatif."
                                                                    value="{{ old('uang_muka') }}" required> --}}
                                                                <input type="text" id="uang_muka" class="form-control currency-input"
                                                                    placeholder="Masukkan biaya tambahan" required>
                                                                <input type="hidden" name="uang_muka" id="uang_muka_hidden"
                                                                min="1000"
                                                                title="Angka minimal 4 digit dan tidak boleh negatif."
                                                                value="{{ old('uang_muka') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="status_pembayaran">Status Pembayaran</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-select" id="status_pembayaran"
                                                                    name="status_pembayaran" required>
                                                                    <option value="">-- Pilih Status Pembayaran
                                                                        --</option>
                                                                    <option value="1"
                                                                        {{ old('status_pembayaran') == 1 ? 'selected' : '' }}>
                                                                        Lunas</option>
                                                                    <option value="2"
                                                                        {{ old('status_pembayaran') == 2 ? 'selected' : '' }}>
                                                                        DP</option>
                                                                    <option value="3"
                                                                        {{ old('status_pembayaran') == 3 ? 'selected' : '' }}>
                                                                        Belum DP</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="sisa_pembayaran">Sisa Pembayaran</label>
                                                            <div class="col-sm-8">
                                                                {{-- <input type="number" name="sisa_pembayaran"
                                                                    id="sisa_pembayaran" class="form-control"
                                                                    placeholder="Sisa pembayaran"
                                                                    value="{{ old('sisa_pembayaran') }}"> --}}
                                                                    <input type="text" id="sisa_pembayaran"
                                                                    class="form-control currency-input" required>
                                                                <input type="hidden" name="sisa_pembayaran" id="sisa_pembayaran_hidden"
                                                                value="{{ old('sisa_pembayaran') }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="metode_pembayaran">Metode Pembayaran</label>
                                                            <div class="col-sm-8">
                                                                <select name="metode_pembayaran" id="metode_pembayaran"
                                                                    class="form-select" required>
                                                                    <option value="">-- Pilih Metode Pembayaran
                                                                        --</option>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="transfer">Transfer</option>
                                                                    <option value="credit_card">Kartu Kredit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-form-label"
                                                                for="catatan_pembayaran">Catatan *</label>
                                                            <div class="col-sm-8">
                                                                <textarea name="catatan_pembayaran" id="catatan_pembayaran" class="form-control" placeholder="Masukkan catatan"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="text-end mt-3">

                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  Tabel -->
                    <div>
                        <div class="table-responsive table-hover">
                        <table id="myTable" class="table table-hover border-top">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id Pesanan</th>
                                        <th class="text-center">Nama Pesanan</th>
                                        <th class="text-center">PJ Rombongan</th>
                                        <th class="text-center">Keberangkatan</th>
                                        <th class="text-center">Tujuan</th>
                                        <th class="text-center">Alamat Penjemputan</th>
                                        <th class="text-center">Status Pembayaran</th>
                                        <th class="text-center col-1">Unit Pemesanan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                           
                                <tbody>
                                    @foreach ($allSp as $order)
                                        <tr data-href="{{ route('detail_pesanan', [$order->id_sp]) }}">
                                            <td class="text-center">{{ $order->id_sp }}</td>
                                            <td class="text-center">{{ $order->nama_pemesan }}</td>
                                            <td class="text-center">{{ $order->pj_rombongan }}</td>
                                            <td class="text-center">{{ $order->tgl_keberangkatan }}</td>
                                            <td class="text-center">{{ $order->tujuan }}</td>
                                            <td class="text-center">{{ $order->alamat_penjemputan }}</td>
                                            <td class="text-center status-pembayaran">{{ $order->status_pembayaran }}</td>
                                            <td class="text-center col-1">
                                                {{ implode(', ', $order->unit_names) }}
                                            </td>
                                            <td> <a href="{{ route('detail_pesanan', [$order->id_sp]) }}"
                                                    class="btn btn-outline-warning btn-sm view-btn"><i
                                                        class='bx bx-show'></i>Detail</a>
                                                {{-- <form action="{{ route('order.destroy', $order->id_sp) }}" method="POST"
                                                    style="display:inline-block;"> @csrf @method('DELETE') <button
                                                        type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this order?')">
                                                        <i class='bx bx-trash'></i>Delete</button>
                                                </form> --}}
                                                <!-- Tombol Delete yang memicu modal -->
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteOrderModal{{ $order->id_sp }}">
                                                    <i class='bx bx-trash'></i>Delete
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteOrderModal{{ $order->id_sp }}"
                                                    tabindex="-1"
                                                    aria-labelledby="deleteOrderModalLabel{{ $order->id_sp }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteOrderModalLabel{{ $order->id_sp }}">Confirm
                                                                    Deletion</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this order?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('order.destroy', $order->id_sp) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">OK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Tangani pengiriman form
                                                        var deleteForm = document.querySelector('#deleteOrderModal{{ $order->id_sp }} form');
                                                        deleteForm.addEventListener('submit', function(event) {
                                                            event.preventDefault();
                                                            // Di sini Anda bisa menambahkan logika tambahan jika diperlukan
                                                            this.submit();
                                                        });
                                                    });
                                                </script>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll('tr[data-href]');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = this.getAttribute('data-href');
                });
            });
        });
    </script> --}}
    <!-- Data SP: End -->

    <script>
        document.getElementById('jumlah_armada').addEventListener('input', function() {
            var jumlahArmada = this.value;
            var nilaiKontrak2 = document.getElementById('nilai_kontrak2');

            // Jika jumlah armada adalah 1, nilai kontrak 2 dinonaktifkan
            if (jumlahArmada == 1) {
                nilaiKontrak2.value = ''; // Kosongkan input
                nilaiKontrak2.disabled = true; // Nonaktifkan input
            }
            // Jika jumlah armada adalah 2, nilai kontrak 2 diaktifkan
            else if (jumlahArmada == 2) {
                nilaiKontrak2.disabled = false; // Aktifkan input
            }
        });
    </script>
    <script>
        function validateForm() {
            const inputs = document.querySelectorAll(
                '#createorder input[required], #createorder select[required], #createorder textarea[required]');
            let valid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                alert('Please fill out all required fields.');
            }

            return valid;
        }
    </script>


@endsection

@include('main_owner')

<!-- CSS for print -->
<style type="text/css" media="print">
    div.no_print {
        display: none;
    }
</style>

<link href="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.js"></script>

<!-- Script for DataTables and Role Mapping -->
<!-- DataTable Script -->
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#myTable').DataTable({
            "order": [
                [0, "desc"]
            ], // Default descending
            "dom": '<"top"fl<"add-button-container">><"clear">tip', // Custom DOM
            "language": { // Pengaturan bahasa
                info: 'Halaman _PAGE_ dari _PAGES_',
                infoEmpty: 'Data tidak ditemukan',
                infoFiltered: '(filter dari _MAX_ total data)',
                lengthMenu: 'Filter _MENU_ ',
                zeroRecords: 'Tidak ditemukan'
            },
            initComplete: function() {
                // Menambahkan tombol "Add" ke dalam DOM
                $("div.add-button-container").append($(".btn-primary.mb-1"));
            }
        });
    });
</script>

<!-- CSS Add di Kanan-->
<style>
    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        /* Memberikan margin bottom pada semua elemen */
    }

    .dataTables_filter {
        order: 1;
        /* Search di kiri */
        margin-bottom: 10px;
        /* Margin bottom untuk search */
    }

    .dataTables_length {
        order: 2;
        /* Filter dekat dengan search */
        margin-left: 20px;
        /* Jarak yang cukup terlihat antara filter dan search */
        margin-bottom: 10px;
        /* Margin bottom untuk filter */
    }

    .add-button-container {
        order: 1;
        /* Tombol di kanan ujung */
        display: flex;
        justify-content: flex-end;
        flex-grow: 1;
        margin-bottom: 10px;
        /* Margin bottom untuk tombol add */
    }
</style>

<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        document.getElementById('createorder').reset(); // Reset form
    });

    // Optionally, reset the form when the modal is closed
    document.getElementById('myModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('createorder').reset(); // Reset form when modal closes
    });
</script>

<script>
    // Select all elements with class 'status-pembayaran'
    const statusElements = document.querySelectorAll('.status-pembayaran');

    // Iterate through each element and change the text based on value
    statusElements.forEach(function(element) {
        const statusValue = parseInt(element.textContent.trim(), 10); // Get the integer value of status
        let statusText = '';

        // Convert integer to corresponding status text
        if (statusValue === 1) {
            statusText = 'Lunas';
        } else if (statusValue === 2) {
            statusText = 'DP';
        } else if (statusValue === 3) {
            statusText = 'Belum DP';
        } else {
            statusText = 'Status Tidak Diketahui';
        }

        // Set the text content of the element to the status text
        element.textContent = statusText;
    });
</script>

{{-- <script>
    // Fungsi untuk Memformat Input sebagai Rupiah
    function formatRupiahInput(inputElement, hiddenElement) {
        inputElement.addEventListener('input', function () {
            const formattedValue = formatToRupiah(this.value);
            hiddenElement.value = formattedValue.replace(/[^\d]/g, ''); // Set hidden input to numeric value only
            inputElement.value = formattedValue;
        });

        // Set nilai awal jika ada
        const initialValue = hiddenElement.value;
        if (initialValue) {
            inputElement.value = formatToRupiah(initialValue);
        }
    }

    // Fungsi untuk Mengubah Angka Menjadi Format Rupiah
    function formatToRupiah(angka) {
        let numberString = angka.replace(/[^\d]/g, '').toString();
        let sisa = numberString.length % 3;
        let rupiah = numberString.substr(0, sisa);
        let ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            rupiah += (sisa ? '.' : '') + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }

    // Inisialisasi Semua Input dengan Kelas "currency-input"
    document.querySelectorAll('.currency-input').forEach(input => {
        const hiddenInputId = input.id + '_hidden';
        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) {
            formatRupiahInput(input, hiddenInput);
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahArmadaInput = document.getElementById('jumlah_armada');
        const nilaiKontrak1 = document.getElementById('nilai_kontrak1');
        const nilaiKontrak2 = document.getElementById('nilai_kontrak2');
        const biayaTambahan = document.getElementById('biaya_tambahan');
        const totalBiaya = document.getElementById('total_biaya');
        const uangMuka = document.getElementById('uang_muka');
        const sisaPembayaran = document.getElementById('sisa_pembayaran');

        // Function to update nilaiKontrak2 state
        function updateNilaiKontrak2State(jumlahArmada) {
            if (jumlahArmada == 1) {
                nilaiKontrak2.value = 0;
                nilaiKontrak2.disabled = true;
                nilaiKontrak2.required = false;
                localStorage.setItem('nilaiKontrak2Disabled', 'true');
                localStorage.setItem('jumlahArmada', '1');
            } else if (jumlahArmada == 2) {
                nilaiKontrak2.disabled = false;
                nilaiKontrak2.required = true;
                localStorage.setItem('nilaiKontrak2Disabled', 'false');
                localStorage.setItem('jumlahArmada', '2');
            }
            nilaiKontrak2.dispatchEvent(new Event('input'));
        }

        // Check localStorage on page load and set initial state
        const savedJumlahArmada = localStorage.getItem('jumlahArmada');
        if (savedJumlahArmada) {
            jumlahArmadaInput.value = savedJumlahArmada;
            updateNilaiKontrak2State(savedJumlahArmada);
        }

        // Event listener for jumlah_armada changes
        jumlahArmadaInput.addEventListener('input', function() {
            updateNilaiKontrak2State(this.value);
        });

        function calculateTotal() {
            const kontrak1 = parseFloat(nilaiKontrak1.value) || 0;
            const kontrak2 = parseFloat(nilaiKontrak2.value) || 0;
            const tambahan = parseFloat(biayaTambahan.value) || 0;

            const total = kontrak1 + kontrak2 + tambahan;
            totalBiaya.value = total;

            calculateSisa(total);
        }

        function calculateSisa(total) {
            const uangMukaValue = parseFloat(uangMuka.value) || 0;
            sisaPembayaran.value = total - uangMukaValue;
        }

        // Event listeners for calculation
        nilaiKontrak1.addEventListener('input', calculateTotal);
        nilaiKontrak2.addEventListener('input', calculateTotal);
        biayaTambahan.addEventListener('input', calculateTotal);
        uangMuka.addEventListener('input', function() {
            const total = parseFloat(totalBiaya.value) || 0;
            calculateSisa(total);
        });

        // Initial calculation
        calculateTotal();
    });
</script>

 --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahArmadaInput = document.getElementById('jumlah_armada');
        const nilaiKontrak1 = document.getElementById('nilai_kontrak1');
        const nilaiKontrak2 = document.getElementById('nilai_kontrak2');
        const nilaiKontrak2v = document.getElementById('nilai_kontrak2');
        const biayaTambahan = document.getElementById('biaya_tambahan');
        const totalBiaya = document.getElementById('total_biaya');
        const totalBiayaHidden = document.getElementById('total_biaya_hidden');
        const uangMuka = document.getElementById('uang_muka');
        const sisaPembayaran = document.getElementById('sisa_pembayaran');
        const sisaPembayaranHidden = document.getElementById('sisa_pembayaran_hidden');

        // Function to update nilaiKontrak2 state
        function updateNilaiKontrak2State(jumlahArmada) {
            if (jumlahArmada == 1) {
                nilaiKontrak2v.value = 0;
                nilaiKontrak2v.disabled = true;
                nilaiKontrak2v.required = false;
                localStorage.setItem('nilaiKontrak2Disabled', 'true');
                localStorage.setItem('jumlahArmada', '1');
            } else if (jumlahArmada == 2) {
                nilaiKontrak2v.disabled = false;
                nilaiKontrak2v.required = true;
                localStorage.setItem('nilaiKontrak2Disabled', 'false');
                localStorage.setItem('jumlahArmada', '2');
            }
            nilaiKontrak2.dispatchEvent(new Event('input'));
        }

        // Check localStorage on page load and set initial state
        const savedJumlahArmada = localStorage.getItem('jumlahArmada');
        if (savedJumlahArmada) {
            jumlahArmadaInput.value = savedJumlahArmada;
            updateNilaiKontrak2State(savedJumlahArmada);
        }

        // Event listener for jumlah_armada changes
        jumlahArmadaInput.addEventListener('input', function() {
            updateNilaiKontrak2State(this.value);
        });

        function calculateTotal() {
            const kontrak1 = parseFloat(nilaiKontrak1.value.replace(/[^\d]/g, '')) || 0;
            const kontrak2 = parseFloat(nilaiKontrak2.value.replace(/[^\d]/g, '')) || 0;
            const tambahan = parseFloat(biayaTambahan.value.replace(/[^\d]/g, '')) || 0;

            const total = kontrak1 + kontrak2 + tambahan;
            totalBiaya.value = formatToRupiah(total.toString());
            totalBiayaHidden.value = total;

            calculateSisa(total);
        }

        function calculateSisa(total) {
            const uangMukaValue = parseFloat(uangMuka.value.replace(/[^\d]/g, '')) || 0;
            const sisa = total - uangMukaValue;

            // Set nilai dengan format Rupiah, dan gunakan hidden input untuk nilai asli
            sisaPembayaran.value = formatToRupiah(sisa.toString());
            sisaPembayaranHidden.value = sisa; // Nilai asli yang bisa negatif
        }

        function formatToRupiah(angka) {
            const isNegative = parseFloat(angka) < 0; // Cek apakah nilai negatif
            let numberString = angka.replace(/[^\d]/g, '').toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                rupiah += (sisa ? '.' : '') + ribuan.join('.');
            }

            return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
        }

        // Event listeners for calculation
        [nilaiKontrak1, nilaiKontrak2, biayaTambahan, uangMuka].forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Initial calculation on load
        calculateTotal();
    });
</script>

<script>
    // Fungsi untuk Memformat Input sebagai Rupiah
    function formatRupiahInput(inputElement, hiddenElement) {
        inputElement.addEventListener('input', function() {
            const formattedValue = formatToRupiah(this.value);
            hiddenElement.value = formattedValue.replace(/[^\d]/g,
                ''); // Set hidden input to numeric value only
            inputElement.value = formattedValue;
        });

        // Set nilai awal jika ada
        const initialValue = hiddenElement.value;
        if (initialValue) {
            inputElement.value = formatToRupiah(initialValue);
        }
    }

    // Fungsi untuk Mengubah Angka Menjadi Format Rupiah
    function formatToRupiah(angka) {
        let numberString = angka.replace(/[^\d]/g, '').toString();
        let sisa = numberString.length % 3;
        let rupiah = numberString.substr(0, sisa);
        let ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            rupiah += (sisa ? '.' : '') + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }

    // Inisialisasi Semua Input dengan Kelas "currency-input"
    document.querySelectorAll('.currency-input').forEach(input => {
        const hiddenInputId = input.id + '_hidden';
        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) {
            formatRupiahInput(input, hiddenInput);
        }
    });
</script>
