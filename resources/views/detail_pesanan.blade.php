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

                                    <a href="https://wa.me/{{ '62' . ltrim($sp->no_telppn, '0') }}?text=Check%20this%20link:%20{{ urlencode(route('view', $sp->id_sp)) }}" 
                                        class="btn btn-success" 
                                        target="_blank">
                                        <span class="tf-icons bx bx-send me-2"></span> Send to WhatsApp
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

                                <form action="{{ route('detail_pesanan', $sp->id_sp) }}" method="POST" data-type="SP" data-id="{{ $sp->id_sp }}" class="form-update">

                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">

                                            <!-- Nama Pemesan -->
                                            <div class="row mb-3">
                                                <label for="nama_pemesan" class="col-sm-4 col-form-label form-label">Nama
                                                    Pemesanan</label>
                                                <div class="col-sm-8 ">
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
                                                <label for="no_telppn" class="col-sm-4 col-form-label form-label">No Telp
                                                    Pemesan</label>
                                                <div class="col-sm-8 ">
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
                                                <label for="pj_rombongan" class="col-sm-4 col-form-label form-label">PJ
                                                    Rombongan</label>
                                                <div class="col-sm-8 ">
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
                                                <label for="no_telpps" class="col-sm-4 col-form-label form-label">No Telp
                                                    PJ</label>
                                                <div class="col-sm-8">
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
                                                <label class="col-sm-4 form-label" for="tgl_keberangkatan">Tanggal
                                                    Berangkat</label>
                                                <div class="col-sm-8">
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
                                                <label class="col-sm-4 form-label" for="tgl_kepulangan">Tanggal
                                                    Kepulangan</label>
                                                <div class="col-sm-8">
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
                                                <label class="col-sm-4 form-label" for="tujuan">Tujuan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" name="tujuan" id="tujuan"
                                                            class="form-control" placeholder="Masukkan tujuan"
                                                            value="{{ $sp->tujuan }}" aria-describedby="tujuan"
                                                            required pattern="[A-Za-z\s]{3,}[0-9]*$"
                                                            title="Harus diisi dengan minimal 3 huruf" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Alamat Penjemputan-->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="alamat_penjemputan">Alamat
                                                    Penjemputan</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <span id="pickup-address-icon" class="input-group-text"><i
                                                                class="bx bx-map"></i></span>
                                                        <input type="text" name="alamat_penjemputan"
                                                            id="alamat_penjemputan" class="form-control"
                                                            placeholder="Masukkan alamat penjemputan"
                                                            value="{{ $sp->alamat_penjemputan }}"
                                                            aria-describedby="pickup-address-icon" required
                                                            pattern="[A-Za-z\s]{3,}[0-9]*$"
                                                            title="Harus diisi dengan minimal 3 huruf" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Catatan -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label"
                                                    for="catatan_pembayaran">Catatan</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" name="catatan_pembayaran" id="catatan_pembayaran" class="form-control"
                                                        placeholder="Masukkan catatan" aria-label="catatan">{{ $sp->catatan_pembayaran }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <!--Jumlah Armada-->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="jumlah_armada">Jumlah
                                                    Armada</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="jumlah_armada" id="jumlah_armada"
                                                        class="form-control" placeholder="Masukkan jumlah armada (Max 2)"
                                                        value="{{ $sp->jumlah_armada }}" aria-label="Jumlah Armada"
                                                        min="1" max="2" required attern="^[0-9]+$"
                                                        title="Input harus berupa angka, hanya 1 atau 2" />
                                                </div>
                                            </div>

                                            <!--Nilai Kontrak-->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="nilai_kontrak1">Nilai Kontrak
                                                    1</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="nilai_kontrak1"
                                                        class="form-control currency-input"
                                                        placeholder="Masukkan nilai kontrak" required>
                                                    <input type="hidden" name="nilai_kontrak1"
                                                        id="nilai_kontrak1_hidden" value="{{ $sp->nilai_kontrak1 }}">
                                                </div>
                                            </div>

                                            <!--Nilai Kontrak 2-->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="nilai_kontrak2">Nilai Kontrak
                                                    2</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="nilai_kontrak2"
                                                        class="form-control currency-input"
                                                        placeholder="Masukkan nilai kontrak" required>
                                                    <input type="hidden" name="nilai_kontrak2"
                                                        id="nilai_kontrak2_hidden" value="{{ $sp->nilai_kontrak2 }}">
                                                </div>
                                            </div>


                                            <!--Biaya Tambahan -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="biaya_tambahan">Biaya
                                                    Tambahan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="biaya_tambahan"
                                                        class="form-control currency-input"
                                                        placeholder="Masukkan biaya tambahan">
                                                    <input type="hidden" name="biaya_tambahan"
                                                        id="biaya_tambahan_hidden" value="{{ $sp->biaya_tambahan }}">
                                                </div>
                                            </div>

                                            <!-- Total Biaya -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="total_biaya">Total Biaya</label>
                                                <div class="col-sm-8">

                                                    <input type="text" id="total_biaya"
                                                        class="form-control currency-input" required>
                                                    <input type="hidden" name="total_biaya" id="total_biaya_hidden"
                                                        value="{{ $sp->total_biaya }}">
                                                </div>
                                            </div>

                                            <!-- Uang Muka -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="uang_muka">Uang Muka</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="uang_muka"
                                                        class="form-control currency-input"
                                                        placeholder="Masukkan biaya tambahan" required>
                                                    <input type="hidden" name="uang_muka" id="uang_muka_hidden"
                                                        value="{{ $sp->uang_muka }}">
                                                </div>
                                            </div>

                                            <!-- Status Pembayaran -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label" for="status_pembayaran">Status
                                                    Pembayaran</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class="bx bx-money"></i></span>
                                                        <select
                                                            class="form-select @error('status_pembayaran') is-invalid @enderror"
                                                            id="status_pembayaran" name="status_pembayaran" required>
                                                            <option value="">-- Pilih Status Pembayaran --</option>
                                                            <option value="1"
                                                                {{ $sp->status_pembayaran == 1 ? 'selected' : '' }}>Lunas
                                                            </option>
                                                            <option value="2"
                                                                {{ $sp->status_pembayaran == 2 ? 'selected' : '' }}>DP
                                                            </option>
                                                            <option value="3"
                                                                {{ $sp->status_pembayaran == 3 ? 'selected' : '' }}>Belum
                                                                DP
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sisa Pembayaran -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="sisa_pembayaran">Sisa
                                                    Pembayaran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="sisa_pembayaran"
                                                        class="form-control currency-input" required>
                                                    <input type="hidden" name="sisa_pembayaran"
                                                        id="sisa_pembayaran_hidden" value="{{ $sp->sisa_pembayaran }}">
                                                </div>
                                            </div>

                                            <!-- Metode Pembayaran -->
                                            <div class="row mb-3">
                                                <label class="col-sm-4 form-label" for="metode_pembayaran">Metode
                                                    Pembayaran</label>
                                                <div class="col-sm-8">
                                                    <select name="metode_pembayaran" id="metode_pembayaran"
                                                        class="form-control">
                                                        <option value="cash"
                                                            {{ $sp->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash
                                                        </option>
                                                        <option value="transfer"
                                                            {{ $sp->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                                            Transfer
                                                        </option>
                                                        <option value="credit_card"
                                                            {{ $sp->metode_pembayaran == 'credit_card' ? 'selected' : '' }}>
                                                            Kartu
                                                            Kredit</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Button Submit -->
                                            <div class="d-flex justify-content-end mb-4">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>

                        {{-- Tab Surat Jalan --}}
                        <div class="tab-pane fade" id="SuratJalan" role="tabpanel">
                            <div class="container">
                                @foreach ($sjs as $index => $sj)
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h2>Surat Jalan {{ $sj->id_sj }} </h2>
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
                                    <form method="POST" action="{{ route('pesanan.updateSJ', $sj->id_sj) }}#SuratJalan" data-type="SJ" data-id="{{ $sj->id_sj }}" class="form-update">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row mb-3">
                                                    <label for="id_unit_{{ $sj->id_sj }}"
                                                        class="col-sm-3 col-form-label form-label">Unit:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select unit-dropdown" name="id_unit"
                                                            id="id_unit_{{ $sj->id_sj }}"
                                                            data-sj-id="{{ $sj->id_sj }}"
                                                            onchange="getDriverCoDriver({{ $sj->id_sj }})">
                                                            <option value="">-- Pilih Armada --</option>
                                                            @foreach ($units as $unit)
                                                                <option value="{{ $unit->id_unit }}"
                                                                    {{ $unit->id_unit == $sj->id_unit ? 'selected' : '' }}>
                                                                    <blade
                                                                        if|%20(%24unit-%3Eid_unit%20%3D%3D%20%24sj-%3Eid_unit)%20selected%20%40endif%3E>
                                                                        {{ $unit->nama_unit }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="driver_{{ $sj->id_sj }}"
                                                        class="col-sm-3 col-form-label form-label">Driver:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="driver"
                                                        placeholder="Masukkan Driver"
                                                            id="driver_{{ $sj->id_sj }}" maxlength="50"
                                                            value="{{ old('driver', $sj->driver) }}">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="codriver_{{ $sj->id_sj }}"
                                                        class="col-sm-3 col-form-label form-label">Co-Driver:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="codriver"
                                                            id="codriver_{{ $sj->id_sj }}" maxlength="50"
                                                            placeholder="Masukkan Codriver"
                                                            value="{{ old('codriver', $sj->codriver) }}">
                                                    </div>
                                                </div>


                                                <div class=" row mb-3">
                                                    <label for="kmsebelum_{{ $sj->id_sj }}"
                                                        class="col-sm-3 col-form-label form-label">KM Sebelum</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" name="kmsebelum"
                                                                id="kmsebelum_{{ $sj->id_sj }}"
                                                                value="{{ old('kmsebelum', $sj->kmsebelum) }}"
                                                                class="form-control" min="1" max="1000000000"
                                                                 placeholder="Masukkan KM Sebelum"
                                                                title="Harus berupa angka" pattern="^\d+(\.\d{1,2})?$"
                                                                step="0.01">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" row mb-3">
                                                    <label for="kmtiba_{{ $sj->id_sj }}"
                                                        class="col-sm-3 col-form-label form-label">KM Tiba</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" name="kmtiba"
                                                                id="kmtiba_{{ $sj->id_sj }}"
                                                                value="{{ old('kmtiba', $sj->kmtiba) }}"
                                                                class="form-control" min="1" max="1000000000"
                                                                placeholder="Masukkan KM Tiba"
                                                                title="Harus berupa angka" pattern="^\d+(\.\d{1,2})?$"
                                                                step="0.01">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <!-- Kasbon BBM -->
                                                <div class="row mb-3">
                                                    <label for="kasbonbbm_{{ $sj->id_sj }}" class="col-sm-3 col-form-label form-label">Kasbon BBM</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" class="form-control currency-input" 
                                                                   id="kasbonbbm_{{ $sj->id_sj }}" 
                                                                   placeholder="Masukkan jumlah kasbon BBM"
                                                                   value="{{ old('kasbonbbm', $sj->kasbonbbm) }}">
                                                            <input type="hidden" name="kasbonbbm" 
                                                                   id="kasbonbbm_{{ $sj->id_sj }}_hiddens"
                                                                    
                                                                   value="{{ old('kasbonbbm', $sj->kasbonbbm) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <!-- Kasbon Makan -->
                                                <div class="row mb-3">
                                                    <label for="kasbonmakan_{{ $sj->id_sj }}" class="col-sm-3 col-form-label form-label">Kasbon Makan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" class="form-control currency-input" 
                                                                   id="kasbonmakan_{{ $sj->id_sj }}" 
                                                                   placeholder="Masukkan jumlah kasbon makan"
                                                                   value="{{ old('kasbonmakan', $sj->kasbonmakan) }}">
                                                            <input type="hidden" name="kasbonmakan" 
                                                                   id="kasbonmakan_{{ $sj->id_sj }}_hiddens" 
                                                                   value="{{ old('kasbonmakan', $sj->kasbonmakan) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <!-- Lain-lain -->
                                                <div class="row mb-3">
                                                    <label for="lainlain_{{ $sj->id_sj }}" class="col-sm-3 col-form-label form-label">Lain-lain</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" class="form-control currency-input" 
                                                                   id="lainlain_{{ $sj->id_sj }}" 
                                                                   placeholder="Masukkan jumlah lain-lain"
                                                                   value="{{ old('lainlain', $sj->lainlain) }}">
                                                            <input type="hidden" name="lainlain" 
                                                                   id="lainlain_{{ $sj->id_sj }}_hiddens" 
                                                                   value="{{ old('lainlain', $sj->lainlain) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            

                                        </div>


                                        <div class=" row mb-3">
                                            <div class="col-sm-10 offset-sm-2 d-flex justify-content-end mb-3 ">
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
                                        <h2>Surat Premi Jalan {{ $spj->id_spj }}</h2>
                                        <a href="#"
                                            onclick="printPreview('{{ route('viewSPJ', $spj->id_spj) }}'); return false;"
                                            class="btn btn-primary">
                                            <span class="tf-icons bx bx-printer me-2"></span> Print SPJ
                                        </a>
                                    </div>

                                    <form method="POST"
                                        action="{{ route('pesanan.updateSPJ', $spj->id_spj) }}#SuratPerintahJalan" class="form-update" data-type="SPJ" data-id="{{ $spj->id_spj }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <!-- Saldo E-toll Awal -->
                                                <div class="form-group row mb-3">
                                                    <label for="SaldoEtollawal_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        Saldo E-toll Awal
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="SaldoEtollawal_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan saldo awal E-toll"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}">
                                                        <input type="hidden" name="SaldoEtollawal"
                                                            id="SaldoEtollawal_{{ $index }}_hiddens"
                                                            value="{{ old('SaldoEtollawal', $spj->SaldoEtollawal) }}">
                                                        @error('SaldoEtollawal')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Saldo E-toll Akhir -->
                                                <div class="form-group row mb-3">
                                                    <label for="SaldoEtollakhir_{{ $index }}"
                                                        class="col-sm-4 col-form-label">
                                                        Saldo E-toll Akhir
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="SaldoEtollakhir_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan saldo akhir E-toll"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}">
                                                        <input type="hidden" name="SaldoEtollakhir"
                                                            id="SaldoEtollakhir_{{ $index }}_hiddens"
                                                            value="{{ old('SaldoEtollakhir', $spj->SaldoEtollakhir) }}">
                                                        @error('SaldoEtollakhir')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="PenggunaanToll_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Penggunaan Toll</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="PenggunaanToll_{{ $index }}"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan saldo awal E-toll"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}">
                                                        <input type="hidden" name="PenggunaanToll"
                                                            id="PenggunaanToll_{{ $index }}_hiddens"
                                                            value="{{ old('PenggunaanToll', $spj->PenggunaanToll) }}">
                                                        @error('PenggunaanToll')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label
                                                        for="uanglainlain_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Uang Lain-lain</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="uanglainlain_{{ $index }}"
                                                            class="form-control currency-input" placeholder="Masukkan Uang Lain-lain"
                                                            value="{{ old('uanglainlain', $spj->uanglainlain) }}">
                                                        <input type="hidden" name="uanglainlain"
                                                            id="uanglainlain_{{ $index }}_hiddens"
                                                            value="{{ old('uanglainlain', $spj->uanglainlain) }}">
                                                        @error('uanglainlain')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="uangmakan_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Uang Makan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="uangmakan_{{ $index }}" placeholder="Masukkan Uang Makan"
                                                            class="form-control currency-input"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}">
                                                        <input type="hidden" name="uangmakan"
                                                            id="uangmakan_{{ $index }}_hiddens"
                                                            value="{{ old('uangmakan', $spj->uangmakan) }}">
                                                        @error('uangmakan')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div class=" col-md-6">
                                                <div class="form-group">
                                                    <a href="{{ route('bbm.index', $spj->id_spj) }}"
                                                        class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                        Konsumsi
                                                        BBM</a>
                                                    <a href="{{ route('pengeluaran.index', $spj->id_spj) }}"
                                                        class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                        Pengeluaran Uang Saku</a>

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="totalisibbm_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Total Isi BBM</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="totalisibbm_{{ $index }}" placeholder="Masukkan Total Isi BBM"
                                                            class="form-control currency-input"
                                                            value="{{ old('totalisibbm', $spj->totalisibbm) }}">
                                                        <input type="hidden" name="totalisibbm"
                                                            id="totalisibbm_{{ $index }}_hiddens"
                                                            value="{{ old('totalisibbm', $spj->totalisibbm) }}">
                                                        @error('totalisibbm')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="sisasaku_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Sisa Saku</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="sisasaku_{{ $index }}"
                                                            class="form-control currency-input" placeholder="Masukkan Sisa Saku"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}">
                                                        <input type="hidden" name="sisasaku"
                                                            id="sisasaku_{{ $index }}_hiddens"
                                                            value="{{ old('sisasaku', $spj->sisasaku) }}">
                                                        @error('sisasaku')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="totalsisa_{{ $spj->id_sj }}"
                                                        class="col-sm-4 col-form-label form">Total Sisa</label>
                                                    
                                                    <div class="col-sm-8">
                                                        <input type="text" id="totalsisa_{{ $index }}"
                                                            class="form-control currency-input" placeholder="Masukkan Total Sisa"
                                                            value="{{ old('totalsisa', $spj->totalsisa) }}">
                                                        <input type="hidden" name="totalsisa"
                                                            id="totalsisa_{{ $index }}_hiddens"
                                                            value="{{ old('totalsisa', $spj->totalsisa) }}">
                                                        @error('totalsisa')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol Submit -->
                                        <div class="d-flex justify-content-end mt-3">
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
        
    </section>
    // Add this at the start of your page
    <script>
        console.log('Document ready state:', document.readyState);
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM Content Loaded');
        });
    </script>
