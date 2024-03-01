<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Support\Facades\Cache;

class MobileAppController
{
    public function currentVersion()
    {
        $mobileVersion = Cache::remember("mobile-app-version", 269746, function () {
            return config('flux-base.models.mobile_version')::select('version', 'ios_version', 'android_version')->first();
        });

        return response()->json([
            'data' => $mobileVersion
        ]);
    }
}
