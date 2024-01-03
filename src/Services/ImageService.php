<?php

namespace Nurdaulet\FluxBase\Services;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class ImageService
{
    public function tempImageUrl($request): array
    {
        $basePath = $request->path ?? 'temp-images';

        $data = $request->toArray();
        $respData = [];
        $user = $request->user();
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $filePath = "$basePath/" . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
//                $webp_filePath = "$basePath/" . Str::uuid() . time() . '.webp';

//                if ($image->getClientOriginalExtension() != 'svg') {
//                    $jpg_image = ImageManagerStatic::make($image)->encode($image->getClientOriginalExtension(), 80);
//                    $data = getimagesize($image);
//                    $w = $data[0];
//                    $h = $data[1];
//                    $imageWebp = ImageManagerStatic::make($image);
//                    if ($w >= 900 && $h >= 900) {
//                        $imageWebp = $imageWebp->resize(900, 900, function ($constraint) {
//                            $constraint->aspectRatio();
//                        });
//                    }
//                    $imageWebp = $imageWebp->encode('webp', 60);
//                } else {
                    $jpg_image = file_get_contents($image);
//                    $imageWebp = file_get_contents($image);
//                    $webp_filePath = 'items/' . Str::uuid() . time() . '.svg';
//                }


                Storage::disk('s3')->put($filePath, $jpg_image);
//                Storage::disk('s3')->put($webp_filePath, $imageWebp);

                $respData[] = config('flux-base.models.temp_image')::create([
                    'image' => $filePath,
//                    'webp' => $webp_filePath,
                    'user_id' => $user->id,
                ]);
            }
        }

        return $respData;
    }

}
