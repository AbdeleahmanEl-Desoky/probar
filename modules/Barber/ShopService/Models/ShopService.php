<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\ShopService\Database\factories\ShopServiceFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use BasePackage\Shared\Traits\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class ShopService extends Model implements HasMedia
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    use HasTranslations;
    use InteractsWithMedia;
    //use SoftDeletes;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';
    public array $translatable = [
        'name',
        'description'
    ];
    protected $fillable = [
        'price',
        'time',
        'shop_id'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): ShopServiceFactory
    {
        return ShopServiceFactory::new();
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('shop_service')->useDisk('public');
    }

    public function getPicturesAttribute()
    {
        return $this->getFirstMedia('shop_service');
    }
}
