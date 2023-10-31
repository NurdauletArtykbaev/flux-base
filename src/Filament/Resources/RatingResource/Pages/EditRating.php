<?php

namespace Nurdaulet\FluxBase\Filament\Resources\RatingResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\RatingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRating extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = RatingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
