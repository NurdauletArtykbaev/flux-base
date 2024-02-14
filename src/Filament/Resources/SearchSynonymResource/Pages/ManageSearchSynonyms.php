<?php

namespace Nurdaulet\FluxBase\Filament\Resources\SearchSynonymResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Nurdaulet\FluxBase\Filament\Resources\SearchSynonymResource;

class ManageSearchSynonyms extends ManageRecords
{
    protected static string $resource = SearchSynonymResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
