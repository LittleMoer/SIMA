<!DOCTYPE html>
<html>

<head>
    <title>Ketersediaan unit</title>
</head>



<body>
    @section('unit_events')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
            <h3 class="text-center"> Kalender Events</h3>
            <h5 class="text-center px-3 mb-0">Jadwal Driver Co Driver dan Unit</h5>

        </section>

        <section>

            {{-- <div class="card">
                <div class="container" style="padding: 30px 30px">
                    <!-- Navigation header tetap sama -->
                    <div class="d-flex align-items-center mb-4">
                        <!-- ... kode navigasi ... -->
                    </div>
            
                    <div class="table-container">
                        <table class="table table-bordered border-top table-fixed border-dark" style="border-collapse: collapse; width: 100%;">
                            <thead class="bg-light shadow border-dark" style="position: sticky; top: 0; z-index: 100;">
                                <tr>
                                    @foreach ($units as $unit)
                                    <th scope="col" class="border border-dark text-center">
                                        <h5>{{ $unit->nama_unit }}</h5>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Mencari maksimum jumlah booking di antara semua unit
                                    $maxBookings = 0;
                                    foreach ($units as $unit) {
                                        if (isset($availability[$unit->id_unit])) {
                                            $maxBookings = max($maxBookings, count($availability[$unit->id_unit]));
                                        }
                                    }
                                @endphp
            
                                @for ($i = 0; $i < $maxBookings; $i++)
                                    <tr>
                                        @foreach ($units as $unit)
                                        <td class="border border-dark" style="vertical-align: top; padding: 10px;">
                                            @if (isset($availability[$unit->id_unit][$i]))
                                                <div class="booking-info">
                                                    <strong>{{ $availability[$unit->id_unit][$i]['range'] }}</strong><br>
                                                    <strong>{{ $availability[$unit->id_unit][$i]['nama_pemesan'] }}</strong><br>
                                                    Driver: {{ $availability[$unit->id_unit][$i]['driver'] }}<br>
                                                    CoDriver: {{ $availability[$unit->id_unit][$i]['codriver'] }}
                                                </div>
                                            @else
                                                @if ($i === 0 && !isset($availability[$unit->id_unit]))
                                                    <span>Tidak ada jadwal</span>
                                                @endif
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <style>
                .table-container {
                    overflow-x: auto;
                }
                
                .table td {
                    min-height: 100px;
                    border: 1px solid #000 !important;
                }
                
                .booking-info {
                    padding: 8px;
                    margin-bottom: 8px;
                    background-color: #f8f9fa;
                    border-radius: 4px;
                }
                
                .booking-info:last-child {
                    margin-bottom: 0;
                }
                
                .table thead th {
                    background-color: #f8f9fa;
                    border: 1px solid #000 !important;
                }
                
                /* Memberikan tinggi minimum pada sel kosong */
                .table td:empty {
                    min-height: 50px;
                }
                
                /* Memastikan semua sel memiliki tinggi yang sama dalam satu baris */
                .table tr {
                    display: table-row;
                    width: 100%;
                }
                
                .table td {
                    display: table-cell;
                    vertical-align: top;
                }
            </style> --}}
            <div class="card">
                <div class="container py-4">
                    <!-- Navigation header -->
                    <div class="d-flex align-items-center mb-4">
                        <a href="{{ route('calendar.events', ['month' => $currentMonth == 1 ? 12 : $currentMonth - 1, 'year' => $currentMonth == 1 ? $currentYear - 1 : $currentYear]) }}"
                            class="btn btn-outline-primary">
                            <i class='bx bx-chevron-left fs-4'></i>
                        </a>
                        <h2 class="mx-3 mb-0">{{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                        </h2>
                        <a href="{{ route('calendar.events', ['month' => $currentMonth == 12 ? 1 : $currentMonth + 1, 'year' => $currentMonth == 12 ? $currentYear + 1 : $currentYear]) }}"
                            class="btn btn-outline-primary">
                            <i class='bx bx-chevron-right fs-4'></i>
                        </a>
                    </div>

                    <!-- Table container with fixed height and scroll -->
                    <div class="table-responsive" style=" overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead  class="bg-light shadow-sm border" style="position: sticky; top: 0;  z-index: 100;">
                                <tr>
                                    @foreach ($units as $unit)
                                        <th scope="col" class="text-center position-sticky bg-light top-0 {{ 'seri-' . $unit->seri_unit }} " 
                                            style="z-index: 1000;">
                                            <h6 class="mb-0">{{ $unit->nama_unit }}</h6>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $maxBookings = 0;
                                    foreach ($units as $unit) {
                                        if (isset($availability[$unit->id_unit])) {
                                            $maxBookings = max($maxBookings, count($availability[$unit->id_unit]));
                                        }
                                    }
                                @endphp

                                @for ($i = 0; $i < $maxBookings; $i++)
                                    <tr>
                                        @foreach ($units as $unit)
                                            <td class="align-top p-3 {{ 'seri-' . $unit->seri_unit }} " >
                                                @if (isset($availability[$unit->id_unit][$i]))
                                                    <div class="card  mb-0">
                                                        <div class="card-body p-3">
                                                            <p class="fw-bold text-primary mb-2">
                                                                {{ $availability[$unit->id_unit][$i]['range'] }}
                                                            </p>
                                                            <h6 class="fw-bold mb-2">
                                                                {{ $availability[$unit->id_unit][$i]['nama_pemesan'] }}
                                                            </h6>
                                                            <p class="mb-1">
                                                                <span class="fw-semibold">
                                                                    {{ $availability[$unit->id_unit][$i]['driver'] }}
                                                                @if (!empty($availability[$unit->id_unit][$i]['codriver']))
                                                                    & {{ $availability[$unit->id_unit][$i]['codriver'] }}
                                                                @endif
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if ($i === 0 && !isset($availability[$unit->id_unit]))
                                                        <div class="text-muted text-center py-2">

                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <style>
                /* Custom styles to enhance Bootstrap */
                .table {
                    margin-bottom: 0;
                }

                .table thead th {
                    position: sticky;
                    top: 0;
                    background-color: #f8f9fa;
                    border-bottom: 2px solid #dee2e6;
                    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
                }


                /* Ensuring borders are visible */
                .table-bordered> :not(caption)>*>* {
                    border-width: 1px;
                    border-color: #dee2e6;
                }

                /* Card styling inside table cells */
                .card {
                    transition: transform 0.2s;
                }

                .card:hover {
                    transform: translateY(-2px);
                }

                .seri-1 {
                    background-color: #F5EFFF !important;
                }

                .seri-2 {
                    background-color: #f5f9f4 !important;
                }

                .seri-3 {
                    background-color: #faefe8 !important;
                }
            </style>


        </section>




    @endsection

    @include('main_owner')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua form dengan class availability-form
            const forms = document.querySelectorAll('.availability-form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Ambil data form
                    const formData = new FormData(this);
                    const button = this.querySelector('button');

                    // Kirim AJAX request
                    fetch('{{ route('availability.update') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update tampilan button
                                const isNowAvailable = formData.get('available') === '1';
                                button.className =
                                    `btn ${isNowAvailable ? 'btn-danger':'btn-success' } rounded-pill w-100  btn-sm box-shadow: none !important;`;
                                button.textContent = isNowAvailable ? 'Terpakai' : 'Tersedia';

                                // Update hidden input untuk next update
                                this.querySelector('input[name="available"]').value =
                                    isNowAvailable ? '0' : '1';

                                // Tampilkan toast
                                showToast('Ketersediaan Unit berhasil diperbarui');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('Terjadi kesalahan', 'danger');
                        });
                });
            });

            // Fungsi untuk menampilkan toast
            function showToast(message, type = 'success') {
                const toast = `
                    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        <div class="bs-toast toast show bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <div class="me-auto fw-semibold">✓ Ketersediaan Unit</div>
                            </div>
                            <div class="toast-body">
                                ${message}
                            </div>
                        </div>
                    </div>
                `;

                // Hapus toast lama jika ada
                const oldToast = document.getElementById('successToast');
                if (oldToast) {
                    oldToast.remove();
                }

                // Tambahkan toast baru
                document.body.insertAdjacentHTML('beforeend', toast);

                // Hilangkan toast setelah beberapa detik
                setTimeout(() => {
                    const newToast = document.getElementById('successToast');
                    if (newToast) {
                        newToast.remove();
                    }
                }, 2500);
            }
        });
    </script>
</body>


</html>
