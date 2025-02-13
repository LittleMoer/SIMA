<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemesanan {{ $sp->id_sp }} {{ $sp->tgl_keberangkatan}} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/assets/img/sima/logo.png') }}" />


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
            font-size: 1.2em;
            /* Kurangi ukuran font untuk fit di halaman */
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea,
        select {
            width: 100%;
            border: none;
            padding: 3px;
            /* Kurangi padding */
            box-sizing: border-box;
            font-size: 0.8em;
            /* Kurangi ukuran font */
        }

        textarea {
            resize: vertical;
        }

        select {
            background: none;
        }

        .SK {
            margin-top: 5px;
            /* Kurangi margin */
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            /* Kurangi margin */
        }

        .signatureManajemen,
        .signaturePemesan {
            text-align: left;
            font-size: 1em;
            /* Kurangi ukuran font */
        }

        .small-text {
            font-size: 0.7em;
            /* Kurangi ukuran font */
            margin-bottom: 2px;
            /* Atur jarak antar item sesuai keinginan */
            padding-bottom: 0;
            /* Tambahkan jika ingin meniadakan padding bawah */
        }

        ul {
            list-style-type: disc;
            padding-left: 15px;
            /* Kurangi padding */
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
            width: 100px;
            /* Sesuaikan ukuran logo */
        }

        .company-info {
            text-align: left;
        }

        .company-info h1 {
            margin: 0;
            font-size: 1.4em;
            /* Kurangi ukuran font */
        }

        .company-info p {
            margin: 0;
            font-size: 0.8em;
            /* Kurangi ukuran font */
            line-height: 1.4;
        }

        .order-title {
            text-align: center;
        }

        .order-title h5 {
            color: black;
            margin-top: 5px;
            /* Jarak dari elemen sebelumnya */

        }

        .order-title p {
            margin-bottom: 1px;

            /* Jarak ke elemen <p> */
        }

        .gambar-hitam {
            filter: grayscale(100%);
        }

        .gambar-status {
            position: absolute;
            /* Posisi absolut untuk gambar */
            margin-left: 190px;
            /* Memberikan jarak antara teks dan gambar */
            top: 530px;
            width: 150px;
            /* Ukuran gambar */
            opacity: 0.5;
            /* Transparansi gambar */
            z-index: 1;
            /* Pastikan gambar berada di atas tabel */
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
                font-size: 1em;
                /* Kurangi ukuran font */
            }

            .header,
            .signature-container,
            .SK {
                page-break-inside: avoid;
                /* Hindari pemisahan bagian penting saat print */
            }

            .header,
            .signature-container,
            .SK {
                margin-bottom: 5px;
                /* Kurangi margin bawah */
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

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #element-to-print,
            #element-to-print * {
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

    <script>
        function createPDF() {
            var element = document.getElementById('element-to-print');
            html2pdf(element, {
                margin: [0.5, 0.5, 0.5, 0.5],
                filename: 'myfile.pdf',
                image: {
                    type: 'png',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'P'
                }
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

            #element-to-print,
            #element-to-print * {
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

    <div id="element-to-print">
        <div class="table-container">

            <table>
                <div class="header">
                    <div class="logo">
                        <img src="https://i.ibb.co.com/dMHB2bC/sima.png" alt="Logo" width="160"
                            class="gambar-hitam">
                    </div>

                    <div class="company-info">
                        <h1 style="color: black"><b>Your Transportation Solution</b></h1>
                        <p>PT. JAGAD SIMA PERKASYA<br>
                            PERUMAHAN MANGUNSARI ASRI NO. 6<br>
                            RT 07 / RW 04 MANGUNSARI GUNUNGPATI SEMARANG<br>
                            No.Telp 08135 9999 789</br>
                            No.Telp 08123 7888 789</p>
                    </div>
                </div>

                <div class="order-title">
                    <h5 style="color: black"><b>SURAT PEMESANAN</b></h5>
                    <h6 style="color: black">No. {{ $sp->id_sp }}</h6>
                </div>
                <tbody class="table">
                    <thead>
                        <tr>
                            <th>Marketing</th>
                            <td colspan="3">{{ $marketing->name }}</td>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Nama Pemesanan</th>
                            <td>{{ $sp->nama_pemesan }}</td>
                            <th>No Telp</th>
                            <td>{{ $sp->no_telppn }}</td>
                        </tr>
                    </thead>

                    <tr>
                        <td>PJ Rombongan</td>
                        <td>{{ $sp->pj_rombongan }}</td>
                        <td>No Telp</td>
                        <td>{{ $sp->no_telpps }}</td>
                    </tr>
                    <thead>
                        <tr>
                            <th>Tanggal Keberangkatan</th>
                            <td>{{ $sp->tgl_keberangkatan }}</td>
                            <th>Jam</th>
                            <td>{{ $sp->jam_keberangkatan }}</td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Tanggal Kepulangan</td>
                        <td>{{ $sp->tgl_kepulangan }}</td>
                        <td>Jam</td>
                        <td>{{ $sp->jam_kepulangan }}</td>
                    </tr>
                    <thead>
                        <tr>
                            <th>Tujuan</th>
                            <td colspan="3">{{ $sp->tujuan }}</td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Alamat Penjemputan</td>
                        <td colspan="3">{{ $sp->alamat_penjemputan }}</td>
                    </tr>
                    <thead>
                        <tr>
                            <th rowspan="2">Jumlah Armada</th>
                            <td rowspan="2">{{ $sp->jumlah_armada }}</td>
                            <td>Nilai Kontrak 1</td>
                            <td>@currency($sp->nilai_kontrak1)</td>
                        </tr>
                        <tr>
                            <td>Nilai Kontrak 2</td>
                            <td>@currency($sp->nilai_kontrak2)</td>
                        </tr>
                    </thead>

                    <tr>
                        <td>Biaya Tambahan</td>
                        <td colspan="3">@currency($sp->biaya_tambahan)</td>
                    </tr>
                    <tr>
                        <td>Total Biaya</td>
                        <td colspan="3">@currency($sp->total_biaya)</td>
                    </tr>
                    <tr>
                        <td>Uang Muka</td>
                        <td colspan="3">@currency($sp->uang_muka)</td>
                    </tr>
                    {{-- <tr>
                         <td>Status Pembayaran</td>
                        @if ($sp->status_pembayaran == 1){
                            <td colspan="3"><img src="{{ asset('images/lunas.png') }}" alt="Logo" width="120" class="gambar-hitam"></td>
                    }
                    @else{
                    <td colspan="3"><img src="{{ asset('images/downpayment.png') }}" alt="Logo" width="120" class="gambar-hitam"></td>
                    }
                    @endif
                    </tr> --}}

                    <tr>
                        <td>Sisa Pembayaran</td>
                        <td colspan="3" class="sisa-pembayaran-container">
                            @currency($sp->sisa_pembayaran)
                            @if ($sp->status_pembayaran == 1)
                            <div class="status">

                                <img src="{{ asset('images/lunas.png') }}" alt="Lunas" class=" gambar-status">
                            </div>
                            @else
                            <div class="status">
                                <img src="{{ asset('images/downpayment.png') }}" alt="Downpayment"
                                    class=" gambar-status">
                            </div>
                            @endif
                        </td>
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
                    Pemesan<br><br> <br>
                    ______________________
                </div>
                <div class="signatureManajemen">
                    <div class="date-text">
                        {{ $sp->created_at->format('d F Y') }} <!-- Jika menggunakan Laravel -->
                    </div>
                    Semarang, Manajemen JSP <br>
                    <img src="{{ asset('images/ttd.png') }}" alt="Logo" width="100">
                </div>
            </div>
            <div class="SK">
                <strong>Syarat dan Ketentuan</strong> <br>

                <ul class="small-text">
                    <li>Pemesan/penyewa wajib membayarkan uang muka (DP) minimal 25% dari total nilai kontrak.</li>
                    <li>Pembayaran dapat ditransfer ke rekening: <br> <strong>A.n JAGAD SIMA PERKASYA</strong> <br> BRI: 136901000438301 <br> Mandiri: 1350019116597 </li>
                    <li>Pelunasan maksimal 7 hari sebelum pemberangkatan.</li>
                    <li>Jika terjadi pembatalan maka uang muka tidak bisa dikembalikan.</li>
                    <li>Kelebihan waktu sewa akan dikenakan biaya tambahan sebesar Rp. 200.000-Rp. 400.000/jam.</li>
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

</body>

</html>