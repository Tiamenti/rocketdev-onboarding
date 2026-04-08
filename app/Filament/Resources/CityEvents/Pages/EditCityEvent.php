<?php

namespace App\Filament\Resources\CityEvents\Pages;

use App\Filament\Resources\CityEvents\CityEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCityEvent extends EditRecord
{
    protected static string $resource = CityEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
