<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Presenters;

use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Admin\CoreAdmin\Models\User;

class CoreAdminPresenter extends AbstractPresenter
{
    private User $coreAdmin;

    public function __construct(User $coreAdmin)
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
