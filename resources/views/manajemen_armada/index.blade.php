
@section('manajemen_armada')
  
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center">Manajemen Crew </h3>
  <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan, manajemen Crew</h5>
</section>

<!-- Manajemen Armada: Start -->
<section>
    <div class="container mt-4">
        <h2>Daftar Crew</h2>
    
        <!-- Add Armada Button -->
        <a href="{{ route('manajemen_armada.create') }}" class="btn btn-primary mb-3"><i class='bx bx-user-plus'></i>Tambah Crew</a>

        @if($armadas->count())
            <table class="datatables-basic table border-top" id="myTable">
                <thead>
                    <tr>
                        <th>Nama Crew</th>
                        <th>Unit</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($armadas as $armada)
                        <tr>
                            <td>{{ $armada->akun->name }}</td>
                            <td>{{ $armada->unit->nama_unit }}</td>
                            <td>{{ $armada->posisi }}</td>
                            <td>{{ $armada->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('manajemen_armada.edit', $armada->id_armada) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('manajemen_armada.destroy', $armada->id_armada) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this armada?')">Delete</button>
                                </form>
                                <!-- Rekap Gaji Armada -->
                                <a href="{{ route('manajemen_armada.rekap_gaji', $armada->id_armada) }}" class="btn btn-sm btn-info">Rekap Gaji</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Tidak ada Crew yang ditemukan.</p>
        @endif
    </div>
</section>

@include('main_owner')

<!-- CSS for print -->
<style type="text/css" media="print"> 
    div.no_print {display: none;} 
</style>

<link href="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.css" rel="stylesheet">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.1.4/datatables.min.js"></script>

<!-- Script for DataTables and Role Mapping -->
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#myTable').DataTable({
            language: {
                info: 'Halaman _PAGE_ dari _PAGES_',
                infoEmpty: 'Data tidak ditemukan',
                infoFiltered: '(filter dari _MAX_ total data)',
                lengthMenu: 'Filter _MENU_ data per halaman',
                zeroRecords: 'Tidak ditemukan'
            }
        });
    });

</script>

  

