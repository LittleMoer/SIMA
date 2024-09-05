<?php

namespace App\Http\Controllers;

use App\Models\KonsumBbm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SP;
use App\Models\SPJ;
use App\Models\SJ;
use App\Models\Unit;

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
    // Retrieve the SP record based on id_sp
    $sp = SP::where('id_sp', $id)->firstOrFail();

    // Retrieve all SJ records related to this SP
    $sjs = SJ::where('id_sp', $id)->get();

    // Retrieve all SPJ records where id_sj is among the SJ records retrieved
    $spjs = SPJ::whereIn('id_sj', $sjs->pluck('id_sj'))->get();

    $units = Unit::all();

    $bbm = KonsumBbm::where('id_spj', $spjs->pluck('id_spj'))->get();

    // Pass data to the view
    return view('detail_pesanan', compact('sp', 'sjs', 'spjs', 'units', 'bbm'));
}




// Update data for SP
public function updateSP(Request $request, $id)
{
    $sp = SP::where('id_sp', $id)->firstOrFail();

    // Validate the request (example validation, you can adjust it)
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

    // Update the SP record
    $sp->update($request->all());

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'Pesanan berhasil diupdate!');
}

// Update data for SJ related to the given SP
public function updateSJ(Request $request, $id)
{
    // Retrieve the SP record along with its related SJ records
    $sp = SP::with('sj')->where('id_sp', $id)->firstOrFail();

    // Validate the request (example validation, you can adjust it)
    $request->validate([
        'nilai_kontrak' => 'required|array',
        'nilai_kontrak.*' => 'required|integer',
        'kmsebelum' => 'nullable|array',
        'kmsebelum.*' => 'nullable|integer',
        'kmtiba' => 'nullable|array',
        'kmtiba.*' => 'nullable|integer',
        'kasbonbbm' => 'nullable|array',
        'kasbonbbm.*' => 'nullable|integer',
        'kasbonmakan' => 'nullable|array',
        'kasbonmakan.*' => 'nullable|integer',
        'lainlain' => 'nullable|array',
        'lainlain.*' => 'nullable|string',
    ]);

    // Update each related SJ record
    foreach ($sp->sjs as $index => $sj) {
        $sj->update([
            'nilai_kontrak' => $request->nilai_kontrak[$index],
            'kmsebelum' => $request->kmsebelum[$index] ?? null,
            'kmtiba' => $request->kmtiba[$index] ?? null,
            'kasbonbbm' => $request->kasbonbbm[$index] ?? null,
            'kasbonmakan' => $request->kasbonmakan[$index] ?? null,
            'lainlain' => $request->lainlain[$index] ?? null,
        ]);
    }

    return redirect()->route('detail_pesanan', ['id' => $id])->with('success', 'SJ berhasil diupdate!');
}

// Update data for SPJ related to the given SP
public function updateSPJ(Request $request, $id)
{
    // Retrieve the SP record along with its related SPJ records
    $sp = SP::with('spjs')->where('id_sp', $id)->firstOrFail();

    // Validate the request (example validation, you can adjust it)
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
        // Add other fields validations as needed
    ]);

    // Update each related SPJ record
    foreach ($sp->spjs as $index => $spj) {
        $spj->update([
            'SaldoEtollawal' => $request->saldo_etollawal[$index] ?? null,
            'SaldoEtollakhir' => $request->saldo_etollakhir[$index] ?? null,
            'PenggunaanToll' => $request->penggunaan_toll[$index] ?? null,
            'uanglainlain' => $request->uanglainlain[$index] ?? null,
            'uangmakan' => $request->uangmakan[$index] ?? null,
            // Add other fields to be updated
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