<script>
    $(document).ready(function() {
    var table = $('#yourTableId').DataTable();
    console.log('DataTable initialized successfully');
});

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupTollCalculation(index) {
        console.log('Setting up toll calculation for index:', index);
        
        const saldoAwal = document.getElementById(`SaldoEtollawal`);
        const saldoAwalHidden = document.getElementById(`SaldoEtollawal_hiddens`);
        const saldoAkhir = document.getElementById(`SaldoEtollakhir`);
        const saldoAkhirHidden = document.getElementById(`SaldoEtollakhir_hiddens`);
        const penggunaanToll = document.getElementById(`PenggunaanToll`);
        const penggunaanTollHidden = document.getElementById(`PenggunaanToll_hiddens`);

        // Log if elements are found
        console.log('Elements found:', {
            saldoAwal: !!saldoAwal,
            saldoAwalHidden: !!saldoAwalHidden,
            saldoAkhir: !!saldoAkhir,
            saldoAkhirHidden: !!saldoAkhirHidden,
            penggunaanToll: !!penggunaanToll,
            penggunaanTollHidden: !!penggunaanTollHidden
        });

        ['input', 'keyup', 'change'].forEach(eventType => {
            saldoAwal.addEventListener(eventType, function(e) {
                console.log(`${eventType} event triggered on saldoAwal:`, this.value);
                const cleanValue = this.value.replace(/[^\d]/g, '');
                console.log('Cleaned value:', cleanValue);
                const formattedValue = formatToRupiah(cleanValue);
                console.log('Formatted value:', formattedValue);
                this.value = formattedValue;
                saldoAwalHidden.value = cleanValue;
                calculateTollUsage();
            });

            saldoAkhir.addEventListener(eventType, function(e) {
                console.log(`${eventType} event triggered on saldoAkhir:`, this.value);
                const cleanValue = this.value.replace(/[^\d]/g, '');
                console.log('Cleaned value:', cleanValue);
                const formattedValue = formatToRupiah(cleanValue);
                console.log('Formatted value:', formattedValue);
                this.value = formattedValue;
                saldoAkhirHidden.value = cleanValue;
                calculateTollUsage();
            });
        });

        function calculateTollUsage() {
            const awal = parseFloat(saldoAwalHidden.value) || 0;
            const akhir = parseFloat(saldoAkhirHidden.value) || 0;
            const penggunaan = awal - akhir;

            console.log('Calculating toll usage:', {
                awal: awal,
                akhir: akhir,
                penggunaan: penggunaan
            });

            penggunaanToll.value = formatToRupiah(penggunaan.toString());
            penggunaanTollHidden.value = penggunaan;
        }
    }

    function formatToRupiah(angka) {
        console.log('Formatting to Rupiah:', angka);
        let number = parseFloat(angka) || 0;
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number);
        console.log('Formatted result:', formatted);
        return formatted;
    }

    // Log all forms found
    const forms = document.querySelectorAll('[id^="SaldoEtollawal_"]');
    console.log('Found forms:', forms.length);
    
    forms.forEach(form => {
        const index = form.id.split('_')[1](citation_1);
        console.log('Processing form with index:', index);
        setupTollCalculation(index);
    });
});
</script>
    <!-- buat otomatis ngisi driver codriver -->
    <script>
        function getDriverCoDriver(sj_id) {
            let unit_id = $('#id_unit_' + sj_id).val(); // Get the selected unit ID

            if (unit_id) {
                $.ajax({
                    url: '/get-driver-codriver/' + unit_id,
                    type: 'GET',
                    success: function(data) {
                        console.log("Data received:", data);
                        $('#driver_' + sj_id).val(data.driver); // Update the driver input
                        $('#codriver_' + sj_id).val(data.codriver); // Update the co-driver input
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            } else {
                $('#driver_' + sj_id).val('');
                $('#codriver_' + sj_id).val('');
            }
        }
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
            const nilaiKontrak2v = document.getElementById('nilai_kontrak2');
            const biayaTambahan = document.getElementById('biaya_tambahan');
            const totalBiaya = document.getElementById('total_biaya');
            const totalBiayaHidden = document.getElementById('total_biaya_hidden');
            const uangMuka = document.getElementById('uang_muka');
            const sisaPembayaran = document.getElementById('sisa_pembayaran');
            const sisaPembayaranHidden = document.getElementById('sisa_pembayaran_hidden');

            // Function to update nilaiKontrak2 state
            function updateNilaiKontrak2State(jumlahArmada) {
                if (jumlahArmada == 1) {
                    nilaiKontrak2v.value = 0;
                    nilaiKontrak2v.disabled = true;
                    nilaiKontrak2v.required = false;
                    localStorage.setItem('nilaiKontrak2Disabled', 'true');
                    localStorage.setItem('jumlahArmada', '1');
                } else if (jumlahArmada == 2) {
                    nilaiKontrak2v.disabled = false;
                    nilaiKontrak2v.required = true;
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
                const kontrak1 = parseFloat(nilaiKontrak1.value.replace(/[^\d]/g, '')) || 0;
                const kontrak2 = parseFloat(nilaiKontrak2.value.replace(/[^\d]/g, '')) || 0;
                const tambahan = parseFloat(biayaTambahan.value.replace(/[^\d]/g, '')) || 0;

                const total = kontrak1 + kontrak2 + tambahan;
                totalBiaya.value = formatToRupiah(total.toString());
                totalBiayaHidden.value = total;

                calculateSisa(total);
            }

            function calculateSisa(total) {
                const uangMukaValue = parseFloat(uangMuka.value.replace(/[^\d]/g, '')) || 0;
                const sisa = total - uangMukaValue;

                // Set nilai dengan format Rupiah, dan gunakan hidden input untuk nilai asli
                sisaPembayaran.value = formatToRupiah(sisa.toString());
                sisaPembayaranHidden.value = sisa; // Nilai asli yang bisa negatif
            }

            function formatToRupiah(angka) {
                const isNegative = parseFloat(angka) < 0; // Cek apakah nilai negatif
                let numberString = angka.replace(/[^\d]/g, '').toString();
                let sisa = numberString.length % 3;
                let rupiah = numberString.substr(0, sisa);
                let ribuan = numberString.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    rupiah += (sisa ? '.' : '') + ribuan.join('.');
                }

                return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
            }

            // Event listeners for calculation
            [nilaiKontrak1, nilaiKontrak2, biayaTambahan, uangMuka].forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Initial calculation on load
            calculateTotal();
        });
    </script>

    <script>
        // Fungsi untuk Memformat Input sebagai Rupiah
        function formatRupiahInput(inputElement, hiddenElement) {
            inputElement.addEventListener('input', function() {
                const formattedValue = formatToRupiah(this.value);
                hiddenElement.value = formattedValue.replace(/[^\d]/g,
                    ''); // Set hidden input to numeric value only
                inputElement.value = formattedValue;
            });

            // Set nilai awal jika ada
            const initialValue = hiddenElement.value;
            if (initialValue) {
                inputElement.value = formatToRupiah(initialValue);
            }
        }

        // Fungsi untuk Mengubah Angka Menjadi Format Rupiah
        function formatToRupiah(angka) {
            let numberString = angka.replace(/[^\d]/g, '').toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                rupiah += (sisa ? '.' : '') + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        // Inisialisasi Semua Input dengan Kelas "currency-input"
        document.querySelectorAll('.currency-input').forEach(input => {
            const hiddenInputId = input.id + '_hidden';
            const hiddenInput = document.getElementById(hiddenInputId);
            if (hiddenInput) {
                formatRupiahInput(input, hiddenInput);
            }
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


    <!-- Toast HTML -->
    <div id="emptyToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050; display: none;">
        <div class="bs-toast toast show bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="me-auto fw-semibold">⚠️ Tidak Ada Data</div>
            </div>
            <div class="toast-body">
                Tidak ada data yang diupdate.
            </div>
        </div>
    </div>

    <!-- Script to check empty fields and show toast -->
    <script>
        function checkForm() {
            const form = document.getElementById('updateForm');
            const inputs = form.querySelectorAll('input');
            let isEmpty = true;

            // Check if all input fields are empty
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    isEmpty = false;
                }
            });

            if (isEmpty) {
                // Show toast
                const toastElement = document.getElementById('emptyToast');
                toastElement.style.display = 'block';

                // Hide toast after a few seconds
                setTimeout(() => {
                    toastElement.style.display = 'none';
                }, 2000);
            } else {
                form.submit();
            }
        }
    </script>

    <script>
        // Fungsi untuk Memformat Input sebagai Rupiah
        function formatInputRupiah(inputElement, hiddensElement) {
            inputElement.addEventListener('input', function() {
                const formattedValue = convertToRupiah(this.value);
                hiddensElement.value = formattedValue.replace(/[^\d]/g, ''); // Set hiddens input ke angka saja
                inputElement.value = formattedValue;
            });

            // Set nilai awal jika ada
            const initialValue = hiddensElement.value;
            if (initialValue) {
                inputElement.value = convertToRupiah(initialValue);
            }
        }

        // Fungsi untuk Mengubah Angka Menjadi Format Rupiah
        function convertToRupiah(angka) {
            let numberString = angka.replace(/[^\d]/g, '').toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                rupiah += (sisa ? '.' : '') + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        // Inisialisasi Semua Input dengan Kelas "currency-input"
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.currency-input').forEach(input => {
                const hiddensInputId = input.id + '_hiddens';
                const hiddensInput = document.getElementById(hiddensInputId);
                if (hiddensInput) {
                    formatInputRupiah(input, hiddensInput);
                }
            });
        });
    </script>
 
     <script>
        $(document).ready(function () {
            $(document).on('submit', '.form-update', function (e) {
                e.preventDefault();
    
                const form = $(this);
                const formData = form.serialize();
                const type = form.data('type'); // Ambil tipe dokumen (SP, SJ, SPJ)
                const id = form.data('id'); // Ambil ID dokumen
                const url = form.attr('action'); // URL endpoint
    
                // Kirim AJAX
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        // Hapus toast lama jika ada
                        $('body').find('#successToast').remove();
    
                        // Tampilkan toast baru
                        $('body').append(`
                            <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                                <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <div class="me-auto fw-semibold"> ✓ Data ${type}</div>
                                    </div>
                                    <div class="toast-body">
                                        Data ${type} berhasil diupdate!
                                    </div>
                                </div>
                            </div>
                        `);
    
                        // Hilangkan toast setelah beberapa detik
                        setTimeout(function() {
                            var toastElement = document.getElementById('successToast');
                            if (toastElement) {
                                toastElement.style.display = 'none'; // Menghilangkan toast
                            }
                        }, 2500);
    
                        // Perbarui data pada halaman tanpa refresh (Opsional jika ingin menampilkan data baru)
                        $(`#data-${type}-${id}`).html(response.html);
                    },
                    error: function (xhr) {
                        alert(`Gagal mengupdate ${type}.`);
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    
@endsection

@include('main_owner')
