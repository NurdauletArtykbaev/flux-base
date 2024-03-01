<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Nurdaulet\FluxBase\Http\Requests\TempImageSaveRequest;
use Nurdaulet\FluxBase\Services\ImageService;

class TempImageController
{
    public function __construct(private ImageService $imageService)
    {
    }


    public function upload(TempImageSaveRequest $request)
    {
        return response()->json(['data'=> $this->imageService->tempImageUrl($request)]);
    }
}
