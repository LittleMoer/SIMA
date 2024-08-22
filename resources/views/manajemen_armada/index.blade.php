
@section('manajemen_armada')
  
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center">Manajemen Armada </h3>
  <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan, manajemen armada</h5>
</section>

<!-- Manajemen Armada: Start -->
<section>
    <div class="container">
        <h2>Daftar Armada</h2>
        
        <form action="{{ route('manajemen_armada.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama crew..." value="{{ old('search', $query) }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Add Armada Button -->
        <a href="{{ route('manajemen_armada.create') }}" class="btn btn-primary mb-3">Tambah Armada</a>

        @if($armadas->count())
            <table class="datatables-basic table border-top">
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
                            <td>{{ $armada->unit->nama_unit }}</td> <!-- Assuming 'nama_unit' is the column in the 'unit' table -->
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
                                <button type="button" class="btn btn-sm btn-info">Rekap Gaji</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Tidak ada armada yang ditemukan.</p>
        @endif
    </div>
</section>

@include('main_owner')

  

