<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopFilter extends SearchModelFilter
{
       public $relations = [];

    public function name($name)
    {
        return $this->whereHas('translations',function($q) use ($name){
            $q->where('content','like','%'.$name.'%');
        });
    }
    public function search($search)
    {
        return $this->whereHas('translations',function($q) use ($search){
            $q->where('content','like','%'.$search.'%');
        })
        ->orWhereHas('barber',function($q) use ($search){
            $q->where('name','like','%'.$search.'%');
        })->orWhereHas('shopServices',function($q) use ($search){
            $q->whereHas('translations',function($q) use ($search){
                $q->where('content','like','%'.$search.'%');
            });
        })
        // ->orWhereHas('city',function($q) use ($search){
        //     $q->where('name','like','%'.$search.'%');
        // })
        ->orWhere('address_1','like','%'.$search.'%')
        ->orWhere('address_2','like','%'.$search.'%');

    }



    public function rate($rate)
    {
        return $this->whereHas('rates',function($q) use ($rate){
            $q->where('rate',$rate);
        });
    }
    public function barber($barber)
    {
        return $this->where('barber_id', $barber);
    }
    public function service($service)
    {
        return $this->whereHas('shopServices',function($q) use ($service){
            $q->where('id',$service);
        });
    }
    public function city($city)
    {
        return $this->whereHas('translations',function($q) use ($city){
            $q->where('content','like','%'.$city.'%');
        });
    }

    public function is_open($is_open)
    {
        return $this->where('is_open', $is_open);
    }
    public function featured($featured)
    {
        return $this->where('featured', $featured);
    }
    public function nearest($value)
    {
        if ($value !== 'yes') {
            return $this;
        }

        $client = auth('api_clients')->user();

        if (!$client || !$client->latitude || !$client->longitude) {
            return $this; // Skip if location is missing
        }

        $latitude = $client->latitude;
        $longitude = $client->longitude;

        // Haversine distance calculation
        return $this->selectRaw("
                *,
                (6371000 * acos(
                    cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )) AS distance
            ", [$latitude, $longitude, $latitude])
            ->orderBy('distance');
    }

    public function topRated($value)
    {
        if ($value !== 'yes') {
            return $this;
        }
        return $this->withAvg('rates', 'rate')->orderBy('rates_avg_rate', 'desc');
    }
}
