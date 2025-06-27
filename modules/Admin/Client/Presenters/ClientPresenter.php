<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Presenters;

use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Client\CoreClient\Models\Client;

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
            'email' => $this->client->email,
            'phone' => $this->client->phone,
            'gender' => $this->client->gender,
            'schedules'=>$this->client->schedules,
            'picture_url' => $this->client?->getFirstMediaUrl('profile_pictures')??null,
            'canceled_schedules_count' => $this->client->canceled_schedules_count,
            'active_schedules_count' => $this->client->active_schedules_count,
            'finished_schedules_count' => $this->client->finished_schedules_count,
            'is_active'=> $this->client->is_active

        ];
    }
}
