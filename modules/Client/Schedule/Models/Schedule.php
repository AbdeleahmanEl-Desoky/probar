<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Schedule\Database\factories\ScheduleFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Barber\ShopService\Models\ShopService;

//use BasePackage\Shared\Traits\HasTranslations;

class Schedule extends Model
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
        'start_time',
        'end_time',
        'schedule_date',
        'shop_id',
        'client_id',
        'status',
        'note',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): ScheduleFactory
    {
        return ScheduleFactory::new();
    }
    public function shopServices():BelongsToMany
    {
        return $this->belongsToMany(ShopService::class, ScheduleService::class, 'schedule_id', 'shop_service_id');
    }
}
