<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function update(Request $request, $username)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required|integer',
        ]);

        // Find the user by username
        $user = Akun::where('username', $username)->firstOrFail();

        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User updated successfully');
    }
    public function index() {
        $users = Akun::all();
        return view('manajemen_akun', compact('users'));
    }
}
