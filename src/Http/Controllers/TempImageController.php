<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Nurdaulet\FluxBase\Http\Requests\TempImageSaveRequest;
use Nurdaulet\FluxBase\Services\ImageService;

class TempImageController
{
    public function __construct(private ImageService $imageService)
    {
    }


    public function upload(TempImageSaveRequest $request): array
    {
        return $this->imageService->tempImageUrl($request);
    }
}
