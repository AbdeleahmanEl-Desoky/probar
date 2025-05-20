<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\Shop\Database\factories\ShopFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use BasePackage\Shared\Traits\HasTranslations;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\Favorite\Models\Favorite;
use Modules\Client\Rate\Models\Rate;
use Modules\Client\Schedule\Models\Schedule;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Ramsey\Uuid\Uuid;
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
        'average_rating',
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
    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
   public function getIsFavoritedAttribute(): int
    {
        // Get the authenticated user's ID string
        $userIdString = auth('api_clients')->user()?->id;

        // If there's no authenticated user or the user has no ID,
        // then this shop cannot be favorited by the current (non-existent) user.
        if (is_null($userIdString)) {
            return 0;
        }

        // If the client_id in the favorites table is stored as a string UUID,
        // you can directly use $userIdString in the query.
        // If you strictly need to ensure it's a Ramsey\Uuid object or validate its format:
        try {
            $clientIdObject = Uuid::fromString($userIdString);
            // Use $clientIdObject (Ramsey\Uuid object) or $clientIdObject->toString()
            // in the where clause, depending on how your database/Eloquent handles UUIDs.
            // Most of the time, Eloquent is smart enough to handle the Ramsey\Uuid object directly.
            $queryClientId = $clientIdObject;
        } catch (\Ramsey\Uuid\Exception\InvalidUuidStringException $e) {
            // This means the user's ID string is not a valid UUID.
            // This should ideally not happen if your user IDs are always UUIDs.
            // You might want to log this error.
            // Log::error("Invalid UUID format for client ID: " . $userIdString, ['exception' => $e]);
            return 0; // Treat as not favorited if ID is invalid
        }

        // Check if the favorite record exists
        return (int) $this->favorites()
            ->where('client_id', $queryClientId) // Using the validated/converted UUID
            ->exists();

        /*
        // Simpler alternative if 'client_id' in 'favorites' table is a string and always valid UUID format from auth:
        // (This version skips the Uuid::fromString conversion if not strictly needed for the query)
        $userIdString = auth('api_clients')->user()?->id;

        if (is_null($userIdString)) {
            return 0;
        }

        return (int) $this->favorites()
            ->where('client_id', $userIdString)
            ->exists();
        */
    }

}
