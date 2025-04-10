<?php

declare(strict_types=1);

namespace Modules\Client\Report\Presenters;

use Modules\Client\Report\Models\Report;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ReportPresenter extends AbstractPresenter
{
    private Report $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->report->id,
            'shop_id' => $this->report->shop_id,
            'schedule_id' => $this->report->schedule_id,
            'client_id' => $this->report->client_id,
            'note' => $this->report->note,
        ];
    }
}
