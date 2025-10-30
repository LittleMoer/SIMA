<head>
    <title>Rekap Gaji Crew</title>
</head>

<body>
    <?php $__env->startSection('rekap_gaji_crew'); ?>
    <section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="<?php echo e(asset('sneat/assets/img/sima/header.png')); ?>"
        alt="Help center header" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <div class="container">
        <nav aria-label="breadcrumb" style="border-bottom: 1px solid #94acc6;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">
                    <a href="<?php echo e(url()->previous()); ?>">Rekap Gaji Crew</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Rekap gaji Karyawan dan Crew</a>
                </li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mb-3 mt-4">
    <section>
        <form action="<?php echo e(route('rekap.gaji.generate')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_armada" value="<?php echo e($armada->id_armada); ?>">

            <?php
                $currentMonth = date('m');
                $earliestYear = \App\Models\Sp::min(\DB::raw('YEAR(tgl_keberangkatan)')) ?? date('Y');
                $currentYear = date('Y');
            ?>

            <div class="form-group row mb-3">
                <div class="col-md-4">
                    <label for="bulan">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(str_pad($month, 2, '0', STR_PAD_LEFT)); ?>"
                                <?php echo e(old('bulan', $currentMonth) == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : ''); ?>>
                                <?php echo e(DateTime::createFromFormat('!m', $month)->format('F')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tahun">Pilih Tahun:</label>
                    <select name="tahun" id="tahun" class="form-control">
                         <?php for($year = $earliestYear; $year <= $currentYear; $year++): ?>
                            <option value="<?php echo e($year); ?>"
                                <?php echo e(old('tahun', $currentYear) == $year ? 'selected' : ''); ?>>
                                <?php echo e($year); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-4">Generate Rekap Gaji</button>
                </div>
            </div>
        </form>
</div>
        <div id="rekapgaji" class="container mb-3 mt-4">
            <h4>Armada: <?php echo e($armada->unit->nama_unit); ?></h4>
            <h4>Nama: <?php echo e($armada->akun->name); ?></h4>


            <?php if($rekapGajiCrew->count()): ?>
                <table class="table table-bordered align-items-center">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Jumlah Hari</th>
                            <th rowspan="2">Nama Pekerjaan</th>
                            <th rowspan="2">Nilai Kontrak</th>
                            <th colspan="4">Operasional</th>
                            <th rowspan="2">Total Operasional</th>
                            <th rowspan="2">Sisa Nilai Kontrak</th>
                            <th rowspan="2">Premi</th>
                            <th rowspan="2">Cuci</th>
                            <th rowspan="2">Subsidi</th>
                            <th rowspan="2">Total Gaji</th>
                        </tr>
                        <tr>
                            <th>BBM</th>
                            <th>Uang Makan</th>
                            <th>Saku</th>
                            <th>Tol</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $rekapGajiCrew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gaji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($gaji->tanggal); ?></td>
                            <td><?php echo e($gaji->hari_kerja); ?></td>
                            <td><?php echo e($gaji->nama_pemesanan); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->nilai_kontrak, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->bbm, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->uang_makan, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->parkir, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->toll, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->total_operasional, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->sisa_nilai_kontrak, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->premi, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->cuci, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->subsidi, 0, ',', '.')); ?></td>
                            <td><?php echo e('Rp ' . number_format($gaji->total_gaji, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <table class="table">
                    <tfoot>
                        <tr>
                            <th colspan="4">Jumlah Hari Dalam Satu Bulan:</th>
                            <td colspan="2"><?php echo e($totalharikerja); ?></td>
                            <th colspan="4">Total Premi:</th>
                            <td colspan="2"><?php echo e('Rp ' . number_format($totalpremi, 0, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <th colspan="4">Insentif:</th>
                            <td colspan="2">
                            <form method="POST" action="<?php echo e(route('rekap.gaji.insentif', ['id_armada' => $armada->id_armada])); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="input-group">
                                    <input type="number" name="insentif" class="form-control" id="insentif" value="<?php echo e($datainsentif->insentif ?? 0); ?>" oninput="calculateTotalPendapatan()">
                                    <button type="submit" class="btn btn-primary" id="submintinsentif">Simpan</button>
                                </div>
                            </form>
                            </td>
                            <th colspan="4">Total Pendapatan:</th>
                            <td colspan="2" id="totalPendapatan"><?php echo e('Rp ' . number_format($totalbulanan, 0, ',', '.')); ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <p class="text-muted">Tidak ada data rekap gaji untuk armada ini.</p>
            <?php endif; ?>
        </div>
        <div class="container mb-3 mt-4">
        <div class="form-group row mb-3">
        <div class = "col-md-1">
        <a class="btn btn-primary mt-2 " href="<?php echo e(route('rekap.gaji.edit', $armada->id_armada)); ?>" >Edit</a>
        </div>
        <div class = "col-md-1">
            <a class="btn btn-primary mt-2 " href="<?php echo e(route('manajemen_armada.index')); ?>" >Kembali</a>
        </div>
        <div class="col-md-2">
            <button id="printButton" class="btn btn-primary mt-2">Print Rekap Gaji</button>
        </div>
        </div>
        </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calculateTotalPendapatan() {
        const totalPremi = <?php echo e($totalpremi); ?>;
        const insentif = parseFloat(document.getElementById('insentif').value) || 0;
        const totalPendapatan = totalPremi + insentif;

        document.getElementById('totalPendapatan').innerText = 'Rp ' + totalPendapatan.toLocaleString('id-ID', { minimumFractionDigits: 0 });
    }

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('printButton').addEventListener('click', function() {
        // Get the current insentif value
        const insentifValue = document.getElementById('insentif').value;

        // Get the table's HTML
        var printContents = document.getElementById('rekapgaji').outerHTML;

        // Create a new window for printing
        var win = window.open('', '', 'height=500,width=800');
        win.document.write('<html><head><title>Print Rekap Gaji</title>');
        win.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">');
        win.document.write('<style>');
        win.document.write('@media print {');
        win.document.write('table { width: 100%; border-collapse: collapse; }');
        win.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
        win.document.write('th { background-color: #f2f2f2; }');
        win.document.write('#submintinsentif { display: none; }'); // Hide the save button when printing
        win.document.write('}');
        win.document.write('</style>');
        win.document.write('</head><body>');
        win.document.write(printContents); // Write the contents of the table
        win.document.write('</body></html>');
        win.document.close(); // Close the document
        win.print(); // Open the print dialog
    });
});
</script>



<?php if(session('success')): ?>
    <div id="successToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="me-auto fw-semibold"> ✓ Data Rekap Gaji</div>
            </div>
            <div class="toast-body">
                <?php echo e(session('success')); ?>

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
<?php endif; ?>
<?php if($errors->any()): ?>
    <div id="errorToast" style="position: fixed; top: 80px; right: 20px; z-index: 1050;">
        <div class="bs-toast toast show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto fw-semibold">✖ Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main_owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Windows 10 Pro\Documents\work\simapush\SIMA\resources\views/rekap_gaji_crew/index.blade.php ENDPATH**/ ?>