<?php

namespace App\Http\Controllers;

use App\Models\KonsumBbm;
use Illuminate\Support\Str;
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
                'kmsebelum' => '0',
                'kmtiba' => '0',
                'kasbonbbm' => '0',
                'kasbonmakan' => '0',
                'lainlain' => '0'
            ]);
            // Create a new KonsumBbm record and get its ID
            $konsumBbm = KonsumBbm::create([
                'idkonsumbbm' => $randomId, 
                'isiBBM' => null,           
                'tanggal' => null,
                'lokasiisi' => null,
                'totalbayar' => null,
            ]);

            // Create SPJ and link it to the SJ records
            SPJ::create([
                'id_spj' => $randomId,
                'id_sj' => $sj->id,
                'SaldoEtollawal' => 0,
                'SaldoEtollakhir' => 0,
                'PenggunaanToll' => 0,
                'uanglainlain' => 0,
                'uangmakan' => 0,
                'idkonsumbbm' => $konsumBbm->idkonsumbbm,
                'sisabbm' => 0,
                'totalisibbm' => 0,
                'sisasaku' => 0,
                'totalsisa' => 0,
                // 'id_sp' => $order->id 
            ]);
        }

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
    }
// Versi nadi
public function view($id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();
    return view('view', compact('sp'));
}

public function detail($id)
{
    $order = SP::where('id_sp', $id)->firstOrFail();
    return view('detail_pesanan', compact('order'));
}
    // Update data pesanan
    public function updateSP(Request $request, $id)
    {
        $order = SP::where('id_sp', $id)->firstOrFail();
        $order->update($request->all());
        return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'Pesanan berhasil diupdate!');
    }
    



public function updateKonsumBbm(Request $request, $id)
{
    $request->validate([
        'isiBBM' => 'required|integer',
        'tanggal' => 'required|date',
        'lokasiisi' => 'required|string|max:100',
        'totalbayar' => 'required|integer',
    ]);

    $konsumBbm = KonsumBbm::findOrFail($id);
    $konsumBbm->update($request->only([
        'isiBBM',
        'tanggal',
        'lokasiisi',
        'totalbayar',
    ]));

    return redirect()->route('pesanan')->with('success', 'KonsumBBM berhasil diperbarui');
}

public function destroy($id)
{
    // Find the SP record by its id
    $order = SP::where('id_sp', $id)->firstOrFail();
    // Attempt to delete the record
    try {
        $order->delete();
        return redirect()->route('pesanan')->with('success', 'Order deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('pesanan')->with('error', 'Failed to delete order: ' . $e->getMessage());
    }
}
}
