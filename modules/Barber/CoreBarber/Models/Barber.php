<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Barber\CoreBarber\Database\factories\CoreBarberFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Barber extends Authenticatable implements JWTSubject//, Auditable
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    use Notifiable;
    // use HasTranslations;
    // use HasRoles;
    // use \OwenIt\Auditing\Auditable;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
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
    protected static function newFactory(): CoreBarberFactory
    {
        return CoreBarberFactory::new();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
