<?php

namespace App\Http\Controllers;

use App\Models\Konsumbbm;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sp;
use App\Models\Spj;
use App\Models\Sj;
use App\Models\Unit;
use App\Models\Armada;
use App\Models\PengeluaranUangSaku;
use App\Models\Akun;


class OrderController extends Controller
{
    public function index()
    {
        $allSp = SP::all();
       
        foreach($allSp as $sp) {
            $unitNames = [];  // Array untuk menyimpan nama unit
            $sjList = SJ::where('id_sp', $sp->id_sp)->get();
           
            foreach($sjList as $sj) {
                $unit = Unit::find($sj->id_unit);  // Menggunakan find() alih-alih where()
                if($unit !== null) {  // Periksa apakah unit ditemukan
                    $unitNames[] = $unit->nama_unit;
                }
            }
           
            $sp->unit_names = $unitNames;  // Simpan array nama unit ke SP
        }
   
        return view('pesanan', compact('allSp'));
    }
    public function getkasbon( $id_spj) {
        //fetch kasbonbbm,kasbonmakan,lainlain,nilai_kontrak from sj and sp that related to spj
        $spj = SPJ::where('id_spj', $id_spj)->first();
        $sj = SJ::where('id_sj', $spj->id_sj)->first();
        $sp = SP::where('id_sp', $sj->id_sp)->first();
        return response()->json([
            'kasbonbbm' => $sj->kasbonbbm,
            'kasbonmakan' => $sj->kasbonmakan,
            'lainlain' => $sj->lainlain,
            'nilai_kontrak' => $sj->nilai_kontrak,
        ]);
    }
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'nama_pemesan' => 'required',
            'pj_rombongan' => 'nullable',
            'no_telppn' => 'required',  
            'no_telpps' => 'nullable',
            'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
            'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
            'tujuan' => 'nullable',
            'alamat_penjemputan' => 'nullable',
            'jumlah_armada' => 'required',
            'nilai_kontrak1' => 'required',
            'nilai_kontrak2' => 'nullable',
            'biaya_tambahan' => 'nullable',
            'total_biaya' => 'required',
            'uang_muka' => 'required',
            'status_pembayaran' => 'required',
            'sisa_pembayaran' => 'nullable',
            'metode_pembayaran' => 'required',
            'catatan_pembayaran' => 'nullable'
        ]);

        // Extract date and time from input
        $tgl_keberangkatan = date('Y-m-d', strtotime($request->tgl_keberangkatan_full));
        $jam_keberangkatan = date('H:i', strtotime($request->tgl_keberangkatan_full));
        $tgl_kepulangan = date('Y-m-d', strtotime($request->tgl_kepulangan_full));
        $jam_kepulangan = date('H:i', strtotime($request->tgl_kepulangan_full));

        // Prepare data for SP
        $orderData = $request->except('_token', 'tgl_keberangkatan_full', 'tgl_kepulangan_full');
        $orderData['tgl_keberangkatan'] = $tgl_keberangkatan;
        $orderData['jam_keberangkatan'] = $jam_keberangkatan;
        $orderData['tgl_kepulangan'] = $tgl_kepulangan;
        $orderData['jam_kepulangan'] = $jam_kepulangan;

        //input marketing data using getmarketing function 
        $orderData['marketing'] = Auth::user()->name;

        // Create the SP record
        $order = SP::create($orderData);
        
        // Create the required SJ and SPJ records as many as "jumlah armada"
        for ($i = 0; $i < $request->jumlah_armada; $i++) {
            // Generate a random 4-digit number for id_sj and id_spj
            $randomId = mt_rand(1000, 9999);

            // Determine the appropriate contract value for each armada
            $nilaiKontrak = ($i == 0) ? $request->nilai_kontrak1 : ($request->nilai_kontrak2 ?? $request->nilai_kontrak1);

            // Create SJ
            $sj = SJ::create([
                'id_sj' => $randomId, 
                'id_sp' => $order->id_sp, 
                'jumlahseat' => null,
                'kmsebelum' => null,
                'kmtiba' => null,
                'kmtempuh' => null,
                'kasbonbbm' => null,
                'kasbonmakan' => null,
                'lainlain' => null
            ]);
            
            // Create SPJ and link it to the SJ records
            $spj = SPJ::create([
                'id_spj' => $randomId,
                'id_sj' => $sj->id_sj,
                'SaldoEtollawal' => null,
                'SaldoEtollakhir' => null,
                'PenggunaanToll' => null,
                'uanglainlain' => null,
                'uangmakan' => null,
                'totalisibbm' => null,
                'sisabbm' => null,
                'sisasaku' => null,
                'totalsisa' => null,
                
            ]);
        }

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
    }
