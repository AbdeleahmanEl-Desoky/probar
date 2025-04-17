<?php

declare(strict_types=1);

namespace Modules\Website\Presenters;

use Modules\Website\Models\Website;
use BasePackage\Shared\Presenters\AbstractPresenter;

class WebsitePresenter extends AbstractPresenter
{
    private Website $website;

    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->website->id,
            'name' => $this->website->name,
        ];
    }
}
