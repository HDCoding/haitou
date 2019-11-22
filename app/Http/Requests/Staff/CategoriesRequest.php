<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'color' => 'nullable|string|max:10',
            'icon' => 'nullable|string|max:45',
            'is_faq' => 'boolean',
            'is_forum' => 'boolean',
            'is_media' => 'boolean',
            'is_torrent' => 'boolean',
            'position' => 'integer|min:1|max:125' // 1 to 125 - maybe used by forum
        ];
    }
}
