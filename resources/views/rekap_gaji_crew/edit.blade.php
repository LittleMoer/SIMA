@extends('main_owner')

@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center">Rekap Gaji Crew</h3>
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
    <h2>Edit Rekap Gaji Crew</h2>

    <form action="{{ route('rekap.gaji.update', ['no_rekap' => $rekapGaji->no_rekap, 'nama' => $rekapGaji->nama]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $rekapGaji->tanggal }}" required>

        <label for="pj_rombongan">Pj pj_rombongan:</label>
        <input type="text" name="pj_rombongan" id="pj_rombongan" value="{{ $rekapGaji->pj_rombongan }}" required>

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
