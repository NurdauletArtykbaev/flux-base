<?php

namespace Nurdaulet\FluxBase\Filament\Resources\BannedTopSearchWordResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\BannedTopSearchWordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTopSearchWords extends ManageRecords
{
    protected static string $resource = BannedTopSearchWordResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
