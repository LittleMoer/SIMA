<!DOCTYPE html>
<html>
<head>
    <title>Rekap Gaji Crew</title>
</head>
<body>
    <h1>Rekap Gaji Crew for Armada: {{ $armada->id_armada }}</h1>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('rekap.gaji.generate') }}" method="POST">
        @csrf
        <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">
        <button type="submit">Generate Rekap Gaji</button>
    </form>

    @if($rekapGaji->isEmpty())
        <p>Tidak ada data rekap gaji untuk armada ini.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Bulan</th>
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
                </tr>
            </thead>
            <tbody>
                @foreach($rekapGaji as $rekap)
                    <tr>
                        <td>{{ $gaji->nama }}</td>
                        <td>{{ $gaji->crew }}</td>
                        <td>{{ $gaji->bulan }}</td>
                        <td>{{ $gaji->no }}</td>
                        <td>{{ $gaji->tanggal }}</td>
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
    @endif
    <a href="{{ route('rekap.gaji.index') }}">Kembali ke Pilih Armada</a>
</body>

</html>
