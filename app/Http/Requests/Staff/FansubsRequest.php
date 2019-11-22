<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class FansubsRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'logo' => 'nullable|string|max:250',
            'website' => 'nullable|url|string|max:250',
            'discord' => 'nullable|url|string|max:250',
            'description' => 'nullable|string|max:5000',
            'is_active' => 'boolean'
        ];
    }
}
