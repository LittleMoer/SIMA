@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
<img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <div class="container">
        <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">
                    <a href="{{ url()->previous() }}">Rekap Gaji Crew</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Rekap gaji Karyawan dan Crew</a>
                </li>
            </ol>
        </nav>
    </div>
</section>

<section>
    <div class="container">
        <h3>Rekap Gaji Crew</h3>
        <h4>Armada: {{ $armada->unit->nama_unit }}</h4>
        <h4>Nama: {{ $armada->akun->name }}</h4>

        @if($rekapGajiCrew->count())
            <form action="{{ route('rekap.gaji.update') }}" method="POST"> <!-- Action points to the update route -->
                @csrf
                <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">
                <input type="hidden" name="insentif" value="{{ old('insentif', $insentif) }}"> <!-- Include insentif -->

                <table class="v-table v-theme--light v-table--density-compact align-items-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah Hari</th>
                            <th>Nama Pekerjaan</th>
                            <th>Nilai Kontrak</th>
                            <th>BBM</th>
                            <th>Uang Makan</th>
                            <th>Parkir</th>
                            <th>Cuci</th>
                            <th>Tol</th>
                            <th>Total Operasional</th>
                            <th>Sisa Nilai Kontrak</th>
                            <th>Premi</th>
                            <th>Subsidi</th>
                            <th>Total Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekapGajiCrew as $gaji)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="date" name="data[{{ $loop->index }}][tanggal]" value="{{ $gaji->tanggal }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][hari_kerja]" value="{{ $gaji->hari_kerja }}" class="form-control"></td>
                                <td><input type="text" name="data[{{ $loop->index }}][pj_rombongan]" value="{{ $gaji->pj_rombongan }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][nilai_kontrak]" value="{{ $gaji->nilai_kontrak }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][bbm]" value="{{ $gaji->bbm }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][uang_makan]" value="{{ $gaji->uang_makan }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][parkir]" value="{{ $gaji->parkir }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][cuci]" value="{{ $gaji->cuci }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][toll]" value="{{ $gaji->toll }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][total_operasional]" value="{{ $gaji->total_operasional }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][sisa_nilai_kontrak]" value="{{ $gaji->sisa_nilai_kontrak }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][premi]" value="{{ $gaji->premi }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][subsidi]" value="{{ $gaji->subsidi }}" class="form-control"></td>
                                <td><input type="number" name="data[{{ $loop->index }}][total_gaji]" value="{{ $gaji->total_gaji }}" class="form-control"></td>
                                <input type="hidden" name="data[{{ $loop->index }}][id_rekapgajicrew]" value="{{ $gaji->id_rekapgajicrew }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class = "col-md-2">
                <button type="submit" class="btn btn-secondary">Save All Changes</button> <!-- Button to submit all changes -->
                </div>
            </form>

        @else
            <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</section>

@if(session('success'))
    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="me-auto fw-semibold"> ✓ Data Rekap Gaji</div>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>

    <!-- Script untuk menghilangkan toast setelah beberapa detik -->
<script>
        setTimeout(function () {
            var toastElement = document.getElementById('successToast');
            if (toastElement) {
                toastElement.style.display = 'none'; // Menghilangkan toast
            }
        }, 2500);

</script>
@endif
@if($errors->any())
    <div id="errorToast" style="position: fixed; top: 80px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto fw-semibold">✖ Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Script to hide error toast after a few seconds -->
<script>
        setTimeout(function () {
            var toastElement = document.getElementById('errorToast');
            if (toastElement) {
                toastElement.style.display = 'none'; // Hide error toast
            }
        }, 2500);
</script>
@endif
@endsection

@include('main_owner')