<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Services;

use Illuminate\Support\Facades\Mail;
use Modules\Barber\CoreBarber\Models\CoreBarber;
use Illuminate\Support\Str;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Modules\Barber\ShopHour\Repositories\ShopHourRepository;
use Modules\Barber\ShopService\Repositories\ShopServiceRepository;
use Ramsey\Uuid\Uuid;

class DataCompleteService
{
    public function __construct(
        private ShopRepository $shopRepository,
        private ShopHourRepository $shopHourRepository,
        private ShopServiceRepository $shopServiceRepository
    ) {
    }
    public function dataComplete($userId)
    {
        try {
            $userUuid = Uuid::fromString($userId);

            $shop = $this->shopRepository->getMyShop($userUuid);
            if (!$shop) {
                return 'shop';
            }

            $shopHour = $this->shopHourRepository->getShopHours(['shop_id' => $shop->id]);

            if ($shopHour->isEmpty()) {
                return 'time';
            }

            $shopService = $this->shopServiceRepository->getShopServices(['shop_id' => $shop->id]);

            if ($shopService->isEmpty()) {
                return 'service';
            }

            return  'completed';

        } catch (\Exception $e) {
            \Log::error("Error in dataComplete: " . $e->getMessage());
            return 'shop';
        }
    }
}
