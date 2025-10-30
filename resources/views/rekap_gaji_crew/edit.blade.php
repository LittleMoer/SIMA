@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <div class="container">
        <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">
                    <a href="{{ url()->previous() }}">Rekap Gaji Crew</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Rekap gaji Karyawan dan Crew</a>
                </li>
            </ol>
        </nav>
    </div>
</section>

<section>
    <div class="container mt-5 mb-5">
        <h3>Rekap Gaji Crew</h3>
        <h4>Armada: {{ $armada->unit->nama_unit }}</h4>
        <h4>Nama: {{ $armada->akun->name }}</h4>

        @if($rekapGajiCrew->count())
            <form action="{{ route('rekap.gaji.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Hari Kerja</th>
                            <th>Nama Pemesanan</th>
                            <th>Nilai Kontrak</th>
                            <th>BBM</th>
                            <th>Uang Makan</th>
                            <th>Saku</th>
                            <th>Cuci</th>
                            <th>Toll</th>
                            <th>Premium Percentage</th>
                            <th>Subsidi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekapGajiCrew as $index => $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="date" name="data[{{ $index }}][tanggal]" value="{{ $gaji->tanggal }}"
                                        class="form-control" required></td>
                                <td><input type="number" name="data[{{ $index }}][hari_kerja]"
                                        value="{{ $gaji->hari_kerja }}" class="form-control" required></td>
                                <td>
                                    <input type="text" name="data[{{ $index }}][nama_pemesanan]"
                                        value="{{ $gaji->nama_pemesanan }}" class="form-control"
                                        oninvalid="this.setCustomValidity('Nama Pemesanan is required.')"
                                        oninput="this.setCustomValidity('')">
                                </td>
                                <td>
                                    <input type="text" id="nilai_kontrak_{{ $index }}"
                                        name="data[{{ $index }}][nilai_kontrak]"
                                        value="{{ number_format($gaji->nilai_kontrak, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Nilai Kontrak"
                                        data-total-operasional="{{ $gaji->total_operasional }}">
                                    <input type="hidden" id="nilai_kontrak_{{ $index }}_hidden"
                                        name="data[{{ $index }}][nilai_kontrak_hidden]"
                                        value="{{ $gaji->nilai_kontrak }}">
                                </td>
                                <td>
                                    <input type="text" id="bbm_{{ $index }}" name="data[{{ $index }}][bbm]"
                                        value="{{ number_format($gaji->bbm, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="BBM">
                                    <input type="hidden" id="bbm_{{ $index }}_hidden"
                                        name="data[{{ $index }}][bbm_hidden]" value="{{ $gaji->bbm }}">
                                </td>
                                <td>
                                    <input type="text" id="uang_makan_{{ $index }}"
                                        name="data[{{ $index }}][uang_makan]"
                                        value="{{ number_format($gaji->uang_makan, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Uang Makan">
                                    <input type="hidden" id="uang_makan_{{ $index }}_hidden"
                                        name="data[{{ $index }}][uang_makan_hidden]" value="{{ $gaji->uang_makan }}">
                                </td>
                                <td>
                                    <input type="text" id="parkir_{{ $index }}" name="data[{{ $index }}][parkir]"
                                        value="{{ number_format($gaji->parkir, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Parkir">
                                    <input type="hidden" id="parkir_{{ $index }}_hidden"
                                        name="data[{{ $index }}][parkir_hidden]" value="{{ $gaji->parkir }}">
                                </td>
                                <td>
                                    <select class="form-control mb-2 service-series" data-index="{{ $index }}" style="width: 100%;">
                                        <option value="">Pilih Seri</option>
                                        <option value="1">Seri 1 (Rp 5.000)</option>
                                        <option value="2">Seri 2 (Rp 5.000)</option>
                                        <option value="3">Seri 3 (Rp 7.500)</option>
                                    </select>
                                    <input type="text" id="cuci_{{ $index }}" name="data[{{ $index }}][cuci]"
                                        value="{{ number_format($gaji->cuci, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Cuci">
                                    <input type="hidden" id="cuci_{{ $index }}_hidden"
                                        name="data[{{ $index }}][cuci_hidden]" value="{{ $gaji->cuci }}">
                                </td>
                                <td>
                                    <input type="text" id="toll_{{ $index }}" name="data[{{ $index }}][toll]"
                                        value="{{ number_format($gaji->toll, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Toll">
                                    <input type="hidden" id="toll_{{ $index }}_hidden"
                                        name="data[{{ $index }}][toll_hidden]" value="{{ $gaji->toll }}">
                                </td>
                                <td>
                                    <input type="text" name="data[{{ $index }}][premium_percentage]"
                                        list="premium-options"
                                        value="{{ old('data.'.$index.'.premium_percentage', $gaji->presentase_premi ?? $gaji->computed_presentase) }}"
                                        class="form-control premium-input" placeholder="Select or enter custom %"
                                        required>
                                    <datalist id="premium-options">
                                        <option value="6">6%</option>
                                        <option value="7">7%</option>
                                        <option value="10">10%</option>
                                        <option value="12">12%</option>
                                        <option value="14">14%</option>
                                        <option value="21">21%</option>
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" id="subsidi_{{ $index }}" name="data[{{ $index }}][subsidi]"
                                        value="{{ number_format($gaji->subsidi, 0, ',', '.') }}"
                                        class="form-control currency-input" required placeholder="Subsidi">
                                    <input type="hidden" id="subsidi_{{ $index }}_hidden"
                                        name="data[{{ $index }}][subsidi_hidden]" value="{{ $gaji->subsidi }}">
                                </td>
                                <input type="hidden" name="data[{{ $index }}][id_rekapgajicrew]"
                                    value="{{ $gaji->id_rekapgajicrew }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        @else
            <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3 mt-4">Kembali</a>
    </div>
