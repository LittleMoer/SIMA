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
                                        <form method="POST"
                                        action="{{ route('crew.pesanan.updateSPJ', $spj->id_spj) }}#SuratPerintahJalan"
                                        class="form-update" data-type="SPJ" data-id="{{ $spj->id_spj }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group md-4">
                                                    @if ($index == 0 && isset($sp))
                                                        <h5 id="nilai_kontrak1_{{ $index }}"
                                                            class="row-sm-4 row-form-label">Nilai Kontrak 1 : Rp
                                                            {{ number_format($sp->nilai_kontrak1, 0, ',', '.') }} </h5>
                                                    @elseif (isset($sp))
                                                        <h5 id="nilai_kontrak2_{{ $index }}"
                                                            class="row-sm-4 row-form-label">Nilai Kontrak 2 : Rp
                                                            {{ number_format($sp->nilai_kontrak2, 0, ',', '.') }} </h5>
                                                    @endif
                                                    <h5 id="kasbon_bbm_{{ $index }}"
                                                        class="row-sm-4 row-form-label">Kasbon BBM : Rp
                                                        {{ number_format($sjs[$index]->kasbonbbm, 0, ',', '.') }} </h5>
                                                    <h5 id="kasbon_makan_{{ $index }}"
                                                        class="row-sm-4 row-form-label">Kasbon Makan : Rp
                                                        {{ number_format($sjs[$index]->kasbonmakan, 0, ',', '.') }} </h5>
                                                    <h5 id="uang_saku_{{ $index }}"
                                                        class="row-sm-4 row-form-label">Uang Saku : Rp
                                                        {{ number_format($sjs[$index]->lainlain, 0, ',', '.') }} </h5>
                                                </div>
                                                <!-- Saldo E-toll Awal -->
                                                <div class="form-group row mb-3">
                                                    <label for="SaldoEtollawal_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        Saldo E-toll Awal
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="SaldoEtollawal_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan saldo awal E-toll"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}">
                                                        <input type="hidden" name="SaldoEtollawal"
                                                            id="SaldoEtollawal_{{ $index }}_hiddens"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}">
                                                        @error('SaldoEtollawal')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Saldo E-toll Akhir -->
                                                <div class="form-group row mb-3">
                                                    <label for="SaldoEtollakhir_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        Saldo E-toll Akhir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="SaldoEtollakhir_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan saldo akhir E-toll"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}">
                                                        <input type="hidden" name="SaldoEtollakhir"
                                                            id="SaldoEtollakhir_{{ $index }}_hiddens"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}">
                                                        @error('SaldoEtollakhir')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="PenggunaanToll_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Penggunaan Toll</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="PenggunaanToll_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan penggunaan E-toll"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}">
                                                        <input type="hidden" name="PenggunaanToll"
                                                            id="PenggunaanToll_{{ $index }}_hiddens"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}">
                                                        @error('PenggunaanToll')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <!-- KM sebelum -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmsebelum_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM sebelum
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmsebelum_{{ $index }}"
                                                            name="kmsebelum" class="form-control currency-input"
                                                            placeholder="Masukkan KM sebelum"
                                                            value="{{ old('kmsebelum', $sjs[$index]->kmsebelum) }}">
                                                    </div>
                                                </div>

                                                <!-- KM tiba -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmtiba_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM tiba
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmtiba_{{ $index }}"
                                                            name="kmtiba" class="form-control"
                                                            placeholder="Masukkan KM tiba"
                                                            value="{{ old('kmtiba', $sjs[$index]->kmtiba) }}">
                                                    </div>
                                                </div>

                                                <!-- KM Tempuh -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmtempuh_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM Tempuh
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmtempuh_{{ $index }}"
                                                            name="kmtempuh" class="form-control"
                                                            placeholder="Masukkan KM Tempuh"
                                                            value="{{ old('kmtempuh', $sjs[$index]->kmtempuh) }}">
                                                    </div>
                                                </div> --}}
                                                <!-- KM sebelum -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmsebelum_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM sebelum
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmsebelum_{{ $index }}"
                                                            name="kmsebelum" class="form-control currency-input"
                                                            placeholder="Masukkan KM sebelum"
                                                            value="{{ old('kmsebelum', $sjs[$index]->kmsebelum) }}">
                                                    </div>
                                                </div>

                                                <!-- KM tiba -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmtiba_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM tiba
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmtiba_{{ $index }}"
                                                            name="kmtiba" class="form-control"
                                                            placeholder="Masukkan KM tiba"
                                                            value="{{ old('kmtiba', $sjs[$index]->kmtiba) }}">
                                                    </div>
                                                </div>

                                                <!-- KM Tempuh -->
                                                <div class="form-group row mb-3">
                                                    <label for="kmtempuh_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        KM Tempuh
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="kmtempuh_{{ $index }}"
                                                            name="kmtempuh" class="form-control"
                                                            placeholder="Masukkan KM Tempuh"
                                                            value="{{ old('kmtempuh', $sjs[$index]->kmtempuh) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class=" col-md-6">
                                                <div class="form-group">
                                                    <a href="{{ route('crew.bbm', $spj->id_spj) }}"
                                                        class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                        Konsumsi
                                                        BBM</a>
                                                    <a href="{{ route('crew.pengeluaran', $spj->id_spj) }}"
                                                        class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                        Pengeluaran Uang Saku</a>

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="totalisibbm_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Total Isi BBM</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    id="totalisibbm_{{ $index }}"
                                                                    name="totalisibbmhidden"
                                                                    class="form-control currency-input"
                                                                    value="{{ old('totalisibbm', $spj->totalisibbm ?? 0) }}"
                                                                    placeholder="Masukkan Total Isi BBM">
                                                                <input type="hidden" name="totalisibbm"
                                                                    id="totalisibbm_{{ $index }}_hiddens"
                                                                    value="{{ old('totalisibbm', $spj->totalisibbm) }}">

                                                                <button type="button" class="btn btn-primary"
                                                                    id="tarik-total-{{ $index }}"
                                                                    onclick="tarikTotalBBM('{{ $index }}', '{{ $spj->id_spj }}')">Tarik
                                                                    Total</button>
                                                            </div>
                                                        </div>

                                                        @error('totalisibbm')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="sisabbm_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Sisa Bbm</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="sisabbm_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan Sisa bbm"
                                                            value="{{ old('sisabbm', $spj->sisabbm) }}">
                                                            <input type="hidden" name="sisabbm"
                                                            id="sisabbm_{{ $index }}_hiddens"
                                                            value="{{ old('sisabbm', $spj->sisabbm) }}">
                                                            @error('sisabbm')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                <div class="form-group row mb-3">
                                                    <label for="uanglainlain_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Pengeluaran Uang Saku</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    id="uanglainlain_{{ $index }}"
                                                                    name="uanglainlainhidden"
                                                                    class="form-control currency-input"
                                                                    value="{{ old('uanglainlain', $spj->uanglainlain ?? 0) }}"
                                                                    placeholder="Masukkan Total Pengeluaran Uang Saku">
                                                                <input type="hidden" name="uanglainlain"
                                                                    id="uanglainlain_{{ $index }}_hiddens"
                                                                    value="{{ old('uanglainlain', $spj->uanglainlain) }}">
                                                   
                                                                <button type="button" class="btn btn-primary"
                                                                    id="tarik-total-uang-saku-{{ $index }}"
                                                                    onclick="tarikTotalUangSaku('{{ $index }}', '{{ $spj->id_spj }}')">Tarik Total</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row mb-3">
                                                    <label for="sisasaku_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Sisa Saku</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="sisasaku_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan Sisa Saku"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}">
                                                        <input type="hidden" name="sisasaku"
                                                            id="sisasaku_{{ $index }}_hiddens"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}">
                                                        @error('sisasaku')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row mb-3">
                                                    <label for="uangmakan_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Pengeluaran Uang Makan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="uangmakan_{{ $index }}"
                                                            placeholder="Masukkan Uang Makan"
                                                            class="form-control currency-input"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}">
                                                        <input type="hidden" name="uangmakan"
                                                            id="uangmakan_{{ $index }}_hiddens"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}">
                                                        @error('uangmakan')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                


                                        <div class="form-group row mb-3">
                                            <label for="totalsisa_{{ $spj->id_sj }}"
                                                class="col-sm-4 col-form-label form">Total Sisa</label>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                id="totalsisa_{{ $index }}"
                                                                name="totalsisa"
                                                                class="form-control currency-input"
                                                                value="{{ old('totalsisa', $spj->totalsisa ?? 0) }}"
                                                                placeholder="Masukkan Total Sisa">
                                                            <input type="hidden"
                                                                id="totalsisa_{{ $index }}_hiddens"
                                                                name="totalsisa"
                                                                value="{{ old('totalsisa_hiddens', $spj->totalsisa ?? 0) }}">
                                                            <button type="button"
                                                                class="btn btn-primary"
                                                                id="tarik-sisa-{{ $index }}"
                                                                onclick="tarikTotalSisa('{{ $index }}', '{{ $spj->id_spj }}')">
                                                                Tarik Total Sisa
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol Submit -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateKmTempuh(index) {
            const kmSebelumInput = document.getElementById(`kmsebelum_${index}`);
            const kmTibaInput = document.getElementById(`kmtiba_${index}`);
            const kmTempuhInput = document.getElementById(`kmtempuh_${index}`);


            function calculate() {
                const kmSebelum = parseFloat(kmSebelumInput.value) || 0;
                const kmTiba = parseFloat(kmTibaInput.value) || 0;
                const kmTempuh = kmTiba - kmSebelum;

                kmTempuhInput.value = kmTempuh;
            }


            kmSebelumInput.addEventListener('input', calculate);
            kmTibaInput.addEventListener('input', calculate);
        }


        document.querySelectorAll('[id^="kmsebelum_"]').forEach(element => {
            const index = element.id.split('_')[1];
            calculateKmTempuh(index);
        });
    });
