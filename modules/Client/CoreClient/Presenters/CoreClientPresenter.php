<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Presenters;

use Modules\Client\CoreClient\Models\Client;
use BasePackage\Shared\Presenters\AbstractPresenter;

class CoreClientPresenter extends AbstractPresenter
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
            'email' => $this->client->email,
            'phone' => $this->client->phone,
            'picture_url' => $this->client->getFirstMediaUrl('profile_pictures'),
            'gender' => $this->client->gender

        ];
    }
}
