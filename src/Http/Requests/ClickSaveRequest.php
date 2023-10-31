<?php

namespace Nurdaulet\FluxBase\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClickSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'item_id' => 'nullable',
            'user_id' => 'nullable',
            'store_id' => 'nullable',
            'order_id' => 'nullable',
            'name' => 'required'
        ];
    }
}
