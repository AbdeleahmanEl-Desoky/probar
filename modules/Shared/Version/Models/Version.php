<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shared\Version\Database\factories\VersionFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;

class Version extends Model
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
        'version',
        'type'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): VersionFactory
    {
        return VersionFactory::new();
    }
}
