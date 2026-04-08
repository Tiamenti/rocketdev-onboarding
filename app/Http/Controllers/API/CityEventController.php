<?php

namespace App\Http\Controllers\API;

use App\Enums\CityEventStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityEvent\StoreCityEventRequest;
use App\Http\Requests\CityEvent\UpdateCityEventRequest;
use App\Http\Resources\CityEventResource;
use App\Models\CityEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityEventController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $perPage = Number::clamp($request->input('limit', 10), 1, 50);

        $cityEvents = QueryBuilder::for(CityEvent::class)
            ->allowedFilters(
                AllowedFilter::callback('from', function ($query, $value) {
                    $query->where('start_at', '>=', $value);
                }),
                AllowedFilter::callback('to', function ($query, $value) {
                    $query->where('start_at', '<=', $value);
                }),

                AllowedFilter::callback('tag', function ($query, $value) {
                    $query->whereJsonContains('tags', $value);
                }),

                AllowedFilter::exact('place'),
                AllowedFilter::exact('status'),

                AllowedFilter::callback('min_popularity', function ($query, $value) {
                    $query->where('popularity', '>=', (int) $value);
                }),
                AllowedFilter::callback('max_popularity', function ($query, $value) {
                    $query->where('popularity', '<=', (int) $value);
                }),
            )
            ->orderBy('start_at', 'desc')
            ->paginate($perPage);

        return CityEventResource::collection($cityEvents);
    }

    public function store(StoreCityEventRequest $request): JsonResource
    {
        $cityEvent = CityEvent::make($request->safe()->all());

        abort_if($cityEvent->calculatePopularity() == 1, 'Low popularity Not interesting Event');

        $cityEvent->save();

        return new CityEventResource($cityEvent);
    }

    public function show(int $id): JsonResource
    {
        $cityEvent = CityEvent::findOrFail($id);
        $resource = new CityEventResource($cityEvent);

        if (now()->isTuesday() || now()->isWednesday()) {
            $resource->additional([
                'recommendation' => 'Рекомендуем по вторникам и средам',
            ]);
        }

        return $resource;
    }

    public function update(UpdateCityEventRequest $request, int $id): JsonResource
    {
        $validated = $request->safe()->all();
        $cityEvent = CityEvent::findOrFail($id);

        $newStatus = $validated['status'] ?? null;

        if ($newStatus == CityEventStatus::Published->value
            && $cityEvent->status == CityEventStatus::Cancelled) {
            abort(400, "You can't change the status from canceled to published.");
        }

        $cityEvent->update($validated);

        return new CityEventResource($cityEvent);
    }
}
