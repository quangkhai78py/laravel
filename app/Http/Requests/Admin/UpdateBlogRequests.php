<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequests extends FormRequest
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
            'name'=>'required',
            'content'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'vui lòng nhập tên blog',
            'content.required'=>'vui lòng nhập nội dung blog',
        ];
    }
}


