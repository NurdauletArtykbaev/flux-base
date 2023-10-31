<?php

namespace Nurdaulet\FluxBase\Filament\Resources\RentTypeResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\RentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRentType extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = RentTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
