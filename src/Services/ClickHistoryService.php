<?php

namespace Nurdaulet\FluxBase\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Nurdaulet\FluxBase\Helpers\CityHelper;
use Nurdaulet\FluxBase\Repositories\CityRepository;
use Nurdaulet\FluxBase\Repositories\ClickHistoryRepository;
use Stevebauman\Location\Facades\Location;

class ClickHistoryService
{
    public function __construct(private readonly ClickHistoryRepository $clickHistoryRepository)
    {
    }

    public function create($data)
    {
        $data = $this->prepareCreateData($data);
        return $this->clickHistoryRepository->create($data);
    }

    private function prepareCreateData($data)
    {
        $fields = [];
        if (isset($data['item_id'])) {
            $fields['item_id'] = $data['item_id'];
        } else if (isset($data['user_id'])) {
            $fields['user_id'] = $data['user_id'];
        } else if (isset($data['store_id'])) {
            $fields['store_id'] = $data['store_id'];
        }

        $data['platform']        = request()->header('platform');
        $data['ip']              = request()->ip();
        $data['clicked_user_id'] = auth()->guard('sanctum')->user()?->id;
        $data['fields'] = $fields;
        return $data;
    }
}