public function view($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    $marketing = Akun::where('id_akun', $sp->marketing)->firstOrFail();
    return view('view', compact('sp', 'marketing'));
}


public function viewSJ($id_sj)
{
    $sj = SJ::findOrFail($id_sj);
    $sp = SP::where('id_sp', $sj->id_sp)->firstOrFail();
    $unit = Unit::where('id_unit', $sj->id_unit)->firstOrFail();
    return view('viewSJ', compact('sp', 'sj', 'unit'));
}

public function viewSPJ($id_spj)
{
    // Ambil data SPJ berdasarkan id_spj
    $spj = SPJ::findOrFail($id_spj);
    
    // Ambil data SJ yang terkait dengan SPJ
    $sj = SJ::where('id_sj', $spj->id_sj)->firstOrFail();
    
    // Ambil data SP yang terkait dengan SJ
    $sp = SP::where('id_sp', $sj->id_sp)->firstOrFail();
    
    // Ambil data Unit yang terkait (jika diperlukan)
    $unit = Unit::where('id_unit', $sj->id_unit)->firstOrFail();

    //Ambil data bbm
    $bbms = Konsumbbm::where('id_spj', $id_spj)->get();

    $pengeluaran = PengeluaranUangSaku::where('id_spj', $id_spj)->first();

        

    // Kirim data ke view 'viewSPJ'
    return view('viewSPJ', compact('spj', 'sj', 'sp', 'unit', 'bbms', 'pengeluaran'));
}



public function detail($id)
{
    // Retrieve the SP record based on id_sp
    $sp = SP::where('id_sp', $id)->firstOrFail();

    // Retrieve all SJ records related to this SP
    $sjs = SJ::where('id_sp', $id)->get();

      // Retrieve all SPJ records related to this SP
    //   $spjs = SPJ::where('id_sj', $id)->get();

    // Retrieve all SPJ records where id_sj is among the SJ records retrieved
    $spjs = SPJ::whereIn('id_sj', $sjs->pluck('id_sj'))->get();

    $units = Unit::all();
    // Pass data to the view
    $units = Unit::orderBy('seri_unit')->get();

    $akuns = Akun::all();

    $pengeluaranData = PengeluaranUangSaku::where('id_spj', $id)->get();

    // dd($akuns);
    
    return view('detail_pesanan', compact('sp', 'sjs', 'spjs', 'units', 'akuns', 'pengeluaranData'));
}




public function updateSP(Request $request, $id)
{
    // Validate request
    $validatedData = $request->validate([
        'nama_pemesan' => 'required',
        'marketing' => 'required',
        'pj_rombongan' => 'nullable',
        'no_telppn' => 'required',
        'no_telpps' => 'nullable',
        'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
        'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
        'tujuan' => 'nullable',
        'alamat_penjemputan' => 'nullable',
        'jumlah_armada' => 'required|integer',
        'nilai_kontrak1' => 'required|numeric',
        'nilai_kontrak2' => 'nullable|numeric',
        'biaya_tambahan' => 'nullable|numeric',
        'total_biaya' => 'required|numeric',
        'uang_muka' => 'required|numeric',
        'status_pembayaran' => 'required',
        'sisa_pembayaran' => 'nullable|numeric',
        'metode_pembayaran' => 'required',
        'catatan_pembayaran' => 'nullable'
    ]);

    $validatedData['tgl_keberangkatan'] = date('Y-m-d', strtotime($validatedData['tgl_keberangkatan_full']));
    $validatedData['jam_keberangkatan'] = date('H:i', strtotime($validatedData['tgl_keberangkatan_full']));

    $validatedData['tgl_kepulangan'] = date('Y-m-d', strtotime($validatedData['tgl_kepulangan_full']));
    $validatedData['jam_kepulangan'] = date('H:i', strtotime($validatedData['tgl_kepulangan_full']));


    // Retrieve the SP record
    $sp = SP::findOrFail($id);

    // Update all validated fields
    $sp->fill($validatedData);

    // Handle jumlah_armada changes
    $newJumlahArmada = $validatedData['jumlah_armada'];
    $currentSJs = SJ::where('id_sp', $sp->id_sp)->get();

    if ($newJumlahArmada < $currentSJs->count()) {
        // Delete excess SJs and related records
        $sjsToDelete = $currentSJs->slice($newJumlahArmada);
        foreach ($sjsToDelete as $sj) {
            // Delete related KonsumBbm records first
            $spj = SPJ::where('id_sj', $sj->id_sj)->first();
            if ($spj) {
                KonsumBbm::where('id_spj', $spj->id_spj)->delete();
                $spj->delete();
            }
            $sj->delete();
        }
    } elseif ($newJumlahArmada > $currentSJs->count()) {
        // Create new SJs and related records
        for ($i = $currentSJs->count(); $i < $newJumlahArmada; $i++) {
            // Generate random ID for all related records
            $randomId = mt_rand(1000, 9999);
            
            // Create new SJ
            $sj = SJ::create([
                'id_sj' => $randomId,
                'id_sp' => $sp->id_sp,
                'nilai_kontrak' => null,
                'jumlahseat' => null,
                'kmsebelum' => null,
                'kmtiba' => null,
                'kmtempuh' => null,
                'kasbonbbm' => null,
                'kasbonmakan' => null,
                'lainlain' => null
            ]);

            // Create corresponding SPJ
            $spj = SPJ::create([
                'id_spj' => $randomId,
                'id_sj' => $sj->id_sj,
                'SaldoEtollawal' => null,
                'SaldoEtollakhir' => null,
                'PenggunaanToll' => null,
                'uanglainlain' => null,
                'uangmakan' => null,
                'totalisibbm' => null,
                'sisabbm' => null,
                'sisasaku' => null,
                'totalsisa' => null
            ]);
        }
    }

    // Save the updated SP
    $sp->save();

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'Surat Pemesanan berhasil diupdate!');
}


