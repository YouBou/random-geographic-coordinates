<?php

namespace App\Http\Controllers;

use App\Services\Usecase\GenerateCoordinatesUsecase;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map', [
            'googleMapsApiKey' => config('services.google.maps_api_key')
        ]);
    }

    public function generateCoordinates(
        GenerateCoordinatesUsecase $usecase,
    ) {
        $output = $usecase->execute();
        
        return response()->json([
            'lat' => $output->getLatitude(),
            'lng' => $output->getLongitude(),
        ]);
    }
}
