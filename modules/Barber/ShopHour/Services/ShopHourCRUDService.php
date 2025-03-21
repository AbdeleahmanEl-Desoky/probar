<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Services;

use Modules\Barber\ShopHour\DTO\CreateShopHourDTO;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopHour\Repositories\ShopHourDetailRepository;
use Modules\Barber\ShopHour\Repositories\ShopHourRepository;
use Ramsey\Uuid\UuidInterface;

class ShopHourCRUDService
{
    public function __construct(
        private ShopHourRepository $repository,
        private ShopHourDetailRepository $repositoryShopHourDetail
    ) {
    }

    public function create(CreateShopHourDTO $createShopHourDTO): void
    {
        $days = ['Saturday', 'Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $data = $createShopHourDTO->toArray();

        $data['shop_id'] = $createShopHourDTO->shop_id;

        $this->repository->deleteAllShopHour();

        foreach ($days as $day) {
            $openingTime = $createShopHourDTO->custom_hours[$day][0] ?? $createShopHourDTO->opening_time;
            $closingTime = $createShopHourDTO->custom_hours[$day][1] ?? $createShopHourDTO->closing_time;
            $status = $createShopHourDTO->custom_hours[$day][2] ?? 1;

            $openingTime = date("H:i:s", strtotime($openingTime));
            $closingTime = date("H:i:s", strtotime($closingTime));

            $shopHour = $this->repository->createShopHour([
                'shop_id' => $createShopHourDTO->shop_id,
                'day' => $day,
                'opening_time' => $openingTime,
                'closing_time' => $closingTime,
                'status' => $status,
            ]);

            $this->generateTimeSlots($shopHour->id, $openingTime, $closingTime);
        }
    }

    private function generateTimeSlots(string $shopHourId, string $openingTime, string $closingTime): void
    {
        $startTime = strtotime($openingTime);
        $endTime = strtotime($closingTime);

        while ($startTime < $endTime) {
            $slotStart = date("H:i:s", $startTime);
            $slotEnd = date("H:i:s", strtotime("+30 minutes", $startTime));

            if (strtotime($slotEnd) > $endTime) {
                break;
            }

            $this->repositoryShopHourDetail->create([
                'shop_hour_id' => $shopHourId,
                'start_time' => $slotStart,
                'end_time' => $slotEnd,
            ]);

            $startTime = strtotime("+30 minutes", $startTime);
        }
    }

    public function list(int $page = 1, int $perPage = 10,$shopId): array
    {
        return $this->repository->paginatedRelations(['shop_id'=>$shopId],page: $page, perPage: $perPage);
    }

    public function get(UuidInterface $id): ShopHour
    {
        return $this->repository->getShopHour(id: $id);
    }

}
