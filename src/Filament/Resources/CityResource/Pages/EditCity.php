<?php

namespace Nurdaulet\FluxBase\Filament\Resources\CityResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\CityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
