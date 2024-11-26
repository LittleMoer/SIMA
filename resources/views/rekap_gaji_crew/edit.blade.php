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
                @foreach($rekapGajiCrew as $index => $gaji)
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
                        <td>
                            <input type="text" 
                                id="nilai_kontrak_{{ $index }}" 
                                name="data[{{ $index }}][nilai_kontrak]" 
                                value="{{ number_format($gaji->nilai_kontrak, 0, ',', '.') }}" 
                                class="form-control" 
                                required 
                                placeholder="Nilai Kontrak" 
                                data-total-operasional="{{ $gaji->total_operasional }}">
                        </td>
                        <td>
                            <input type="text" 
                                id="bbm_{{ $index }}" 
                                name="data[{{ $index }}][bbm]" 
                                value="{{ $gaji->bbm }}" 
                                class="form-control" 
                                required 
                                placeholder="BBM">
                        </td>
                        <td>
                            <input type="text" 
                                id="uang_makan_{{ $index }}" 
                                name="data[{{ $index }}][uang_makan]" 
                                value="{{ $gaji->uang_makan }}" 
                                class="form-control" 
                                required 
                                placeholder="Uang Makan">
                        </td>
                        <td>
                            <input type="text" 
                                id="parkir_{{ $index }}" 
                                name="data[{{ $index }}][parkir]" 
                                value="{{ $gaji->parkir }}" 
                                class="form-control" 
                                required 
                                placeholder="Parkir">
                        </td>
                        <td>
                            <input type="text" 
                                id="cuci_{{ $index }}" 
                                name="data[{{ $index }}][cuci]" 
                                value="{{ $gaji->cuci }}" 
                                class="form-control" 
                                required 
                                placeholder="Cuci">
                        </td>
                        <td>
                            <input type="text" 
                                id="toll_{{ $index }}" 
                                name="data[{{ $index }}][toll]" 
                                value="{{ $gaji->toll }}" 
                                class="form-control" 
                                required 
                                placeholder="Toll">
                        </td>
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
        const form = document.querySelector('form'); // Adjust the selector to your form
        const inputs = document.querySelectorAll('input[id^="nilai_kontrak_"], input[id^="bbm_"], input[id^="uang_makan_"], input[id^="parkir_"], input[id^="cuci_"], input[id^="toll_"]');

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                // Format the input value as Rupiah
                this.value = formatRupiah(this.value);
            });
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let isValid = true;

            inputs.forEach(input => {
                // Clean the input value before submission
                const cleanedValue = input.value.replace(/[^0-9]/g, '');
                input.value = cleanedValue; // Set the cleaned value back

                // Check if the cleaned value is a valid integer
                if (isNaN(cleanedValue) || cleanedValue === '') {
                    isValid = false;
                    alert(input.name + ' must be a valid integer.');
                    input.focus();
                    return; // Exit the loop
                }

                // Additional validation for nilai_kontrak against total_operasional
                if (input.name.includes('nilai_kontrak')) {
                    const totalOperasional = parseFloat(input.dataset.totalOperasional);
                    const nilaiKontrak = parseFloat(cleanedValue);

                    if (nilaiKontrak < totalOperasional) {
                        isValid = false;
                        alert('Nilai Kontrak tidak boleh kurang dari Total Operasional (' + totalOperasional + ').');
                        input.focus();
                        return; // Exit the loop
                    }
                }
            });

            if (isValid) {
                // If all validations pass, submit the form via AJAX
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data submitted successfully!');
                        // Optionally, you can redirect or update the UI
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the form.');
                });
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
