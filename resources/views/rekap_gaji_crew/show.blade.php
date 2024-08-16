{{-- <!DOCTYPE html>
<html>
<head>
    <title>Rekap Gaji Crew</title>
</head>
<body> --}}
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
    <h2>Rekap Gaji Crew JSP - {{ $armada->id_armada }}</h2>

    @foreach($akun as $member)
        <h3>Nama Crew: {{ $member->name }}</h3>
    @endforeach

    <form action="{{ route('rekap.gaji.generate') }}" method="POST">
        @csrf
        <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan" required>
            <option value="" disabled selected>Pilih bulan</option>
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
        <button type="submit">Generate Rekap Gaji</button>
    </form>

    @if($rekapGaji->isEmpty())
        <p>Tidak ada data rekap gaji untuk armada ini.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>PJ Rombongan</th>
                    <th>Nilai Kontrak</th>
                    <th>BBM</th>
                    <th>Uang Makan</th>
                    <th>Parkir</th>
                    <th>Cuci</th>
                    <th>Toll</th>
                    <th>Total Operasional</th>
                    <th>Sisa Nilai Kontrak</th>
                    <th>Premi</th>
                    <th>Subsidi</th>
                    <th>Total Gaji</th>
                    <th>Aksi</th> <!-- Added column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($rekapGaji as $index => $rekap)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $rekap->tanggal }}</td>
                        <td>{{ $rekap->pj_rombongan }}</td>
                        <td>{{ $rekap->nilai_kontrak }}</td>
                        <td>{{ $rekap->bbm }}</td>
                        <td>{{ $rekap->uang_makan }}</td>
                        <td>{{ $rekap->parkir }}</td>
                        <td>{{ $rekap->cuci }}</td>
                        <td>{{ $rekap->toll }}</td>
                        <td>{{ $rekap->total_operasional }}</td>
                        <td>{{ $rekap->sisa_nilai_kontrak }}</td>
                        <td>{{ $rekap->premi }}</td>
                        <td>{{ $rekap->subsidi }}</td>
                        <td>{{ $rekap->total_gaji }}</td>
                        <td>
                            <a href="{{ route('rekap.gaji.edit', ['nama' => $rekap->nama]) }}"
                                class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('rekap.gaji.index') }}">Kembali ke Pilih Armada</a>
</section>
@endsection

@include('main_owner')
{{-- </body>
    </html> --}}
