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

    public function create($data)
    {
        $user = auth()->guard('sanctum')->user();
        $data['user_id'] = $user?->id;
        $data['file'] = $filePath ?? null;

        $support = $this->supportRepository->create($data);
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $this->saveFile($support, $file);
            }

        }
        if (request()->file('file')) {
            $this->saveFile($support, request()->file('file'));
        }

        if (app()->isProduction() && config('flux-base.options.support_email')) {
            Mail::to(config('flux-base.options.support_email'))->send(new SupportSendMail($support));
        }
    }

    private function saveFile($support, $file)
    {
        $fileName = time() . '_' . str_replace(' ', '', $file->getClientOriginalName());
        $filePath = $file->storeAs('supports', $fileName, 's3');
        $support->files()->create([
            'path' => $filePath
        ]);
    }
}
