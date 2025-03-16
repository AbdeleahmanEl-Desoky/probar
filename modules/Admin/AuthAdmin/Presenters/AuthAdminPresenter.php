<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Presenters;

use Modules\Admin\AuthAdmin\Models\AuthAdmin;
use BasePackage\Shared\Presenters\AbstractPresenter;

class AuthAdminPresenter extends AbstractPresenter
{
    private AuthAdmin $authAdmin;

    public function __construct(AuthAdmin $authAdmin)
    {
        $this->authAdmin = $authAdmin;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->authAdmin->id,
            'name' => $this->authAdmin->name,
        ];
    }
}
