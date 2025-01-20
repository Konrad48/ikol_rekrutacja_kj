<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DistanceController extends Controller
{
    public function calculate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'pointA.latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'pointA.longitude' => [
                'required',
                'numeric',
                'between:-180,180'
            ],
            'pointB.latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'pointB.longitude' => [
                'required',
                'numeric',
                'between:-180,180'
            ],
        ]);

        $pointA = $validated['pointA'];
        $pointB = $validated['pointB'];

        $distance = $this->calculateDistance(
            $pointA['latitude'],
            $pointA['longitude'],
            $pointB['latitude'],
            $pointB['longitude']
        );

        return response()->json([
            'status' => 'success',
            'data' => [
                'distance' => $distance,
                'points' => [
                    'pointA' => $pointA,
                    'pointB' => $pointB,
                ]
            ]
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Haversine formula to calculate the distance
        $earthRadius = 6371000; // Earth radius in meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) *
            pow(sin($lonDelta / 2), 2)
        ));

        $distanceInMeters = $angle * $earthRadius;
        $distanceInKilometers = $distanceInMeters / 1000;

        return [
            'meters' => round($distanceInMeters, 2),
            'kilometers' => round($distanceInKilometers, 2),
        ];
    }
}