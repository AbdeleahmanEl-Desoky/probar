<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Favorite\Database\factories\FavoriteFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\Barber\Shop\Models\Shop;
use Modules\Client\CoreClient\Models\Client;

//use BasePackage\Shared\Traits\HasTranslations;

class Favorite extends Model
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
        'client_id'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): FavoriteFactory
    {
        return FavoriteFactory::new();
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
