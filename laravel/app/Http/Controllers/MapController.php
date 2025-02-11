<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map', [
            'googleMapsApiKey' => config('services.google.maps_api_key')
        ]);
    }

    public function generateCoordinates()
    {
        $latitude = rand(-90 * 10000, 90 * 10000) / 10000;
        $longitude = rand(-180 * 10000, 180 * 10000) / 10000;
        
        return response()->json([
            'lat' => $latitude,
            'lng' => $longitude
        ]);
    }
}
