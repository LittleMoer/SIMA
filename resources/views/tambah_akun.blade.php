@section('tambah_akun')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center">Tambah Akun </h3>
  <h5 class="text-center px-3 mb-0">Membuat akun baru untuk dapat akses masuk </h5>
</section>

<!-- Tambah Akun Start -->
<section>
  <!-- Form with Buttons -->
<div style="padding: 30px 60px">

<div >  
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
  <div class="card-body">
      <form method="POST" action="{{ route('manajemen_akun') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="name">Nama</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" value="{{ old('name') }}" required />

                  </div>
              </div>
          </div>

          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="username">Username</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="JohnDoe" aria-label="JohnDoe" aria-describedby="basic-icon-default-fullname2" value="{{ old('username') }}" required />
                  </div>
              </div>
          </div>

          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="role_id">Role</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user-pin"></i></span>
                      <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                          <option value="">-- Pilih Role --</option>

                          <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Admin</option>
                          <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Crew</option>
                          <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Viewer</option>
                      </select>
                  </div>
              </div>
          </div>

          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="email">Email</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2" value="{{ old('email') }}" required />
                      <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                      
                  </div>
              </div>
          </div>

          <div class="row mb-3">
              <label class="col-sm-2 form-label" for="password">Password</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-password2" class="input-group-text"><i class="bx bx-key"></i></span>
                      <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" aria-label="password" aria-describedby="basic-icon-default-password2" required/>
                      
                  </div>
              </div>
          </div>

          <div class="row mb-3">
              <label class="col-sm-2 form-label" for="password_confirmation">Confirm Password</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-password2" class="input-group-text"><i class="bx bx-key"></i></span>
                      <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="password" aria-label="password" aria-describedby="basic-icon-default-password2" required />
                  </div>
              </div>
          </div>

          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
              </div>
          </div>
      </form>
  </div>
</div>


               
             
</div>
  <!--/ Form with Buttons -->
</section>

<!-- Tambah Akun End -->


<style type="text/css" media="print"> 
  div.no_print {display: none; } 
</style>  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">
 <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>  
  
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
  
{{-- <script type="text/javascript">
$(document).ready(function(){
 $("#mytable").DataTable();                 
});  
</script>   --}}
<script>
  $(document).ready(function() {
      $('#accountTable').DataTable({
    language: {
        info: 'Halaman _PAGE_ dari _PAGES_',
        infoEmpty: 'Data tidak ditemukan',
        infoFiltered: '(filter dari _MAX_ total data)',
        lengthMenu: 'Filter _MENU_ data per halaman',
        zeroRecords: 'Tidak ditemukan'
    }
});
     
      // Map role_id to role_name
      const roleMap = {
          1: 'Admin',
          2: 'Crew',
          3: 'Viewer'
      };
   

      // Change role_id to role_name
      $('.role-id').each(function() {
          const roleId = $(this).text().trim();
          const roleName = roleMap[roleId] || 'Unknown';
          $(this).text(roleName);
      });

     
  });
</script>
<!-- Help Area: End -->
@endsection
@include('main_owner')