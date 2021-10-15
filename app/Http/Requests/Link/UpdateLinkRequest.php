<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
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
            'title' => ['required', 'max:200'],
            'url' => ['required'],
            'open_in_new_tab' => ['required'],
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
            'title.required' => __('The :attribute field is required', ['attribute' => __('title')]),
            'title.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('title'), 'max' => 50]),

            'url.required' => __('The :attribute field is required', ['attribute' => __('url')]),

            'open_in_new_tab.required' => __('The :attribute field is required', ['attribute' => __('Open in new tab')]),

        ];
    }
}
