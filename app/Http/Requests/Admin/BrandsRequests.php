<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequests extends FormRequest
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
            'brand' =>'required|max:200|min:3',
        ];
    }

    public function messages()
    {
        return [
           'brand.required'=>'vui lòng nhập Nhãn hiệu',
            'max'=>'không được nhập quá max: ký tự',
            'min'=>'không được nhập nhỏ min: ký tự'
        ];
    }
}
