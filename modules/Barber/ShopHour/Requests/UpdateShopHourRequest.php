<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopHourRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            '*.id' => [
                'required',
                'exists:shop_hour_details,id',
            ],
            '*.status' => [
                'required',
                'integer',
                'in:0,1',
            ],
        ];
    }
}
