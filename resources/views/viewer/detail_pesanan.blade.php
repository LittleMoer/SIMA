@section('detail_pesanan_viewer')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header"
            style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
        <div class="container">
            <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item ">
                        <a href="{{ url('viewer/pesanan') }}">Data Pesanan</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="javascript:void(0);">Detail Pesanan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section>

        <div class="row">
            <div class="col-xl-12">
                <div class="card p-3">
                    <div class="container mb-4">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="mb-3">Surat Pemesanan {{ $sp->id_sp }}</h4>
                        <a href="#"
                           onclick="printPreview('{{ route('view', $sp->id_sp) }}'); return false;"
                           class="btn btn-primary btn-sm">
                            <span class="tf-icons bx bx-printer me-2"></span> Print SP
                        </a>
                            </div>
                        </div>
                    </div>
                
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">Surat Jalan</h5>
                                @foreach ($sjs as $index => $sj)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Surat Jalan {{ $sj->id_sj }}</span>
                                        <a href="#"
                                           onclick="printPreview('{{ route('viewSJ', $sj->id_sj) }}'); return false;"
                                           class="btn btn-primary btn-sm">
                                            <span class="tf-icons bx bx-printer me-2"></span> Print SJ
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                
                        <hr class="my-4">
                
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">Surat Premi Jalan</h5>
                                @foreach ($spjs as $index => $spj)
                                    @csrf
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Surat Premi Jalan {{ $spj->id_spj }}</span>
                                        <a href="#"
                                           onclick="printPreview('{{ route('viewSPJ', $spj->id_spj) }}'); return false;"
                                           class="btn btn-primary btn-sm">
                                            <span class="tf-icons bx bx-printer me-2"></span> Print SPJ
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                    function printPreview(url) {
                        var printWindow = window.open(url, 'printWindow', 'width=800,height=600');
                        printWindow.onload = function () {
                            printWindow.print();
                        };
                    }
                </script>
                

            </div>
        </div>

    </section>

    <!-- buat otomatis ngisi driver codriver -->
    <script>
        function getDriverCoDriver(sj_id) {
            let unit_id = $('#id_unit_' + sj_id).val(); // Get the selected unit ID

            if (unit_id) {
                $.ajax({
                    url: '/get-driver-codriver/' + unit_id,
                    type: 'GET',
                    success: function(data) {
                        console.log("Data received:", data);
                        $('#driver_' + sj_id).val(data.driver); // Update the driver input
                        $('#codriver_' + sj_id).val(data.codriver); // Update the co-driver input
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            } else {
                $('#driver_' + sj_id).val('');
                $('#codriver_' + sj_id).val('');
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departureInput = document.getElementById('departure-datetime');
            const returnInput = document.getElementById('return-datetime');

            // Set min attribute for departure date to ensure past dates and times can't be selected
            const now = new Date();
            const formattedDateTime = now.toISOString().slice(0,
                16); // Get current date and time in the format required by datetime-local input
            departureInput.setAttribute('min', formattedDateTime);

            // Automatically show the calendar when input is focused
            departureInput.addEventListener('focus', function() {
                departureInput.showPicker();
            });

            returnInput.addEventListener('focus', function() {
                returnInput.showPicker();
            });

            // Update return date min attribute based on departure date selection
            departureInput.addEventListener('input', function() {
                const selectedDepartureDateTime = new Date(departureInput.value);
                if (selectedDepartureDateTime < now) {
                    alert('Tanggal dan waktu keberangkatan tidak boleh kurang dari hari ini');
                    departureInput.value = ''; // Reset the input
                } else {
                    // Set the min attribute of the return date input to be the same as the selected departure date and time
                    returnInput.setAttribute('min', departureInput.value);
                }
            });

            // Custom validation for return date
            returnInput.addEventListener('input', function() {
                const selectedReturnDateTime = new Date(returnInput.value);
                const selectedDepartureDateTime = new Date(departureInput.value);
                if (selectedReturnDateTime < selectedDepartureDateTime) {
                    alert(
                        'Tanggal dan waktu kepulangan tidak boleh kurang dari tanggal dan waktu keberangkatan'
                    );
                    returnInput.value = ''; // Reset the input
                }
            });
        });
    </script>

    <script>
        const keberangkatanInput = document.getElementById('tgl_keberangkatan');
        const kepulanganInput = document.getElementById('tgl_kepulangan');
        const errorMessage = document.getElementById('error-message');

        function setMinKepulangan() {
            // Set nilai minimum untuk tanggal kepulangan
            kepulanganInput.min = keberangkatanInput.value;
        }

        function validateDates() {
            const keberangkatanDate = new Date(keberangkatanInput.value);
            const kepulanganDate = new Date(kepulanganInput.value);

            if (kepulanganDate <= keberangkatanDate) {
                errorMessage.style.display = 'block'; // Tampilkan pesan error
                kepulanganInput.setCustomValidity('Tanggal kepulangan harus lebih besar dari tanggal keberangkatan.');
            } else {
                errorMessage.style.display = 'none'; // Sembunyikan pesan error
                kepulanganInput.setCustomValidity(''); // Hapus error validasi
            }
        }

        // Event listener untuk set min tanggal kepulangan dan validasi
        keberangkatanInput.addEventListener('change', function() {
            setMinKepulangan();
            validateDates();
        });
        kepulanganInput.addEventListener('change', validateDates);

        // Set min saat halaman pertama kali dimuat
        window.addEventListener('load', setMinKepulangan);
    </script>


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahArmadaInput = document.getElementById('jumlah_armada');
        const nilaiKontrak1 = document.getElementById('nilai_kontrak1');
        const nilaiKontrak2 = document.getElementById('nilai_kontrak2');
        const biayaTambahan = document.getElementById('biaya_tambahan');
        const totalBiaya = document.getElementById('total_biaya');
        const totalBiayaHidden = document.getElementById('total_biaya_hidden');
        const uangMuka = document.getElementById('uang_muka');
        const sisaPembayaran = document.getElementById('sisa_pembayaran');
        const sisaPembayaranHidden = document.getElementById('sisa_pembayaran_hidden');

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
            sisaPembayaran.value = formatToRupiah(sisa.toString());
            sisaPembayaranHidden.value = sisa;
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


        [nilaiKontrak1, nilaiKontrak2, biayaTambahan, uangMuka].forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Initial calculation on load
        calculateTotal();
    });
</script> --}}

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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.nav-link');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-bs-target');
                    if (targetId) {
                        history.pushState(null, null, targetId);
                    }
                });
            });

            // Handle URL hash on page load
            const hash = window.location.hash;
            if (hash) {
                const targetTab = document.querySelector(`.nav-link[data-bs-target="${hash}"]`);
                if (targetTab) {
                    const tab = new bootstrap.Tab(targetTab);
                    tab.show();
                }
            }
        });
    </script>


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

    <!-- Toast HTML -->
    <div id="emptyToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050; display: none;">
        <div class="bs-toast toast show bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="me-auto fw-semibold">⚠️ Tidak Ada Data</div>
            </div>
            <div class="toast-body">
                Tidak ada data yang diupdate.
            </div>
        </div>
    </div>

    <!-- Script to check empty fields and show toast -->
    <script>
        function checkForm() {
            const form = document.getElementById('updateForm');
            const inputs = form.querySelectorAll('input');
            let isEmpty = true;

            // Check if all input fields are empty
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    isEmpty = false;
                }
            });

            if (isEmpty) {
                // Show toast
                const toastElement = document.getElementById('emptyToast');
                toastElement.style.display = 'block';

                // Hide toast after a few seconds
                setTimeout(() => {
                    toastElement.style.display = 'none';
                }, 2500);
            } else {
                form.submit();
            }
        }
    </script>
@endsection

@include('main_viewer')
