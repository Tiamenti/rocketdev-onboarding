<?php

namespace App\Http\Requests\CityEvent;

use App\Enums\CityEventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCityEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'place' => 'sometimes|required|string|max:255',
            'start_at' => 'sometimes|required|date|after_or_equal:now',
            'end_at' => 'sometimes|required|date|after:start_at',
            'capacity' => 'sometimes|required|integer|min:1|max:5000',

            'tags' => 'sometimes|required|array|max:5',
            'tags.*' => 'string|max:50',

            'status' => [
                'sometimes',
                'required',
                'string',
                Rule::enum(CityEventStatus::class),
            ],
        ];
    }
}
