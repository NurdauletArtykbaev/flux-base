<?php

namespace Nurdaulet\FluxBase\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportSaveRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'nullable',
            'file' => 'nullable|file|mimes:jpeg,avif,mov,mp4,png,gif,svg,pdf,doc,docx,ppt,pptx,heic',
            'description' => 'nullable',
        ];
    }
}
