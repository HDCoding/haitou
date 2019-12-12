<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class ActorsRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg|max:3072',
            'website' => 'nullable|url|string|max:250',
            'birthday' => 'required|date',
            'description' => 'required|string|max:65530'
        ];
    }
}
