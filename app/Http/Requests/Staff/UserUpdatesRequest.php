<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatesRequest extends FormRequest
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
            'avatar' => 'nullable|string|url|max:250',
            'cover' => 'nullable|string|url|max:250',
            'title' => 'nullable|string|max:250',
            'info' => 'nullable|string|max:250',
            'signature' => 'nullable|string|max:1000',
            'role_id' => 'exists:groups,id'
        ];
    }
}
