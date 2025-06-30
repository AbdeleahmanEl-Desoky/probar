<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Services;

use Illuminate\Support\Collection;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopService\DTO\CreateShopServiceDTO;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Barber\ShopService\Repositories\ShopServiceRepository;
use Ramsey\Uuid\UuidInterface;

class ShopServiceCRUDService
{
    public function __construct(
        private ShopServiceRepository $repository,
    ) {
    }

    public function create(CreateShopServiceDTO $createShopServiceDTO,$nameTranslations, $descriptionTranslations = [],$file): ShopService
    {
        $data = $createShopServiceDTO->toArray();

        $data['shop_id'] = $createShopServiceDTO->shop_id;

        $shopService = $this->repository->createShopService($data);

        if ($file) {
            $shopService->clearMediaCollection('shop_service');
            $shopService->addMedia($file)->toMediaCollection('shop_service');
        }
        $this->assignTranslations($shopService, $nameTranslations ?? [], $descriptionTranslations ?? []);

        $shopService->save();
        return $shopService;
    }

    private function assignTranslations(ShopService $shopService, array $nameTranslations = [], array $descriptionTranslations = []): void
    {
        foreach ($nameTranslations as $locale => $value) {
            $shopService->setTranslation('name', $locale, $value);
        }

    foreach ($descriptionTranslations as $locale => $value) {
        if (!is_null($value)) {
            $shopService->setTranslation('description', $locale, (string) $value);
        }
    }
    }

    public function list(int $page = 1, int $perPage = 10,$shop): array
    {
        return $this->repository->paginated(
            ['shop_id'=>$shop],
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ShopService
    {
        return $this->repository->getShopService(
            id: $id,
        );
    }
}
