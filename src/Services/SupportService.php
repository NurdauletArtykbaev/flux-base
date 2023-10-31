<?php

namespace Nurdaulet\FluxBase\Services;


use Nurdaulet\FluxBase\Mail\SupportSendMail;
use Illuminate\Support\Facades\Mail;
use Nurdaulet\FluxBase\Repositories\SupportRepository;

class SupportService
{

    public function __construct(private SupportRepository $supportRepository)
    {
    }

    public function create($data, $file)
    {

        $user = auth()->guard('sanctum')->user();
        if ($file) {
            $fileName = time().'_'.str_replace(' ', '', $file->getClientOriginalName());
            $filePath = $file->storeAs('supports', $fileName, 's3');
        }
        $data['user_id'] =  $user?->id;
        $data['file'] =  $filePath ?? null;

        $support = $this->supportRepository->create($data);

        if (app()->isProduction()) {
            Mail::to(config('flux-base.options.support_email'))->send(new SupportSendMail($support));
        }
    }
}
