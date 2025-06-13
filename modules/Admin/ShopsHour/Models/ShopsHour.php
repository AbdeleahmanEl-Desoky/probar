<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\ShopsHour\Database\factories\ShopsHourFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;

class ShopsHour extends Model
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
        'name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): ShopsHourFactory
    {
        return ShopsHourFactory::new();
    }
}
