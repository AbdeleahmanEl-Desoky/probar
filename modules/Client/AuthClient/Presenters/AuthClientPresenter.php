<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Presenters;

use Modules\Client\AuthClient\Models\AuthClient;
use BasePackage\Shared\Presenters\AbstractPresenter;

class AuthClientPresenter extends AbstractPresenter
{
    private AuthClient $authClient;

    public function __construct(AuthClient $authClient)
    {
        $this->authClient = $authClient;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->authClient->id,
            'name' => $this->authClient->name,
        ];
    }
}