</section>

<script>
    document.querySelectorAll('.premium-selection').forEach(select => {
        select.addEventListener('change', function () {
            const customInput = this.closest('td').querySelector('.premium-custom');
            if (this.value === 'custom') {
                customInput.style.display = 'block';
                customInput.value = ''; // Clear the value if custom is selected
            } else {
                customInput.style.display = 'none';
            }
        });
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle service series selection
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('service-series')) {
                const index = e.target.dataset.index;
                const cuciInput = document.getElementById('cuci_' + index);
                const cuciHidden = document.getElementById('cuci_' + index + '_hidden');
                let price = 0;
                
                switch(e.target.value) {
                    case '1':
                        price = 5000; // Seri 1: Rp 5.000 (same as generate())
                        break;
                    case '2':
                        price = 5000;  // Seri 2: Rp 5.000 (same as generate())
                        break;
                    case '3':
                        price = 7500;  // Seri 3: Rp 7.500 (same as generate())
                        break;
                }
                
                if (price > 0) {
                    cuciHidden.value = price;
                    cuciInput.value = 'Rp ' + price.toLocaleString('id-ID');
                }
            }
        });

        // Function to format numbers to Rupiah
        function formatToRupiah(angka) {
            const isNegative = parseFloat(angka) < 0; // Check if the value is negative
            let numberString = angka.replace(/[^\d]/g, '').toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                rupiah += (sisa ? '.' : '') + ribuan.join('.');
            }

            return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
        }

        // Function to handle input formatting
        function formatRupiahInput(inputElement, hiddenElement) {
            inputElement.addEventListener('input', function () {
                const formattedValue = formatToRupiah(this.value);
                hiddenElement.value = this.value.replace(/[^\d]/g, ''); // Set hidden input to numeric value only
                inputElement.value = formattedValue; // Set formatted value to input

                // Validate nilai_kontrak against total operational costs
                validateNilaiKontrak(inputElement);
            });

            // Set initial value if available
            const initialValue = hiddenElement.value;
            if (initialValue) {
                inputElement.value = formatToRupiah(initialValue);
            }
        }

        // Function to calculate total operational costs
        function calculateTotalOperational(index) {
            const bbm = parseInt(document.getElementById('bbm_' + index + '_hidden').value) || 0;
            const uangMakan = parseInt(document.getElementById('uang_makan_' + index + '_hidden').value) || 0;
            const parkir = parseInt(document.getElementById('parkir_' + index + '_hidden').value) || 0;
            const cuci = parseInt(document.getElementById('cuci_' + index + '_hidden').value) || 0;
            const toll = parseInt(document.getElementById('toll_' + index + '_hidden').value) || 0;

            return bbm + uangMakan + parkir + cuci + toll;
        }

        // Function to validate nilai_kontrak
        function validateNilaiKontrak(nilaiKontrakInput) {
            const index = nilaiKontrakInput.id.split('_')[2]; // Get the index from the ID
            const totalOperational = calculateTotalOperational(index);
            const nilaiKontrakValue = parseInt(nilaiKontrakInput.value.replace(/[^\d]/g, '')) || 0;

            // Validate nilai_kontrak against total operational costs
            if (nilaiKontrakValue < totalOperational) {
                alert('Nilai Kontrak cannot be lower than the total operational costs (BBM + Uang Makan + Parkir + Cuci + Toll).');
                nilaiKontrakInput.value = formatToRupiah(totalOperational); // Set to minimum valid value
                document.getElementById('nilai_kontrak_' + index + '_hidden').value = totalOperational; // Update hidden input
            }
        }

        // Initialize all currency inputs
        document.querySelectorAll('.currency-input').forEach(input => {
            const hiddenInputId = input.id + '_hidden'; // Create hidden input ID
            const hiddenInput = document.getElementById(hiddenInputId); // Get the hidden input element
            if (hiddenInput) {
                formatRupiahInput(input, hiddenInput); // Connect the function
            }
        });
    });
</script>

@if(session('success'))
    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="me-auto fw-semibold"> ✓ Data Rekap Gaji</div>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>

    <!-- Script untuk menghilangkan toast setelah beberapa detik -->
    <script>
        setTimeout(function () {
            var toastElement = document.getElementById('successToast');
            if (toastElement) {
                toastElement.style.display = 'none'; // Menghilangkan toast
            }
        }, 2500);

    </script>
@endif
@if($errors->any())
    <div id="errorToast" style="position: fixed; top: 80px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto fw-semibold">✖ Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Script to hide error toast after a few seconds -->
    <script>
        setTimeout(function () {
            var toastElement = document.getElementById('errorToast');
            if (toastElement) {
                toastElement.style.display = 'none'; // Hide error toast
            }
        }, 2500);

    </script>
@endif
@endsection

@include('main_owner')
