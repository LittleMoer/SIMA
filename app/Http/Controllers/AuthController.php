<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('/homepage');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $role = Auth::user()->role_id;
            if ($role == 1) {
                return redirect()->intended('admin/dashboard');
            } elseif ($role == 2) {
                return redirect()->intended('crew/dashboard');
            } elseif ($role == 3) {
                return redirect()->intended('viewer/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('tambah_akun');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:akun',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:akun|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $akun = Akun::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->intended('/manajemen_akun')->with('success', 'Akun berhasil dibuat!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat akun: ' . $e->getMessage()]);
        }
    }
}
