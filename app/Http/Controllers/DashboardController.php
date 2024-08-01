<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        $user = Auth::user();

        if ($user) {
            // Pass the authenticated user to the view
            return view('dashboard', ['user' => $user]);
        } else {
            // Redirect to login if user is not authenticated
            return redirect('/login');
        }
    }
}
