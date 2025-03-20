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
        // Ensure barber_id is part of the data passed to the repository
        $data = $createShopDTO->toArray();

        // If barber_id is not in the data, it will throw an error, so ensure it's always set
        $data['barber_id'] = $createShopDTO->barber_id;

        // Fetch or create shop
        $shop = $this->repository->getMyShop($createShopDTO->barber_id) ?? $this->repository->createShop($data);

        // Update shop if it already exists
        if ($shop->exists) {
            $this->repository->updateShop(Uuid::fromString($shop->id), $data);
        }

        if ($file) {
            $shop->clearMediaCollection('images');
            $shop->addMedia($file)->toMediaCollection('images');
        }
        // Assign translations for name and description
        $this->assignTranslations($shop, $nameTranslations, $descriptionTranslations);

        // Save the shop with translations
        $shop->save();

        // Return the shop object
        return $this->repository->getMyShop($createShopDTO->barber_id) ;
        ;
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
