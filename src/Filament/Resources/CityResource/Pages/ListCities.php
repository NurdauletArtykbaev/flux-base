<?php

namespace Nurdaulet\FluxBase\Filament\Resources\CityResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\CityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
