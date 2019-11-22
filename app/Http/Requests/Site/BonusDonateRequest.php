<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class BonusDonateRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
