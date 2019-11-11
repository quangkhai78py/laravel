<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequests extends FormRequest
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
            'size' => 'required|max:10'
        ];
    }

    public function messages()
    {
        return [
           'size.required'=>'vui lòng nhập SIZE sản phẩm',
            'max'=>'không được nhập quá max: ký tự',
            
        ];
    }
}