</script>
<script>
function tarikTotalUangSaku(index, idSpj) {
    fetch(`/total-uang-saku/${idSpj}`)
        .then(response => response.json())
        .then(data => {
            const totalInput = document.getElementById(`uanglainlain_${index}`);
            const hiddensInput = document.getElementById(`uanglainlain_${index}_hiddens`);
            const sisaInput = document.getElementById(`sisasaku_${index}`);
            const sisaHiddensInput = document.getElementById(`sisasaku_${index}_hiddens`);


            // Format ke Rupiah untuk total uang saku
            const formattedTotal = convertToRupiah(data.totalUangSaku.toString());
            totalInput.value = formattedTotal;
            hiddensInput.value = data.totalUangSaku; // Tetap angka untuk backend


            // Format ke Rupiah untuk sisa saku
            const formattedSisa = convertToRupiah(data.sisa.toString());
            sisaInput.value = formattedSisa;
            sisaHiddensInput.value = data.sisa; // Tetap angka untuk backend
        })
        .catch(error => console.error('Error:', error));
}
</script>

<script>
    function tarikTotalBBM(index, idSpj) {
        fetch(`/total-bbm/${idSpj}`)
            .then(response => response.json())
            .then(data => {
                const totalInput = document.getElementById(`totalisibbm_${index}`);
                const hiddensInput = document.getElementById(`totalisibbm_${index}_hiddens`);
                const sisaInput = document.getElementById(`sisabbm_${index}`);
                const sisaHiddensInput = document.getElementById(`sisabbm_${index}_hiddens`);

                // Format ke Rupiah
                const formattedTotal = convertToRupiah(data.totalBBM.toString());
                totalInput.value = formattedTotal;
                hiddensInput.value = data.totalBBM; // Tetap angka untuk backend

                // Format ke Rupiah
                const formattedSisa = convertToRupiah(data.sisaBBM.toString());
                sisaInput.value = formattedSisa;
                sisaHiddensInput.value = data.sisaBBM; // Tetap angka untuk backend
       
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
    function tarikTotalSisa(index, idSpj) {
        fetch(`/total-sisa/${idSpj}`)
            .then(response => response.json())
            .then(data => {
                const totalInput = document.getElementById(`totalsisa_${index}`);
                const hiddensInput = document.getElementById(`totalsisa_${index}_hiddens`);


                // Format ke Rupiah
                const formattedValue = convertToRupiah(data.totalSisa.toString());


                // Set nilai untuk input dan hiddens
                totalInput.value = formattedValue;
                hiddensInput.value = data.totalSisa; // Tetap angka untuk backend
            })
            .catch(error => console.error('Error:', error));
    }


</script>
<script>
        // Fungsi untuk Memformat Input sebagai Rupiah
        function formatInputRupiah(inputElement, hiddensElement) {
            inputElement.addEventListener('input', function() {
                const formattedValue = convertToRupiah(this.value);
                hiddensElement.value = formattedValue.replace(/[^\d]/g, ''); // Set hiddens input ke angka saja
                inputElement.value = formattedValue;
            });

            // Set nilai awal jika ada
            const initialValue = hiddensElement.value;
            if (initialValue) {
                inputElement.value = convertToRupiah(initialValue);
            }
        }

        // Fungsi untuk Mengubah Angka Menjadi Format Rupiah
        function convertToRupiah(angka) {
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

        // Inisialisasi Semua Input dengan Kelas "currency-input"
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.currency-input').forEach(input => {
                const hiddensInputId = input.id + '_hiddens';
                const hiddensInput = document.getElementById(hiddensInputId);
                if (hiddensInput) {
                    formatInputRupiah(input, hiddensInput);
                }
            });
        });
    </script>

    <!-- kalkulasi toll -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function calculateEtollUsage(index) {
                const awalInput = document.getElementById(`SaldoEtollawal_${index}`);
                const akhirInput = document.getElementById(`SaldoEtollakhir_${index}`);
                const penggunaanInput = document.getElementById(`PenggunaanToll_${index}`);
                const penggunaanHidden = document.getElementById(`PenggunaanToll_${index}_hiddens`);

                function formatToRupiah(angka) {
                    const isNegative = parseFloat(angka) < 0;
                    let numberString = Math.abs(parseFloat(angka)).toString();
                    let split = numberString.split('.');
                    let sisa = split[0].length % 3;
                    let rupiah = split[0].substr(0, sisa);
                    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        rupiah += (sisa ? '.' : '') + ribuan.join('.');
                    }

                    return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
                }

                function calculate() {
                    const awal = parseFloat(awalInput.value.replace(/[^\d]/g, '')) || 0;
                    const akhir = parseFloat(akhirInput.value.replace(/[^\d]/g, '')) || 0;
                    const penggunaan = awal - akhir;

                    penggunaanInput.value = formatToRupiah(penggunaan);
                    penggunaanHidden.value = penggunaan;
                }

                awalInput.addEventListener('input', calculate);
                akhirInput.addEventListener('input', calculate);
            }

            document.querySelectorAll('[id^="SaldoEtollawal_"]').forEach(element => {
                const index = element.id.split('_')[1];
                calculateEtollUsage(index);
            });
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
