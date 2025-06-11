<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopPaymentCommand;
use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopStatusCommand;
use Ramsey\Uuid\Uuid;

class UpdateScheduleShopPaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment' => 'required|in:payment,cash_payed,city_ledger',
            'addition' => 'sometimes|numeric|min:0',
            'discount' => 'sometimes|numeric|min:0',
        ];
    }

    public function updateScheduleShopStatusCommand(): UpdateScheduleShopPaymentCommand
    {
        return new UpdateScheduleShopPaymentCommand(
            id: Uuid::fromString($this->route('id')),
            payment: $this->get('payment'),
            addition: $this->get('addition', 0),
            discount: $this->get('discount', 0),
        );
    }
}
