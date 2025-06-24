<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Presenters;

use Modules\Client\Report\Models\Report;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ReportAllPresenter extends AbstractPresenter
{
    private Report $reportAll;

    public function __construct(Report $reportAll)
    {
        $this->reportAll = $reportAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->reportAll->id,
            'shop_name' => $this->reportAll->shop->name ?? null,
            'client_name' => $this->reportAll->client->name ?? null,
            'schedule_date' => $this->reportAll->schedule->schedule_date ?? null,
            'schedule_start_time' => $this->reportAll->schedule->start_time ?? null,
            'schedule_end_time' => $this->reportAll->schedule->end_time ?? null,
            'note' => $this->reportAll->note,
            'type' => $this->reportAll->type,
        ];
    }
}
