<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Http\Request;

class WebSiteConfigController
{
    public function index()
    {
        return response()->json(['data' => config('flux-base.models.web_site_config')::first()?->config]);
    }

    public function store(Request $request)
    {
        $config = config('flux-base.models.web_site_config')::first();
        $config = $config?->id ? $config : (new ( config('flux-base.models.user')));
        $config->config = $request->all();
        $config->save();
        return response()->noContent();
    }
}
