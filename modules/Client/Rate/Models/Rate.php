<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Rate\Database\factories\RateFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\Barber\Shop\Models\Shop;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\Schedule\Models\Schedule;

//use BasePackage\Shared\Traits\HasTranslations;

class Rate extends Model
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
        'schedule_id',
        'client_id',
        'note',
        'rate',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): RateFactory
    {
        return RateFactory::new();
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
