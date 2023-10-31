<?php

namespace Nurdaulet\FluxBase\Filament\Resources\BannerResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\BannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = BannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
