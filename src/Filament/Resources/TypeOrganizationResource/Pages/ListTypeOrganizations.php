<?php

namespace Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeOrganizations extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = TypeOrganizationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
