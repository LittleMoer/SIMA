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
    <div class="container">
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
                        <th>Parkir</th>
                        <th>Cuci</th>
                        <th>Toll</th>
                        <th>Premium Percentage</th>
                        <th>Subsidi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekapGajiCrew  as $index => $gaji)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="date" name="data[{{ $index }}][tanggal]" value="{{ $gaji->tanggal }}" class="form-control" required></td>
                        <td><input type="number" name="data[{{ $index }}][hari_kerja]" value="{{ $gaji->hari_kerja }}" class="form-control" required></td>
                        <td>
                            <input type="text" 
                                name="data[{{ $index }}][nama_pemesanan]" 
                                value="{{ $gaji->nama_pemesanan }}" 
                                class="form-control" 
                                required 
                                oninvalid="this.setCustomValidity('Nama Pemesanan is required.')" 
                                oninput="this.setCustomValidity('')">
                        </td>
                        <td><input type="number" id="nilai_kontrak" name="data[{{ $index }}][nilai_kontrak]" value="{{ $gaji->nilai_kontrak }}" class="form-control" required></td>
                        <td><input type="number" id="bbm" name="data[{{ $index }}][bbm]" value="{{ $gaji->bbm }}" class="form-control" required></td>
                        <td><input type="number" id="uang_makan" name="data[{{ $index }}][uang_makan]" value="{{ $gaji->uang_makan }}" class="form-control" required></td>
                        <td><input type="number" id="parkir" name="data[{{ $index }}][parkir]" value="{{ $gaji->parkir }}" class="form-control" required></td>
                        <td><input type="number" id="cuci" name="data[{{ $index }}][cuci]" value="{{ $gaji->cuci }}" class="form-control" required></td>
                        <td><input type="number" id="toll" name="data[{{ $index }}][toll]" value="{{ $gaji->toll }}" class="form-control" required></td>
                        <td>
                            <input type="text" name="data[{{ $index }}][premium_percentage]" 
                                list="premium-options" 
                                value="{{ !in_array($gaji->premium_percentage, [6, 7, 10, 12, 14, 21]) ? $gaji->premium_percentage : '' }}"
                                class="form-control premium-input" 
                                placeholder="Select or enter custom %" 
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
                        <td><input type="number" name="data[{{ $index }}][subsidi]" value="{{ $gaji->subsidi }}" class="form-control" required></td>
                        <input type="hidden" name="data[{{ $index }}][id_rekapgajicrew]" value="{{ $gaji->id_rekapgajicrew }}">
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        @else
            <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3 mt-4">Kembali</a>
    </div>
</section>

<script>
    document.querySelectorAll('.premium-selection').forEach(select => {
        select.addEventListener('change', function() {
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
    function formatRupiah(value) {
        const numberString = value.replace(/[^0-9]/g, '');
        const number = parseInt(numberString, 10);
        
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(number);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const nilai_Kontrak = document.getElementById('nilai_kontrak');
        const bbm = document.getElementById('bbm');
        const uang_makan = document.getElementById('uang_makan');
        const parkir = document.getElementById('parkir');
        const cuci = document.getElementById('cuci');
        const toll = document.getElementById('toll');

        function formatInputAsRupiah(input) {
            input.addEventListener('input', function() {
                this.value = formatRupiah(this.value);
            });
        }

        formatInputAsRupiah(nilai_Kontrak);
        formatInputAsRupiah(bbm);
        formatInputAsRupiah(uang_makan);
        formatInputAsRupiah(parkir);
        formatInputAsRupiah(cuci);
        formatInputAsRupiah(toll);

        document.querySelector('form').addEventListener('submit', function(e) {
            const inputs = [nilai_Kontrak, bbm, uang_makan, parkir, cuci, toll];

            inputs.forEach(input => {
                input.value = input.value.replace(/[^0-9]/g, '');
            });
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