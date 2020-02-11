<?php

namespace App\Http\Requests\Staff\Settings;

use Illuminate\Foundation\Http\FormRequest;

class PointsRequest extends FormRequest
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
            //Points
            'points_signup' => 'integer|min:1|max:250',
            'points_invite' => 'integer|min:1|max:250',
            'points_download' => 'integer|min:1|max:250',
            'points_comment' => 'integer|min:1|max:250',
            'points_upload' => 'integer|min:1|max:250',
            'points_rating' => 'integer|min:1|max:250',
            'points_topic' => 'integer|min:1|max:250',
            'points_post' => 'integer|min:1|max:250',
            'points_delete' => 'integer|min:1|max:250',
            'points_thanks' => 'integer|min:1|max:250',
            'points_report' => 'integer|min:1|max:250',
            'points_calendar' => 'integer|min:1|max:250',
        ];
    }
}
