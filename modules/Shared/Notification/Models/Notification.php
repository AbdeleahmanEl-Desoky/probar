<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use BasePackage\Shared\Traits\UuidTrait;
use BasePackage\Shared\Traits\BaseFilterable;

class Notification extends Model
{
    use HasFactory, UuidTrait, BaseFilterable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'body',
        'data',
        'is_read',
        'notifiable_id',
        'notifiable_type',
    ];

    protected $casts = [
        'id' => 'string',
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
