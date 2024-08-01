<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ],[
        'username.required' => 'Username wajib diisi',
        'password.required' => 'Password wajib diisi'
    ]);

    $credentials = [
        'username' => $request->username,
        'password' => $request->password
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        Session:: put('username', $request->username);
        return redirect("dashboard");
    } else {
        return redirect()->route('login')->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function halamanregis()
    {
        return view('auth/register');
    }
    public function registrasi(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ],[
            'username.required' => 'Username wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'role_id.required' => 'Role wajib diisi'
        ]);
        $akun = new Akun();
        $akun->username = $request->username;
        $akun->name = $request->name;
        $akun->email = $request->email;
        $akun->password = bcrypt($request->password);
        $akun->role_id = $request->role_id;
        $akun->save();
        return redirect('/');
    }

}