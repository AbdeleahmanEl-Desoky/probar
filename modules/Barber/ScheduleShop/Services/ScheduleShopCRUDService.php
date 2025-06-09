<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Services;

use Illuminate\Support\Collection;
use Modules\Barber\ScheduleShop\DTO\CreateScheduleShopDTO;
use Modules\Barber\ScheduleShop\Models\ScheduleShop;
use Modules\Barber\ScheduleShop\Repositories\ScheduleShopRepository;
use Modules\Client\Schedule\Models\Schedule;
use Ramsey\Uuid\UuidInterface;

class ScheduleShopCRUDService
{
    public function __construct(
        private ScheduleShopRepository $repository,
    ) {
    }

    public function mostSellingServices(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        return $this->repository->mostSellingServices(
            shopId: $shopId,
            startDate: $startDate,
            endDate:$endDate,
            page:$page,
            perPage:$perPage
        );
    }
    public function rate(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        return $this->repository->rate(
            shopId: $shopId,
            startDate: $startDate,
            endDate:$endDate,
            page:$page,
            perPage:$perPage
        );
    }
    public function totalEarning(string $shopId, ?string $startDate = null, ?string $endDate = null)//: array
    {
        return $this->repository->totalEarning(
            shopId: $shopId,
            startDate: $startDate,
            endDate:$endDate,
        );
    }

    public function totalCashPayed(string $shopId, ?string $startDate = null, ?string $endDate = null)//: array
    {
        return $this->repository->totalCashPayed(
            shopId: $shopId,
            startDate: $startDate,
            endDate:$endDate,
        );
    }

    public function totalCityLedger(string $shopId, ?string $startDate = null, ?string $endDate = null)//: array
    {
        return $this->repository->totalCityLedger(
            shopId: $shopId,
            startDate: $startDate,
            endDate:$endDate,
        );
    }

    public function getTotalSummary(string $shopId, ?string $startDate = null, ?string $endDate = null): array
    {
        return [
            'total_earning'   => $this->totalEarning($shopId, $startDate, $endDate),
            'total_cash_paid' => $this->totalCashPayed($shopId, $startDate, $endDate),
            'total_city_ledger' => $this->totalCityLedger($shopId, $startDate, $endDate),
        ];
    }
    public function list(string $shopId, int $page = 1, int $perPage = 10)//: array
    {
        return $this->repository->paginated(
            ['shop_id'=>$shopId],
            page:$page,
            perPage:$perPage
        );
    }

    public function get(UuidInterface $id): Schedule
    {
        return $this->repository->getScheduleShop(
            id: $id,
        );
    }

}
