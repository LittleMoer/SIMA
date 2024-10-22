@section('manajemen_armada')

<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center">Manajemen Armada </h3>
    <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan, manajemen armada</h5>
</section>
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
        <h2>Tambah Armada</h2>
        <form action="{{ route('manajemen_armada.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_akun">Nama</label>
                <select class="form-select" name="id_akun" id="id_akun" required>
                    @foreach($akuns as $akun)
                        <option value="{{ $akun->id_akun }}"
                            {{ isset($armada) && $armada->id_akun == $akun->id_akun ? 'selected' : '' }}>
                            {{ $akun->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_unit">Unit</label>
                <select class="form-select" name="id_unit" id="id_unit" required>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id_unit }}"
                            {{ isset($armada) && $armada->id_unit == $unit->id ? 'selected' : '' }}>
                            {{ $unit->nama_unit }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="posisi">Posisi</label>
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Contoh: Driver"
                    aria-describedby="defaultFormControlHelp">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value=1>Aktif</option>
                    <option value=0>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Armada
            </button>
        </form>
    </div>
</section>




<!-- Manajemen Armada: End -->

@endsection

@include('main_owner')
