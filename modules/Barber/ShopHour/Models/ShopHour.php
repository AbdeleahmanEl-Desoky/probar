<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\ShopHour\Database\factories\ShopHourFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\Barber\Shop\Models\Shop;
use Carbon\Carbon;
//use BasePackage\Shared\Traits\HasTranslations;

class ShopHour extends Model
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    //use HasTranslations;
    //use SoftDeletes;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'shop_id',
        'status',
        'day',
        'opening_time',
        'closing_time',
        'strto_time'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): ShopHourFactory
    {
        return ShopHourFactory::new();
    }
    public function details()
    {
        return $this->hasMany(ShopHourDetail::class)->orderBy('start_time', 'asc');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
