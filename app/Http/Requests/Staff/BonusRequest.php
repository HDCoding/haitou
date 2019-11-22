<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class BonusRequest extends FormRequest
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
            'cost' => 'required|integer',
            'bonus_type' => 'required|numeric',
            'bytes' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'description' => 'string|max:65530',
            'is_enabled' => 'boolean'
        ];
    }
}
