<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Presenters;

use Modules\Client\CoreClient\Models\CoreClient;
use BasePackage\Shared\Presenters\AbstractPresenter;

class CoreClientPresenter extends AbstractPresenter
{
    private CoreClient $coreClient;

    public function __construct(CoreClient $coreClient)
    {
        $this->coreClient = $coreClient;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->coreClient->id,
            'name' => $this->coreClient->name,
        ];
    }
}
