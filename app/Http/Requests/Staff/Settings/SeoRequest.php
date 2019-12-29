<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
            //SEO
            'site_title' => 'string|min:1|max:45',
            'meta_keywords' => 'nullable|string|max:530',
            'meta_description' => 'nullable|string|max:530',
        ];
    }
}
