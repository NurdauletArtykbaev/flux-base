<?php

namespace Nurdaulet\FluxBase\Filament\WebSiteConfigResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\WebSiteConfigResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebSiteConfig extends ListRecords
{

    protected static string $resource = WebSiteConfigResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
