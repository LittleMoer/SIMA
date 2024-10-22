@section('detail_pesanan')
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
        <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header"
            style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
        <div class="container">
            <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item ">
                        <a href="{{ url('/pesanan') }}">Data Pesanan</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="javascript:void(0);">Detail Pesanan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
 
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
                        {{-- Tab Surat Pemesanan --}}
                        <div class="tab-pane fade show active" id="SuratPesanan" role="tabpanel">
                        <div class="container">

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2>Surat Pemesanan {{ $sp->id_sp }}</h2>
                                    <a href="#"
                                        onclick="printPreview('{{ route('view', $sp->id_sp) }}'); return false;"
                                        class="btn btn-primary">
                                        <span class="tf-icons bx bx-printer me-2"></span> Print SP
                                    </a>
                                </div>
                                <script>
                                    function printPreview(url) {
                                        var printWindow = window.open(url, 'printWindow', 'width=800,height=600');
                                        printWindow.onload = function() {
                                            printWindow.print();
                                        };
                                    }
                                </script>

                                <form action="{{ route('detail_pesanan', $sp->id_sp) }}" method="POST">

                                    @csrf
                                    @method('POST')

                                    <!-- Nama Pemesan -->
                                    <div class="row mb-3">
                                        <label for="nama_pemesan" class="col-sm-2 col-form-label form-label">Nama
                                            Pemesan</label>
                                        <div class="col-sm-10 ">
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="nama_pemesan"
                                                    value="{{ $sp->nama_pemesan }}" required
                                                    pattern="[A-Za-z\s']{2,}[0-9]*$"
                                                    title="Harus diawali dengan minimal 2 huruf dan tanda baca yg diperbolehkan hanya berupa '">
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
                                                    value="{{ $sp->no_telppn }}" required pattern="[0-9]*"
                                                    title="Hanya angka yang diperbolehkan dan minimal 10 digit"
                                                    minlength="10" maxlength="13">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PJ Rombongan -->
                                    <div class="row mb-3">
                                        <label for="pj_rombongan" class="col-sm-2 col-form-label form-label">PJ
                                            Rombongan</label>
                                        <div class="col-sm-10 ">
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="pj_rombongan"
                                                    value="{{ $sp->pj_rombongan }}" required
                                                    pattern="[A-Za-z\s']{2,}[0-9]*$"
                                                    title="Harus diawali dengan minimal 2 huruf dan tanda baca yg diperbolehkan hanya berupa '">
                                            </div>
                                        </div>
                                    </div>



                                    <!-- No Telp PJ -->
                                    <div class="row mb-3">
                                        <label for="no_telpps" class="col-sm-2 col-form-label form-label">No Telp PJ</label>
                                        <div class="col-sm-10 ">
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="no_telpps"
                                                    value="{{ $sp->no_telpps }}" required pattern="[0-9]*"
                                                    title="Hanya angka yang diperbolehkan dan minimal 10 digit"
                                                    minlength="10" maxlength="13">
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Tanggal Waktu Berangkat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="tgl_keberangkatan">Tanggal
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
                                    <!-- Tanggal Kepulangan -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="tgl_kepulangan">Tanggal Kepulangan</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="datetime-local" name="tgl_kepulangan_full"
                                                    id="tgl_kepulangan" class="form-control"
                                                    value="{{ $sp->tgl_kepulangan . 'T' . $sp->jam_kepulangan }}"
                                                    aria-describedby="return-datetime-icon" />
                                            </div>
                                            <small id="error-message" style="color: red; display: none;">Tanggal
                                                kepulangan harus lebih besar dari tanggal keberangkatan!</small>
                                        </div>
                                    </div>


                                    <!-- Tujuan-->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="tujuan">Tujuan</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="tujuan" id="tujuan" class="form-control"
                                                    placeholder="Masukkan tujuan" value="{{ $sp->tujuan }}"
                                                    aria-describedby="tujuan" required pattern="[A-Za-z\s]{3,}[0-9]*$"
                                                    title="Harus diisi dengan minimal 3 huruf" />
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
                                                    aria-describedby="pickup-address-icon" required
                                                    pattern="[A-Za-z\s]{3,}[0-9]*$"
                                                    title="Harus diisi dengan minimal 3 huruf" />
                                            </div>
                                        </div>
                                    </div>

                                    <!--Jumlah Armada-->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="jumlah_armada">Jumlah Armada</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="jumlah_armada" id="jumlah_armada"
                                                class="form-control" placeholder="Masukkan jumlah armada (Max 2)"
                                                value="{{ $sp->jumlah_armada }}" aria-label="Jumlah Armada"
                                                min="1" max="2" required attern="^[0-9]+$"
                                                title="Input harus berupa angka, hanya 1 atau 2" />
                                        </div>
                                    </div>

                                    <!--Nilai Kontrak-->

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="nilai_kontrak">Nilai Kontrak 1</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="1" name="nilai_kontrak1"
                                                id="nilai_kontrak1" class="form-control"
                                                placeholder="Masukkan nilai kontrak" value="{{ $sp->nilai_kontrak1 }}"
                                                aria-label="Nilai Kontrak" required />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="nilai_kontrak">Nilai Kontrak 2</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="nilai_kontrak2" id="nilai_kontrak2"
                                                class="form-control" placeholder="Masukkan nilai kontrak"
                                                value="{{ $sp->nilai_kontrak2 }}" aria-label="Nilai Kontrak"
                                                min="0" title="Angka tidak boleh negatif." />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="biaya_tambahan">Biaya Tambahan</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="biaya_tambahan" id="biaya_tambahan"
                                                class="form-control" placeholder="Masukkan biaya tambahan"
                                                value="{{ $sp->biaya_tambahan }}" aria-label="Biaya Tambahan" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="total_biaya">Total Biaya</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="total_biaya" id="total_biaya"
                                                class="form-control" placeholder="Masukkan total biaya"
                                                value="{{ $sp->total_biaya }}" aria-label="Total Biaya" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="uang_muka">Uang Muka</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="uang_muka" id="uang_muka" class="form-control"
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
                                                <select
                                                    class="form-select @error('status_pembayaran') is-invalid @enderror"
                                                    id="status_pembayaran" name="status_pembayaran" required>
                                                    <option value="">-- Pilih Status Pembayaran --</option>
                                                    <option value="1"
                                                        {{ $sp->status_pembayaran == 1 ? 'selected' : '' }}>Lunas</option>
                                                    <option value="2"
                                                        {{ $sp->status_pembayaran == 2 ? 'selected' : '' }}>DP</option>
                                                    <option value="3"
                                                        {{ $sp->status_pembayaran == 3 ? 'selected' : '' }}>Belum DP
                                                    </option>
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
                                        <label for="id_unit_{{ $sj->id_sj }}">Unit:</label>
                                        <select name="id_unit" id="id_unit_{{ $sj->id_sj }}" class="form-select"
                                            required>
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id_unit }}"
                                                    {{ old('id_unit', $sj->id_unit) == $unit->id_unit ? 'selected' : '' }}>
                                                    {{ $unit->nama_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="driver_{{ $sj->id_sj }}">Driver:</label>
                                        <input type="text" name="driver" id="driver_{{ $sj->id_sj }}"
                                            value="{{ old('driver', $sj->driver) }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="codriver_{{ $sj->id_sj }}">Co-Driver:</label>
                                        <input type="text" name="codriver" id="codriver_{{ $sj->id_sj }}"
                                            value="{{ old('codriver', $sj->codriver) }}"
                                            class="form-control">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="catatan_pembayaran">Catatan</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" name="catatan_pembayaran" id="catatan_pembayaran" class="form-control"
                                                placeholder="Masukkan catatan" aria-label="catatan">{{ $sp->catatan_pembayaran }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Button Submit -->
                                    <div class="d-flex justify-content-end mb-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                        {{-- Tab Surat Jalan --}}
                        <div class="tab-pane fade" id="SuratJalan" role="tabpanel">
                            <div class="container">
                                @foreach ($sjs as $index => $sj)
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h2>Surat Jalan {{ $index + 1 }} </h2>
                                        <a href="#"
                                            onclick="printPreview('{{ route('viewSJ', $sj->id_sj) }}'); return false;"
                                            class="btn btn-primary">
                                            <span class="tf-icons bx bx-printer me-2"></span> Print SJ
                                        </a>
                                    </div>

                                    <script>
                                        function printPreview(url) {
                                            var printWindow = window.open(url, 'printWindow', 'width=800,height=600');
                                            printWindow.onload = function() {
                                                printWindow.print();
                                            };
                                        }
                                    </script>
                                    <form method="POST" action="{{ route('pesanan.updateSJ', $sj->id_sj) }}#SuratJalan">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="id_unit_{{ $sj->id_unit }}"
                                                class="col-sm-2 col-form-label form-label">Unit :</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <select class="form-select" name="id_unit" id="id_unit" required>
                                                        <option value="">-- Pilih Armada --</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id_unit }}"
                                                                @if ($unit->id_unit == $sj->id_unit) selected @endif>
                                                                {{ $unit->nama_unit }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kmsebelum_{{ $sj->id_sj }}"
                                                class="col-sm-2 col-form-label form-label">KM Sebelum:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="kmsebelum"
                                                        id="kmsebelum_{{ $sj->id_sj }}"
                                                        value="{{ old('kmsebelum', $sj->kmsebelum) }}"
                                                        class="form-control" 
                                                        min="1" max="1000000000"
                                                        title="Harus berupa angka" 
                                                        pattern="^\d+(\.\d{1,2})?$" 
                                                        step="0.01"              
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kmtiba_{{ $sj->id_sj }}"
                                                class="col-sm-2 col-form-label form-label">KM Tiba:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="kmtiba" id="kmtiba_{{ $sj->id_sj }}"
                                                        value="{{ old('kmtiba', $sj->kmtiba) }}" class="form-control"
                                                        min="1" max="1000000000"
                                                        title="Harus berupa angka" 
                                                        pattern="^\d+(\.\d{1,2})?$" 
                                                        step="0.01"
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kasbonbbm_{{ $sj->id_sj }}"
                                                class="col-sm-2 col-form-label form-label">Kasbon BBM:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="number" name="kasbonbbm"
                                                        id="kasbonbbm_{{ $sj->id_sj }}"
                                                        value="{{ old('kasbonbbm', $sj->kasbonbbm) }}"
                                                        class="form-control"
                                                        min="1" max="1000000000"
                                                        title="Harus berupa angka" 
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kasbonmakan_{{ $sj->id_sj }}"
                                                class="col-sm-2 col-form-label form-label">Kasbon Makan:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="number" name="kasbonmakan"
                                                        id="kasbonmakan_{{ $sj->id_sj }}"
                                                        value="{{ old('kasbonmakan', $sj->kasbonmakan) }}"
                                                        class="form-control"
                                                        min="1" max="1000000000"
                                                        title="Harus berupa angka" 
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lainlain_{{ $sj->id_sj }}"
                                                class="col-sm-2 col-form-label form-label">Lain-lain:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <input type="number" name="lainlain"
                                                        id="lainlain_{{ $sj->id_sj }}"
                                                        value="{{ old('lainlain', $sj->lainlain) }}"
                                                        class="form-control"
                                                        min="1" max="1000000000"
                                                        title="Harus berupa angka" 
                                                        >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2 d-flex justify-content-end mb-3 mt-3">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                        </div>
                                    </form>

                                    <hr>
                                @endforeach
                            </div>

                        </div>

                        {{-- Tab Surat Perintah Jalan --}}
                        <div class="tab-pane fade" id="SuratPerintahJalan" role="tabpanel">
                            <div class="container">
                                @foreach ($spjs as $index => $spj)
                                 @csrf

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h2>Surat Premi Jalan {{ $index + 1 }} </h2>
                                        <a href="#"
                                            onclick="printPreview('{{ route('viewSPJ', $spj->id_spj) }}'); return false;"
                                            class="btn btn-primary">
                                            <span class="tf-icons bx bx-printer me-2"></span> Print SPJ
                                        </a>
                                    </div>

                                    <script>
                                        function printPreview(url) {
                                            var printWindow = window.open(url, 'printWindow', 'width=800,height=600');
                                            printWindow.onload = function() {
                                                printWindow.print();
                                            };
                                        }
                                    </script>

                                    <div class="form-group">
                                        <a href="{{ route('bbm.index', $spj->id_spj) }}" class="btn btn-primary">Konsumsi
                                            BBM</a>

                                    </div>

                                    <form method="POST" action="{{ route('pesanan.updateSPJ', $spj->id_spj) }}#SuratPerintahJalan">
                                    @csrf
                                     @method('PUT')
                                        

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="SaldoEtollawal_{{ $spj->id_sj }} "
                                                        class="col-sm-4 col-form-label form-label">Saldo E-toll
                                                        Awal:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="SaldoEtollawal"
                                                            id="SaldoEtollawal_{{ $spj->id_sj }}"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="SaldoEtollakhir_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Saldo E-toll Akhir:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="SaldoEtollakhir"
                                                            id="SaldoEtollakhir_{{ $spj->id_sj }}"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="PenggunaanToll_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Penggunaan Toll:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="PenggunaanToll"
                                                            id="PenggunaanToll_{{ $spj->id_sj }}"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        for="uanglainlain_{{ $spj->id_sj }}
                                                "
                                                        class="col-sm-4 col-form-label form">Uang Lain-lain:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="uanglainlain"
                                                            id="uanglainlain_{{ $spj->id_sj }}"
                                                            value="{{ old('uanglainlain', $spj->uanglainlain) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="uangmakan_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Uang Makan:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="uangmakan"
                                                            id="uangmakan_{{ $spj->id_sj }}"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class=" col-md-6">
                                                <div class="form-group row">
                                                    <label for="sisabbm_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Sisa BBM:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="sisabbm"
                                                            id="sisabbm_{{ $spj->id_sj }}"
                                                            value="{{ old('sisabbm', $spj->sisabbm) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="totalisibbm_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Total Isi BBM:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="totalisibbm"
                                                            id="totalisibbm_{{ $spj->id_sj }}"
                                                            value="{{ old('totalisibbm', $spj->totalisibbm) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="sisasaku_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Sisa Saku:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="sisasaku"
                                                            id="sisasaku_{{ $spj->id_sj }}"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="totalsisa_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Total Sisa:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="totalsisa"
                                                            id="totalsisa_{{ $spj->id_sj }}"
                                                            value="{{ old('totalsisa', $spj->totalsisa) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
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
    </div>
</section>
<!-- buat otomatis ngisi driver codriver -->
<script>
$(document).ready(function() {
    // Listen for changes on the unit select dropdown
    $('#id_unit_{{ $sj->id_sj }}').on('change', function() {
        var unit_id = $(this).val(); // Get the selected unit ID

        if (unit_id) {
            // Make an AJAX call to fetch the driver and co-driver
            $.ajax({
                url: '/get-driver-codriver/' + unit_id,
                type: 'GET',
                success: function(data) {
                    // Update the driver and co-driver fields with new values
                    $('#driver_{{ $sj->id_sj }}').val(data.driver);
                    $('#codriver_{{ $sj->id_sj }}').val(data.codriver);
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        } else {
            // Clear the fields if no unit is selected
            $('#driver_{{ $sj->id_sj }}').val('');
            $('#codriver_{{ $sj->id_sj }}').val('');
        }
    });

    // Trigger the change event to auto-load the driver/codriver if unit is pre-selected
    $('#id_unit_{{ $sj->id_sj }}').trigger('change');
});
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departureInput = document.getElementById('departure-datetime');
            const returnInput = document.getElementById('return-datetime');

            // Set min attribute for departure date to ensure past dates and times can't be selected
            const now = new Date();
            const formattedDateTime = now.toISOString().slice(0,
                16); // Get current date and time in the format required by datetime-local input
            departureInput.setAttribute('min', formattedDateTime);

            // Automatically show the calendar when input is focused
            departureInput.addEventListener('focus', function() {
                departureInput.showPicker();
            });

            returnInput.addEventListener('focus', function() {
                returnInput.showPicker();
            });

            // Update return date min attribute based on departure date selection
            departureInput.addEventListener('input', function() {
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
            returnInput.addEventListener('input', function() {
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
        const keberangkatanInput = document.getElementById('tgl_keberangkatan');
        const kepulanganInput = document.getElementById('tgl_kepulangan');
        const errorMessage = document.getElementById('error-message');

        function setMinKepulangan() {
            // Set nilai minimum untuk tanggal kepulangan
            kepulanganInput.min = keberangkatanInput.value;
        }

        function validateDates() {
            const keberangkatanDate = new Date(keberangkatanInput.value);
            const kepulanganDate = new Date(kepulanganInput.value);

            if (kepulanganDate <= keberangkatanDate) {
                errorMessage.style.display = 'block'; // Tampilkan pesan error
                kepulanganInput.setCustomValidity('Tanggal kepulangan harus lebih besar dari tanggal keberangkatan.');
            } else {
                errorMessage.style.display = 'none'; // Sembunyikan pesan error
                kepulanganInput.setCustomValidity(''); // Hapus error validasi
            }
        }

        // Event listener untuk set min tanggal kepulangan dan validasi
        keberangkatanInput.addEventListener('change', function() {
            setMinKepulangan();
            validateDates();
        });
        kepulanganInput.addEventListener('change', validateDates);

        // Set min saat halaman pertama kali dimuat
        window.addEventListener('load', setMinKepulangan);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahArmadaInput = document.getElementById('jumlah_armada');
            const nilaiKontrak1 = document.getElementById('nilai_kontrak1');
            const nilaiKontrak2 = document.getElementById('nilai_kontrak2');
            const biayaTambahan = document.getElementById('biaya_tambahan');
            const totalBiaya = document.getElementById('total_biaya');
            const uangMuka = document.getElementById('uang_muka');
            const sisaPembayaran = document.getElementById('sisa_pembayaran');

            // Function to update nilaiKontrak2 state
            function updateNilaiKontrak2State(jumlahArmada) {
                if (jumlahArmada == 1) {
                    nilaiKontrak2.value = 0;
                    nilaiKontrak2.disabled = true;
                    nilaiKontrak2.required = false;
                    localStorage.setItem('nilaiKontrak2Disabled', 'true');
                    localStorage.setItem('jumlahArmada', '1');
                } else if (jumlahArmada == 2) {
                    nilaiKontrak2.disabled = false;
                    nilaiKontrak2.required = true;
                    localStorage.setItem('nilaiKontrak2Disabled', 'false');
                    localStorage.setItem('jumlahArmada', '2');
                }
                nilaiKontrak2.dispatchEvent(new Event('input'));
            }

            // Check localStorage on page load and set initial state
            const savedJumlahArmada = localStorage.getItem('jumlahArmada');
            if (savedJumlahArmada) {
                jumlahArmadaInput.value = savedJumlahArmada;
                updateNilaiKontrak2State(savedJumlahArmada);
            }

            // Event listener for jumlah_armada changes
            jumlahArmadaInput.addEventListener('input', function() {
                updateNilaiKontrak2State(this.value);
            });

            function calculateTotal() {
                const kontrak1 = parseFloat(nilaiKontrak1.value) || 0;
                const kontrak2 = parseFloat(nilaiKontrak2.value) || 0;
                const tambahan = parseFloat(biayaTambahan.value) || 0;

                const total = kontrak1 + kontrak2 + tambahan;
                totalBiaya.value = total;

                calculateSisa(total);
            }

            function calculateSisa(total) {
                const uangMukaValue = parseFloat(uangMuka.value) || 0;
                sisaPembayaran.value = total - uangMukaValue;
            }

            // Event listeners for calculation
            nilaiKontrak1.addEventListener('input', calculateTotal);
            nilaiKontrak2.addEventListener('input', calculateTotal);
            biayaTambahan.addEventListener('input', calculateTotal);
            uangMuka.addEventListener('input', function() {
                const total = parseFloat(totalBiaya.value) || 0;
                calculateSisa(total);
            });

            // Initial calculation
            calculateTotal();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.nav-link');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-bs-target');
                    if (targetId) {
                        history.pushState(null, null, targetId);
                    }
                });
            });

            // Handle URL hash on page load
            const hash = window.location.hash;
            if (hash) {
                const targetTab = document.querySelector(`.nav-link[data-bs-target="${hash}"]`);
                if (targetTab) {
                    const tab = new bootstrap.Tab(targetTab);
                    tab.show();
                }
            }
        });
    </script>
    @if (session('success'))
        <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
            <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <div class="me-auto fw-semibold"> ✓ Data Pesanan</div>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <!-- Script untuk menghilangkan toast setelah beberapa detik -->
        <script>
            setTimeout(function() {
                var toastElement = document.getElementById('successToast');
                if (toastElement) {
                    toastElement.style.display = 'none'; // Menghilangkan toast
                }
            }, 2500);
        </script>
    @endif
@endsection

@include('main_owner')
