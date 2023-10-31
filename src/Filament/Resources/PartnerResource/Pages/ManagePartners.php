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
            Actions\CreateAction::make()      ->mutateFormDataUsing(function (array $data): array {
                $url = env('AWS_URL') . '/' . $data['image'];
//                dd($data['image']);
                $imageExtension = explode('.', $data['image']);
                $imageExtension = end($imageExtension);
                $file = file_get_contents($url);

                $image = ImageManagerStatic::make($file)->encode($imageExtension, 90);
                $imageWebp = Image::make($file)->encode('webp', 80);
                $webpName = 'partners/'.  time() . Str::uuid().'.webp';

                $data['webp']  = $webpName;
                Storage::disk('s3')->put($data['image'], $image);
                Storage::disk('s3')->put($webpName, $imageWebp);

                $url = env('AWS_URL') . '/' . $data['logo'];
                $logoExtension = explode('.', $data['logo']);
                $logoExtension = end($logoExtension);
                $file = file_get_contents($url);
                $image = ImageManagerStatic::make($file)
                    ->encode($logoExtension, 90);
                $imageWebp = Image::make($file)->encode('webp', 80);
                $webpName = 'partners/'.  time() . Str::uuid().'.webp';

                $data['logo_webp']  = $webpName;
                Storage::disk('s3')->put($data['logo'], $image);
                Storage::disk('s3')->put($webpName, $imageWebp);
                return $data;
            }),
        ];
    }
}
