<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Services;


use Modules\Client\Shops\Repositories\ShopsRepository;

class ShopsFormatDistanceService
{


    public static function formatDistance(float $distanceInMeters): string
    {
        $distanceInKm = $distanceInMeters / 1000;

        if ($distanceInKm < 1) {
            return round($distanceInMeters, -1) . ' m';
        }

        if ($distanceInKm > 5) {
            return '5+ km';
        }

        return round($distanceInKm, 1) . ' km';
    }

    public static function calculateDistance(float $latFrom, float $lonFrom, float $latTo, float $lonTo): float
    {
        $earthRadius = 6371000; // meters
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
