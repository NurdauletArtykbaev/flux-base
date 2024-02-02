<?php

namespace Nurdaulet\FluxBase\Repositories;

class ComplaintReasonRepository
{
    public function get($filters = [])
    {
        return  config('flux-base.models.complaint_reason')::active()
            ->where('is_for_user', request()->is_for_user == 'true' ? 1 : 0)
            ->when(!isset($filters['type']), fn($query) => $query->whereNull('type'))
            ->applyFilters(new ( config('flux-base.filters.complaint_reason')), $filters)
            ->orderBy('sort')->get();
    }
}
