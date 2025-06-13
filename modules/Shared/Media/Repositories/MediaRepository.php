<?php

declare(strict_types=1);

namespace Modules\Shared\Media\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Shared\Help\Models\Help;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property Media $model
 * @method Help findOneOrFail($id)
 * @method Help findOneByOrFail(array $data)
 */
class MediaRepository extends BaseRepository
{
    public function __construct(Media $model)
    {
        parent::__construct($model);
    }


    public function deleteMedia(UuidInterface|array $ids): bool
    {
        if (is_array($ids)) {
            foreach ($ids as $id) {
                parent::delete($id);
            }
            return true;
        }

        return parent::delete($ids);
    }
}
