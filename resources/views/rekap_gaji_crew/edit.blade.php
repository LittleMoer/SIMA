@extends('main_owner')

@section('rekap_gaji_crew')
<section>
    <h2>Edit Rekap Gaji Crew</h2>

    <form action="{{ route('rekap.gaji.update', ['no_rekap' => $rekapGaji->no_rekap, 'nama' => $rekapGaji->nama]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $rekapGaji->tanggal }}" required>

        <label for="nama_pekerjaan">Nama Pekerjaan:</label>
        <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" value="{{ $rekapGaji->nama_pekerjaan }}" required>

        <label for="nilai_kontrak">Nilai Kontrak:</label>
        <input type="number" name="nilai_kontrak" id="nilai_kontrak" value="{{ $rekapGaji->nilai_kontrak }}" required>

        <label for="bbm">BBM:</label>
        <input type="number" name="bbm" id="bbm" value="{{ $rekapGaji->bbm }}" required>

        <label for="uang_makan">Uang Makan:</label>
        <input type="number" name="uang_makan" id="uang_makan" value="{{ $rekapGaji->uang_makan }}" required>

        <label for="parkir">Parkir:</label>
        <input type="number" name="parkir" id="parkir" value="{{ $rekapGaji->parkir }}" required>

        <label for="cuci">Cuci:</label>
        <input type="number" name="cuci" id="cuci" value="{{ $rekapGaji->cuci }}" required>

        <label for="toll">Toll:</label>
        <input type="number" name="toll" id="toll" value="{{ $rekapGaji->toll }}" required>

        <label for="total_operasional">Total Operasional:</label>
        <input type="number" name="total_operasional" id="total_operasional" value="{{ $rekapGaji->total_operasional }}" required>

        <label for="sisa_nilai_kontrak">Sisa Nilai Kontrak:</label>
        <input type="number" name="sisa_nilai_kontrak" id="sisa_nilai_kontrak" value="{{ $rekapGaji->sisa_nilai_kontrak }}" required>

        <label for="premi">Premi 21%:</label>
        <input type="number" name="premi" id="premi" value="{{ $rekapGaji->premi }}" required>

        <label for="subsidi">Subsidi:</label>
        <input type="number" name="subsidi" id="subsidi" value="{{ $rekapGaji->subsidi }}" required>

        <label for="total_pendapatan">Total Pendapatan:</label>
        <input type="number" name="total_pendapatan" id="total_pendapatan" value="{{ $rekapGaji->total_pendapatan }}" required>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('rekap.gaji.index') }}">Kembali ke Pilih Armada</a>
</section>
@endsection
