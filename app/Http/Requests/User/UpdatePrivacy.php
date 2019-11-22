<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacy extends FormRequest
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
            'show_achievements' => 'boolean',
            'show_mood' => 'boolean',
            'show_state' => 'boolean',
            'show_role' => 'boolean',
            'show_downloaded' => 'boolean',
            'show_uploaded' => 'boolean',
            'show_profile' => 'boolean',
            'show_profile_points' => 'boolean',
            'show_profile_level' => 'boolean',
            'show_profile_avatar' => 'boolean',
            'show_profile_cover' => 'boolean',
            'show_profile_info' => 'boolean',
            'show_profile_title' => 'boolean',
            'show_profile_signature' => 'boolean',
            'show_profile_birthday' => 'boolean',
            'show_profile_about' => 'boolean',
            'show_profile_social_links' => 'boolean',
            'show_profile_friends' => 'boolean',
            'show_profile_warning' => 'boolean',
            'show_forum_signatures' => 'boolean',
            'pm_from_all' => 'boolean',
        ];
    }
}
