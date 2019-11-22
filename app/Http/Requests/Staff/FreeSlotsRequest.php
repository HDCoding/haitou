<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class FreeSlotsRequest extends FormRequest
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
            'is_enabled' => 'boolean',
            'required' => 'required|integer|min:1000|max:2000000000',
            'actual' => 'integer|max:2000000000',
            'days' => 'required|integer|min:1|max:125',
            'is_freeleech' => 'boolean',
            'is_silver' => 'boolean',
            'is_doubleup' => 'boolean',
        ];
    }
}
