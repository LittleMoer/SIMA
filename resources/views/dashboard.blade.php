<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main_owner')

@section('dashboard')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <div class="container container-p-y">
    <div class="row">
      <div class="col-lg-10 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-6">
              <div class="card-body">
                <h4 class="card-title text-primary">
                  Selamat Datang {{ $username }}! 🎉
                </h4>
                <p class="mb-4">
                  Pantau serta kelola data dengan efisien dan akurat, memastikan informasi selalu diperbarui dan mudah diakses
                </p>
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
            <div>
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
<!-- Other sections -->
@endsection
