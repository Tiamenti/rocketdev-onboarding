<?php

namespace App\Observers;

use App\Models\CityEvent;

class CityEventObserver
{
    public function saving(CityEvent $cityEvent): void
    {
        $cityEvent->popularity = $cityEvent->calculatePopularity();
    }
}
