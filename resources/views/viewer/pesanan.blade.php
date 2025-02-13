@section('pesanan_viewer')
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
                                        <th class="text-center col-1">Jumlah Armada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sp as $order)
                                        <tr data-href="{{ route('detail_pesanan', [$order->id_sp]) }}">
                                            <td class="text-center">{{ $order->id_sp }}</td>
                                            <td class="text-center">{{ $order->nama_pemesan }}</td>
                                            <td class="text-center">{{ $order->pj_rombongan }}</td>
                                            <td class="text-center">{{ $order->tgl_keberangkatan }}</td>
                                            <td class="text-center">{{ $order->tujuan }}</td>
                                            <td class="text-center">{{ $order->alamat_penjemputan }}</td>
                                            <td class="text-center status-pembayaran">{{ $order->status_pembayaran }}</td>
                                            <td class="text-center col-1">{{ $order->jumlah_armada }}</td>
                                            <td> <a href="{{ route('viewer.detail_pesanan', [$order->id_sp]) }}"
                                                    class="btn btn-outline-warning btn-sm view-btn"><i
                                                        class='bx bx-show'></i>Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>


@endsection

@include('main_viewer')

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