<?php

namespace App\Http\Requests\Snippet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSnippetRequest extends FormRequest
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
            'description' => ['required'],
            'content' => ['required'],
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

            'description.required' => __('The :attribute field is required', ['attribute' => __('description')]),

            'content.required' => __('The :attribute field is required', ['attribute' => __('content')]),

        ];
    }
}
