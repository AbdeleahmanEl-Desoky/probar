<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Handlers;

use Modules\Barber\ShopService\Commands\UpdateShopServiceCommand;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Barber\ShopService\Repositories\ShopServiceRepository;

class UpdateShopServiceHandler
{
    public function __construct(
        private ShopServiceRepository $repository,
    ) {
    }

    public function handle(UpdateShopServiceCommand $updateShopServiceCommand, array $nameTranslations, array $descriptionTranslations = [],$file): void
    {
        $shopService = $this->repository->updateShopService(
            $updateShopServiceCommand->getId(),
            $updateShopServiceCommand->toArray()
        );
        if ($file) {
            $shopService->clearMediaCollection('shop_service');
            $shopService->addMedia($file)->toMediaCollection('shop_service');
        }

        $this->updateTranslations($shopService, $nameTranslations, $descriptionTranslations??[]);

        $shopService->save();
    }

    private function updateTranslations(ShopService $shopService, array $nameTranslations, array $descriptionTranslations=[]): void
    {
        foreach ($nameTranslations as $locale => $value) {
            $shopService->setTranslation('name', $locale, $value);
        }

        foreach ($descriptionTranslations as $locale => $value) {
            $shopService->setTranslation('description', $locale, $value);
        }
    }
}
