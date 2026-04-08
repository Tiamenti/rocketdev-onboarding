<?php

use App\Http\Controllers\API\CityEventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/events', CityEventController::class);
