<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Nurdaulet\FluxBase\Http\Resources\PaymentMethodsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PaymentMethodController
{
    public function __invoke(Request $request)
    {
        $lang = app()->getLocale();

        return Cache::remember("payment-methods-news-$lang", 269746, function () {
            return PaymentMethodsResource::collection(config('flux-base.models.payment_method')::active()->get());
        });

    }
}
