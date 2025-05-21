<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Services;


use Modules\Client\Shops\Repositories\ShopsRepository;

class ShopsFormatDistanceService
{


    public function formatDistance(float $distanceInMeters): string
    {
        $distanceInKm = $distanceInMeters / 1000;

        if ($distanceInKm < 1) {
            // Less than 1 km, show in meters rounded to nearest 10 meters
            $distanceInMetersRounded = round($distanceInMeters, -1); // e.g., 740 -> 740, 755 -> 760
            return $distanceInMetersRounded . ' m';
        }

        if ($distanceInKm > 5) {
            // If more than 5 km, cap at "5+ km"
            return '5+ km';
        }

        // Between 1 and 5 km, round to 1 decimal place
        return round($distanceInKm, 1) . ' km';
    }

    public  function calculateDistance(float $latFrom, float $lonFrom, float $latTo, float $lonTo): float
    {
        $earthRadius = 6371000; // in meters

        $latFromRad = deg2rad($latFrom);
        $lonFromRad = deg2rad($lonFrom);
        $latToRad = deg2rad($latTo);
        $lonToRad = deg2rad($lonTo);

        $latDelta = $latToRad - $latFromRad;
        $lonDelta = $lonToRad - $lonFromRad;

        $a = sin($latDelta / 2) ** 2 + cos($latFromRad) * cos($latToRad) * sin($lonDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
