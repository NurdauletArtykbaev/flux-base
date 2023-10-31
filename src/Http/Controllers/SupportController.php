<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Nurdaulet\FluxBase\Http\Requests\SupportSaveRequest;
use Nurdaulet\FluxBase\Services\SupportService;
use Illuminate\Http\Request;

class SupportController
{
    public function __construct(private SupportService $supportService)
    {
    }

    public function store(SupportSaveRequest $request)
    {
        $this->supportService->create($request->validated(), $request->file('file'));
        return response()->noContent();
    }
}
