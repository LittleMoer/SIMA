<!DOCTYPE html>
<html>

<head>
    <title>Ketersediaan unit</title>
</head>
<style>
    .calendar {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .calendar-cell {
        border: 1px solid #ddd;
        padding: 10px;
        min-height: 100px;
    }

    .date {
        font-weight: bold;
    }

    .event {
        margin-top: 5px;
        background-color: #f4f4f4;
        padding: 5px;
        border-radius: 3px;
    }
</style>

<body>
    @section('unit_events')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
            <h3 class="text-center"> Kalender Events</h3>
            <h5 class="text-center px-3 mb-0">Jadwal Driver Co Driver dan Unit</h5>

        </section>

        <section>
            <div class="card">
                <div class="container" style="padding: 30px 30px">
                    <div class="d-flex align-items-center mb-4">
                        <a href="{{ route('calendar.events', ['month' => $currentMonth == 1 ? 12 : $currentMonth - 1, 'year' => $currentMonth == 1 ? $currentYear - 1 : $currentYear]) }}">
                            <i class='bx bx-chevron-left' style="font-size: 1.5rem;"></i>
                        </a>
                        
                        <h2 class="mx-2 mb-0">{{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}</h2>
                    
                        <a href="{{ route('calendar.events', ['month' => $currentMonth == 12 ? 1 : $currentMonth + 1, 'year' => $currentMonth == 12 ? $currentYear + 1 : $currentYear]) }}">
                            <i class='bx bx-chevron-right' style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                    
                    <div class="table-container">
                        <table class="table table-hover border-top table-fixed" border="1">
                            <thead class="bg-light shadow border" style="position: sticky; top: 0; z-index: 100;">
                                <tr>
                                    <th><h6>Tanggal</h6></th>
                                    @foreach ($units as $unit)
                                        <th scope="col" class="{{ 'seri-' . $unit->seri_unit }}">
                                            <h6>{{ $unit->nama_unit }}</h6>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <?php $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day)->format('Y-m-d'); ?>
                                    <tr>
                                        <td><h4>{{ \Carbon\Carbon::create($currentYear, $currentMonth, $day)->format('d') }}</h4></td>
                                        @foreach ($units as $unit)
                                            <td class="{{ 'seri-' . $unit->seri_unit }}">
                                                <?php
                                                // Ambil ketersediaan berdasarkan tanggal dan unit
                                                $bookings = isset($availability[$date]) ? $availability[$date] : [];
                                                $bookingInfo = '';
                                                if ($bookings) {
                                                    foreach ($bookings as $booking) {
                                                        $bookingInfo .= $booking['nama_pemesan'] . ' (Driver: ' . $booking['driver'] . ', Co-Driver: ' . $booking['codriver'] . ')';
                                                    }
                                                } else {
                                                    $bookingInfo = ' ';
                                                }
                                                ?>
                                                <div>
                                                    {{ $bookingInfo }}
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody> --}}
                            <tbody>
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <?php $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day)->format('Y-m-d'); ?>
                                    <tr>
                                        <td><h4>{{ \Carbon\Carbon::create($currentYear, $currentMonth, $day)->format('d') }}</h4></td>
                                        @foreach ($units as $unit)
                                            <td class="{{ 'seri-' . $unit->seri_unit }}">
                                                @if(isset($availability[$date][$unit->id_unit]))
                                                    <?php $booking = $availability[$date][$unit->id_unit]; ?>
                                                    <button class="btn  btn-success btn-sm box-shadow disabled">
                                                        <div class="w-100">
                                                            <h6 style="margin-bottom: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;">
                                                                {{ $booking['nama_pemesan'] }}
                                                            </h6>
                                                            <p style="margin: 0;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;">
                                                                {{ $booking['driver'] }} 
                                                                @if (!empty($booking['codriver']))
                                                                    / {{ $booking['codriver'] }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </button>
                                                @else
                                                    <button class="btn  btn-danger btn-sm box-shadow disabled">
                                                        Tersedia
                                                    </button>
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