public function show($id)
    {
        try {
            $decryptedId = decrypt($id); // Dekripsi id

            $sp = Sp::findOrFail($decryptedId);
            $marketing = Akun::where('id_akun',$sp->marketing)->firstOrFail();
            return view('view-receipt', compact('sp','marketing'));
        } catch (\Exception $e) {
            // Tangani jika dekripsi gagal
            return abort(404, 'Invalid decryption.');
        }
    }


// Update data for SJ related to the given SP
public function updateSJ(Request $request, $id)
{
    // Temukan SJ yang akan diupdate
    $sj = SJ::findOrFail($id);

    // Validasi input
    $request->validate([
        'id_unit' => 'required',
        'driver' => 'nullable',
        'codriver' => 'nullable',
        'jumlahseat' => 'nullable',
        'kasbonbbm' => 'nullable',
        'kasbonmakan' => 'nullable',
        'lainlain' => 'nullable'
    ]);
    $sj->update($request->all());
    return redirect()->route('detail_pesanan', ['id' => $sj->id_sp])->with('success', 'SJ berhasil diupdate!');
}

public function updateSPJ(Request $request, $id)
{
    // Temukan SPJ yang akan diupdate
    $spj = SPJ::findOrFail($id);
    $sj = SJ::findOrFail($spj->id_sj);

    // Validate all inputs
    $request->validate([
        'SaldoEtollawal' => 'nullable',
        'SaldoEtollakhir' => 'nullable',
        'PenggunaanToll' => 'nullable',
        'totalisibbm'  => 'nullable',
        'sisabbm'=> 'nullable',
        'sisasaku'  => 'nullable',
        'totalsisa'  => 'nullable',
        'uanglainlain' => 'nullable',
        'uangmakan' => 'nullable',
        'kmsebelum' => 'nullable',
        'kmtiba' => 'nullable',
        'kmtempuh' => 'nullable',
        'isvalid' => 'nullable',
    ]);

    // Update SPJ
    $spj->update([
        'isvalid' => $request->isvalid,
        'SaldoEtollawal' => $request->SaldoEtollawal,
        'SaldoEtollakhir' => $request->SaldoEtollakhir,
        'PenggunaanToll' => $request->PenggunaanToll,
        'totalisibbm'  => $request-> totalisibbm,
        'sisabbm'  => $request-> sisabbm,
        'sisasaku'  => $request-> sisasaku,
        'totalsisa'  => $request->totalsisa,
        'uanglainlain' => $request->uanglainlain,
        'uangmakan' => $request->uangmakan,
    ]);

    // Update SJ
    $sj->update([
        'kmsebelum' => $request->kmsebelum,
        'kmtiba' => $request->kmtiba,
        'kmtempuh' => $request->kmtempuh,
    ]);

    return redirect()
        ->route('detail_pesanan', ['id' => $sj->id_sp])
        ->with('success', 'SPJ berhasil diupdate!');
}
public function destroy($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    $sp->delete();

    return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus');
}

