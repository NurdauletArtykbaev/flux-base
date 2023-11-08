<?php

namespace Nurdaulet\FluxBase\Filament\Resources\LayoutResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Nurdaulet\FluxBase\Filament\Resources\LayoutResource;

class ListLayouts extends ListRecords
{
    protected static string $resource = LayoutResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
