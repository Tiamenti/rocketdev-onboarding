<?php

namespace App\Models;

use App\Enums\CityEventStatus;
use App\Observers\CityEventObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

#[ObservedBy(CityEventObserver::class)]
class CityEvent extends Model
{
    use HasFactory;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'tags' => 'array',
        'status' => CityEventStatus::class,
    ];

    public function calculatePopularity(): int
    {
        $daysToStart = today()->diffInDays($this->start_at);

        $raw = 3 + ($this->capacity / 1000) - ($daysToStart / 10) + count($this->tags);

        $popularity = round($raw);

        return Number::clamp($popularity, 1, 5);
    }
}
