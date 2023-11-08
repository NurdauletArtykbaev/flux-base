<?php


namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Nurdaulet\FluxBase\Http\Resources\InfoBalancesResource;

final class InfoBalanceController
{
    public function __construct()
    {
    }

    public function __invoke()
    {
        $lang = app()->getLocale();

        return Cache::remember("info-balances-$lang", 269746, function () {
            return InfoBalancesResource::collection(config('flux-base.models.info_balance')::get());
        });
    }
}
