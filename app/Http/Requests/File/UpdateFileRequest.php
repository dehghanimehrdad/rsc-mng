<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
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
            'file' => ['mimes:pdf', 'nullable'],
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
            'file.mimes' => __('The :attribute field only supports PDF files', ['attribute' => __('file')]),

            'title.required' => __('The :attribute field is required', ['attribute' => __('title')]),
            'title.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('title'), 'max' => 50]),

        ];
    }
}
