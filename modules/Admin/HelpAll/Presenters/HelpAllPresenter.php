<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Presenters;

use Modules\Admin\HelpAll\Models\HelpAll;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Shared\Help\Models\Help;

class HelpAllPresenter extends AbstractPresenter
{
    private Help $helpAll;

    public function __construct(Help $helpAll)
    {
        $this->helpAll = $helpAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->helpAll->id,
            'name' => $this->helpAll->name,
            'email' => $this->helpAll->email,
            'phone' => $this->helpAll->phone,
            'subject' => $this->helpAll->subject,
            'message' => $this->helpAll->message,
            'type' => $this->helpAll->type,
        ];
    }
}
