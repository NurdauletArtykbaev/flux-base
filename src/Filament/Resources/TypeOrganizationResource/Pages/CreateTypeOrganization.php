<?php

namespace Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeOrganization extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = TypeOrganizationResource::class;
    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
