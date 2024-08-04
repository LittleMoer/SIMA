<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();
        return view('manajemen_akun', compact('akuns'));
    }
    public function update(Request $request, $username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
    
        $emailRules = 'required|string|email|max:255';
        if ($request->email !== $akun->email) {
            $emailRules .= '|unique:akun';
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => $emailRules,
            'role_id' => 'required|exists:roles,roleid',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $akun->name = $request->name;
        $akun->email = $request->email;
        $akun->role_id = $request->role_id;
        $akun->save();
    
        // session()->flash('success', 'User berhasil diupdate.'); 
        
        return redirect()->route('manajemen_akun');
    }
    
    
    
    public function destroy($username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
        $akun->delete();
    
        return redirect()->route('manajemen_akun');
    }
    

}
