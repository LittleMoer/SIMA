<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\UnitAvailability;
use App\Models\UnitStatus;
use App\Models\SP;
use App\Models\SJ;


class CalendarController extends Controller
{
    public function showMonthlyCalendar(Request $request)
    {
        // Ambil bulan dan tahun dari request, defaultnya bulan dan tahun sekarang
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Dapatkan jumlah hari dalam bulan tersebut
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        
        // Dapatkan daftar unit
        $units = Unit::all()->sortBy('seri_unit');

        // Ambil data ketersediaan dari database untuk bulan tersebut
        $availability = UnitAvailability::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy('date');

        return view('calendar.monthly', compact('daysInMonth', 'month', 'year', 'units', 'availability'));
    }


public function updateAvailability(Request $request)
{
    $date = $request->input('date');
    $unitId = $request->input('id_unit');

    // Ambil entri yang ada untuk unit dan tanggal tersebut
    $currentAvailability = UnitAvailability::where('id_unit', $unitId)
                                           ->where('date', $date)
                                           ->first();

    if ($currentAvailability) {
        // Sikluskan status (0 -> 1 -> 2 -> 3 -> 0)
        $newStatus = ($currentAvailability->available + 1) % 4;
        $currentAvailability->available = $newStatus;
        $currentAvailability->save();
    } else {
        // Jika entri belum ada, buat entri baru dengan status default (0: Tersedia)
        UnitAvailability::create([
            'id_unit' => $unitId,
            'date' => $date,
            'available' => 1, // Default status
        ]);

        $newStatus = 1; // Default status untuk entri baru
    }

    // Kembalikan status baru sebagai JSON
    return response()->json([
        'success' => true,
        'new_status' => $newStatus,
    ]);
}



// Ini udah bener versi 1 events_aman
public function showCalendar3()
    {
         // Ambil bulan dan tahun saat ini
    $currentMonth = now()->month; // Bulan saat ini
    $currentYear = now()->year; // Tahun saat ini

    // Jumlah hari dalam bulan
    $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

     // Ambil semua unit
     $units = Unit::all()->sortBy('seri_unit');

    $availability = []; // Reset struktur data

    foreach ($units as $unit) {
        $bookings = Sp::whereHas('sj', function ($query) use ($unit) {
            $query->where('id_unit', $unit->id_unit);
        })
        ->where(function ($query) use ($currentYear, $currentMonth, $daysInMonth) {
            $query->whereBetween('tgl_keberangkatan', [
                "{$currentYear}-{$currentMonth}-01", 
                "{$currentYear}-{$currentMonth}-{$daysInMonth}"
            ])
            ->orWhereBetween('tgl_kepulangan', [
                "{$currentYear}-{$currentMonth}-01", 
                "{$currentYear}-{$currentMonth}-{$daysInMonth}"
            ]);
        })
        ->with(['sj' => function ($query) {
            $query->select('id_sp', 'id_unit', 'driver', 'codriver');
        }])
        ->get();

        foreach ($bookings as $booking) {
            foreach ($booking->sj as $sj) {
                $keberangkatan = Carbon::parse($booking->tgl_keberangkatan);
                $kepulangan = Carbon::parse($booking->tgl_kepulangan);
                
                for ($day = $keberangkatan->day; $day <= $kepulangan->day; $day++) {
                    $date = Carbon::create($currentYear, $currentMonth, $day);
                    $formattedDate = $date->format('Y-m-d');

                    if ($date->month == $currentMonth) {
                        // Ubah struktur array dengan menambahkan id_unit sebagai key kedua
                        $availability[$formattedDate][$sj->id_unit] = [
                            'nama_pemesan' => $booking->nama_pemesan,
                            'driver' => $sj->driver,
                            'codriver' => $sj->codriver,
                        ];
                    }
                }
            }
        }
    }
        // Mengirimkan data ke view
        return view('calendar.monthly3', compact('units', 'daysInMonth', 'currentYear', 'currentMonth', 'availability'));
    }

public function showCalendar2()
    {
         // Ambil bulan dan tahun saat ini
    $currentMonth = now()->month; // Bulan saat ini
    $currentYear = now()->year; // Tahun saat ini

    // Jumlah hari dalam bulan
    $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

     // Ambil semua unit
     $units = Unit::all()->sortBy('seri_unit');

    $availability = []; // Reset struktur data

    foreach ($units as $unit) {
        $bookings = Sp::whereHas('sj', function ($query) use ($unit) {
            $query->where('id_unit', $unit->id_unit);
        })
        ->where(function ($query) use ($currentYear, $currentMonth, $daysInMonth) {
            $query->whereBetween('tgl_keberangkatan', [
                "{$currentYear}-{$currentMonth}-01", 
                "{$currentYear}-{$currentMonth}-{$daysInMonth}"
            ])
            ->orWhereBetween('tgl_kepulangan', [
                "{$currentYear}-{$currentMonth}-01", 
                "{$currentYear}-{$currentMonth}-{$daysInMonth}"
            ]);
        })
        ->with(['sj' => function ($query) {
            $query->select('id_sp', 'id_unit', 'driver', 'codriver');
        }])
        ->get();

        foreach ($bookings as $booking) {
            foreach ($booking->sj as $sj) {
                $keberangkatan = Carbon::parse($booking->tgl_keberangkatan);
                $kepulangan = Carbon::parse($booking->tgl_kepulangan);
                
                for ($day = $keberangkatan->day; $day <= $kepulangan->day; $day++) {
                    $date = Carbon::create($currentYear, $currentMonth, $day);
                    $formattedDate = $date->format('Y-m-d');

                    if ($date->month == $currentMonth) {
                        // Ubah struktur array dengan menambahkan id_unit sebagai key kedua
                        $availability[$formattedDate][$sj->id_unit] = [
                            'nama_pemesan' => $booking->nama_pemesan,
                            'driver' => $sj->driver,
                            'codriver' => $sj->codriver,
                        ];
                    }
                }
            }
        }
    }
        // Mengirimkan data ke view
        return view('calendar.monthly2', compact('units', 'daysInMonth', 'currentYear', 'currentMonth', 'availability'));
    }

public function showCalendar() {
    // Ambil bulan dan tahun saat ini
    $currentMonth = now()->month;
    $currentYear = now()->year; 
 
    // Ambil semua unit dan urutkan berdasarkan seri_unit 
    $units = Unit::orderBy('seri_unit')->get(); 
    $availability = []; // Data ketersediaan per unit

    foreach ($units as $unit) {
        // Ambil pemesanan untuk unit tertentu dalam bulan yang dipilih, urutkan berdasarkan tgl_keberangkatan
        $bookings = Sp::whereHas('sj', function ($query) use ($unit) {
            $query->where('id_unit', $unit->id_unit);
        })
        ->whereMonth('tgl_keberangkatan', $currentMonth)
        ->whereYear('tgl_keberangkatan', $currentYear)
        ->with(['sj' => function ($query) {
            $query->select('id_sp', 'driver', 'codriver');
        }])
        ->orderBy('tgl_keberangkatan')
        ->get();

        // Siapkan data ketersediaan
        foreach ($bookings as $booking) {
            foreach ($booking->sj as $sj) {
                $keberangkatan = Carbon::parse($booking->tgl_keberangkatan);
                $kepulangan = Carbon::parse($booking->tgl_kepulangan);

                $availability[$unit->id_unit][] = [
                    'range' => $keberangkatan->format('d') . '-' . $kepulangan->format('d'),
                    'nama_pemesan' => $booking->nama_pemesan,
                    'driver' => $sj->driver,
                    'codriver' => $sj->codriver,
                    'tgl_keberangkatan' => $booking->tgl_keberangkatan,
                ];
            }
        }
    }
    return view('calendar.events', compact('units', 'currentYear', 'currentMonth', 'availability')); 
    
}

}
