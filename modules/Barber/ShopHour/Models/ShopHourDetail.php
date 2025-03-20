<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\ShopHour\Database\factories\ShopHourFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;

class ShopHourDetail extends Model
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
        'shop_hour_id',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): ShopHourFactory
    {
        return ShopHourFactory::new();
    }
    public function shopHour()
    {
        return $this->belongsTo(ShopHour::class);
    }
}
