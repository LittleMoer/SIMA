<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Surat Pesanan</title>
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/assets/img/sima/logo.png') }}" />

    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
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
            font-size: 0.8em;
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
        background: none;
    }
    .SK {
        margin-top: 2px; /* Kurangi margin */
    }
    .signature-container {
        display: flex;
        justify-content: space-between;
        margin-top: 8px; /* Kurangi margin */
    }
    .signatureManajemen, .signaturePemesan {
        text-align: left;
        font-size: 1em; /* Kurangi ukuran font */
    }
    .small-text {
        font-size: 0.6em; /* Kurangi ukuran font */
        margin-bottom: 2px; /* Atur jarak antar item sesuai keinginan */
        padding-bottom: 0; /* Tambahkan jika ingin meniadakan padding bawah */
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
        width: 100px; /* Sesuaikan ukuran logo */
    }
    .company-info {
        text-align: left;
    }
    .company-info h1 {
        margin: 0;
        font-size: 1.4em; /* Kurangi ukuran font */
    }
    .company-info p {
        margin: 0;
        font-size: 0.8em; /* Kurangi ukuran font */
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
                font-size: 0.8em;
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
</head>

<body class="container">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px; margin-top: 10px; ">
        <button class="btn btn-secondary" onclick="printPreview()">Print Preview</button>
    </div>
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
                            TELP. 08135 9999 789</p>
                    </div>
                </div>

                <div class="order-title">
                    <h5><b>SURAT PERINTAH JALAN</b></h5>
                    <p>No.{{ $sp->id_sp }}</p>
                </div>
                <tbody>
                    <tr>
                        <th>No Pemesan</th>
                        <td>{{ $sp->id_sp }}</td>
                        <th>No Lambung</th>
                        <td>{{ $unit->nama_unit}}</td>
                    </tr>
                    <tr>
                        <td>Driver</td>
                        <td> {{ $sj->driver}} </td>
                        <td>Co Driver</td>
                        <td> {{ $sj->codriver}} </td>
                    </tr>



                </tbody>

            </table>
            <table style="border: none; border-collapse: collapse;">
                <tr>
                    <td style="border: none; width: 200px; line-height: 1; padding: 2px;">Tujuan</td>
                    <td style="border: none; line-height: 1; padding: 2px;">
                        <span class="line"></span>: {{ $sp->tujuan }}
                    </td>
                </tr>
                <tr>
                    <td style="border: none; width: 200px; line-height: 1; padding: 2px;">Tanggal dan jam keberangkatan</td>
                    <td style="border: none; line-height: 1; padding: 2px;">
                        <span class="line"></span>: {{ $sp->tgl_keberangkatan }}, {{ $sp->jam_keberangkatan }}
                    </td>
                </tr>
                <tr>
                    <td style="border: none; width: 200px; line-height: 1; padding: 2px;">Tanggal dan jam tiba</td>
                    <td style="border: none; line-height: 1; padding: 2px;">
                        <span class="line"></span>: {{ $sp->tgl_kepulangan }}, {{ $sp->jam_kepulangan }}
                    </td>
                </tr>
                <tr>
                        <td>KM saat Berangkat</td>
                        <td colspan="3">{{ $sj->kmsebelum}}</td>
                    </tr>
                    <tr>
                        <td>KM saat Tiba</td>
                        <td colspan="3">{{ $sj->kmtiba }}</td>
                    </tr>
                    <tr>
                        <td>KM Tempuh</td>
                        <td colspan="3">--</td>
                    </tr>
                    <tr>
                        <td>Kasbon BBM</td>
                        <td colspan="3">@currency($sj->kasbonbbm)</td>
                    </tr>
                    <tr>
                        <td>Kasbon uang makan</td>
                        <td colspan="3">@currency($sj->kasbonmakan)</td>
                    </tr>
                    <tr>
                        <td>Lain-lain</td>
                        <td colspan="3">
                            @currency($sj->lainlain)
                        </td>
                    </tr> 
            </table>
            
            
            <div style="display: flex; gap: 20px;">
                <!-- Tabel Kiri -->
                <table style="width: 50%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid black; ">Saldo awal E-toll</td>
                        <td style="border: 1px solid black; ">@currency($spj->SaldoEtollawal)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Saldo akhir E-toll</td>
                        <td style="border: 1px solid black; ">@currency($spj->SaldoEtollakhir)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Penggunaan Toll</td>
                        <td style="border: 1px solid black; ">@currency($spj->PenggunaanToll)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Uang Saku</td>
                        <td style="border: 1px solid black; ">@currency($spj->uanglainlain)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Uang Makan</td>
                        <td style="border: 1px solid black; ">@currency($spj->uangmakan)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Total BBM</td>
                        <td style="border: 1px solid black; ">@currency($spj->totalisibbm)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Sisa BBM</td>
                        <td style="border: 1px solid black; ">@currency ($spj->sisabbm)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Sisa Saku</td>
                        <td style="border: 1px solid black; ">@currency($spj->sisasaku)</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; ">Total Sisa</td>
                        <td style="border: 1px solid black; "> @currency($spj->totalsisa)</td>
                    </tr>
                </table>

                <!-- Tabel Kanan -->
                @if($bbms->count())
                <table style="width: 50%; border-collapse: collapse; font-size: 0.8em; white-space: nowrap;">
                    <thead>
                        <tr>
                            <td style="border: 1px solid black; padding: 4px;">Pengisian BBM</td>
                            <td style="border: 1px solid black; padding: 4px;">Tanggal</td>
                            <td style="border: 1px solid black; padding: 4px;">Lokasi</td>
                            <td style="border: 1px solid black; padding: 4px;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bbms as $bbm)
                            <tr>
                                <td style="border: 1px solid black; padding: 4px;">{{ $bbm->isiBBM }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $bbm->tanggal }}</td>
                                <td style="border: 1px solid black; padding: 4px;">{{ $bbm->lokasiisi }}</td>
                                <td style="border: 1px solid black; padding: 4px;">@currency($bbm->totalbayar)</td>
                            </tr>
                        @endforeach
            
                        @if($pengeluaran)
                            <tr>
                                <td rowspan="3" style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                    Pengeluaran<br> Uang Saku
                                </td>
                                <td colspan="3" style="border: 1px solid black; padding: 4px;">
                                    @currency($pengeluaran->nominal ?? '-')
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid black; padding: 4px;">
                                    {{ $pengeluaran->catatan ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border: 1px solid black; padding: 4px;">
                                    {{ $pengeluaran->deskripsi ?? '-' }}
                                </td>
                            </tr>
                       
                        @endif
                    </tbody>
                </table>
            @endif
            



                {{-- 
                </tr>
                <tr>
                    <td colspan="4" style="height: 30px;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="height: 30px;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="height: 30px;"></td>
                </tr>
                </table> --}}
            </div>






            <div class="signature-container">
                <div class="signaturePemesan">
                    Pemesan<br><br><br>
                    ____________________
                </div>
                <div class="signatureManajemen">
                    Semarang,<br>
                    Manajemen JSP<br><br><br>
                    ____________________
                </div>
            </div>
            <!-- <div class="SK">
                <strong>Syarat dan Ketentuan</strong>
                
                <ul class="small-text">
                    <li>Semua pembayaran melalui rekening Bank Mandiri an JAGAD SIMA PERKASYA No.rek 1350019116597.</li>
                    <li>Pemesan/penyewa wajib membayarkan uang muka sebesar 25% dari total nilai kontrak.</li>
                    <li>Pelunasan maksimal 7 hari sebelum pemberangkatan.</li>
                    <li>Jika terjadi pembatalan maka uang muka tidak bisa dikembalikan.</li>
                    <li>Kelebihan waktu sewa akan dikenakan biaya tambahan sebesar Rp. 200.000/jam.</li>
                    <li>Harga di atas tidak termasuk biaya tol, parkir, pajak, retribusi penyeberangan/ferry.</li>
                    <li>Harga sewaktu-waktu bisa berubah jika terjadi kenaikan BBM.</li>
                    <li>Penyewa berhak menegur pengemudi yang ugal-ugalan/melaporkan kepada pihak manajemen.</li>
                    <li>Akses charger di tiap armada dikhususkan hanya untuk charging handphone, bukan
                        perangkat-perangkat lainnya.</li>
                    <li>Penyewa tidak diperbolehkan merubah/menambah rute perjalanan diluar yang telah disepakati.</li>
                    <li>Pengemudi berhak menolak jika akses jalan tidak memadai untuk dilalui armada.</li>
                    <li>Kehilangan, kerusakan, dan barang tertukar bukan tanggung jawab crew/perusahaan.</li>
                    <li>Penyewa harus bertanggung jawab atas kerusakan yang disebabkan oleh peserta rombongan.</li>
                </ul>
            </div> -->


        </div>
    </div>

</body>

</html>
