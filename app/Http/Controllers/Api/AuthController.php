<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'name' => $user->name
        ], 201);
    }

    //LOGIN
public function login(Request $request)
{
    $user = User::where(
        'email',
        $request->email
    )->first();

    // USER BELUM REGISTER
    if (!$user) {

        return response()->json([
            'success' => false,
            'message' => 'Akun belum terdaftar, silakan register dulu'
        ]);
    }

    // PASSWORD SALAH
    if (!Hash::check(
        $request->password,
        $user->password
    )) {

        return response()->json([
            'success' => false,
            'message' => 'Password salah'
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Login berhasil',
        'user' => $user
    ]);
}

}