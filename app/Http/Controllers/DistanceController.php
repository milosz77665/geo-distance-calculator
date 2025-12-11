<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class DistanceController extends Controller
{
    public function index()
    {
        return Inertia::render('DistanceCalculator');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'latA' => 'required|numeric|between:-90,90',
            'longA' => 'required|numeric|between:-180,180',
            'latB' => 'required|numeric|between:-90,90',
            'longB' => 'required|numeric|between:-180,180',
        ]);

        $latA = $validated['latA'];
        $longA = $validated['longA'];
        $latB = $validated['latB'];
        $longB = $validated['longB'];

        $earthRadius = 6371000; 

        $latDiff = deg2rad($latB - $latA);
        $longDiff = deg2rad($longB - $longA);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($latA)) * cos(deg2rad($latB)) *
             sin($longDiff / 2) * sin($longDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distanceMeters = $earthRadius * $c;
        $distanceKilometers = $distanceMeters / 1000;

        return Inertia::render('DistanceCalculator', [
            'result' => [
                'meters' => round($distanceMeters, 2),
                'kilometers' => round($distanceKilometers, 2),
            ],
        ]);
    }
}
