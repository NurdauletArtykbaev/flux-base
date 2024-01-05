<?php

namespace Nurdaulet\FluxBase\Filament\Resources\PaymentMethodResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\PaymentMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentMethod extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = PaymentMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
