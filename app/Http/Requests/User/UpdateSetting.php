<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetting extends FormRequest
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
            'facebook' => 'nullable|url|string|max:250',
            'twitter' => 'nullable|url|string|max:250',
            'linkedin' => 'nullable|url|string|max:250',
            'instagram' => 'nullable|url|string|max:250',
            'pinterest' => 'nullable|url|string|max:250',
            'torrents_per_page' => 'required|integer|min:10|max:50',
            'topics_per_page' => 'required|integer|min:10|max:50',
            'posts_per_page' => 'required|integer|min:10|max:50'
        ];
    }
}
