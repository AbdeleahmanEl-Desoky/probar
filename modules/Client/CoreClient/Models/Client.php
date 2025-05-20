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
        'cfm_token'
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
}
