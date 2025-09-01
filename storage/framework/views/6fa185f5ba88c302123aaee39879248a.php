<?php $__env->startSection('detail_pesanan'); ?>
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="<?php echo e(asset('sneat/assets/img/sima/header.png')); ?>" alt="Help center header"
        style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <div class="container">
        <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">
                    <a href="<?php echo e(url('/pesanan')); ?>">Data Pesanan</a>
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
                    
                    <div class="tab-pane fade show active" id="SuratPesanan" role="tabpanel">
                        <div class="container">


                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2>Surat Pemesanan <?php echo e($sp->id_sp); ?></h2>
                                <a href="#"
                                    onclick="printPreview('<?php echo e(route('view', $sp->id_sp)); ?>'); return false"
                                    class="btn btn-primary">
                                    <span class="tf-icons bx bx-printer me-2"></span> Print SP
                                </a>

                                <a href="https://wa.me/<?php echo e('62' . ltrim($sp->no_telppn, '0')); ?>?text= Berikut kami kirim bukti transaksi Sima Perkasya melalui e-receipt : <?php echo e(rawurlencode(route('e-receipt', ['id' => encrypt($sp->id_sp)]))); ?>"
                                    class="btn btn-success" target="_blank">
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

                            <form action="<?php echo e(route('detail_pesanan', $sp->id_sp)); ?>" method="POST" data-type="SP"
                                data-id="<?php echo e($sp->id_sp); ?>" class="form-update">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- marketing -->
                                        <div class="row mb-3">
                                            <label for="marketing"
                                                class="col-sm-4 col-form-label form-label">Marketing</label>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-merge">
                                                    <select class="form-select" name="marketing" required>
                                                        <option value="">-- Pilih Akun --</option>
                                                        <?php $__currentLoopData = $akuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($akun->role_id == 1): ?>
                                                        <option value="<?php echo e($akun->id_akun); ?>"
                                                            <?php echo e(old('marketing', $sp->marketing ?? '') == $akun->id_akun ? 'selected' : ''); ?>>
                                                            <?php echo e($akun->name); ?>

                                                        </option>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nama Pemesan -->
                                        <div class="row mb-3">
                                            <label for="nama_pemesan" class="col-sm-4 col-form-label form-label">Nama
                                                Pemesanan</label>
                                            <div class="col-sm-8 ">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nama_pemesan"
                                                        value="<?php echo e($sp->nama_pemesan); ?>" required
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
                                                        value="<?php echo e($sp->no_telppn); ?>" required pattern="[0-9]*"
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
                                                        value="<?php echo e($sp->pj_rombongan); ?>">
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
                                                        value="<?php echo e($sp->no_telpps); ?>"
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
                                                        value="<?php echo e($sp->tgl_keberangkatan . 'T' . $sp->jam_keberangkatan); ?>"
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
                                                        value="<?php echo e($sp->tgl_kepulangan . 'T' . $sp->jam_kepulangan); ?>"
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
                                                        value="<?php echo e($sp->tujuan); ?>" aria-describedby="tujuan" />
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
                                                        value="<?php echo e($sp->alamat_penjemputan); ?>"
                                                        aria-describedby="pickup-address-icon" required />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Catatan -->
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label"
                                                for="catatan_pembayaran">Catatan</label>
                                            <div class="col-sm-8">
                                                <textarea type="text" name="catatan_pembayaran" id="catatan_pembayaran" class="form-control"
                                                    placeholder="Masukkan catatan" aria-label="catatan"><?php echo e($sp->catatan_pembayaran); ?></textarea>
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
                                                    value="<?php echo e($sp->jumlah_armada); ?>" aria-label="Jumlah Armada"
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
                                                    id="nilai_kontrak1_hidden" value="<?php echo e($sp->nilai_kontrak1); ?>">
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
                                                    id="nilai_kontrak2_hidden" value="<?php echo e($sp->nilai_kontrak2); ?>">
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
                                                    id="biaya_tambahan_hidden" value="<?php echo e($sp->biaya_tambahan); ?>">
                                            </div>
                                        </div>

                                        <!-- Total Biaya -->
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label" for="total_biaya">Total Biaya</label>
                                            <div class="col-sm-8">

                                                <input type="text" id="total_biaya"
                                                    class="form-control currency-input" required>
                                                <input type="hidden" name="total_biaya" id="total_biaya_hidden"
                                                    value="<?php echo e($sp->total_biaya); ?>">
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
                                                    value="<?php echo e($sp->uang_muka); ?>">
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
                                                        class="form-select <?php $__errorArgs = ['status_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="status_pembayaran" name="status_pembayaran" required>
                                                        <option value="">-- Pilih Status Pembayaran --</option>
                                                        <option value="1"
                                                            <?php echo e($sp->status_pembayaran == 1 ? 'selected' : ''); ?>>Lunas
                                                        </option>
                                                        <option value="2"
                                                            <?php echo e($sp->status_pembayaran == 2 ? 'selected' : ''); ?>>DP
                                                        </option>
                                                        <option value="3"
                                                            <?php echo e($sp->status_pembayaran == 3 ? 'selected' : ''); ?>>Belum
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
                                                    id="sisa_pembayaran_hidden" value="<?php echo e($sp->sisa_pembayaran); ?>">
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
                                                        <?php echo e($sp->metode_pembayaran == 'cash' ? 'selected' : ''); ?>>Cash
                                                    </option>
                                                    <option value="transfer"
                                                        <?php echo e($sp->metode_pembayaran == 'transfer' ? 'selected' : ''); ?>>
                                                        Transfer
                                                    </option>
                                                    <option value="credit_card"
                                                        <?php echo e($sp->metode_pembayaran == 'credit_card' ? 'selected' : ''); ?>>
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

                    
                    <div class="tab-pane fade" id="SuratJalan" role="tabpanel">
                        <div class="container">
                            <?php $__currentLoopData = $sjs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2>Surat Jalan <?php echo e($sj->id_sj); ?> </h2>
                                <a href="#"
                                    onclick="printPreview('<?php echo e(route('viewSJ', $sj->id_sj)); ?>'); return false;"
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
                            <form method="POST" action="<?php echo e(route('pesanan.updateSJ', $sj->id_sj)); ?>#SuratJalan"
                                data-type="SJ" data-id="<?php echo e($sj->id_sj); ?>" class="form-update">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="id_unit_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Unit:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select unit-dropdown" name="id_unit"
                                                    id="id_unit_<?php echo e($sj->id_sj); ?>"
                                                    data-sj-id="<?php echo e($sj->id_sj); ?>"
                                                    onchange="getDriverCoDriver(<?php echo e($sj->id_sj); ?>)">
                                                    <option value="">-- Pilih Armada --</option>
                                                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($unit->id_unit); ?>"
                                                        <?php echo e($unit->id_unit == $sj->id_unit ? 'selected' : ''); ?>>
                                                        <blade
                                                            if|%20(%24unit-%3Eid_unit%20%3D%3D%20%24sj-%3Eid_unit)%20selected%20%40endif%3E>
                                                            <?php echo e($unit->nama_unit); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="driver_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Driver:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="driver"
                                                    placeholder="Masukkan Driver" id="driver_<?php echo e($sj->id_sj); ?>"
                                                    maxlength="50" value="<?php echo e(old('driver', $sj->driver)); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="driver2_<?php echo e($sj->id_sj); ?>" class="col-sm-3 col-form-label form-label">Driver Cadangan:</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control driver-autocomplete"
                                                    name="driver2"
                                                    placeholder="Masukkan Driver Cadangan (optional)"
                                                    id="driver2_<?php echo e($sj->id_sj); ?>"
                                                    maxlength="50"
                                                    value="<?php echo e(old('driver2', $sj->driver2)); ?>"
                                                    autocomplete="on">
                                                <div class="suggestion-box" id="suggestionBox_<?php echo e($sj->id_sj); ?>"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="codriver_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Co-Driver:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="codriver"
                                                    id="codriver_<?php echo e($sj->id_sj); ?>" maxlength="50"
                                                    placeholder="Masukkan Codriver"
                                                    value="<?php echo e(old('codriver', $sj->codriver)); ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <!-- Jumlah Seat -->
                                        <div class=" row mb-3">
                                            <label for="jumlahseat_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Jumlah Seat</label>
                                            <div class="col-sm-9">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="jumlahseat"
                                                        id="jumlahseat_<?php echo e($sj->id_sj); ?>"
                                                        value="<?php echo e(old('jumlahseat', $sj->jumlahseat)); ?>"
                                                        class="form-control" min="1" max="100"
                                                        placeholder="Masukkan Jumlah Seat"
                                                        title="Harus berupa angka" pattern="^\d+(\.\d{1,2})?$"
                                                        step="0.01">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kasbon BBM -->
                                        <div class="row mb-3">
                                            <label for="kasbonbbm_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Kasbon BBM</label>
                                            <div class="col-sm-9">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control currency-input"
                                                        id="kasbonbbm_<?php echo e($sj->id_sj); ?>"
                                                        placeholder="Masukkan jumlah kasbon BBM"
                                                        value="<?php echo e(old('kasbonbbm', $sj->kasbonbbm)); ?>">
                                                    <input type="hidden" name="kasbonbbm"
                                                        id="kasbonbbm_<?php echo e($sj->id_sj); ?>_hiddens"
                                                        value="<?php echo e(old('kasbonbbm', $sj->kasbonbbm)); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kasbon Makan -->
                                        <div class="row mb-3">
                                            <label for="kasbonmakan_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Kasbon Makan</label>
                                            <div class="col-sm-9">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control currency-input"
                                                        id="kasbonmakan_<?php echo e($sj->id_sj); ?>"
                                                        placeholder="Masukkan jumlah kasbon makan"
                                                        value="<?php echo e(old('kasbonmakan', $sj->kasbonmakan)); ?>">
                                                    <input type="hidden" name="kasbonmakan"
                                                        id="kasbonmakan_<?php echo e($sj->id_sj); ?>_hiddens"
                                                        value="<?php echo e(old('kasbonmakan', $sj->kasbonmakan)); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lain-lain -->
                                        <div class="row mb-3">
                                            <label for="lainlain_<?php echo e($sj->id_sj); ?>"
                                                class="col-sm-3 col-form-label form-label">Uang Saku</label>
                                            <div class="col-sm-9">
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control currency-input"
                                                        id="lainlain_<?php echo e($sj->id_sj); ?>"
                                                        placeholder="Masukkan jumlah Uang Saku"
                                                        value="<?php echo e(old('lainlain', $sj->lainlain)); ?>">
                                                    <input type="hidden" name="lainlain"
                                                        id="lainlain_<?php echo e($sj->id_sj); ?>_hiddens"
                                                        value="<?php echo e(old('lainlain', $sj->lainlain)); ?>">
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>

                    
                    <div class="tab-pane fade" id="SuratPerintahJalan" role="tabpanel">
                        <div class="container">
                            <?php $__currentLoopData = $spjs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $spj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo csrf_field(); ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2>Surat Premi Jalan <?php echo e($spj->id_spj); ?></h2>
                                <a href="#"
                                    onclick="printPreview('<?php echo e(route('viewSPJ', $spj->id_spj)); ?>'); return false;"
                                    class="btn btn-primary">
                                    <span class="tf-icons bx bx-printer me-2"></span> Print SPJ
                                </a>
                            </div>

                            <form method="POST"
                                action="<?php echo e(route('pesanan.updateSPJ', $spj->id_spj)); ?>#SuratPerintahJalan"
                                class="form-update" data-type="SPJ" data-id="<?php echo e($spj->id_spj); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group md-4">
                                            <?php if($index == 0 && isset($sp)): ?>
                                            <h5 id="nilai_kontrak1_<?php echo e($index); ?>"
                                                class="row-sm-4 row-form-label">Nilai Kontrak 1 : Rp
                                                <?php echo e(number_format($sp->nilai_kontrak1, 0, ',', '.')); ?>

                                            </h5>
                                            <?php elseif(isset($sp)): ?>
                                            <h5 id="nilai_kontrak2_<?php echo e($index); ?>"
                                                class="row-sm-4 row-form-label">Nilai Kontrak 2 : Rp
                                                <?php echo e(number_format($sp->nilai_kontrak2, 0, ',', '.')); ?>

                                            </h5>
                                            <?php endif; ?>
                                            <h5 id="kasbon_bbm_<?php echo e($index); ?>"
                                                class="row-sm-4 row-form-label">Kasbon BBM : Rp
                                                <?php echo e(number_format($sjs[$index]->kasbonbbm, 0, ',', '.')); ?>

                                            </h5>
                                            <h5 id="kasbon_makan_<?php echo e($index); ?>"
                                                class="row-sm-4 row-form-label">Kasbon Makan : Rp
                                                <?php echo e(number_format($sjs[$index]->kasbonmakan, 0, ',', '.')); ?>

                                            </h5>
                                            <h5 id="uang_saku_<?php echo e($index); ?>"
                                                class="row-sm-4 row-form-label">Uang Saku : Rp
                                                <?php echo e(number_format($sjs[$index]->lainlain, 0, ',', '.')); ?>

                                            </h5>
                                        </div>
                                        <!-- Saldo E-toll Awal -->
                                        <div class="form-group row mb-3">
                                            <label for="SaldoEtollawal_<?php echo e($index); ?>"
                                                class="col-sm-4 col-form-label">
                                                Saldo E-toll Awal
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="SaldoEtollawal_<?php echo e($index); ?>"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan saldo awal E-toll"
                                                    value="<?php echo e(old('SaldoEtollawal', $spj->SaldoEtollawal)); ?>">
                                                <input type="hidden" name="SaldoEtollawal"
                                                    id="SaldoEtollawal_<?php echo e($index); ?>_hiddens"
                                                    value="<?php echo e(old('SaldoEtollawal', $spj->SaldoEtollawal)); ?>">
                                                <?php $__errorArgs = ['SaldoEtollawal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <!-- Saldo E-toll Akhir -->
                                        <div class="form-group row mb-3">
                                            <label for="SaldoEtollakhir_<?php echo e($index); ?>"
                                                class="col-sm-4 col-form-label">
                                                Saldo E-toll Akhir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="SaldoEtollakhir_<?php echo e($index); ?>"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan saldo akhir E-toll"
                                                    value="<?php echo e(old('SaldoEtollakhir', $spj->SaldoEtollakhir)); ?>">
                                                <input type="hidden" name="SaldoEtollakhir"
                                                    id="SaldoEtollakhir_<?php echo e($index); ?>_hiddens"
                                                    value="<?php echo e(old('SaldoEtollakhir', $spj->SaldoEtollakhir)); ?>">
                                                <?php $__errorArgs = ['SaldoEtollakhir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="PenggunaanToll_<?php echo e($spj->id_sj); ?>"
                                                class="col-sm-4 col-form-label form">Penggunaan Toll</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="PenggunaanToll_<?php echo e($index); ?>"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan penggunaan E-toll"
                                                    value="<?php echo e(old('PenggunaanToll', $spj->PenggunaanToll)); ?>">
                                                <input type="hidden" name="PenggunaanToll"
                                                    id="PenggunaanToll_<?php echo e($index); ?>_hiddens"
                                                    value="<?php echo e(old('PenggunaanToll', $spj->PenggunaanToll)); ?>">
                                                <?php $__errorArgs = ['PenggunaanToll'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <!-- KM sebelum -->
                                        <div class="form-group row mb-3">
                                            <label for="kmsebelum_<?php echo e($index); ?>"
                                                class="col-sm-4 col-form-label">
                                                KM sebelum
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="kmsebelum_<?php echo e($index); ?>"
                                                    name="kmsebelum" class="form-control currency-input"
                                                    placeholder="Masukkan KM sebelum"
                                                    value="<?php echo e(old('kmsebelum', $sjs[$index]->kmsebelum)); ?>">
                                            </div>
                                        </div>


                                        <!-- KM tiba -->
                                        <div class="form-group row mb-3">
                                            <label for="kmtiba_<?php echo e($index); ?>"
                                                class="col-sm-4 col-form-label">
                                                KM tiba
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="kmtiba_<?php echo e($index); ?>"
                                                    name="kmtiba" class="form-control"
                                                    placeholder="Masukkan KM tiba"
                                                    value="<?php echo e(old('kmtiba', $sjs[$index]->kmtiba)); ?>">
                                            </div>
                                        </div>


                                        <!-- KM Tempuh -->
                                        <div class="form-group row mb-3">
                                            <label for="kmtempuh_<?php echo e($index); ?>"
                                                class="col-sm-4 col-form-label">
                                                KM Tempuh
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="kmtempuh_<?php echo e($index); ?>"
                                                    name="kmtempuh" class="form-control"
                                                    placeholder="Masukkan KM Tempuh"
                                                    value="<?php echo e(old('kmtempuh', $sjs[$index]->kmtempuh)); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <a href="<?php echo e(route('bbm.index', $spj->id_spj)); ?>"
                                                class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                Konsumsi
                                                BBM</a>
                                            <a href="<?php echo e(route('pengeluaran.index', $spj->id_spj)); ?>"
                                                class="btn btn-primary mb-4"> <i class='bx bx-gas-pump'> </i>
                                                Pengeluaran Uang Saku</a>
                                            <!-- buatlah cek box untuk input data is valid jika terisi maka input 1 jika tidak 0 -->
                                            <div class="form-group row mb-3">
                                                <label for="isvalid_<?php echo e($spj->id_sj); ?>"
                                                    class="col-sm-4 col-form-label form">Valid</label>
                                                <div class="col-sm-8">
                                                    <select id="isvalid_<?php echo e($index); ?>" name="isvalid" class="form-control">
                                                        <option value="1" <?php echo e(old('isvalid', $spj->isvalid) == 1 ? 'selected' : ''); ?>>Valid</option>
                                                        <option value="0" <?php echo e(old('isvalid', $spj->isvalid) == 0 ? 'selected' : ''); ?>>Tidak Valid</option>
                                                    </select>
                                                    <?php $__errorArgs = ['isvalid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="totalisibbm_<?php echo e($spj->id_sj); ?>"
                                                class="col-sm-4 col-form-label form">Total Isi BBM</label>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text"
                                                            id="totalisibbm_<?php echo e($index); ?>"
                                                            name="totalisibbmhidden"
                                                            class="form-control currency-input"
                                                            value="<?php echo e(old('totalisibbm', $spj->totalisibbm ?? 0)); ?>"
                                                            placeholder="Masukkan Total Isi BBM">
                                                        <input type="hidden" name="totalisibbm"
                                                            id="totalisibbm_<?php echo e($index); ?>_hiddens"
                                                            value="<?php echo e(old('totalisibbm', $spj->totalisibbm)); ?>">

                                                        <button type="button" class="btn btn-primary"
                                                            id="tarik-total-<?php echo e($index); ?>"
                                                            onclick="tarikTotalBBM('<?php echo e($index); ?>', '<?php echo e($spj->id_spj); ?>')">Tarik
                                                            Total</button>
                                                    </div>
                                                </div>

                                                <?php $__errorArgs = ['totalisibbm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="sisabbm_<?php echo e($spj->id_sj); ?>"
                                                class="col-sm-4 col-form-label form">Sisa Bbm</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="sisabbm_<?php echo e($index); ?>"
                                                    class="form-control currency-input"
                                                    placeholder="Masukkan Sisa bbm"
                                                    value="<?php echo e(old('sisabbm', $spj->sisabbm)); ?>">
                                                <input type="hidden" name="sisabbm"
                                                    id="sisabbm_<?php echo e($index); ?>_hiddens"
                                                    value="<?php echo e(old('sisabbm', $spj->sisabbm)); ?>">
                                                <?php $__errorArgs = ['sisabbm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                                    <label for="uanglainlain_<?php echo e($spj->id_sj); ?>"
                                                        class="col-sm-4 col-form-label form">Pengeluaran Uang Saku</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    id="uanglainlain_<?php echo e($index); ?>"
                                                                    name="uanglainlainhidden"
                                                                    class="form-control currency-input"
                                                                    value="<?php echo e(old('uanglainlain', $spj->uanglainlain ?? 0)); ?>"
                                                                    placeholder="Masukkan Total Pengeluaran Uang Saku">
                                                                <input type="hidden" name="uanglainlain"
                                                                    id="uanglainlain_<?php echo e($index); ?>_hiddens"
                                                                    value="<?php echo e(old('uanglainlain', $spj->uanglainlain)); ?>">
                                                   
                                                                <button type="button" class="btn btn-primary"
                                                                    id="tarik-total-uang-saku-<?php echo e($index); ?>"
                                                                    onclick="tarikTotalUangSaku('<?php echo e($index); ?>', '<?php echo e($spj->id_spj); ?>')">Tarik Total</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="sisasaku_<?php echo e($spj->id_sj); ?>"
                                                        class="col-sm-4 col-form-label form">Sisa Saku</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="sisasaku_<?php echo e($index); ?>"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan Sisa Saku"
                                                            value="<?php echo e(old('sisasaku', $spj->sisasaku)); ?>">
                                                        <input type="hidden" name="sisasaku"
                                                            id="sisasaku_<?php echo e($index); ?>_hiddens"
                                                            value="<?php echo e(old('sisasaku', $spj->sisasaku)); ?>">
                                                        <?php $__errorArgs = ['sisasaku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>




                                        <div class="form-group row mb-3">
                                            <label for="uangmakan_<?php echo e($spj->id_sj); ?>"
                                                class="col-sm-4 col-form-label form">Pengeluaran Uang Makan</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="uangmakan_<?php echo e($index); ?>"
                                                    placeholder="Masukkan Uang Makan"
                                                    class="form-control currency-input"
                                                    value="<?php echo e(old('uangmakan', $spj->uangmakan)); ?>">
                                                <input type="hidden" name="uangmakan"
                                                    id="uangmakan_<?php echo e($index); ?>_hiddens"
                                                    value="<?php echo e(old('uangmakan', $spj->uangmakan)); ?>">
                                                <?php $__errorArgs = ['uangmakan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="totalsisa_<?php echo e($spj->id_sj); ?>"
                                                class="col-sm-4 col-form-label form">Total Sisa</label>

                                            <!-- <div class="col-sm-8">
                                                        <input type="text" id="totalsisa_<?php echo e($index); ?>"
                                                            class="form-control currency-input"
                                                            placeholder="Masukkan Total Sisa"
                                                            value="<?php echo e(old('totalsisa', $spj->totalsisa)); ?>">
                                                        <input type="hidden" name="totalsisa"
                                                            id="totalsisa_<?php echo e($index); ?>_hiddens"
                                                            value="<?php echo e(old('totalsisa', $spj->totalsisa)); ?>">
                                                        <?php $__errorArgs = ['totalsisa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="text-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div> -->
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text"
                                                            id="totalsisa_<?php echo e($index); ?>"
                                                            name="totalsisa"
                                                            class="form-control currency-input"
                                                            value="<?php echo e(old('totalsisa', $spj->totalsisa ?? 0)); ?>"
                                                            placeholder="Masukkan Total Sisa">
                                                        <input type="hidden"
                                                            id="totalsisa_<?php echo e($index); ?>_hiddens"
                                                            name="totalsisa"
                                                            value="<?php echo e(old('totalsisa_hiddens', $spj->totalsisa ?? 0)); ?>">
                                                        <button type="button"
                                                            class="btn btn-primary"
                                                            id="tarik-sisa-<?php echo e($index); ?>"
                                                            onclick="tarikTotalSisa('<?php echo e($index); ?>', '<?php echo e($spj->id_spj); ?>')">
                                                            Tarik Total Sisa
                                                        </button>
                                                    </div>
                                                </div>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Debugging info
        console.log("Starting autocomplete initialization");

        $('.driver-autocomplete').each(function() {
            let input = $(this);
            let inputId = input.attr('id');
            let suggestionBox = $('#suggestionBox_' + inputId);

            console.log("Setting up autocomplete for:", inputId);
            console.log("Suggestion box found:", suggestionBox.length > 0);

            // Pastikan suggestion box memiliki style yang tepat
            suggestionBox.css({
                'position': 'absolute',
                'background': 'white',
                'border': '1px solid #ccc',
                'max-height': '200px',
                'overflow-y': 'auto',
                'width': '100%',
                'z-index': '1000',
                'margin-top': '2px'
            });

            let typingTimer;
            const doneTypingInterval = 300;

            // Fungsi untuk menampilkan suggestions
            function displaySuggestions(suggestions) {
                console.log('Displaying suggestions:', suggestions);
                suggestionBox.empty();

                if (suggestions.length > 0) {
                    suggestions.forEach(function(name) {
                        let item = $(`<div class="suggestion-item" data-name="${name}">${name}</div>`);
                        suggestionBox.append(item);
                    });

                    // Gunakan .css() untuk mengatur display secara eksplisit
                    suggestionBox.css('display', 'block');

                    console.log("Suggestion box display style:", suggestionBox.css('display'));
                    console.log("Suggestions displayed");
                } else {
                    suggestionBox.css('display', 'none');
                    console.log("No suggestions found");
                }
            }
            input.on('input', function() {
                clearTimeout(typingTimer);
                let query = $(this).val();
                console.log("Input value changed:", query);

                if (query.length >= 2) {
                    typingTimer = setTimeout(function() {
                        $.ajax({
                            url: '/search-driver',
                            method: 'GET',
                            data: {
                                query: query
                            },
                            beforeSend: function() {
                                console.log("Sending request for:", query);
                            },
                            success: function(response) {
                                console.log("Received response:", response);
                                displaySuggestions(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Request failed:", error);
                                suggestionBox.css('display', 'none');
                            }
                        });
                    }, doneTypingInterval);
                } else {
                    suggestionBox.css('display', 'none');
                }
            });

            // Click outside handler
            $(document).on('click', function(event) {
                if (!$(event.target).closest(input).length &&
                    !$(event.target).closest(suggestionBox).length) {
                    suggestionBox.css('display', 'none');
                }
            });

            // Log when events are bound
            console.log("Events bound for input:", inputId);
        });
    });
</script>
<style>
    .suggestion-box {
        display: none;
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
        width: 100%;
        z-index: 1000;
        margin-top: 2px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .suggestion-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f5f5f5;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotalSisa(index) {
            // Mengambil nilai dari input fields
            const kasbonBBM = document.getElementById(`kasbon_bbm_${index}`);
            const kasbonMakan = document.getElementById(`kasbon_makan_${index}`);
            const uangSaku = document.getElementById(`uang_saku_${index}`);
            const totalisiBBM = document.getElementById(`totalisibbm_${index}`);
            const uangLainLain = document.getElementById(`uanglainlain_${index}`);
            const uangMakan = document.getElementById(`uangmakan_${index}`);
            const sisaSaku = document.getElementById(`sisasaku_${index}`);
            const totalsisa = document.getElementById(`totalsisa_${index}`);
            const totalsisahidden = document.getElementById(`totalsisa_${index}_hiddens`);


            function formatToRupiah(angka) {
                const isNegative = parseFloat(angka) < 0;
                let numberString = Math.abs(parseFloat(angka)).toString();
                let split = numberString.split('.');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    rupiah += (sisa ? '.' : '') + ribuan.join('.');
                }

                return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
            }

            function calculate() {
                const bbm = parseFloat(kasbonBBM.value.replace(/[^\d]/g, '')) || 0;
                const makan = parseFloat(kasbonMakan.value.replace(/[^\d]/g, '')) || 0;
                const saku = parseFloat(uangSaku.value.replace(/[^\d]/g, '')) || 0;
                const sisasaku = parseFloat(sisaSaku.value.replace(/[^\d]/g, '')) || 0;
                const totbbm = parseFloat(totalisiBBM.value.replace(/[^\d]/g, '')) || 0;
                const umakan = parseFloat(uangMakan.value.replace(/[^\d]/g, '')) || 0;
                const ulainlain = parseFloat(uangLainLain.value.replace(/[^\d]/g, '')) || 0;

                const totalSisa = (bbm + makan + saku + sisasaku) - (totbbm + umakan + ulainlain);

                totalsisa.value = formatToRupiah(totalSisa);
                totalsisahidden.value = totalSisa;

            }
            sisaSaku.addEventListener('input', calculate);
            totalisiBBM.addEventListener('input', calculate);
            uangMakan.addEventListener('input', calculate);
            uangLainLain.addEventListener('input', calculate);
        }


        document.querySelectorAll('[id^="totalisibbm_"]').forEach(element => {
            const index = element.id.split('_')[1];
            calculateTotalSisa(index);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateKmTempuh(index) {
            const kmSebelumInput = document.getElementById(`kmsebelum_${index}`);
            const kmTibaInput = document.getElementById(`kmtiba_${index}`);
            const kmTempuhInput = document.getElementById(`kmtempuh_${index}`);


            function calculate() {
                const kmSebelum = parseFloat(kmSebelumInput.value) || 0;
                const kmTiba = parseFloat(kmTibaInput.value) || 0;
                const kmTempuh = kmTiba - kmSebelum;

                kmTempuhInput.value = kmTempuh;
            }


            kmSebelumInput.addEventListener('input', calculate);
            kmTibaInput.addEventListener('input', calculate);
        }


        document.querySelectorAll('[id^="kmsebelum_"]').forEach(element => {
            const index = element.id.split('_')[1];
            calculateKmTempuh(index);
        });
    });
</script>
<script>
function tarikTotalUangSaku(index, idSpj) {
    fetch(`/total-uang-saku/${idSpj}`)
        .then(response => response.json())
        .then(data => {
            const totalInput = document.getElementById(`uanglainlain_${index}`);
            const hiddensInput = document.getElementById(`uanglainlain_${index}_hiddens`);
            const sisaInput = document.getElementById(`sisasaku_${index}`);
            const sisaHiddensInput = document.getElementById(`sisasaku_${index}_hiddens`);


            // Format ke Rupiah untuk total uang saku
            const formattedTotal = convertToRupiah(data.totalUangSaku.toString());
            totalInput.value = formattedTotal;
            hiddensInput.value = data.totalUangSaku; // Tetap angka untuk backend


            // Format ke Rupiah untuk sisa saku
            const formattedSisa = convertToRupiah(data.sisa.toString());
            sisaInput.value = formattedSisa;
            sisaHiddensInput.value = data.sisa; // Tetap angka untuk backend
        })
        .catch(error => console.error('Error:', error));
}
</script>

<script>
    function tarikTotalBBM(index, idSpj) {
        fetch(`/total-bbm/${idSpj}`)
            .then(response => response.json())
            .then(data => {
                const totalInput = document.getElementById(`totalisibbm_${index}`);
                const hiddensInput = document.getElementById(`totalisibbm_${index}_hiddens`);
                const sisaInput = document.getElementById(`sisabbm_${index}`);
                const sisaHiddensInput = document.getElementById(`sisabbm_${index}_hiddens`);

                // Format ke Rupiah
                const formattedTotal = convertToRupiah(data.totalBBM.toString());
                totalInput.value = formattedTotal;
                hiddensInput.value = data.totalBBM; // Tetap angka untuk backend

                // Format ke Rupiah
                const formattedSisa = convertToRupiah(data.sisaBBM.toString());
                sisaInput.value = formattedSisa;
                sisaHiddensInput.value = data.sisaBBM; // Tetap angka untuk backend
       
            })
            .catch(error => console.error('Error:', error));
    }
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
        //function updateNilaiKontrak2State(jumlahArmada) {
        //   if (jumlahArmada == 1) {
        //        nilaiKontrak2v.value = 0;
        //        nilaiKontrak2v.disabled = true;
        //        nilaiKontrak2v.required = false;
        //        localStorage.setItem('nilaiKontrak2Disabled', 'true');
        //        localStorage.setItem('jumlahArmada', '1');
        //    } else if (jumlahArmada == 2) {
        //        nilaiKontrak2v.disabled = false;
        //        nilaiKontrak2v.required = true;
        //        localStorage.setItem('nilaiKontrak2Disabled', 'false');
        //        localStorage.setItem('jumlahArmada', '2');
        //    }
        //    nilaiKontrak2.dispatchEvent(new Event('input'));
        //}

        // Check localStorage on page load and set initial state
        // const savedJumlahArmada = localStorage.getItem('jumlahArmada');
        // if (savedJumlahArmada) {
        //     jumlahArmadaInput.value = savedJumlahArmada;
        //     updateNilaiKontrak2State(savedJumlahArmada);
        // }

        // // Event listener for jumlah_armada changes
        // jumlahArmadaInput.addEventListener('input', function() {
        //     updateNilaiKontrak2State(this.value);
        // });

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
<!-- 
<script>
    $(document).ready(function() {
        $(document).on('submit', '.form-update', function(e) {
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
                success: function(response) {
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
                            toastElement.style.display =
                                'none'; // Menghilangkan toast
                        }
                    }, 2500);

                    // Perbarui data pada halaman tanpa refresh (Opsional jika ingin menampilkan data baru)
                    $(`#data-${type}-${id}`).html(response.html);
                },
                error: function(xhr) {
                    alert(`Gagal mengupdate ${type}.`);
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> -->
<!-- kalkulasi toll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateEtollUsage(index) {
            const awalInput = document.getElementById(`SaldoEtollawal_${index}`);
            const akhirInput = document.getElementById(`SaldoEtollakhir_${index}`);
            const penggunaanInput = document.getElementById(`PenggunaanToll_${index}`);
            const penggunaanHidden = document.getElementById(`PenggunaanToll_${index}_hiddens`);

            function formatToRupiah(angka) {
                const isNegative = parseFloat(angka) < 0;
                let numberString = Math.abs(parseFloat(angka)).toString();
                let split = numberString.split('.');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    rupiah += (sisa ? '.' : '') + ribuan.join('.');
                }

                return (isNegative ? '-Rp ' : 'Rp ') + rupiah;
            }

            function calculate() {
                const awal = parseFloat(awalInput.value.replace(/[^\d]/g, '')) || 0;
                const akhir = parseFloat(akhirInput.value.replace(/[^\d]/g, '')) || 0;
                const penggunaan = awal - akhir;

                penggunaanInput.value = formatToRupiah(penggunaan);
                penggunaanHidden.value = penggunaan;
            }

            awalInput.addEventListener('input', calculate);
            akhirInput.addEventListener('input', calculate);
        }

        document.querySelectorAll('[id^="SaldoEtollawal_"]').forEach(element => {
            const index = element.id.split('_')[1];
            calculateEtollUsage(index);
        });
    });
</script>
<script>
    function tarikTotalSisa(index, idSpj) {
        fetch(`/total-sisa/${idSpj}`)
            .then(response => response.json())
            .then(data => {
                const totalInput = document.getElementById(`totalsisa_${index}`);
                const hiddensInput = document.getElementById(`totalsisa_${index}_hiddens`);


                // Format ke Rupiah
                const formattedValue = convertToRupiah(data.totalSisa.toString());


                // Set nilai untuk input dan hiddens
                totalInput.value = formattedValue;
                hiddensInput.value = data.totalSisa; // Tetap angka untuk backend
            })
            .catch(error => console.error('Error:', error));
    }


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('main_owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Windows 10 Pro\Documents\work\New folder\SIMA\resources\views/detail_pesanan.blade.php ENDPATH**/ ?>