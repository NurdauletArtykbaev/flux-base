<?php

namespace Nurdaulet\FluxBase\Filament\Resources\LinkResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Nurdaulet\FluxBase\Filament\Resources\LinkResource;

class ListLinks extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
