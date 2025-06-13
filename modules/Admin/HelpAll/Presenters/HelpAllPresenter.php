<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Presenters;

use Modules\Admin\HelpAll\Models\HelpAll;
use BasePackage\Shared\Presenters\AbstractPresenter;

class HelpAllPresenter extends AbstractPresenter
{
    private HelpAll $helpAll;

    public function __construct(HelpAll $helpAll)
    {
        $this->helpAll = $helpAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->helpAll->id,
            'name' => $this->helpAll->name,
        ];
    }
}
