<?php

namespace Nurdaulet\FluxBase\Filament\Resources\RentTypeResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\RentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRentType extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = RentTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
