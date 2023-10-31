<?php

namespace Nurdaulet\FluxBase\Filament\Resources\BannerResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\BannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = BannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
