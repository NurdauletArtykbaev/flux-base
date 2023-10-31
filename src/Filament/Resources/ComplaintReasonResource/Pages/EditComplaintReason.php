<?php

namespace Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplaintReason extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ComplaintReasonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
