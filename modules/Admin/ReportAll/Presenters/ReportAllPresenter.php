<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Presenters;

use Modules\Admin\ReportAll\Models\ReportAll;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ReportAllPresenter extends AbstractPresenter
{
    private ReportAll $reportAll;

    public function __construct(ReportAll $reportAll)
    {
        $this->reportAll = $reportAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->reportAll->id,
            'name' => $this->reportAll->name,
        ];
    }
}
