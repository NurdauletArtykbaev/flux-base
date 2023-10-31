<?php

namespace Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeOrganization extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = TypeOrganizationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
