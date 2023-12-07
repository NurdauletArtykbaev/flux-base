<?php

namespace Nurdaulet\FluxBase\Filament\Resources\CountryResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Nurdaulet\FluxBase\Filament\Resources\CountryResource;

class ListCountry extends ListRecords
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
