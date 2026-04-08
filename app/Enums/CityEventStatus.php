<?php

namespace App\Enums;

enum CityEventStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Cancelled = 'cancelled';
}
