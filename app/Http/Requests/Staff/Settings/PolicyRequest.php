<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
            //Policy
            'terms' => 'nullable|string|max:65530',
            'privacy' => 'nullable|string|max:65530',
            'disclaimer' => 'nullable|string|max:65530',
        ];
    }
}
