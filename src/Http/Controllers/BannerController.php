<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Repositories\BannerRepository;

class BannerController
{
    public function __construct(private readonly BannerRepository $bannerRepository)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->bannerRepository->get();
    }
}
