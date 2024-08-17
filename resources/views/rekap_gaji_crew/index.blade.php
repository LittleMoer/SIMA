@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center"> Rekap Gaji Crew</h3>
    <h5 class="text-center px-3 mb-0">Catatan penghasilan crew perbulan</h5>
</section>
<section>
    {{-- <div class="d-flex justify-content-left align-items-left card" >
        <div class="text-left" style="margin: 50px">
            <form action="{{ route('rekap.gaji.show') }}" method="POST">
                @csrf
                <div class="form-group">
                    <h2>Pilih Armada <i class="bx bx-bus bx-tada"style="font-size: 1.5em;"> </i></h2>
                    <select class="form-select" name="id_armada" id="id_armada"  required>
                        @foreach($armadas as $armada)
                            <option value="{{ $armada->id_armada }}">{{ $armada->id_armada }} - {{ $armada->driver }} / {{ $armada->codriver }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Lihat Rekap Gaji</button>
            </form>
        </div>
    </div> --}}
    <div class="card p-4">
        <div class="row ">
            <div class="d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <form action="{{ route('rekap.gaji.show') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <h2>Pilih Armada <i class="bx bx-bus bx-tada" style="font-size: 1.5em;"> </i></h2>
                            <select class="form-select" name="id_armada" id="id_armada" required>
                                {{-- <option value=""> Select Armada</option> --}}
                                @foreach($armadas as $armada)
                                    <option value="{{ $armada->id_armada }}">{{ $armada->id_armada }} - {{ $armada->driver }} / {{ $armada->codriver }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Lihat Rekap Gaji</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</section>

@endsection

@include('main_owner')
