<?php

namespace Nurdaulet\FluxBase\Filament\Resources\LinkResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Nurdaulet\FluxBase\Filament\Resources\LinkResource;

class CreateLink extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
