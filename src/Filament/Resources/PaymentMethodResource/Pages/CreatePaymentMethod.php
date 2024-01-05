<?php

namespace Nurdaulet\FluxBase\Filament\Resources\PaymentMethodResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\PaymentMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentMethod extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = PaymentMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
