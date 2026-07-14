<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // TAMBAH FAVORIT
    public function store(Request $request)
    {
        $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'wisata_id' => $request->wisata_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil tambah favorit',
            'data' => $favorite
        ]);
    }

    // HAPUS FAVORIT
    public function destroy(Request $request)
    {
        Favorite::where('user_id', $request->user_id)
            ->where('wisata_id', $request->wisata_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Favorit dihapus'
        ]);
    }

    // AMBIL FAVORIT USER
    public function getFavorites($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'data' => $favorites
        ]);
    }
}