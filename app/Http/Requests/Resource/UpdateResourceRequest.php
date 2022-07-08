<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
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
            'type' => ['required', 'in:Link,Snippet,File'],
            'title' => ['required', 'max:200'],

            //snippet only
            'description' => ['exclude_unless:type,Snippet','required'],
            'content' => ['exclude_unless:type,Snippet','required'],

            //file only
            'file' => ['exclude_unless:type,File','nullable','mimes:pdf'],

            //link only
            'url' => ['exclude_unless:type,Link','required'],
            'open_in_new_tab' => ['exclude_unless:type,Link','required'],
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
            'type.required' => __('The :attribute field is required', ['attribute' => __('type')]),
            'type.in' => __('The :attribute field must be one of Link, Snippet, File', ['attribute' => __('type')]),

            'title.required' => __('The :attribute field is required', ['attribute' => __('title')]),
            'title.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('title'), 'max' => 50]),

            'description.required' => __('The :attribute field is required', ['attribute' => __('description')]),
            'content.required' => __('The :attribute field is required', ['attribute' => __('content')]),
            'url.required' => __('The :attribute field is required', ['attribute' => __('url')]),
            'open_in_new_tab.required' => __('The :attribute field is required', ['attribute' => __('open_in_new_tab')]),

            'file.required' => __('The :attribute field is required', ['attribute' => __('file')]),
            'file.mimes' => __('The :attribute field only supports PDF files', ['attribute' => __('file')]),
        ];
    }
}
