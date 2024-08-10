<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SP;
use App\Models\SPJ;
use App\Models\SJ;

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
            'nilai_kontrak' => 'required|integer',
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

// Create the SP record first
$order = SP::create($orderData);

// Create the required SJ and SPJ records as many as "jumlah armada"
for ($i = 0; $i < $request->jumlah_armada; $i++) {
    // Create SJ
    $sj = SJ::create([
        'id_sp' => $order->id, // Associate SJ with the SP record
        'nilai_kontrak' => $request->nilai_kontrak,
        'kmsebelum' => '0',
        'kmtiba' => '0',
        'kasbonbbm' => '0',
        'kasbonmakan' => '0',
        'lainlain' => '0'
    ]);

    // Create a new KonsumBbm record and get its ID
    // $konsumBbm = KonsumBbm::create([
    //     'isiBBM' => 0,
    //     'tanggal' => now(),
    //     'lokasiisi' => 'Auto-generated',
    //     'totalbayar' => 0,
    // ]);

    // Create SPJ and link it to the SJ records
    SPJ::create([
        'id_sj' => $sj->id, // Associate SPJ with the SJ record
        'SaldoEtollawal' => 0,
        'SaldoEtollakhir' => 0,
        'PenggunaanToll' => 0,
        'uanglainlain' => 0,
        'uangmakan' => 0,
        // 'idkonsumbbm' => $konsumBbm->id, // Associate SPJ with the KonsumBbm record
        'sisabbm' => 0,
        'totalisibbm' => 0,
        'sisasaku' => 0,
        'totalsisa' => 0,
        'id_sp' => $order->id // Associate SPJ with the SP record
    ]);
}

return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
}
    public function destroy($id)
    {
        $sp = SP::findOrFail($id);
        $sp->delete();
        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus');
    }
}
