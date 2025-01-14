<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        $nearByStores = DB::table('stores')
            ->select('*', DB::raw("
        (6371 * acos(
            cos(radians($userLatitude)) *
            cos(radians(stores.latitude)) *
            cos(radians(stores.longitude) - radians($userLongitude)) +
            sin(radians($userLatitude)) *
            sin(radians(stores.latitude))
        )) AS distance
     "))->orderBy('distance', 'asc')
            ->get();
        return response()->json(['nearByStores' => $nearByStores]);
        // dd($nearByStores);

    }
}
