<?php

use App\Http\Controllers\API\CityEventController;
use App\Http\Middleware\ApiKey;
use Illuminate\Support\Facades\Route;

Route::apiResource('/events', CityEventController::class)->middleware(ApiKey::class);
