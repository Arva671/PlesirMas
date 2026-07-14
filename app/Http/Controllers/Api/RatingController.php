<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'wisata_id' => $request->wisata_id
        ]);

        return response()->json([
            'success' => true,
            'data' => $favorite
        ]);
    }

    public function index($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'data' => $favorites
        ]);
    }

    public function destroy(Request $request)
    {
        Favorite::where('user_id', $request->user_id)
            ->where('wisata_id', $request->wisata_id)
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }
    public function getRating($wisata_id)
{
    $ratings = Rating::where('wisata_id', $wisata_id)->get();

    $average = $ratings->avg('rating') ?? 0;

    $count = $ratings->count();

    return response()->json([
        'success' => true,
        'average_rating' => round($average, 1),
        'review_count' => $count
    ]);
}
}