<?php

namespace Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplaintReasons extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ComplaintReasonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
