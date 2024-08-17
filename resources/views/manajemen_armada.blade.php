
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
        <a href="{{ route('tambah_akun') }}" class="btn btn-primary">
            <span class="tf-icons bx bxs-user-plus me-2"></span>Tambah Armada
        </a> 
    </div> 
    



</div>
</section>

<!-- Manajemen Armada: End -->

@endsection

@include('main_owner')

  

