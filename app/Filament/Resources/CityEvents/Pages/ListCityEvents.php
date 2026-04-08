<?php

namespace App\Filament\Resources\CityEvents\Pages;

use App\Filament\Resources\CityEvents\CityEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCityEvents extends ListRecords
{
    protected static string $resource = CityEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
