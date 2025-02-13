<!DOCTYPE html>
<html>

<head>
    <title>Ketersediaan unit</title>
</head>
<style>
    .available {
        background-color: green !important;
        color: white;
        /* teks warna putih agar lebih kontras */
    }

    .not-available {
        background-color: red !important;
        color: white;
        /* teks warna putih agar lebih kontras */
    }

    .seri-1 {
        background-color: #F5EFFF !important;
    }

    .seri-2 {
        background-color: #fffffe !important;
    }

    .seri-3 {
        background-color: #faefe8 !important;
    }

    .btn-purple {
        background-color: rgb(18, 16, 18);
        color: white;
    }

    .btn-orange {
        background-color: orange;
        color: white;
    }


    .custom-disabled {
    opacity: 1 !important; /* Hilangkan efek transparansi tombol disabled */
    pointer-events: none; /* Tetap nonaktifkan klik */
}

.custom-disabled.btn-success {
    background-color: #198754; /* Warna tombol success Bootstrap */
    color: white; /* Warna teks tombol */
}

.custom-disabled.btn-danger {
    background-color: #dc3545; /* Warna tombol danger Bootstrap */
    color: white;
}

.custom-disabled.btn-warning {
    background-color: #ffc107; /* Warna tombol warning Bootstrap */
    color: black;
}

.custom-disabled.btn-info {
    background-color: #0dcaf0; /* Warna tombol info Bootstrap */
    color: black;
}

</style>

<body>
    @section('crew_jadwalunit')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
            <h3 class="text-center"> Kalender Unit</h3>
            <h5 class="text-center px-3 mb-0">Jadwal ketersediaan unit perbulan</h5>
            @if (session('success'))
                @if (session('success'))
                    <div id="successToast" class="toast-container"
                        style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        <div class="toast align-items-center text-white bg-success border-0 show" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ✓ {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            const toastElement = document.getElementById('successToast');
                            if (toastElement) {
                                toastElement.remove();
                            }
                        }, 2500);
                    </script>
                @endif


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
        </section>

        <section>

            <div class="card">
                <div class="container" style="padding: 30px 30px">
                    <div class="d-flex align-items-center mb-4">
                        <a
                            href="{{ route('crew.calendar', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}">
                            <i class='bx bx-chevron-left' style="font-size: 1.5rem;"></i>
                        </a>

                        <h2 class="mx-2 mb-0">{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</h2>

                        <a
                            href="{{ route('crew.calendar', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}">
                            <i class='bx bx-chevron-right' style="font-size: 1.5rem;"></i>
                        </a>
                    </div>


                    <div>
                        {{-- <a href="{{ route('calendar.month', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}">
                            <i class='bx bx-chevron-left'></i> Previous Month
                        </a>
                        <a href="{{ route('calendar.month', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}">
                            Next Month <i class='bx bx-chevron-right'></i>
                        </a>                         --}}
                    </div>
                    <div class="table-container">
                        <table class="table table-hover border-top table-fixed" border="1">
                            <thead class="bg-light shadow border" style="position: sticky; top: 0;  z-index: 100;">
                                <tr>
                                    <th>
                                        <h6>Tanggal</h6>
                                    </th>
                                    @foreach ($units as $unit)
                                        <th scope="col" class="{{ 'seri-' . $unit->seri_unit }} ">
                                            <h6>{{ $unit->nama_unit }}</h6>
                                        </th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <?php $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d'); ?>
                                    <tr>
                                        {{-- <td>{{ \Carbon\Carbon::create($year, $month, $day)->format('d F Y') }}</td> --}}
                                        <td>
                                            <h4>{{ \Carbon\Carbon::create($year, $month, $day)->format('d') }} </h4>
                                        </td>

                                        @foreach ($units as $unit)
                                            <?php
                                            $status = isset($availability[$date]) && $availability[$date]->where('id_unit', $unit->id_unit)->first() ? $availability[$date]->where('id_unit', $unit->id_unit)->first()->available : 0; // Default ke Tersedia
                                            $status = $status % 4; // Validasi rentang status
                                            
                                            $statusClasses = ['btn-success', 'btn-danger', 'btn-warning', 'btn-info'];
                                            $statusLabels = ['Tersedia', 'Terpakai', 'Booking', 'Perpal'];
                                            ?>
                                            <td class="{{ 'seri-' . $unit->seri_unit }}">
                                                <button
                                                    class="btn {{ $statusClasses[$status] }} rounded-pill w-100 btn-sm box-shadow: none !important custom-disabled " disabled>
                                                    {{ $statusLabels[$status] }}
                                                </button>
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

    @include('main_crew')

</body>


</html>
