<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Presenters;

use Modules\Shared\Version\Models\Version;
use BasePackage\Shared\Presenters\AbstractPresenter;

class VersionPresenter extends AbstractPresenter
{
    private Version $version;

    public function __construct(Version $version)
    {
        $this->version = $version;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->version->id,
            'version' => $this->version->version,
            'type' => $this->version->type, 
        ];
    }
}
