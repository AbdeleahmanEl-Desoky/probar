<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Services;

use Modules\Barber\ShopHour\DTO\CreateShopHourDTO;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopHour\Repositories\ShopHourDetailRepository;
use Modules\Barber\ShopHour\Repositories\ShopHourRepository;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

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

        $data['shop_id'] =  $createShopHourDTO->shop_id;

        $this->repository->deleteShopHour($data['shop_id']);

        foreach ($days as $day) {
            $openingTime = $createShopHourDTO->custom_hours[$day][0] ?? $createShopHourDTO->opening_time;
            $closingTime = $createShopHourDTO->custom_hours[$day][1] ?? $createShopHourDTO->closing_time;
            $status = $createShopHourDTO->custom_hours[$day][2] ?? 1;
            $strtoTime = $createShopHourDTO->strto_time;

            $openingTime = date("H:i", strtotime($openingTime));
            $closingTime = date("H:i", strtotime($closingTime));

            $shopHour = $this->repository->createShopHour([
                'shop_id' => $data['shop_id'],
                'day' => $day,
                'opening_time' => $openingTime,
                'closing_time' => $closingTime,
                'status' => $status,
                'strto_time' => $strtoTime
            ]);

            $this->generateTimeSlots($data['shop_id'],$shopHour->id, $openingTime, $closingTime, $strtoTime, $day);
        }
    }
    private function generateTimeSlots(string $shopId,string $shopHourId, string $openingTime, string $closingTime, string $strtoTime, string $baseDay): void
    {
        $startTime = strtotime($openingTime);
        $endTime = strtotime($closingTime);

        $crossesMidnight = $endTime <= $startTime;

        $daysOfWeek = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $baseDayIndex = array_search($baseDay, $daysOfWeek);
        $nextDay = $daysOfWeek[($baseDayIndex + 1) % 7];

        while (true) {
            $slotStart = date("H:i", $startTime);
            $nextSlotTime = strtotime($strtoTime, $startTime);
            $slotEnd = date("H:i", $nextSlotTime);

            if (!$crossesMidnight && $nextSlotTime > $endTime) {
                break;
            }

            $day = ($crossesMidnight && $nextSlotTime > strtotime("23:59")) ? $nextDay : $baseDay;

            $this->repositoryShopHourDetail->create([
                'shop_hour_id' => $shopHourId,
                'shop_id' => $shopId,
                'start_time' => $slotStart,
                'end_time' => $slotEnd,
                'day' => $day
            ]);

            if (!$crossesMidnight && $nextSlotTime >= $endTime) {
                break;
            }

            if ($crossesMidnight && $nextSlotTime >= strtotime($closingTime . " +1 day")) {
                break;
            }

            $startTime = $nextSlotTime;
        }
    }


    public function list(int $page = 1, int $perPage = 10, $shopId): array
    {
        $result = $this->repository->paginatedRelations(
            ['shop_id' => $shopId],
            page: $page,
            perPage: $perPage,
            orderBy: 'id',
            sortBy: 'ASC'
        );

        $weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $result['data'] = collect($result['data'])
            ->sortBy(fn($item) => array_search($item->day, $weekdays))
            ->values()
            ->all();

        return $result;
    }

    public function get(UuidInterface $id): ShopHour
    {
        return $this->repository->getShopHour(id: $id);
    }

}
