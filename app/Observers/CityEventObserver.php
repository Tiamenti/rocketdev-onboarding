<?php

namespace App\Observers;

use App\Models\CityEvent;

class CityEventObserver
{
    public function updating(CityEvent $cityEvent): void
    {
        $cityEvent->change_number += 1;
    }

    public function saving(CityEvent $cityEvent): void
    {
        $cityEvent->popularity = $cityEvent->calculatePopularity();
    }
}
