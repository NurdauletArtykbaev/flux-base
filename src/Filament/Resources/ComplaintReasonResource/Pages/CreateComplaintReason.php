<?php

namespace Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComplaintReason extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ComplaintReasonResource::class;
    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
