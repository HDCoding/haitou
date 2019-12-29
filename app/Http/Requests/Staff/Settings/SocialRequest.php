<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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
            //Social
            'facebook' => 'nullable|string|url|max:255',
            'twitter' => 'nullable|string|url|max:255',
            'pinterest' => 'nullable|string|url|max:255',
            'googleplus' => 'nullable|string|url|max:255',
            'youtube' => 'nullable|string|url|max:255',
            'instagram' => 'nullable|string|url|max:255',
            'twitch' => 'nullable|string|url|max:255',
            'discord' => 'nullable|string|url|max:255',
        ];
    }
}
