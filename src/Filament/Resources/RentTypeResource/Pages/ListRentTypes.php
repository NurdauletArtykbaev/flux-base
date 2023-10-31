<?php

namespace Nurdaulet\FluxBase\Filament\Resources\RentTypeResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\RentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRentTypes extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = RentTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
