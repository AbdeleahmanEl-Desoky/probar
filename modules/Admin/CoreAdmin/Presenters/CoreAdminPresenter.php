<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Presenters;

use Modules\Admin\CoreAdmin\Models\CoreAdmin;
use BasePackage\Shared\Presenters\AbstractPresenter;

class CoreAdminPresenter extends AbstractPresenter
{
    private CoreAdmin $coreAdmin;

    public function __construct(CoreAdmin $coreAdmin)
    {
        $this->coreAdmin = $coreAdmin;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->coreAdmin->id,
            'name' => $this->coreAdmin->name,
        ];
    }
}
