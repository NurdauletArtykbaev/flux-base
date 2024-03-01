<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Nurdaulet\FluxBase\Http\Requests\ClickSaveRequest;
use Nurdaulet\FluxBase\Services\ClickHistoryService;

class ClickHistoryController
{
    public function __construct(private ClickHistoryService $clickHistoryService)
    {
    }

    public function store(ClickSaveRequest $request)
    {

        $this->clickHistoryService->create($request->validated());
        return response()->noContent();
    }
}
