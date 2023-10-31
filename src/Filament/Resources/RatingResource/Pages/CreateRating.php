<?php

namespace Nurdaulet\FluxBase\Filament\Resources\RatingResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\RatingResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions;

class CreateRating extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = RatingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
