@extends('main_owner')

@section('rekap_gaji_crew')
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
    <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}"
        alt="Help center header">
    <h3 class="text-center">Rekap Gaji Crew</h3>
    <h5 class="text-center px-3 mb-0">Catatan penghasilan crew perbulan</h5>
</section>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section>
    <h2>Rekap Gaji Crew - {{ $armada->id_armada }}</h2>



    <form action="{{ route('rekap.gaji.generate') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="hidden" name="id_armada" value="{{ $armada->id_armada }}">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan" required>
            <option value="" disabled selected>Pilih bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <button type="submit" class="btn btn-success">Generate Payroll Summary</button>
    </form>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pekerjaan</th>
                <th>Nilai Kontrak</th>
                <th>BBM</th>
                <th>Uang Makan</th>
                <th>Parkir</th>
                <th>Cuci</th>
                <th>Toll</th>
                <th>Total Operasional</th>
                <th>Sisa Nilai Kontrak</th>
                <th>Premi</th>
                <th>Subsidi</th>
                <th>Total Pendapatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekapGaji as $index => $rekap)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rekap->tanggal }}</td>
                    <td>{{ $rekap->pj_rombongan }}</td>
                    <td>{{ number_format($rekap->nilai_kontrak, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->bbm, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->uang_makan, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->parkir, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->cuci, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->toll, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->total_operasional, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->sisa_nilai_kontrak, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->premi, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->subsidi, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($rekap->total_gaji, 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('rekap.gaji.edit', ['no_rekap' => $rekap->no_rekap, 'nama' => $rekap->nama]) }}"
                            class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</section>

<a href="{{ route('rekap.gaji.index') }}">Kembali ke Pilih Armada</a>
@endsection
