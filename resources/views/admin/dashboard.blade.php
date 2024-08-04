@section('dashboard')
<!-- Help Center Header: Start -->
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  {{-- <h3> Selamat datang, Pak Umar 🎉</h3> --}}
  {{-- <h5 class="text-center px-3 mb-0">Pantau serta kelola data dengan efisien dan mudah diakses</h5> --}}
  <div class="container container-p-y">
    {{-- <h3 id="current-date"></h3> --}}
    <div class="row">
      <div class="col-lg-10 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-6">
              <div class="card-body">
                <h4 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }}!! 🎉</h4>
                <p class="mb-4">
                  Pantau serta kelola data dengan efisien dan akurat, memastikan informasi selalu diperbarui dan mudah diakses
                </p>

                {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{asset('sneat/assets/img/illustrations/man-with-laptop-light.png')}}"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 mb-4 order-0">
        
        <img src="{{ asset('sneat/assets/img/sima/contact-border.png') }}" alt="contact border" class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
        <div class="card">
          <div class="d-flex align-items-end row">
            <div >
              <div class="card-body">
                
                  <span class="d-block mb-1">Tanggal hari ini</span>
                  

                  <h3 class="card-title text-nowrap mb-2" id="current-date"></h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>
<!-- Help Center Header: End -->

<!-- Dashboard : Start -->
  <!-- Fun facts: Start -->
  <section id="landingFunFacts" class="section-py landing-fun-facts">
    <div class="container">
      <div class="row gy-3">
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-primary shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/sima/laptop.svg') }}" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">100</h5>
              <p class="fw-medium mb-0">
                Pemesanan Bus<br />
                 Sima Perkasya
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-success shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/sima/user-success.svg') }}" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">100</h5>
              <p class="fw-medium mb-0">
                Driver dan Co Driver<br /> Bus Sima Perkasya
                
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-info shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/sima/diamond-info.svg') }}" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1"> 20</h5>
              <p class="fw-medium mb-0">
                Unit Bus<br />
                Sima Perkasya
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-warning shadow-none">
            <div class="card-body text-center">
              <img src="{{ asset('sneat/assets/img/sima/check-warning.svg') }}" alt="laptop" class="mb-2" />
              <h5 class="h2 mb-1">12jt</h5>
              <p class="fw-medium mb-0">
                Rata-rata<br />
                Profit per bulan
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Fun facts: End -->
<!-- Dashboard : End -->
<!-- Help Area: Start -->
<section class="section-py bg-body">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 text-center">
        <h3>Terdapat Kendala?</h3>
        <p class="mb-3"> Hubungi jika terdapat kendala dalam sistem ini.<br /> Hubungi kami selama jam kerja atau kirim email kapan saja, dan kami akan merespon secepat mungkin. </p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
          <a href="javascript:void(0);" class="btn btn-primary">Email</a>
          <a href="javascript:void(0);" class="btn btn-primary">Whats App</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Help Area: End -->
@endsection

@include('main_owner')