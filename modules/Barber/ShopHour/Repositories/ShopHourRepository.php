<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\ShopHour\Models\ShopHour;
use Ramsey\Uuid\Uuid;

/**
 * @property ShopHour $model
 * @method ShopHour findOneOrFail($id)
 * @method ShopHour findOneByOrFail(array $data)
 */
class ShopHourRepository extends BaseRepository
{
    public function __construct(ShopHour $model)
    {
        parent::__construct($model);
    }

    public function getShopHourList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopHour(UuidInterface $id): ShopHour
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopHour(array $data): ShopHour
    {
        return $this->create($data);
    }

    public function updateShopHour(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopHour(string $id)//: bool
    {
        return $this->model->where('shop_id', Uuid::fromString($id))->delete();
    }

    public function deleteAllShopHour(): mixed
    {
        return $this->deleteBy([]);
    }

    public function paginatedRelations(
        array $conditions = [],
        int $page = 1,
        int $perPage = 15,
        string $orderBy = 'status',
        string $sortBy = 'ASC'
    ) {
        if (method_exists($this->model, 'scopeFilter')) {
            $query = $this->model->with('details')->filter(request()->all())->where($conditions);
        } else {
            $query = $this->model->with('details')->where($conditions);
        }

        $count = $query->count();
        $paginatedData = $query->forPage($page, $perPage)->orderBy($orderBy, $sortBy)->get();
        $paginationArray = $this->getPaginationInformation($page, $perPage, $count);

        return [
            'pagination' => $paginationArray['pagination'],
            'data' => $paginatedData,
        ];
    }

    public function getShopHours( array $conditions = []){
        return $this->model->where($conditions)->get();
    }
}
