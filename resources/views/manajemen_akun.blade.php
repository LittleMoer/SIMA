@section('manajemen_akun')

<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
    <h3 class="text-center">Manajemen Akun</h3>
    <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan manajemen akun</h5>
</section>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Manajemen Akun: Start -->
<section>
    <!-- DataTable with Buttons -->
    <div style="padding: 30px 60px">
        <div class="no_print d-flex justify-content mb-4">
            <a href="{{ route('tambah_akun') }}" class="btn btn-primary">
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
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td class="role-id">{{ $user->role_id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop" data-id="{{ $user->id_akun }}" data-name="{{ $user->name }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}" data-role="{{ $user->role_id }}">Edit</button>
                            
                            <form action="{{ route('users.destroy', $user->id_akun) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- Manajemen Akun: End -->

<style type="text/css" media="print"> 
    div.no_print {display: none;} 
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

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
@endsection

@include('main_owner')

<!-- Offcanvas Edit Form -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBackdropLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="editUserForm" method="POST">
            @csrf
            @method('POST')
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Name</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="username">Username</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="john.doe" />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@gmail.com" />
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
                            <option value="1">Admin</option>
                            <option value="2">Crew</option>
                            <option value="3">Viewer</option>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const form = document.getElementById('editUserForm');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const role = this.getAttribute('data-role');

                // Fill the form with data from the table
                form.querySelector('#name').value = name;
                form.querySelector('#username').value = username;
                form.querySelector('#email').value = email;
                form.querySelector('#role_id').value = role;

                // Update the form's action URL with the correct user ID
                form.action = `{{ url('/manajemen_akun') }}/${id}`;
            });
        });
    });
</script>
