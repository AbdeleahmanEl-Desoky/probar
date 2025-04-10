<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\Shop\Database\factories\ShopFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use BasePackage\Shared\Traits\HasTranslations;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\Rate\Models\Rate;
use Modules\Client\Schedule\Models\Schedule;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Shop extends Model implements HasMedia
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    use HasTranslations;
    use InteractsWithMedia;
    //use SoftDeletes;

    public array $translatable = [
        'name',
        'description'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        // 'name',
        // 'description',
        'barber_id',
        'worker_no',
        'city_id',
        'street',
        'address_1',
        'address_2',
        'longitude',
        'latitude',
        'is_open'
    ];

    protected $casts = [
        'id' => 'string',
    ];
    protected $appends = [
        'pictures',
        'total_rates',
        'average_rating'
    ];

    protected static function newFactory(): ShopFactory
    {
        return ShopFactory::new();
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('shops')->useDisk('public');
    }

    public function getPicturesAttribute()
    {
        return $this->getFirstMedia('shops');
    }
    public function shopHours()
    {
        return $this->hasMany(ShopHour::class);
    }
    public function shopServices()
    {
        return $this->hasMany(ShopService::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function getTotalRatesAttribute()
    {
        return $this->rates()->count();
    }

    public function getAverageRatingAttribute()
    {
        return $this->rates()->avg('rate') ?? 0;
    }
}
