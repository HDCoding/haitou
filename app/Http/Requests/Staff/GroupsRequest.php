<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:250',
            'color' => 'nullable|max:10',
            'icon' => 'nullable|max:45',
            'is_main' => 'boolean',
            'hnr' => 'required|integer|min:1|max:168'
        ];
    }
}
