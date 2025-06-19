<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\Shop\Models\Shop;
use Ramsey\Uuid\UuidInterface;

/**
 * @property Shop $model
 * @method Shops findOneOrFail($id)
 * @method Shops findOneByOrFail(array $data)
 */
class ShopsRepository extends BaseRepository
{
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    public function getShopsList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }
public function paginated(
    array $conditions = [],
    int $page = 1,
    int $perPage = 15,
    string $orderBy = 'created_at',
    string $sortBy = 'desc'
) {
    if (method_exists($this->model, 'scopeFilter')) {
        $query = $this->model->filter(request()->all())->where($conditions);
    } else {
        $query = $this->model->where($conditions);
    }
    $query->whereHas('shop.barber', function ($q) {
        $q->where('is_active', 1);
    });


    $count = $query->count();
    $paginatedData = $query->forPage($page, $perPage)->orderBy($orderBy, $sortBy)->get();
    $paginationArray = $this->getPaginationInformation($page, $perPage, $count);

    return [
        'pagination' => $paginationArray['pagination'],
        'data' => $paginatedData,
    ];
}
    public function getShops(UuidInterface $id): Shop
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

}
