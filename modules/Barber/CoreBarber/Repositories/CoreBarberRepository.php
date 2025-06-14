<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\CoreBarber\Models\Barber;

/**
 * @property Barber $model
 * @method CoreBarber findOneOrFail($id)
 * @method CoreBarber findOneByOrFail(array $data)
 */
class CoreBarberRepository extends BaseRepository
{
    public function __construct(Barber $model)
    {
        parent::__construct($model);
    }

    public function getCoreBarberList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getCoreBarber(UuidInterface $id): Barber
    {
        return $this->model->where('id', $id->toString())->firstOrFail();
    }

    public function createCoreBarber(array $data): Barber
    {
        return $this->create($data);
    }

    public function updateCoreBarber(UuidInterface $id, array $data): bool
    {
        $barber = $this->getCoreBarber($id);

        if (!$barber) {
            return false;
        }
                if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $barber->clearMediaCollection('profile_pictures');

            $barber->addMedia($data['file'])
                ->toMediaCollection('profile_pictures');
        }

        return $this->update($id, $data);
    }

    public function deleteCoreBarber(UuidInterface $id): bool
    {
        return $this->delete($id);
    }

    public function getCoreBarberByEmail( $email):Barber
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    public function updateCfmToken(UuidInterface $id, array $data): bool
    {
        $barber = $this->getCoreBarber($id);

        if (!$barber) {
            return false;
        }


        $barber->update(array_filter([
            'fcm_token' => $data['fcm_token'],
        ]));

        return true;
    }
    
}
