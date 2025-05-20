<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shared\Help\Database\factories\HelpFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;

class Help extends Model
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
        'email',
        'phone',
        'subject',
        'message',
        'type',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): HelpFactory
    {
        return HelpFactory::new();
    }
}
