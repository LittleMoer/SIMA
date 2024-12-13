<?php

namespace App\Http\Controllers;

use App\Models\KonsumBbm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SP;
use App\Models\SPJ;
use App\Models\SJ;
use App\Models\Unit;
use App\Models\Armada;
use App\Models\PengeluaranUangSaku;
use App\Models\Akun;


class OrderController extends Controller
{
    public function index()
    {
        $sp = SP::all(); 
        return view('pesanan', compact('sp'));  // Mengirimkan data ke view
    }
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'nama_pemesan' => 'required',
            'pj_rombongan' => 'required',
            'no_telppn' => 'required',
            'no_telpps' => 'required',
            'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
            'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
            'tujuan' => 'required',
            'alamat_penjemputan' => 'required',
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
        $orderData['jam_kepulangan'] = $jam_keberangkatan;

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
                'nilai_kontrak' => $nilaiKontrak,
                'kmsebelum' => null,
                'kmtiba' => null,
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
                'sisasaku' => null,
                'totalsisa' => null,
                
            ]);
            // // Create a new KonsumBbm record and get its ID
            // $konsumBbm = KonsumBbm::create([
            //     'idkonsumbbm' => $randomId,
            //     'id_spj' => $spj->id_spj, 
            //     'isiBBM' => null,           
            //     'tanggal' => null,
            //     'lokasiisi' => null,
            //     'totalbayar' => null,
            //     'foto_struk' => null,
            //     'isvalid'=> 0,
            // ]);
        }

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
    }
public function view($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    return view('view', compact('sp'));
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


    
    return view('detail_pesanan', compact('sp', 'sjs', 'spjs', 'units'));
}




public function updateSP(Request $request, $id)
{
    // Validate request
    $validatedData = $request->validate([
        'nama_pemesan' => 'required',
        'pj_rombongan' => 'required',
        'no_telppn' => 'required',
        'no_telpps' => 'required',
        'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
        'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
        'tujuan' => 'required',
        'alamat_penjemputan' => 'required',
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
                'kmsebelum' => null,
                'kmtiba' => null,
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
                'sisasaku' => null,
                'totalsisa' => null
            ]);

            // // Create corresponding KonsumBbm
            // KonsumBbm::create([
            //     'idkonsumbbm' => $randomId,
            //     'id_spj' => $spj->id_spj,
            //     'isiBBM' => null,
            //     'tanggal' => null,
            //     'lokasiisi' => null,
            //     'totalbayar' => null,
            //     'foto_struk' => null,
            //     'isvalid' => 0
            // ]);
        }
    }

    // Save the updated SP
    $sp->save();

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'Surat Pemesanan berhasil diupdate!');
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
        'kmsebelum' => 'nullable',
        'kmtiba' => 'nullable',
        'kasbonbbm' => 'nullable',
        'kasbonmakan' => 'nullable',
        'lainlain' => 'nullable',
    ]);
    $sj->update($request->all());
    return redirect()->route('detail_pesanan', ['id' => $sj->id_sp])->with('success', 'SJ berhasil diupdate!');
}



public function updateSPJ(Request $request, $id)
{
    // Temukan SJ yang akan diupdate
    $spj = SPJ::findOrFail($id);

    // Validasi input
    $request->validate([
        'saldo_etollawal' => 'nullable',
        'saldo_etollakhir' => 'nullable',
        'penggunaan_toll' => 'nullable',
        'uanglainlain' => 'nullable',
        'uangmakan' => 'nullable',
    ]);
    $spj->update($request->all());
        $sj = SJ::findOrFail($spj->id_sj);
        $id_sp = $sj->id_sp;
    
        // Redirect to detail_pesanan page with the specific tab
        return redirect()->route('detail_pesanan', ['id' => $id_sp])
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

}