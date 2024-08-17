
@section('manajemen_armada')
  
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center">Manajemen Armada </h3>
  <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan, manajemen armada</h5>
</section>

<!-- Manajemen Armada: Start -->
<section>

<div style="padding: 30px 60px">
    <div class=" d-flex justify-content mb-4"> 
        <form action="{{ route('manajemen_armada.index') }}" method="POST">
            @csrf
            <div class="form-group">
                <h2>Pilih Armada <i class="bx bx-bus bx-tada" style="font-size: 1.5em;"> </i></h2>
                <select class="form-select" name="id_armada" id="id_armada" required>
                    {{-- <option value=""> Select Armada</option> --}}
                    @foreach(armadas as $item)
                        <option value="{{ $item->id_armada }}">{{ $item->id_armada }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lihat Rekap Gaji</button>
        </form>
    </div> 

    



</div>
</section>

<!-- Manajemen Armada: End -->

@endsection

@include('main_owner')

  

