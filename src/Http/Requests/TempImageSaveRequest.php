<?php

namespace Nurdaulet\FluxBase\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempImageSaveRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'images' => 'required|array',
            'images.*' => 'image'
        ];
    }
}
