<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Web;
use Illuminate\Support\Facades\Validator;
use Livewire\FileUploadConfiguration;
use Livewire\TemporaryUploadedFile;

class FileUploadController
{
    public function getMiddleware()
    {
        return [[
            'middleware' => FileUploadConfiguration::middleware(),
            'options' => [],
        ]];
    }

    public function handle()
    {

        $disk = FileUploadConfiguration::disk();

        $filePaths = $this->validateAndStore(request('files'), $disk);

        return ['paths' => $filePaths];
    }

    public function validateAndStore($files, $disk)
    {
        Validator::make(['files' => $files], [
            'files.*' => FileUploadConfiguration::rules()
        ])->validate();

        $fileHashPaths = collect($files)->map(function ($file) use ($disk) {
            $filename = TemporaryUploadedFile::generateHashNameWithOriginalNameEmbedded($file);

            return $file->storeAs('/'.FileUploadConfiguration::path(), $filename, [
                'disk' => $disk
            ]);
        });
        return $fileHashPaths->map(function ($path) { return str_replace(FileUploadConfiguration::path('/'), '', $path); });
    }
}

