<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class OthersRequest extends FormRequest
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
            //Boolean
            'signup_on' => 'boolean',
            'invite_on' => 'boolean',
            'forum_on' => 'boolean',
            'rnh_on' => 'boolean',
            //Ratio
            'max_ratio' => 'numeric',
            'min_ratio' => 'numeric',
            'low_ratio' => 'numeric',
            //Invite
            'invitedays' => 'integer|min:1|max:150',
        ];
    }
}
