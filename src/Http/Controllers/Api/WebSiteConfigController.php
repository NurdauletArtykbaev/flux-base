<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebSiteConfigController
{
    public function index()
    {
        $config = config('flux-base.models.web_site_config')::first();
        return response()->json(['data' => $this->prepareData($config)]);
    }

    public function store(Request $request)
    {
        $config = config('flux-base.models.web_site_config')::first();
        $config = $config?->id ? $config : (new (config('flux-base.models.user')));
        $config->config = $request->all();
        $config->save();
        return response()->noContent();
    }

    private function prepareData($config)
    {
        $configData = null;
        try {
            $configData = $config->config ? json_decode($config->config) : null;
        } catch (\Exception $exception) {

        }

        return [
            "logo" => [
                'primary' => $config->logo_primary ? Storage::disk('s3')->url($config->logo_primary) : null,
                'secondary' => $config->logo_secondary ? Storage::disk('s3')->url($config->logo_secondary) : null,
            ],
            "font" => $config->font,
            "design" => $config->design ? Storage::disk('s3')->url($config->design) : null,
            "config" => $configData
        ];
    }
}
