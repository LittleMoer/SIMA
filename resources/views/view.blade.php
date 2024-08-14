<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
 
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
            background-color: white;
            /* font-family: 'Montserrat', sans-serif; */
            margin: 0;
            padding: 0;
            color: black;
        }
        #element-to-print {
            width: 100%;
            box-sizing: border-box;
        }
        .table-container {
            width: 100%;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8em; /* Kurangi ukuran font untuk fit di halaman */
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: black;
            color: white;
        }
        input[type="text"], input[type="date"], input[type="time"], textarea, select {
            width: 100%;
            border: none;
            padding: 3px; /* Kurangi padding */
            box-sizing: border-box;
            font-size: 0.8em; /* Kurangi ukuran font */
        }
        textarea {
            resize: vertical;
        }
        select {
            background: none;
        }
        .SK {
            margin-top: 8px; /* Kurangi margin */
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 8px; /* Kurangi margin */
        }
        .signatureManajemen, .signaturePemesan {
            text-align: left;
            font-size: 0.8em; /* Kurangi ukuran font */
        }
        .small-text {
            font-size: 0.6em; /* Kurangi ukuran font */
        }
        ul {
            list-style-type: disc;
            padding-left: 15px; /* Kurangi padding */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid black;
            padding-bottom: 5px; 
            margin-bottom: 8px; 
        }
        .logo {
            width: 150px; /* Sesuaikan ukuran logo */
        }
        .company-info {
            text-align: left;
        }
        .company-info h1 {
            margin: 0;
            font-size: 1.2em; /* Kurangi ukuran font */
        }
        .company-info p {
            margin: 0;
            font-size: 0.7em; /* Kurangi ukuran font */
        }
        .order-title {
            text-align: center;
        }
        .gambar-hitam {
            filter: grayscale(100%);
        }

        @media print {
            #element-to-print {
                width: 100%;
                height: 100%;
                overflow: hidden;
                page-break-inside: avoid;
            }
            @page {
                size: A4;
                margin: 0.5in;
            }
            table {
                font-size: 0.8em; /* Kurangi ukuran font */
            }
            .header, .signature-container, .SK {
                page-break-inside: avoid; /* Hindari pemisahan bagian penting saat print */
            }
            .header, .signature-container, .SK {
        margin-bottom: 5px; /* Kurangi margin bawah */
    }
        }
    </style>
    <script>
        function toggleCustomMethod() {
            const select = document.getElementById('payment-method');
            const customMethod = document.getElementById('custom-method');
            const selectedValue = select.options[select.selectedIndex].value;
            if (selectedValue === 'other') {
                customMethod.style.display = 'block';
                select.style.display = 'none';
            } else {
                customMethod.style.display = 'none';
                select.style.display = 'block';
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
        function createPDF() {
            var element = document.getElementById('element-to-print');
            html2pdf(element, {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: 'myfile.pdf',
                image: { type: 'png', quality: 1 },
                html2canvas: { scale: 1, useCORS: true },
                jsPDF: { unit: 'in', format: 'A4', orientation: 'P' }
            });
        }

function printPreview() {
    window.print();
}

    </script>
  <style>
    @media print {
    body * {
        visibility: hidden;
    }
    #element-to-print, #element-to-print * {
        visibility: visible;
    }
    #element-to-print {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
}

  </style>
    <script>
        function toggleCustomMethod() {
            const select = document.getElementById('payment-method');
            const customMethod = document.getElementById('custom-method');
            const selectedValue = select.options[select.selectedIndex].value;
            if (selectedValue === 'other') {
                customMethod.style.display = 'block';
                select.style.display = 'none';
            } else {
                customMethod.style.display = 'none';
                select.style.display = 'block';
            }
        }
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script>
            function createPDF() {
                var element = document.getElementById('element-to-print');
                html2pdf(element, {
                    margin: [0.5, 0.5, 0.5, 0.5],
                    filename: 'myfile.pdf',
                    image: { type: 'png', quality: 1 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'in', format: 'A4', orientation: 'P' }
                });
            }
    
    function printPreview() {
        window.print();
    }
    
        </script>
      <style>
        @media print {
        body * {
            visibility: hidden;
        }
        #element-to-print, #element-to-print * {
            visibility: visible;
        }
        #element-to-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
    }
    
      </style>
