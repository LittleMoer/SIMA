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
<!-- Manajemen Armada: Start -->
<section>
<section>
    <div class="container">
        <h2>Edit Armada</h2>
        <form action="{{ isset($armada) ? route('manajemen_armada.update', ['id_armada' => $armada->id_armada]) : route('manajemen_armada.store') }}" method="POST">
            @csrf
            @if(isset($armada))
                @method('POST')
            @endif

            <!-- Hidden field to store id_akun -->
            <input type="hidden" name="id_akun" value="{{ $akuns->id_akun }}">

            <div class="form-group">
                <label for="id_akun">Nama</label>
                <input type="text" readonly="" class="form-control-plaintext text-body-1 mb-1" id="id_akun"
                    value="{{ $akuns->name }}">
            </div>

            <div class="form-group">
                <label for="id_unit">Unit</label>
                <select class="form-select" name="id_unit" id="id_unit" required>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id_unit }}"
                            {{ isset($armada) && $armada->id_unit == $unit->id_unit ? 'selected' : '' }}>
                            {{ $unit->nama_unit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="posisi">Posisi</label>
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Contoh: Driver"
                    aria-describedby="defaultFormControlHelp" value="{{ old('posisi', $armada->posisi ?? '') }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="1" {{ isset($armada) && $armada->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ isset($armada) && $armada->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                {{ isset($armada) ? 'Update Armada' : 'Tambah Armada' }}
            </button>
        </form>
    </div>
</section>
    @endsection

    @include('main_owner')
