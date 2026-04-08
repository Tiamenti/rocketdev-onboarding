<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum CityEventStatus: string implements HasLabel
{
    case Draft = 'draft';
    case Published = 'published';
    case Cancelled = 'cancelled';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Draft => 'Черновик',
            self::Published => 'Опубликовано',
            self::Cancelled => 'Отменено',
        };
    }
}