</head>
<body class="container">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px; margin-top: 10px; ">
        <button class="btn btn-primary" onclick="createPDF()" style="margin-right: 5px">Download</button>
        <button class="btn btn-secondary" onclick="printPreview()">Preview Print PDF</button>
    </div>
  <div id="element-to-print">
  <div class="table-container">
       
            <table>
                <div class="header">
                    <div class="logo">
                        <img src="https://i.ibb.co.com/dMHB2bC/sima.png" alt="Logo" width="200" class="gambar-hitam">
                    </div>
                    <div class="company-info">
                        <h1 style="color: black"><b>Your Transportation Solution</b></h1>
                        <p>PT. JAGAD SIMA PERKASYA<br>
                        PERUMAHAN MANGUNSARI ASRI NO. 6<br>
                        RT 07 / RW 04 MANGUNSARI GUNUNGPATI SEMARANG<br>
                        TELP. 08135 9999 789</p>
                    </div>
                </div>
    
                <div class="order-title">
                    <h5 style="color: black"><b>SURAT PEMESANAN</b></h5>
                    <p>No. {{ $sp->id_sp }}</p>
                </div>
                <tbody>
                    <tr>
                        <th>Nama Pemesan</th>
                        <td>{{ $sp->nama_pemesan }}</td>
                        <th>No Telp</th>
                        <td>{{ $sp->no_telppn }}</td>
                    </tr>
                    <tr>
                        <td>PJ Rombongan</td>
                        <td>{{ $sp->pj_rombongan }}</td>
                        <td>No Telp</td>
                        <td>{{ $sp->no_telpps }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keberangkatan</th>
                        <td>{{ $sp->tgl_keberangkatan }}</td>
                        <th>Jam</th>
                        <td>{{ $sp->jam_keberangkatan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kepulangan</td>
                        <td>{{ $sp->tgl_kepulangan }}</td>
                        <td>Jam</td>
                        <td>{{ $sp->jam_kepulangan }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan</th>
                        <td colspan="3">{{ $sp->tujuan }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Penjemputan</td>
                        <td colspan="3">{{ $sp->alamat_penjemputan }}</td>
                    </tr>
                    <tr>
                        <th rowspan="2">Jumlah Armada</th>
                        <td rowspan="2">{{ $sp->jumlah_armada }}</td>
                        <td>Nilai Kontrak 1</td>
                        <td>{{ $sp->nilai_kontrak1 }}</td>
                    </tr>
                    <tr>
                        <td>Nilai Kontrak 2</td>
                        <td>{{ $sp->nilai_kontrak2 }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Tambahan</td>
                        <td colspan="3">{{ $sp->biaya_tambahan }}</td>
                    </tr>
                    <tr>
                        <td>Total Biaya</td>
                        <td colspan="3">{{ $sp->total_biaya }}</td>
                    </tr>
                    <tr>
                        <td>Uang Muka</td>
                        <td colspan="3">{{ $sp->uang_muka }}</td>
                    </tr>
                    <tr>
                        <td>Sisa Pembayaran</td>
                        <td colspan="3">{{ $sp->sisa_pembayaran }}</td>
                    </tr>
                    <tr>
                        <td>Metode Pembayaran</td>
                        <td colspan="3">
                            {{ $sp->metode_pembayaran }}
                        </td>
                    </tr>
                    <tr>
                        <td>Catatan Lainnya</td>
                        <td colspan="3">{{ $sp->catatan_pembayaran }}</td>
                    </tr>
                </tbody>
            </table>
    
            <div class="signature-container">
                <div class="signaturePemesan">
                    Pemesan<br><br><br><br>
                    (____________________)
                </div>
                <div class="signatureManajemen">
                    Semarang,<br>
                    Manajemen JSP<br><br><br><br>
                    (____________________)
                </div>
            </div>
            <div class="SK">
                <strong>Syarat dan Ketentuan</strong>
                <br>
                <ul class="small-text">
                    <li>Semua pembayaran melalui rekening Bank Mandiri an JAGAD SIMA PERKASYA No.rek 1350019116597.</li>
                    <li>Pemesan/penyewa wajib membayarkan uang muka sebesar 25% dari total nilai kontrak.</li>
                    <li>Pelunasan maksimal 7 hari sebelum pemberangkatan.</li>
                    <li>Jika terjadi pembatalan maka uang muka tidak bisa dikembalikan.</li>
                    <li>Kelebihan waktu sewa akan dikenakan biaya tambahan sebesar Rp. 200.000/jam.</li>
                    <li>Harga di atas tidak termasuk biaya tol, parkir, pajak, retribusi penyeberangan/ferry.</li>
                    <li>Harga sewaktu-waktu bisa berubah jika terjadi kenaikan BBM.</li>
                    <li>Penyewa berhak menegur pengemudi yang ugal-ugalan/melaporkan kepada pihak manajemen.</li>
                    <li>Akses charger di tiap armada dikhususkan hanya untuk charging handphone, bukan perangkat-perangkat lainnya.</li>
                    <li>Penyewa tidak diperbolehkan merubah/menambah rute perjalanan diluar yang telah disepakati.</li>
                    <li>Pengemudi berhak menolak jika akses jalan tidak memadai untuk dilalui armada.</li>
                    <li>Kehilangan, kerusakan, dan barang tertukar bukan tanggung jawab crew/perusahaan.</li>
                    <li>Penyewa harus bertanggung jawab atas kerusakan yang disebabkan oleh peserta rombongan.</li>
                </ul>
            </div>
    
        
    </div>
</div>

</body>
</html>
