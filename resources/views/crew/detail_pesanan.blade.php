@section('detail_pesanan_crew')
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
                        <a href="javascript:void(0);">Detail Pesanan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section>

        <div class="row">
            <div class="col-xl-12">
                {{-- Tab Surat Perintah Jalan --}}
                <div id="SuratPerintahJalan"  style="padding: 30px 30px">
                    <div class="container">
                        @foreach ($spjs as $index => $spj)
                            @csrf

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h2>Surat Premi Jalan {{ $spj->id_spj }} </h2>

                                <a href="#"
                                    onclick="printPreview('{{ route('viewSPJ', $spj->id_spj) }}'); return false;"
                                    class="btn btn-primary">
                                    <span class="tf-icons bx bx-printer me-2"></span> Print SPJ
                                </a>
                            </div>

                            <script>
                                function printPreview(url) {
                                    var printWindow = window.open(url, 'printWindow', 'width=800,height=600');
                                    printWindow.onload = function() {
                                        printWindow.print();
                                    };
                                }
                            </script>



                            <form method="POST" action="{{ route('crew.pesanan.updateSPJ', $spj->id_spj) }}#SuratPerintahJalan">
                                @csrf
                                @method('PUT')


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-3">
                                            <label for="SaldoEtollawal_{{ $spj->id_sj }} "
                                                class="col-sm-4 col-form-label form-label">Saldo E-toll
                                                Awal</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="SaldoEtollawal"
                                                            id="SaldoEtollawal_{{ $spj->id_sj }}"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}"
                                                            class="form-control"> --}}

                                                <input type="text" id="SaldoEtollawal"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan saldo awal E toll" required>
                                                <input type="hidden" name="SaldoEtollawal" id="SaldoEtollawal_hidden"
                                                    value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="SaldoEtollakhir_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Saldo E-toll Akhir</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="SaldoEtollakhir"
                                                            id="SaldoEtollakhir_{{ $spj->id_sj }}"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="SaldoEtollakhir"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan saldo akhir E toll" required>
                                                <input type="hidden" name="SaldoEtollakhir" id="SaldoEtollakhir_hidden"
                                                    value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="PenggunaanToll_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Penggunaan Toll</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="PenggunaanToll"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan Penggunaan toll" required>
                                                <input type="hidden" name="PenggunaanToll" id="PenggunaanToll_hidden"
                                                    value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                                {{-- <input type="text" name="PenggunaanToll"
                                                            id="PenggunaanToll_{{ $spj->id_sj }}"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}"
                                                            class="form-control"> --}}
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label
                                                for="uanglainlain_{{ $spj->id_sj }}
                                                "
                                                class="col-sm-4 col-form-label form">Uang Lain-lain</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="uanglainlain"
                                                            id="uanglainlain_{{ $spj->id_sj }}"
                                                            value="{{ old('uanglainlain', $spj->uanglainlain) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="uanglainlain" class="form-control currency-input"
                                                    placeholder="Masukkan Uang lain-lain" required>
                                                <input type="hidden" name="uanglainlain" id="uanglainlain_hidden"
                                                    value="{{ old('uanglainlain', $spj->uanglainlain) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="uangmakan_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Uang Makan</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="uangmakan"
                                                            id="uangmakan_{{ $spj->id_sj }}"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="uangmakan" class="form-control currency-input"
                                                    placeholder="Masukkan Uang Makan" required>
                                                <input type="hidden" name="uangmakan" id="uangmakan_hidden"
                                                    value="{{ old('uangmakan', $spj->uangmakan) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>
                                    </div>


                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <a href="{{ route('crew.bbm', $spj->id_spj) }}" class="btn btn-primary mb-4">
                                                <i class='bx bx-gas-pump'> </i>
                                                Konsumsi
                                                BBM</a>
                                            <a href="{{ route('crew.pengeluaran', $spj->id_spj) }}"
                                                class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                Pengeluaran Uang Saku</a>

                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="sisabbm_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Sisa BBM</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="sisabbm" id="sisabbm_{{ $spj->id_sj }}"
                                                    placeholder="Masukkan Sisa BBM"
                                                    value="{{ old('sisabbm', $spj->sisabbm) }}" class="form-control"
                                                    title="Harus berupa angka">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="totalisibbm_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Total Isi BBM</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="totalisibbm"
                                                            id="totalisibbm_{{ $spj->id_sj }}"
                                                            value="{{ old('totalisibbm', $spj->totalisibbm) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="totalisibbm"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan total isi bbm" required>
                                                <input type="hidden" name="totalisibbm" id="totalisibbm_hidden"
                                                    value="{{ old('totalisibbm', $spj->totalisibbm) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="sisasaku_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Sisa Saku</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="sisasaku"
                                                            id="sisasaku_{{ $spj->id_sj }}"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="sisasaku" class="form-control currency-input"
                                                    placeholder="Masukkan Sisa Saku" required>
                                                <input type="hidden" name="sisasaku" id="sisasaku_hidden"
                                                    value="{{ old('sisasaku', $spj->sisasaku) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="totalsisa_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Total Sisa</label>
                                            <div class="col-sm-8">
                                                {{-- <input type="text" name="totalsisa"
                                                            id="totalsisa_{{ $spj->id_sj }}"
                                                            value="{{ old('totalsisa', $spj->totalsisa) }}"
                                                            class="form-control"> --}}
                                                <input type="text" id="totalsisa" class="form-control currency-input"
                                                    placeholder="Masukkan Total Sisa" required>
                                                <input type="hidden" name="totalsisa" id="totalsisa_hidden"
                                                    value="{{ old('totalsisa', $spj->totalsisa) }}"
                                                    title="Hanya angka yang diperbolehkan">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                                    <button type="submit" onclick="checkForm()" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <hr>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>

    </section>


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

@include('main_crew')
