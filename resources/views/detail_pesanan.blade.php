@section('detail_pesanan')

<!-- Header : Start -->
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center"> Detail Pesanan</h3>
    <h5 class="text-center px-3 mb-0">Lihat detail Surat Pesanan, Surat Jalan serta Surat Perintah Jalan</h5>
</section>

<section>
    {{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif--}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12">

            <div class="nav-align-top">

                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#SuratPesanan" aria-controls="SuratPesanan" aria-selected="true">
                            <i class="tf-icons bx bx-file"></i> Surat Pesanan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#SuratJalan" aria-controls="SuratJalan" aria-selected="false">
                            <i class="tf-icons bx bx-file"></i> Surat Jalan
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#SuratPerintahJalan" aria-controls="SuratPerintahJalan"
                            aria-selected="false">
                            <i class="tf-icons bx bx-file"></i> Surat Perintah Jalan
                        </button>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="SuratPesanan" role="tabpanel">
                        <div class="container">

                            <h2>Edit Surat Pesanan</h2>
                            <form action="{{ route('updateSP', $sp->id_sp) }}" method="POST">
                                @csrf
                                <!-- Nama Pemesan -->
                                <div class="row mb-3">
                                    <label for="nama_pemesan" class="col-sm-2 col-form-label form-label">Nama
                                        Pemesan</label>
                                    <div class="col-sm-10 ">
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="nama_pemesan"
                                                value="{{ $sp->nama_pemesan }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- No Telp Pemesan -->
                                <div class="row mb-3">
                                    <label for="no_telppn" class="col-sm-2 col-form-label form-label">No Telp
                                        Pemesan</label>
                                    <div class="col-sm-10 ">
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="no_telppn"
                                                value="{{ $sp->no_telppn }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- PJ Rombongan -->
                                <div class="row mb-3">
                                    <label for="no_telpps" class="col-sm-2 col-form-label form-label">PJ
                                        Rombongan</label>
                                    <div class="col-sm-10 ">
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="no_telpps"
                                                value="{{ $sp->no_telpps }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- No Telp PJ -->
                                <div class="row mb-3">
                                    <label for="no_telpps" class="col-sm-2 col-form-label form-label">PJ
                                        Rombongan</label>
                                    <div class="col-sm-10 ">
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="pj_rombongan"
                                                value="{{ $sp->pj_rombongan }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Tanggal Waktu Berangkat -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="tgl_keberangkatan">Tanggal Waktu
                                        Berangkat</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="datetime-local" name="tgl_keberangkatan_full"
                                                id="tgl_keberangkatan" class="form-control"
                                                value="{{ $sp->tgl_keberangkatan . 'T' . $sp->jam_keberangkatan }}"
                                                aria-describedby="departure-datetime-icon" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Tanggal Waktu Kepulangan -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="tgl_kepulangan">Tanggal Waktu
                                        Kepulangan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="datetime-local" name="tgl_kepulangan_full" id="tgl_kepulangan"
                                                class="form-control"
                                                value="{{ $sp->tgl_kepulangan . 'T' . $sp->jam_kepulangan }}"
                                                aria-describedby="return-datetime-icon" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Tujuan-->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="tujuan">Tujuan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="tujuan" id="tujuan" class="form-control"
                                                placeholder="Masukkan tujuan" value="{{ $sp->tujuan }}"
                                                aria-describedby="tujuan" />
                                        </div>
                                    </div>
                                </div>
                                <!--Alamat Penjemputan-->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="alamat_penjemputan">Alamat
                                        Penjemputan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="pickup-address-icon" class="input-group-text"><i
                                                    class="bx bx-map"></i></span>
                                            <input type="text" name="alamat_penjemputan" id="alamat_penjemputan"
                                                class="form-control" placeholder="Masukkan alamat penjemputan"
                                                value="{{ $sp->alamat_penjemputan }}"
                                                aria-describedby="pickup-address-icon" />
                                        </div>
                                    </div>
                                </div>
                                <!--Jumlah Armada-->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="jumlah_armada">Jumlah Armada</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="jumlah_armada" id="jumlah_armada"
                                            class="form-control" placeholder="Masukkan jumlah armada"
                                            value="{{ $sp->jumlah_armada }}" aria-label="Jumlah Armada" />
                                    </div>
                                </div>
                                <!--Nilai Kontrak-->
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="nilai_kontrak">Nilai Kontrak 1</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nilai_kontrak1" id="nilai_kontrak1"
                                            class="form-control" placeholder="Masukkan nilai kontrak"
                                            value="{{ $sp->nilai_kontrak1 }}" aria-label="Nilai Kontrak" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="nilai_kontrak">Nilai Kontrak 2</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nilai_kontrak2" id="nilai_kontrak2"
                                            class="form-control" placeholder="Masukkan nilai kontrak"
                                            value="{{ $sp->nilai_kontrak2 }}" aria-label="Nilai Kontrak" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="biaya_tambahan">Biaya Tambahan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="biaya_tambahan" id="biaya_tambahan"
                                            class="form-control" placeholder="Masukkan biaya tambahan"
                                            value="{{ $sp->biaya_tambahan }}" aria-label="Biaya Tambahan" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="total_biaya">Total Biaya</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="total_biaya" id="total_biaya" class="form-control"
                                            placeholder="Masukkan total biaya" value="{{ $sp->total_biaya }}"
                                            aria-label="Total Biaya" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="uang_muka">Uang Muka</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="uang_muka" id="uang_muka" class="form-control"
                                            placeholder="Masukkan uang muka" value="{{ $sp->uang_muka }}"
                                            aria-label="Uang Muka" />
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
                                                id="status_pembayaran" name="status_pembayaran" required>
                                                <option value="">-- Pilih Status Pembayaran --</option>
                                                <option value="1"
                                                    {{ $sp->status_pembayaran == 1 ? 'selected' : '' }}>
                                                    Lunas</option>
                                                <option value="2"
                                                    {{ $sp->status_pembayaran == 2 ? 'selected' : '' }}>
                                                    DP</option>
                                                <option value="3"
                                                    {{ $sp->status_pembayaran == 3 ? 'selected' : '' }}>
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
                                            value="{{ $sp->sisa_pembayaran }}" aria-label="Sisa Pembayaran" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="metode_pembayaran">Metode Pembayaran</label>
                                    <div class="col-sm-10">
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                                            <option value="cash"
                                                {{ $sp->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                                Cash</option>
                                            <option value="transfer"
                                                {{ $sp->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                                Transfer</option>
                                            <option value="credit_card"
                                                {{ $sp->metode_pembayaran == 'credit_card' ? 'selected' : '' }}>
                                                Kartu Kredit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="catatan_pembayaran">Catatan</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" name="catatan_pembayaran" id="catatan_pembayaran"
                                            class="form-control" placeholder="Masukkan catatan"
                                            aria-label="catatan">{{ $sp->catatan_pembayaran }}</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mb-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="SuratJalan" role="tabpanel">
                        <div class="container">
                            <h2>Edit Surat Jalan</h2>
                            @foreach($sjs as $index => $sj)
                                <h3>Surat Jalan {{ $index + 1 }}</h3>
                                <form method="POST"
                                    action="{{ route('updateSJ', $sj->id_sj) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="id_unit">Unit:</label>
                                        <select name="id_unit" id="id_unit" class="form-control" required>
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ old('id_unit', $sj->id_unit) == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->nama_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="driver">Driver:</label>
                                        <input type="text" name="driver" id="driver"
                                            value="{{ old('driver', $sj->driver) }}"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="codriver">Co-Driver:</label>
                                        <input type="text" name="codriver" id="codriver"
                                            value="{{ old('codriver', $sj->codriver) }}"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="kmsebelum_{{ $sj->id_sj }}">KM Sebelum:</label>
                                        <input type="text" name="kmsebelum" id="kmsebelum_{{ $sj->id_sj }}"
                                            value="{{ old('kmsebelum', $sj->kmsebelum) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="kmtiba_{{ $sj->id_sj }}">KM Tiba:</label>
                                        <input type="text" name="kmtiba" id="kmtiba_{{ $sj->id_sj }}"
                                            value="{{ old('kmtiba', $sj->kmtiba) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="kasbonbbm_{{ $sj->id_sj }}">Kasbon BBM:</label>
                                        <input type="text" name="kasbonbbm" id="kasbonbbm_{{ $sj->id_sj }}"
                                            value="{{ old('kasbonbbm', $sj->kasbonbbm) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="kasbonmakan_{{ $sj->id_sj }}">Kasbon Makan:</label>
                                        <input type="text" name="kasbonmakan" id="kasbonmakan_{{ $sj->id_sj }}"
                                            value="{{ old('kasbonmakan', $sj->kasbonmakan) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="lainlain_{{ $sj->id_sj }}">Lain-lain:</label>
                                        <input type="text" name="lainlain" id="lainlain_{{ $sj->id_sj }}"
                                            value="{{ old('lainlain', $sj->lainlain) }}"
                                            class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="SuratPerintahJalan" role="tabpanel">
                        <div class="container">
                            <h2>Edit Surat Premi Jalan</h2>
                            @foreach($spjs as $index => $spj)
                                @csrf
                                <h3>Surat Premi Jalan {{ $index + 1 }}</h3>

                                <div class="form-group">
                                    <a href="{{ route('bbm.index', $spj->id_spj) }}"
                                        class="btn btn-primary">Konsumsi BBM</a>

                                </div>

                                <form method="POST"
                                    action="{{ route('updateSPJ', $spj->id_sj) }}">

                                    <div class="form-group">
                                        <label for="SaldoEtollawal_{{ $spj->id_sj }}">Saldo E-toll Awal:</label>
                                        <input type="text" name="SaldoEtollawal" id="SaldoEtollawal_{{ $spj->id_sj }}"
                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="SaldoEtollakhir_{{ $spj->id_sj }}">Saldo E-toll Akhir:</label>
                                        <input type="text" name="SaldoEtollakhir"
                                            id="SaldoEtollakhir_{{ $spj->id_sj }}"
                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="PenggunaanToll_{{ $spj->id_sj }}">Penggunaan Toll:</label>
                                        <input type="text" name="PenggunaanToll" id="PenggunaanToll_{{ $spj->id_sj }}"
                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="uanglainlain_{{ $spj->id_sj }}">Uang Lain-lain:</label>
                                        <input type="text" name="uanglainlain" id="uanglainlain_{{ $spj->id_sj }}"
                                            value="{{ old('uanglainlain', $spj->uanglainlain) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="uangmakan_{{ $spj->id_sj }}">Uang Makan:</label>
                                        <input type="text" name="uangmakan" id="uangmakan_{{ $spj->id_sj }}"
                                            value="{{ old('uangmakan', $spj->uangmakan) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="sisabbm_{{ $spj->id_sj }}">Sisa BBM:</label>
                                        <input type="text" name="sisabbm" id="sisabbm_{{ $spj->id_sj }}"
                                            value="{{ old('sisabbm', $spj->sisabbm) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="totalisibbm_{{ $spj->id_sj }}">Total Isi BBM:</label>
                                        <input type="text" name="totalisibbm" id="totalisibbm_{{ $spj->id_sj }}"
                                            value="{{ old('totalisibbm', $spj->totalisibbm) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="sisasaku_{{ $spj->id_sj }}">Sisa Saku:</label>
                                        <input type="text" name="sisasaku" id="sisasaku_{{ $spj->id_sj }}"
                                            value="{{ old('sisasaku', $spj->sisasaku) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="totalsisa_{{ $spj->id_sj }}">Total Sisa:</label>
                                        <input type="text" name="totalsisa" id="totalsisa_{{ $spj->id_sj }}"
                                            value="{{ old('totalsisa', $spj->totalsisa) }}"
                                            class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <hr>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- buat otomatis ngisi driver codriver -->
<script>
    $('#id_unit').change(function () {
        var unit_id = $(this).val();
        if (unit_id) {
            $.ajax({
                url: '/get-driver-codriver/' + id_unit,
                type: 'GET',
                success: function (data) {
                    $('#driver').val(data.driver);
                    $('#codriver').val(data.codriver);
                }
            });
        } else {
            $('#driver').val('');
            $('#codriver').val('');
        }
    });

</script>

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
