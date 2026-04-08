<?php

namespace App\Http\Requests\CityEvent;

use App\Enums\CityEventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCityEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'capacity' => 'required|integer|min:1|max:5000',

            'tags' => 'required|array|max:5',
            'tags.*' => 'string|max:50',

            'status' => [
                'required',
                'string',
                Rule::enum(CityEventStatus::class),
                Rule::notIn([CityEventStatus::Cancelled->value]),
            ],
        ];
    }
}
