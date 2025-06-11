<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Schedule\Database\factories\ScheduleFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\Barber\ShopService\Models\ShopService;

//use BasePackage\Shared\Traits\HasTranslations;

class ScheduleService extends Model
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
        'schedule_id', 'shop_service_id'
        , 'price', 'time'
    ];
    protected $casts = ['id' => 'string'];

    protected static function newFactory()
    {
        return ScheduleFactory::new();
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
    public function shopService()
    {
        return $this->belongsTo(ShopService::class, 'shop_service_id', 'id');
    }
}
