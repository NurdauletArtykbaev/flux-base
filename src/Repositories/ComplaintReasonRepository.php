<?php

namespace Nurdaulet\FluxBase\Repositories;

class ComplaintReasonRepository
{
    public function get($filters = [])
    {

        return  config('flux-base.models.complaint_reason')::active()
            ->where('is_for_user', request()->is_for_user == 'true' ? 1 : 0)
            ->applyFilters((new ( config('flux-base.models.user'))), $filters)
            ->orderBy('sort')->get();
    }
}
