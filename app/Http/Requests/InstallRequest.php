<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstallRequest extends FormRequest
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
            'db.host' => 'required',
            'db.port' => 'required',
            'db.username' => 'required',
            'db.password' => 'nullable',
            'db.database' => 'required',
            'admin.first_name' => 'required',
            'admin.last_name' => 'required',
            'admin.email' => 'required|email',
            'admin.password' => 'required|confirmed',
            'store.store_name' => 'required',
            'store.store_email' => 'required|email',
            'store.search_engine' => ['required', Rule::in(['mysql', 'algolia'])],
            'store.algolia_app_id' => 'required_if:store.search_engine,algolia',
            'store.algolia_secret' => 'required_if:store.search_engine,algolia',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.required_if' => 'The :attribute field is required when :other is :value.',
            '*.email' => 'The :attribute must be a valid email address.',
            '*.unique' => 'The :attribute has already been taken.',
            '*.confirmed' => 'The :attribute confirmation does not match.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'db.host' => 'host',
            'db.port' => 'port',
            'db.username' => 'username',
            'db.password' => 'password',
            'db.database' => 'datbase',
            'admin.first_name' => 'first name',
            'admin.last_name' => 'last name',
            'admin.email' => 'email',
            'admin.password' => 'password',
            'store.store_name' => 'store name',
            'store.store_email' => 'store email',
            'store.search_engine' => 'search engine',
            'store.algolia_app_id' => 'algolia app id',
            'store.algolia_secret' => 'algolia secret',
        ];
    }
}
