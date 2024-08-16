{{-- <!DOCTYPE html>
<html>
<head>
    <title>Rekap Gaji Crew</title>
</head>
<body> --}}
@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <h3 class="text-center">Edit Rekap Gaji Crew</h3>
</section>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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
<form action="{{ route('rekap.gaji.update', ['nama' => $rekapGaji->nama]) }}" method="POST">
        @csrf
        <input type="hidden" name="id_armada" value="{{ $rekapGaji->id_armada }}">
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $rekapGaji->tanggal }}" required>
        
        <label for="pj_rombongan">PJ Rombongan:</label>
        <input type="text" name="pj_rombongan" id="pj_rombongan" value="{{ $rekapGaji->pj_rombongan }}" required>
        
        <label for="nilai_kontrak">Nilai Kontrak:</label>
        <input type="number" name="nilai_kontrak" id="nilai_kontrak" value="{{ $rekapGaji->nilai_kontrak }}" required>
        
        <label for="bbm">bbm:</label>
        <input type="number" name="bbm" id="bbm" value="{{ $rekapGaji->bbm }}" required>

        <label for="uang_makan">Uang Makan:</label>
        <input type="number" name="uang_makan" id="uang_makan" value="{{ $rekapGaji->uang_makan }}" required>

        <label for="parkir">parkir:</label>
        <input type="number" name="parkir" id="parkir" value="{{ $rekapGaji->parkir }}" required>

        <label for="cuci">Cuci:</label>
        <input type="number" name="cuci" id="cuci" value="{{ $rekapGaji->cuci }}" required>

        <label for="toll">Toll:</label>
        <input type="number" name="toll" id="toll" value="{{ $rekapGaji->toll }}" required>

        <label for="total_operasional">Total Operasional:</label>
        <input type="number" name="total_operasional" id="total_operasional" value="{{ $rekapGaji->total_operasional }}" required>

        <label for="sisa_nilai_kontrak">Sisa Nilai Kontrak:</label>
        <input type="number" name="sisa_nilai_kontrak" id="sisa_nilai_kontrak" value="{{ $rekapGaji->sisa_nilai_kontrak }}" required>

        <label for="premi">Premi:</label>
        <input type="number" name="premi" id="premi" value="{{ $rekapGaji->premi }}" required>

        <label for="subsidi">Subsidi:</label>
        <input type="number" name="subsidi" id="subsidi" value="{{ $rekapGaji->subsidi }}" required>

        <label for="total_gaji">Total Gaji:</label>
        <input type="number" name="total_gaji" id="total_gaji" value="{{ $rekapGaji->total_gaji }}" required>
        

        <button type="submit">Update Rekap Gaji</button>
    </form>

    <a href="{{ route('rekap.gaji.show', ['id_armada' => $rekapGaji->id_armada]) }}">Kembali</a>
</section>
@endsection
@include('main_owner')
{{-- </body>
    </html> --}}