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
                  Selamat Datang, {{ $user->name ?? 'Guest' }}! 🎉
                </h4>
                <p class="mb-4">
                  Pantau serta kelola data dengan efisien dan akurat, memastikan informasi selalu diperbarui dan mudah diakses
                </p>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
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
      <div class="col-lg-10 order-0">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="{{ url('/pemilik') }}">
              <div class="card">
                <div class="card-body text-center">
                  <div class="app-brand justify-content-center">
                    <span class="app-brand-text demo text-body fw-bolder">
                      <img src="{{ asset('sneat/assets/img/icons/sima/pemilik.png') }}" alt="pemilik" style="width: 3rem; height: auto;">
                    </span>
                  </div>
                  <h5 class="card-title">Pemilik</h5>
                  <p class="card-text">Data Pemilik</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="{{ url('/spv') }}">
              <div class="card">
                <div class="card-body text-center">
                  <div class="app-brand justify-content-center">
                    <span class="app-brand-text demo text-body fw-bolder">
                      <img src="{{ asset('sneat/assets/img/icons/sima/spv.png') }}" alt="spv" style="width: 3rem; height: auto;">
                    </span>
                  </div>
                  <h5 class="card-title">Supervisor</h5>
                  <p class="card-text">Data Supervisor</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-6 mb-4">
            <a href="{{ url('/user') }}">
              <div class="card">
                <div class="card-body text-center">
                  <div class="app-brand justify-content-center">
                    <span class="app-brand-text demo text-body fw-bolder">
                      <img src="{{ asset('sneat/assets/img/icons/sima/user.png') }}" alt="user" style="width: 3rem; height: auto;">
                    </span>
                  </div>
                  <h5 class="card-title">User</h5>
                  <p class="card-text">Data User</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