public function getDriverCoDriver($id_unit)
{
    // Retrieve all records from Armada where 'id_unit' matches the input
    $armada = Armada::where('id_unit', $id_unit)->get();

    // Check if any armada records are found for the given id_unit
    if ($armada->isEmpty()) {
        return response()->json([
            'driver' => '',
            'codriver' => ''
        ]);
    }

    // Find the driver by checking the 'posisi' field
    $driver = $armada->where('posisi', 'Driver')->first();

    // Find the co-driver by checking the 'posisi' field
    $codriver = $armada->where('posisi', 'Co-Driver')->first();

    // Initialize variables to store the names
    $driverName = $driver ? $driver->akun->name : '';
    $codriverName = $codriver ? $codriver->akun->name : '';

    // Return the names in JSON format
    return response()->json([
        'driver' => $driverName,
        'codriver' => $codriverName
    ]);
}

public function searchDriver(Request $request)
{
    $query = $request->get('query');
    // get driver name from akun table where role is 2
    $names = Akun::where('role_id', 2)
        ->where('name', 'like', "%$query%")
        ->get();

    $driver = $names->pluck('name');
        
    return response()->json($driver);
}

public function update(Request $request, $id)
{
    $type = $request->input('type'); // Ambil tipe dokumen dari request

    // Proses update sesuai tipe dokumen
    if ($type === 'SP') {
        $sp = SP::findOrFail($id);
        $sp->update($request->all());
        $html = "<p>Data SP berhasil diupdate!</p>"; 
    } elseif ($type === 'SJ') {
        $sj = SJ::findOrFail($id);
        $sj->update($request->all());
        $html = "<p>Data SJ berhasil diupdate!</p>";
    } elseif ($type === 'SPJ') {
        $spj = SPJ::findOrFail($id);
        $spj->update($request->all());
        $html = "<p>Data SPJ berhasil diupdate!</p>";
    } else {
        return response()->json(['error' => 'Tipe dokumen tidak valid'], 400);
    }

    // Kembalikan respons AJAX
    return response()->json(['html' => $html]);
}

public function TotalSisa($id_spj)
{
    $spj = Spj::find($id_spj);


    if (!$spj) {
        return response()->json(['error' => 'Data SPJ tidak ditemukan.'], 404);
    }


    $sj = Sj::find($spj->id_sj);
    if (!$sj) {
        return response()->json(['error' => 'Data SJ tidak ditemukan.'], 404);
    }


   $sisasaku = $spj->sisasaku;
    $sisabbm = $spj->sisabbm;


    $totalSisa = $sisasaku + $sisabbm;


    return response()->json(['totalSisa' => $totalSisa]);
}


public function TotalPengeluaranUangSaku($id_spj)
{
    // Ambil data SPJ berdasarkan id_spj atau return 404 jika tidak ditemukan
    $spj = Spj::findOrFail($id_spj);

    // Ambil data SJ berdasarkan id_sj di tabel SPJ atau return 404 jika tidak ditemukan
    $sj = Sj::findOrFail($spj->id_sj);

    // Ambil nilai 'lainlain' dari tabel SJ
    $lainlain = $sj->lainlain;

    // Hitung total pengeluaran uang saku dari tabel PengeluaranUangSaku
    $totalUangSaku = PengeluaranUangSaku::where('id_spj', $id_spj)->sum('nominal');

    // Set nilai uanglainlain sama dengan total pengeluaran uang saku
    $uanglainlain = $totalUangSaku;

    // Hitung sisa
    $sisa = $lainlain - $uanglainlain;

    // Return data JSON
    return response()->json([
        'totalUangSaku' => $totalUangSaku,
        'uanglainlain' => $uanglainlain,
        'lainlain' => $lainlain,
        'sisa' => $sisa,
    ]);
}

public function TotalBBM($id_spj)
{
    // Mengambil semua data konsumsi BBM berdasarkan id_spj
    $bbms = KonsumBbm::where('id_spj', $id_spj)->get();


    // Menghitung total dari kolom totalbayar
    $totalBBM = $bbms->sum('totalbayar');

    //menghitung sisa penggunaan bbm
    $spj = Spj::where('id_spj', $id_spj)->first();
    $sj = Sj::where('id_sj', $spj->id_sj)->first();
    $sisaBBM = $sj->kasbonbbm - $totalBBM;


    // Return data JSON agar bisa digunakan oleh JavaScript
    return response()->json([
        'totalBBM' => $totalBBM,
        'sisaBBM' => $sisaBBM
    ]);
}

}