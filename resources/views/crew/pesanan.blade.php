@section('data_pesanan_crew')
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
        <h5 class="text-center px-3 mb-0">Pemantauan, edit data pesanan</h5>
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
                                        <tr data-href="{{ route('crew.detail_pesanan', [$order->id_sp]) }}">
                                            <td class="text-center">{{ $order->id_sp }}</td>
                                            <td class="text-center">{{ $order->nama_pemesan }}</td>
                                            <td class="text-center">{{ $order->pj_rombongan }}</td>
                                            <td class="text-center">{{ $order->tgl_keberangkatan }}</td>
                                            <td class="text-center">{{ $order->tujuan }}</td>
                                            <td class="text-center">{{ $order->alamat_penjemputan }}</td>
                                            <td class="text-center status-pembayaran">{{ $order->status_pembayaran }}</td>
                                            <td class="text-center col-1">{{ $order->jumlah_armada }}</td>
                                            <td>
                                            @php
                                                // Ambil SPJ dari relasi SJ
                                                $spj = $order->sj->first()?->spj; // Mengambil SPJ pertama dari SJ
                                            @endphp

                                            @if ($spj && $spj->isvalid == 1)
                                                <button class="btn btn-outline-success btn-sm view-btn" disabled>
                                                    <i class='bx bx-check'></i>Terverifikasi
                                                </button>
                                            @else
                                                <a href="{{ route('crew.detail_pesanan', [$order->id_sp]) }}" class="btn btn-outline-warning btn-sm view-btn">
                                                    <i class='bx bx-show'></i>Detail
                                                </a>
                                            @endif
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

    <script>
        // Mendapatkan tanggal hari ini
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
        const day = String(today.getDate()).padStart(2, '0');

        // Mengatur atribut minimum pada input
        const minDateTime = `${year}-${month}-${day}T00:00`; // format YYYY-MM-DDTHH:MM
        document.getElementById('tgl_keberangkatan_full').setAttribute('min', minDateTime);

        // Mengatur atribut minimum pada input tanggal kepulangan
        const departureInput = document.getElementById('tgl_keberangkatan_full');
        const returnInput = document.getElementById('tgl_kepulangan_full');

        // Set min untuk tanggal kepulangan sesuai tanggal keberangkatan
        departureInput.addEventListener('change', function() {
            returnInput.min = this.value; // Set min untuk tanggal kepulangan
        });

        // Validasi tanggal kepulangan saat berubah
        returnInput.addEventListener('change', function() {
            if (new Date(this.value) <= new Date(departureInput.value)) {
                alert('Tanggal kepulangan harus lebih dari tanggal keberangkatan.');
                this.value = ''; // Reset nilai jika tidak valid
            }
        });
    </script>



@endsection

@include('main_crew')

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
