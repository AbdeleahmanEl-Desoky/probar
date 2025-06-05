<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\CoreClient\Database\factories\CoreClientFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Client\Favorite\Models\Favorite;
use Modules\Client\Rate\Models\Rate;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Shared\Notification\Models\Notification;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Client extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    use InteractsWithMedia;
    //use HasTranslations;
    //use SoftDeletes;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'fcm_token',
        'longitude',
        'latitude',
    ];

    protected $casts = [
        'id' => 'string',
        'email',
        'password',
        'phone'
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory(): CoreClientFactory
    {
        return CoreClientFactory::new();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    protected static function booted(): void
    {
        static::deleting(function (Client $client) {
            $client->rates()->delete();
            $client->schedules()->delete();
            $client->favorites()->delete();
            $client->notifications()->delete();
        });
    }
}
