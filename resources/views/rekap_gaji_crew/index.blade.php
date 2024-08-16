<!DOCTYPE html>
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
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section>
    <h1>Pilih Armada</h1>
    <form action="{{ route('rekap.gaji.show') }}" method="POST">
        @csrf
        <label for="id_armada">Pilih Armada:</label>
        <select name="id_armada" id="id_armada" required>
            @foreach($armadas as $armada)
                <option value="{{ $armada->id_armada }}">{{ $armada->id_armada }} - {{ $armada->driver }} /
                    {{ $armada->codriver }}</option>
            @endforeach
        </select>
        <button type="submit">Lihat Rekap Gaji</button>
    </form>
</section>

@endsection

@include('main_owner')
{{-- </body>
</html> --}}
