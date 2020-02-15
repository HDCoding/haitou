<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class MediasRequest extends FormRequest
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
            'studio_id' => 'required|integer|exists:studios,id',
            'name' => 'required|string|max:255',
            'title_english' => 'nullable|string|max:255',
            'title_japanese' => 'required|string|max:255',
            'media_type' => 'required|in:1,2,3,4',
            'released_at' => 'required|date',
            'finished_on' => 'nullable|date',
            'description' => 'required|string|max:65530',
            'is_adult' => 'boolean',
            'status' => 'required|integer',
            'yt_video' => 'nullable|string|max:45',
            'total_episodes' => 'nullable|integer|max:2000',
            'duration' => 'nullable|integer|max:1000',
            'total_chapters' => 'nullable|integer|max:32767',
            'total_volumes' => 'nullable|integer|max:32767',
        ];
    }
}
