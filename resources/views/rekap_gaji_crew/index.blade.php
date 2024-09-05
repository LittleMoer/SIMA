<!DOCTYPE html>
<html>

<head>
    <title>Rekap Gaji Crew</title>
</head>

<body>
    @section('rekap_gaji_crew')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
            alt="Help center header">
        <h3 class="text-center"> Rekap Gaji Crew</h3>
        <h5 class="text-center px-3 mb-0">Catatan penghasilan crew perbulan</h5>
    </section>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section>
        <div class="container">
            <h4> Armada: {{ $armada->unit->nama_unit }}</h4>
            <h4> Nama : {{ $armada->akun->name }}</h4>

            @if($rekapGajiCrew->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah Hari</th>
                            <th>Nama Pekerjaan</th>
                            <th>Nilai Kontrak</th>
                            <th>BBM</th>
                            <th>Uang Makan</th>
                            <th>Parkir</th>
                            <th>Cuci</th>
                            <th>Tol</th>
                            <th>Total Operasional</th>
                            <th>Sisa Nilai Kontrak</th>
                            <th>Premi</th>
                            <th>Subsidi</th>
                            <th>Total Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekapGajiCrew as $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gaji->tanggal }}</td>
                                <td>{{ $gaji->hari_kerja }}</td>
                                <td>{{ $gaji->pj_rombongan }}</td>
                                <td>{{ $gaji->nilai_kontrak }}</td>
                                <td>{{ $gaji->bbm }}</td>
                                <td>{{ $gaji->uang_makan }}</td>
                                <td>{{ $gaji->parkir }}</td>
                                <td>{{ $gaji->cuci }}</td>
                                <td>{{ $gaji->toll }}</td>
                                <td>{{ $gaji->total_operasional }}</td>
                                <td>{{ $gaji->sisa_nilai_kontrak }}</td>
                                <td>{{ $gaji->premi }}</td>
                                <td>{{ $gaji->subsidi }}</td>
                                <td>{{ $gaji->total_gaji }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
            @endif

            <form action="{{ route('rekap.gaji.generate') }}" method="POST">
                @csrf
                <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">

                <div class="form-group">
                    <label for="bulan">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Generate Rekap Gaji</button>
            </form>

            <a href="{{ route('manajemen_armada.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </section>
    @endsection


    @include('main_owner')
    {{-- </body>
</html> --}}
