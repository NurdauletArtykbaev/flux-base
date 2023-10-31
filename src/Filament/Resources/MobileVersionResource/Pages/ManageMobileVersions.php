<?php

namespace Nurdaulet\FluxBase\Filament\Resources\MobileVersionResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\MobileAppResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMobileVersions extends ManageRecords
{
    protected static string $resource = MobileAppResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
