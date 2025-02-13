<!DOCTYPE html>
<html>

<head>
    <title>Ketersediaan unit</title>
</head>



<body>
    @section('jadwal_crew')
        <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
            <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
            <h3 class="text-center"> Kalender Events</h3>
            <h5 class="text-center px-3 mb-0">Jadwal Driver Co Driver dan Unit</h5>

        </section>

        <section>
            <div class="card">
                <div class="container py-4">
                    <!-- Navigation header -->
                    <div class="d-flex align-items-center mb-4">
                        <!-- Tombol Previous -->
                        <a
                            href="{{ route('crew.events', [
                                'month' => $currentMonth == 1 ? 12 : $currentMonth - 1,
                                'year' => $currentMonth == 1 ? $currentYear - 1 : $currentYear,
                            ]) }}">
                            <i class='bx bx-chevron-left fs-4'></i>
                        </a>

                        <!-- Menampilkan Bulan dan Tahun -->
                        <h2 class="mx-3 mb-0">{{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                        </h2>

                        <!-- Tombol Next -->
                        <a
                            href="{{ route('crew.events', [
                                'month' => $currentMonth == 12 ? 1 : $currentMonth + 1,
                                'year' => $currentMonth == 12 ? $currentYear + 1 : $currentYear,
                            ]) }}">
                            <i class='bx bx-chevron-right fs-4'></i>
                        </a>

                    </div>


                    <!-- Table container with fixed height and scroll -->
                    <div class="table-responsive" style=" overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead class="bg-light shadow-sm border" style="position: sticky; top: 0;  z-index: 100;">
                                <tr>
                                    @foreach ($units as $unit)
                                        <th scope="col"
                                            class="text-center position-sticky bg-light top-0 {{ 'seri-' . $unit->seri_unit }} "
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
                                            <td class="align-top p-3 {{ 'seri-' . $unit->seri_unit }} ">
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
                                                                        &
                                                                        {{ $availability[$unit->id_unit][$i]['codriver'] }}
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

    @include('main_crew')

   
</body>


</html>
