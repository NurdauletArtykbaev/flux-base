<?php

namespace Nurdaulet\FluxBase\Filament\Resources\LinkResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Nurdaulet\FluxBase\Filament\Resources\LinkResource;

class EditLink extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
