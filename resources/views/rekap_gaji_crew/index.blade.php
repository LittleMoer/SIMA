<head>
    <title>Rekap Gaji Crew</title>
</head>

<body>
    @section('rekap_gaji_crew')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <div class="container">
        <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">
                    <a href="{{ url('/pesanan') }}">Rekap Gaji Crew</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Rekap gaji Karyawan dan Crew</a>
                </li>
            </ol>
        </nav>
    </div>
</section>

    <section>
        <div class="container mb-3 mt-4">
            <h4>Armada: {{ $armada->unit->nama_unit }}</h4>
            <h4>Nama: {{ $armada->akun->name }}</h4>

            <form action="{{ route('rekap.gaji.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">

                @php
                    $currentMonth = date('m');
                    $earliestYear = \App\Models\SP::min(\DB::raw('YEAR(tgl_keberangkatan)')) ?? date('Y');
                    $currentYear = date('Y');
                @endphp

                <div class="form-group row mb-3">
                    <div class="col-md-4">
                        <label for="bulan">Pilih Bulan:</label>
                        <select name="bulan" id="bulan" class="form-control">
                            @foreach(range(1, 12) as $month)
                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}"
                                    {{ old('bulan', $currentMonth) == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="tahun">Pilih Tahun:</label>
                        <select name="tahun" id="tahun" class="form-control">
                             @for($year = $earliestYear; $year <= $currentYear; $year++)
                                <option value="{{ $year }}"
                                    {{ old('tahun', $currentYear) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">Generate Rekap Gaji</button> <!-- Added margin-top -->
                    </div>
                </div>
            </form>

            @if($rekapGajiCrew->count())
                <table class="table table-bordered align-items-center">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Jumlah Hari</th>
                            <th rowspan="2">Nama Pekerjaan</th>
                            <th rowspan="2">Nilai Kontrak</th>
                            <th colspan="5">Operasional</th>
                            <th rowspan="2">Total Operasional</th>
                            <th rowspan="2">Sisa Nilai Kontrak</th>
                            <th rowspan="2">Premi</th>
                            <th rowspan="2">Subsidi</th>
                            <th rowspan="2">Total Gaji</th>
                        </tr>
                        <tr>
                            <th>BBM</th>
                            <th>Uang Makan</th>
                            <th>Parkir</th>
                            <th>Cuci</th>
                            <th>Tol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekapGajiCrew as $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gaji->tanggal }}</td>
                                <td>{{ $gaji->hari_kerja }}</td>
                                <td>{{ $gaji->nama_pemesanan }}</td>
                                <td>{{ number_format($gaji->nilai_kontrak, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->bbm, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->uang_makan, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->parkir, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->cuci, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->toll, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->total_operasional, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->sisa_nilai_kontrak, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->premi, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->subsidi, 0, ',', '.') }}</td>
                                <td>{{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="table">
                    <tfoot>
                        <tr>
                            <th colspan="4">Jumlah Hari Dalam Satu Bulan:</th>
                            <td colspan="2">{{ $rekapGajiCrew->sum('hari_kerja') }}</td>
                            <th colspan="4">Total Premi:</th>
                            <td colspan="2">{{ number_format($rekapGajiCrew->sum('premi'), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th colspan="4">Insentif:</th>
                            <td colspan="2">{{ number_format($insentif, 0, ',', '.') }}</td> <!-- Placeholder for calculation -->
                            <th colspan="4">Total Pendapatan:</th>
                            <td colspan="2">{{ number_format($rekapGajiCrew->sum('total_gaji'), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

            @else
                <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
            @endif

            <a href="{{ route('manajemen_armada.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </section>
</body>

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