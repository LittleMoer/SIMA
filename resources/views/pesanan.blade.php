@section('data_sp')
<script>
    function toggleCustomMethod() {
        const select = document.getElementById('metode-pembayaran');
        const customMethod = document.getElementById('custom-method');
        const selectedValue = select.options[select.selectedIndex].value;
        if (selectedValue === 'lainnya') {
            customMethod.style.display = 'block';
            select.style.display = 'none';
        } else {
            customMethod.style.display = 'none';
            select.style.display = 'block';
        }
    }

</script>
<!-- Header : Start -->
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center"> Data Pesanan</h3>
    <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan data pesanan</h5>
</section>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Header: End -->

<!-- Data SP: Start -->
<!-- Manajemen Akun: Start -->
<section id="landingFunFacts">
    <!-- DataTable with Buttons -->
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-akun" aria-controls="navs-justified-akun"
                            aria-selected="true">
                            <i class="tf-icons bx bx-user"></i> Data Pesanan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-generate" aria-controls="navs-justified-generate"
                            aria-selected="false">
                            <i class="tf-icons bx bxs-user-plus"></i> Generate Data Pesanan
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-justified-akun" role="tabpanel">
                        <div class="card-datatable table-responsive">
                            <table id="accountTable" class="datatables-basic table border-top">
                                <thead>
                                    <tr>
                                        <th>Id Pesanan</th>
                                        <th>Nama Pesanan</th>
                                        <th>PJ Rombongan</th>
                                        <th>Tanggal Keberangkatan</th>
                                        <th>Tujuan</th>
                                        <th>Alamat Penjemputan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sp as $order)
                                        <tr>
                                            <td>{{ $order->id_sp }}</td>
                                            <td>{{ $order->nama_pemesan }}</td>
                                            <td>{{ $order->pj_rombongan }}</td>
                                            <td>{{ $order->tgl_keberangkatan }}</td>
                                            <td>{{ $order->tujuan }}</td>
                                            <td>{{ $order->alamat_penjemputan }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop"
                                                    aria-controls="offcanvasBackdrop"
                                                    data-name="{{ $order->nama_pemesan }}"
                                                    data-email="{{ $order->email }}"
                                                    data-role="{{ $order->role_id }}">Edit</button>
                                                <form
                                                    action="{{ route('order.destroy', $order->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-generate" role="tabpanel">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form id="createorder" action="{{ route('order.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname">Nama Pemesan </label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nama_pemesan"
                                                        id="nama_pemesan" placeholder="JohnDoe" aria-label="JohnDoe"
                                                        aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">No
                                                Telp Pemesan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="no_telppn" id="no_telppn"
                                                        class="form-control" placeholder="083169251172"
                                                        aria-label="083169251172" aria-describedby="2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-icon-default-role">PJ
                                                Rombongan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="pj_rombongan" id="pj_rombongan"
                                                        class="form-control" placeholder="Masukkan Nama Pj Rombongan"
                                                        aria-describedby="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">No Telp
                                                PJ</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="no_telpps" id="no_telpps"
                                                        class="form-control phone-mask" placeholder="658 799 8941"
                                                        aria-label="658 799 8941"
                                                        aria-describedby="basic-icon-default-phone2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 form-label" for="departure-datetime">Tanggal Waktu
                                                Keberangkatan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="datetime-local" name="tgl_keberangkatan_full"
                                                        id="tgl_keberangkatan" class="form-control"
                                                        aria-describedby="departure-datetime-icon" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 form-label" for="return-datetime">Tanggal Waktu
                                                Kepulangan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="datetime-local" name="tgl_kepulangan_full"
                                                        id="tgl_kepulangan" class="form-control"
                                                        aria-describedby="return-datetime-icon" />
                                                </div>
                                            </div>
                                        </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="tujuan">Tujuan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="tujuan" id="tujuan" class="form-control"
                                                placeholder="Masukkan tujuan" aria-describedby="tujuan" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="pickup-address">Alamat Penjemputan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="pickup-address-icon" class="input-group-text"><i
                                                    class="bx bx-map"></i></span>
                                            <input type="text" name="alamat_penjemputan" id="alamat_penjemputan"
                                                class="form-control" placeholder="Masukkan alamat penjemputan"
                                                aria-describedby="pickup-address-icon" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="jumlah-armada">Jumlah Armada</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="jumlah_armada" id="jumlah_armada"
                                            class="form-control" placeholder="Masukkan jumlah armada"
                                            aria-label="Jumlah Armada" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="nilai-kontrak1">Nilai Kontrak 1</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nilai_kontrak1" id="nilai_kontrak1" class="form-control"
                                            placeholder="Masukkan nilai kontrak 1" aria-label="Nilai Kontrak" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="nilai-kontrak2">Nilai Kontrak 2</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nilai_kontrak2" id="nilai_kontrak2" class="form-control"
                                            placeholder="Masukkan nilai kontrak 2" aria-label="Nilai Kontrak" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="biaya-tambahan">Biaya Tambahan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="biaya_tambahan" id="biaya_tambahan"
                                            class="form-control" placeholder="Masukkan biaya tambahan"
                                            aria-label="Biaya Tambahan" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="total-biaya">Total Biaya</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="total_biaya" id="total_biaya" class="form-control"
                                            placeholder="Masukkan total biaya" aria-label="Total Biaya" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="uang-muka">Uang Muka</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="uang_muka" id="uang_muka" class="form-control"
                                            placeholder="Masukkan uang muka" aria-label="Uang Muka" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status_pembayaran">Status
                                        Pembayaran</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                    class="bx bx-money"></i></span>
                                            <select class="form-select @error('status_pembayaran') is-invalid @enderror"
                                                id="status-pembayaran" name="status_pembayaran" required
                                                onchange="toggleCustomMethod()">
                                                <option value="">-- Pilih Status Pembayaran --</option>
                                                <option value="1"
                                                    {{ old('status_pembayaran') == 1 ? 'selected' : '' }}>
                                                    Lunas</option>
                                                <option value="2"
                                                    {{ old('status_pembayaran') == 2 ? 'selected' : '' }}>
                                                    DP</option>
                                                <option value="3"
                                                    {{ old('status_pembayaran') == 3 ? 'selected' : '' }}>
                                                    Belum DP</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="sisa_pembayaran">Sisa Pembayaran</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sisa_pembayaran" id="sisa_pembayaran"
                                            class="form-control" placeholder="Sisa pembayaran"
                                            aria-label="Sisa Pembayaran" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="metode_pembayaran">Metode Pembayaran</label>
                                    <div class="col-sm-10">
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                                            <option value="cash">Cash</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="credit_card">Kartu Kredit</option>
                                            <!-- Tambahkan opsi lainnya jika diperlukan -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="catatan_pembayaran">Catatan</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="catatan_pembayaran" id="catatan_pembayaran"
                                            class="form-control" placeholder="Masukkan catatan"
                                            aria-label="catatan"></textarea>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Data SP: End -->

<!-- Help Area: Start -->
<section class="section-py bg-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                <h3>Terdapat Kendala?</h3>
                <p class="mb-3"> Hubungi jika terdapat kendala dalam sistem ini.<br /> Hubungi kami selama jam kerja
                    atau kirim email kapan saja, dan kami akan merespon secepat mungkin. </p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="javascript:void(0);" class="btn btn-primary">Email</a>
                    <a href="javascript:void(0);" class="btn btn-primary">Whats App</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Help Area: End -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departureInput = document.getElementById('departure-datetime');
        const returnInput = document.getElementById('return-datetime');

        // Set min attribute for departure date to ensure past dates and times can't be selected
        const now = new Date();
        const formattedDateTime = now.toISOString().slice(0,
            16); // Get current date and time in the format required by datetime-local input
        departureInput.setAttribute('min', formattedDateTime);

        // Automatically show the calendar when input is focused
        departureInput.addEventListener('focus', function () {
            departureInput.showPicker();
        });

        returnInput.addEventListener('focus', function () {
            returnInput.showPicker();
        });

        // Update return date min attribute based on departure date selection
        departureInput.addEventListener('input', function () {
            const selectedDepartureDateTime = new Date(departureInput.value);
            if (selectedDepartureDateTime < now) {
                alert('Tanggal dan waktu keberangkatan tidak boleh kurang dari hari ini');
                departureInput.value = ''; // Reset the input
            } else {
                // Set the min attribute of the return date input to be the same as the selected departure date and time
                returnInput.setAttribute('min', departureInput.value);
            }
        });

        // Custom validation for return date
        returnInput.addEventListener('input', function () {
            const selectedReturnDateTime = new Date(returnInput.value);
            const selectedDepartureDateTime = new Date(departureInput.value);
            if (selectedReturnDateTime < selectedDepartureDateTime) {
                alert(
                    'Tanggal dan waktu kepulangan tidak boleh kurang dari tanggal dan waktu keberangkatan'
                    );
                returnInput.value = ''; // Reset the input
            }
        });
    });

</script>
<script>

</script>



@endsection

@include('main_owner')
