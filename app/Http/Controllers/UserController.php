<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = Akun::all();
        return view('manajemen_akun', compact('users'));
    }

    public function update(Request $request, $id)
    {
        // Find the user by id_akun
        $user = Akun::where('id_akun', $id)->firstOrFail();
    
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($user) {
                    // Check if the username already exists in another record
                    if ($value !== $user->username) {
                        $exists = Akun::where('username', $value)
                                       ->where('id_akun', '!=', $user->id_akun)
                                       ->exists();
                        if ($exists) {
                            $fail('The username has already been taken.');
                        }
                    }
                }
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    // Validate email domain
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('The email must be a Gmail address.');
                    }
    
                    // Check if the email already exists in another record
                    if ($value !== $user->email) {
                        $exists = Akun::where('email', $value)
                                       ->where('id_akun', '!=', $user->id_akun)
                                       ->exists();
                        if ($exists) {
                            $fail('The email has already been taken.');
                        }
                    }
                }
            ],
            'role_id' => 'sometimes|required|integer',
            'password' => 'sometimes|nullable|string|min:8|confirmed', 
        ]);
        // Update the user's data
        $user->update($request->only(['username', 'name', 'role_id']));

        // Hash the password if it is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user
        $user->save();

        return back()->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $akun = Akun::where('id_akun', $id)->firstOrFail();
        $akun->delete();
    
        return redirect()->route('manajemen_akun');
    }
}
