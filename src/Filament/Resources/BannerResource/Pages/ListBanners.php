<?php

namespace Nurdaulet\FluxBase\Filament\Resources\BannerResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\BannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBanners extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = BannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
