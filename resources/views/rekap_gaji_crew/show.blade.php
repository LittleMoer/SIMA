<!DOCTYPE html>
<html>
<head>
    <title>Rekap Gaji Crew</title>
</head>
<body>
    <h2>Rekap Gaji Crew for Armada: {{ $armada->id_armada }}</h2>
    <h2>Nama Crew: {{ $armada->driver }} dan {{ $armada->codriver }}</h2>
    <h2>Rekap Bulan: {{ \Carbon\Carbon::parse($rekapGaji->first()->tanggal)->format('F Y') }}</h2>
    
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
                </tr>
            </thead>
            <tbody>
                @foreach($rekapGaji as $rekap)
                    <tr>
                        <td>{{ $rekap->no }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('rekap.gaji.index') }}">Kembali ke Pilih Armada</a>
</body>
</html>
