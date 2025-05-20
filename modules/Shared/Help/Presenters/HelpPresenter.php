<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Presenters;

use Modules\Shared\Help\Models\Help;
use BasePackage\Shared\Presenters\AbstractPresenter;

class HelpPresenter extends AbstractPresenter
{
    private Help $help;

    public function __construct(Help $help)
    {
        $this->help = $help;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->help->id,
            'name' => $this->help->name,
        ];
    }
}
