<?php

namespace App\Http\Requests\Torrent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'media_id' => 'required|exists:medias,id',
            'fansub_id' => 'required|exists:fansubs,id',
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:65530',
            'allow_comments' => 'boolean',
            'is_anonymous' => 'boolean',
            'is_freeleech' => 'boolean',
            'is_silver' => 'boolean',
            'is_doubleup' => 'boolean'
        ];
    }
}
