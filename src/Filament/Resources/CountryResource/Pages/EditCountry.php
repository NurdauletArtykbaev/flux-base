<?php

namespace Nurdaulet\FluxBase\Filament\Resources\CountryResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\CityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Nurdaulet\FluxBase\Filament\Resources\CountryResource;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
