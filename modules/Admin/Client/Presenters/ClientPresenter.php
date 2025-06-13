<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Presenters;

use Modules\Admin\Client\Models\Client;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ClientPresenter extends AbstractPresenter
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->client->id,
            'name' => $this->client->name,
        ];
    }
}
