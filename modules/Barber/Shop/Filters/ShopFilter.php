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
        ->orWhere('address','like','%'.$search.'%');

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

}
