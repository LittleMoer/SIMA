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
            'nama_pemesan' => 'required|string|max:50',
            'pj_rombongan' => 'required|string|max:50',
            'no_telppn' => 'required|string|max:12',
            'no_telpps' => 'required|string|max:12',
            'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
            'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
            'tujuan' => 'required|string|max:20',
            'alamat_penjemputan' => 'required|string|max:100',
            'jumlah_armada' => 'required|integer',
            'nilai_kontrak1' => 'required|integer',
            'nilai_kontrak2' => 'nullable|integer',
            'biaya_tambahan' => 'nullable|integer',
            'total_biaya' => 'required|integer',
            'uang_muka' => 'required|integer',
            'status_pembayaran' => 'required|integer',
            'sisa_pembayaran' => 'nullable|integer',
            'metode_pembayaran' => 'required|string|max:10',
            'catatan_pembayaran' => 'nullable|string'
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
                'driver' => null,
                'codriver' => null,
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
                'sisabbm' => null,
                'totalisibbm' => null,
                'sisasaku' => null,
                'totalsisa' => null,
                
            ]);
            // Create a new KonsumBbm record and get its ID
            $konsumBbm = KonsumBbm::create([
                'idkonsumbbm' => $randomId,
                'id_spj' => $spj->id_spj, 
                'isiBBM' => null,           
                'tanggal' => null,
                'lokasiisi' => null,
                'totalbayar' => null,
                'foto_struk' => null,
                'isvalid'=> 0,
            ]);
        }

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
    }
public function view($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    return view('view', compact('sp'));
}

public function detail($id)
{

    $sp = SP::where('id_sp', $id)->firstOrFail();
    $sjs = SJ::where('id_sp', $id)->get();
    $spjs = SPJ::whereIn('id_sj', $sjs->pluck('id_sj')->toArray())->get(); 
    $bbm = KonsumBbm::whereIn('id_spj', $spjs->pluck('id_spj')->toArray())->get(); 
    $units = Unit::all();
    return view('detail_pesanan', compact('sp', 'sjs', 'spjs', 'units', 'bbm'));
}


// Update data for SP
public function updateSP(Request $request, $id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    $request->validate([
        'nama_pemesan' => 'required|string|max:50',
        'pj_rombongan' => 'required|string|max:50',
        'no_telppn' => 'required|string|max:12',
        'no_telpps' => 'required|string|max:12',
        'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
        'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
        'tujuan' => 'required|string|max:20',
        'alamat_penjemputan' => 'required|string|max:100',
        'jumlah_armada' => 'required|integer',
        'nilai_kontrak1' => 'required|integer',
        'nilai_kontrak2' => 'nullable|integer',
        'biaya_tambahan' => 'nullable|integer',
        'total_biaya' => 'required|integer',
        'uang_muka' => 'required|integer',
        'status_pembayaran' => 'required|integer',
        'sisa_pembayaran' => 'nullable|integer',
        'metode_pembayaran' => 'required|string|max:10',
        'catatan_pembayaran' => 'nullable|string'
    ]);


    $sp->update($request->all());

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'Pesanan berhasil diupdate!');
}

public function updateSJ(Request $request, $id_sj)
{
    $sj = Sj::where('id_sj', $id_sj)->firstOrFail();

    $request->validate([
        'id_unit' => 'required|integer',
        'driver' => 'nullable|string',
        'codriver' => 'nullable|string',
        'kmsebelum' => 'nullable|integer',
        'kmtiba' => 'nullable|integer',
        'kasbonbbm' => 'nullable|integer',
        'kasbonmakan' => 'nullable|integer',
        'lainlain' => 'nullable|string',
    ]);

    $sj->update($request->all());

    return redirect()->route('detail_pesanan', ['id' => $sj->id_sp])->with('success', 'SJ updated successfully!');
}


public function getDriverCoDriver($id_unit)
{
    $armada = Armada::where('id_unit', $id_unit)->first();

    if (!$armada) {
        return response()->json([
            'driver' => '',
            'codriver' => ''
        ]);
    }

    $driver = Akun::where('id_akun', $armada->id_akun and 'Driver',$armada->posisi)->first();
    $codriver = Akun::where('id_akun', $armada->id_akun)->first();

    return response()->json([
        'driver' => $driver ? $driver->name : '',
        'codriver' => $codriver ? $codriver->name : ''
    ]);
}



public function updateSPJ(Request $request, $id)
{
    $sp = SP::with('spjs')->where('id_sp', $id)->firstOrFail();


    $request->validate([
        'saldo_etollawal' => 'nullable|array',
        'saldo_etollawal.*' => 'nullable|integer',
        'saldo_etollakhir' => 'nullable|array',
        'saldo_etollakhir.*' => 'nullable|integer',
        'penggunaan_toll' => 'nullable|array',
        'penggunaan_toll.*' => 'nullable|integer',
        'uanglainlain' => 'nullable|array',
        'uanglainlain.*' => 'nullable|integer',
        'uangmakan' => 'nullable|array',
        'uangmakan.*' => 'nullable|integer',
   
    ]);

    // Update each related SPJ record
    foreach ($sp->spjs as $index => $spj) {
        $spj->update([
            'SaldoEtollawal' => $request->saldo_etollawal[$index] ?? null,
            'SaldoEtollakhir' => $request->saldo_etollakhir[$index] ?? null,
            'PenggunaanToll' => $request->penggunaan_toll[$index] ?? null,
            'uanglainlain' => $request->uanglainlain[$index] ?? null,
            'uangmakan' => $request->uangmakan[$index] ?? null,
        ]);
    }

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'SPJ berhasil diupdate!');
}


public function destroy($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    $sp->delete();

    return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus');
}
}