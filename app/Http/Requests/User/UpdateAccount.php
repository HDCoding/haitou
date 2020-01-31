<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccount extends FormRequest
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
            'state_id' => 'required|integer|exists:states,id',
            'mood_id' => 'required|integer|exists:moods,id',
            'birthday' => 'nullable|date',
            'info' => 'nullable|string|max:250',
            'signature' => 'nullable|string|max:1000'
        ];
    }
}
