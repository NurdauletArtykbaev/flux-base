<?php

namespace Nurdaulet\FluxBase\Repositories;


use App\Models\ComplaintReason;

class ComplaintReasonRepository
{
    public function get()
    {
        return  config('flux-base.models.complaint_reason')::active()
            ->where('is_for_user', $request->is_for_user == 'true' ? 1 : 0)
            ->orderBy('sort')->get();
    }
}
