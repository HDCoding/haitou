<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class IndexImageRequest extends FormRequest
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
            'index' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ];
    }
}
