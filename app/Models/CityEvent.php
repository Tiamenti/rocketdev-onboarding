<?php

namespace App\Models;

use App\Enums\CityEventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityEvent extends Model
{
    use HasFactory;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'tags' => 'array',
        'status' => CityEventStatus::class,
    ];
}
