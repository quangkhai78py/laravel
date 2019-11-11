<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'fullname' =>'required|max:200|min:3',
            //'email' => 'required|max:100|min:3',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|min:3|numeric',
            'address' => 'required',
            'country' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=>'vui lòng nhập tên của bạn',
            //'email.required'=>'vui lòng nhập email của bạn',
            'phone.required'=>'vui lòng nhập số điện thoại của bạn',
            'address.required'=>'vui lòng nhập địa chỉ của bạn',
            'country.required'=>'vui lòng chọn quốc gia',        
            'image' => 'phải là hình ảnh',
            'mimes' => 'phải dịnh dạng như sau:jpeg,png,jpg,gif',
            'avatar.max' => 'Maximum file size to upload :max',
            'numeric'=>':attribute Chỉ được nhập số',
            'phone.min'=>'số điện thoại không được nhỏ hơn 3 ký tự',

        ];
    }
}
