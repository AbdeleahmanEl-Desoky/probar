<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Services;

use Illuminate\Support\Collection;
use Modules\Barber\Shop\DTO\CreateShopDTO;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

class ShopCRUDService
{
    public function __construct(
        private ShopRepository $repository,
    ) {
    }

    public function create(CreateShopDTO $createShopDTO, array $nameTranslations, array $descriptionTranslations,$file): Shop
    {
        $data = $createShopDTO->toArray();

        $data['barber_id'] = $createShopDTO->barber_id;

        $shop = $this->repository->getMyShop($createShopDTO->barber_id) ?? $this->repository->createShop($data);

        if ($shop->exists) {
            $this->repository->updateShop(Uuid::fromString($shop->id), $data);
        }

        if ($file) {
            $shop->clearMediaCollection('shops');
            $shop->addMedia($file)->toMediaCollection('shops');
        }
        $this->assignTranslations($shop, $nameTranslations, $descriptionTranslations);

        $shop->save();

        return $this->repository->getMyShop($createShopDTO->barber_id) ;
    }

    private function assignTranslations(Shop $shop, array $nameTranslations, array $descriptionTranslations): void
    {
        foreach ($nameTranslations as $locale => $value) {
            $shop->setTranslation('name', $locale, $value);
        }

        foreach ($descriptionTranslations as $locale => $value) {
            $shop->setTranslation('description', $locale, $value);
        }
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Shop
    {
        return $this->repository->getShop(
            id: $id,
        );
    }

    public function getMyShop(UuidInterface $barber_id): ?Shop
    {
        return $this->repository->getMyShop(
            barber_id: $barber_id,
        );
    }
}
