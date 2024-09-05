<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Armada;
use App\Models\Unit;
use App\Models\Konsumbbm;
use Illuminate\Http\Request;

class BbmController extends Controller
{
    public function index($id_spj)
    {
        // Fetch the Konsumbbm data based on id_spj
        $bbms = Konsumbbm::where('id_spj', $id_spj)->get();

        // Return the view with the BBM data
        return view('bbm.index', compact('bbms'));
    }
    public function destroy($id)
    {
        // Find the Konsumbbm data based on the id
        $bbm = Konsumbbm::findOrFail($id);

        // Delete the Konsumbbm data
        $bbm->delete();

        // Redirect back to the previous page
        return back()->with('success', 'BBM data deleted successfully.');
    }
}