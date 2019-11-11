<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequests extends FormRequest
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
            'avatar'=>'required|image|mimes:jpeg,png,jpg,gif',
            'content'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'vui lòng nhập tên blog',
            'avatar.required'=>'vui lòng chọn ảnh blog',
            'content.required'=>'vui lòng nhập nội dung blog',
            'image' => 'phải là hình ảnh',
            'mimes' => 'phải dịnh dạng như sau:jpeg,png,jpg,gif',
        ];
    }
}
