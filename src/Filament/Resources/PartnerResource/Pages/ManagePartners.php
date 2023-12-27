<?php

namespace Nurdaulet\FluxBase\Filament\Resources\PartnerResource\Pages;

use Nurdaulet\FluxBase\Filament\Resources\PartnerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class ManagePartners extends ManageRecords
{
    protected static string $resource = PartnerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
