<?php
namespace Nurdaulet\FluxBase\Filament\Resources\WebSiteConfigResource\Pages;


use Nurdaulet\FluxBase\Filament\Resources\WebSiteConfigResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebSiteConfig extends EditRecord
{
    protected static string $resource = WebSiteConfigResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
