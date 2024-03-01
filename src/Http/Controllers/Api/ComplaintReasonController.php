<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Nurdaulet\FluxBase\Http\Resources\ComplaintReasonsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Nurdaulet\FluxBase\Repositories\ComplaintReasonRepository;

class ComplaintReasonController 
{
    public function __construct(private ComplaintReasonRepository $complaintReasonRepository)
    {
    }

    public function __invoke(Request $request)
    {
        $lang = app()->getLocale();
        $filters = $request->input('filters', []);

        return Cache::remember("complaint-reasons-$lang-" . json_encode($request->all()),  config('flux-base.options.cache_expiration', 269746),
            function () use ($filters) {
            return ComplaintReasonsResource::collection($this->complaintReasonRepository->get($filters));
        });
    }
}
