<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Presenters;

use Modules\Admin\ShopsService\Models\ShopsService;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ShopsServicePresenter extends AbstractPresenter
{
    private ShopsService $shopsService;

    public function __construct(ShopsService $shopsService)
    {
        $this->shopsService = $shopsService;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopsService->id,
            'name' => $this->shopsService->name,
        ];
    }
}
