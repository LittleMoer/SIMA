@section('rekap_gaji_crew')

<div class="container">
    <h2>Rekap Gaji Crew for Armada: {{ $armada->id_armada }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Crew</th>
                <th>Bulan</th>
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
            @forelse ($rekapGajiCrew as $gaji)
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
            @empty
                <tr>
                    <td colspan="17">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
