
@section('manajemen_akun')
  
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center">Manajemen Akun </h3>
  <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan manajemen akun</h5>
</section>

<!-- Manajemen Akun: Start -->
<section>
  <!-- DataTable with Buttons -->
<div style="padding: 30px 60px">

<div class="no_print d-flex justify-content mb-4">  
              
                <a href="{{ route('manajemen_akun') }}" class="btn btn-primary">
                  <span class="tf-icons bx bxs-user-plus me-2"></span>Tambah Akun
                </a>
  
              </div> 
              <table id="accountTable" class="row-border">
                <thead>
                  <tr>
                      <th>NO</th>
                      <th>NAMA</th>
                      <th>USERNAME</th>
                      <th>ROLE</th>
                      <th>EMAIL</th>
                      <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($akuns as $akun)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $akun->name }}</td>
                          <td>{{ $akun->username }}</td>
                          <td class="role-id">{{ $akun->role_id }}</td>
                          <td>{{ $akun->email }}</td>
                          <td>
<<<<<<< HEAD
                              <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop" data-name="{{ $akun->name }}" data-email="{{ $akun->email }}"  data-role="{{ $akun->role_id  }}"  >Edit</button>                              
                              <button class="btn btn-danger btn-sm">Delete</button>

=======
                              <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop" data-name="{{ $user->name }}" data-email="{{ $user->email }}"  data-role="{{ $user->role_id  }}"  >Edit</button>                              
                              <button class="btn btn-danger btn-sm">Delete</button>
<<<<<<< HEAD
>>>>>>> parent of bbf575d (manajemen akun)
=======
>>>>>>> parent of bbf575d (manajemen akun)
                          </td>
                      </tr>

                  @endforeach
                  
                  </tbody>
              </table>



</div>
  <!--/ DataTable with Buttons -->
</section>

<!-- Manajemen Akun: End -->

<!-- Help Area: Start -->
<section class="section-py bg-body">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 text-center">
        <h3>Terdapat Kendala?</h3>
        <p class="mb-3">Hubungi jika terdapat kendala dalam sistem ini.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
          <a href="https://wa.me/6281235177505" class="btn btn-primary">WhatsApp</a>
        </div>
      </div>
    </div>
  </div>
</section>
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
          1: 'Pemilik',
          2: 'Admin',
          3: 'Viewer',
          4: 'Crew'
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
  <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasBackdropLabel">Edit User</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form id="editUserForm" action="{{ route('users.update', ['username' => $akun->username]) }}" method="POST">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="name">Name</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                      <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                  </div>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="email">Email</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input type="text" name="email" id="email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                  </div>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="role_id">Role</label>
              <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user-pin"></i></span>
                      <select class="form-select" id="role_id" name="role_id" required>
                          <option value="">-- Pilih Role --</option>
                          <option value="2">Admin</option>
                          <option value="3">Viewer</option>
                          <option value="4">Crew</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </div>
      </form>
  </div>
</div>
<style type="text/css" media="print"> 
  div.no_print {display: none; } 
</style>  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
 <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>  
  
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
  
<script type="text/javascript">
$(document).ready(function(){
 $("#mytable").DataTable();                 
});  
</script>  
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const editButtons = document.querySelectorAll('.edit-btn');
      const form = document.getElementById('editUserForm');
      
      editButtons.forEach(button => {
          button.addEventListener('click', function () {
              const name = this.getAttribute('data-name');
              const email = this.getAttribute('data-email');
              const role = this.getAttribute('data-role');
              const username = this.getAttribute('data-username');
  
              // Mengisi form dengan data dari tabel
              form.querySelector('#name').value = name;
              form.querySelector('#email').value = email;
              form.querySelector('#role_id').value = role;
              form.querySelector('#username').value = username;
  
              // Mengupdate action form dengan username yang diambil dari data-atribut
              form.action = `{{ url('/manajemen_akun') }}/${username}`;
          });
      });
  });
  </script>
  

