<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required',
            'brand_id' => 'required',
            'size_id' => 'required',
            'product' => 'required|min:3|max:50',
            'price' =>'required|min:3|numeric',
            'avatar' => 'max:2048',
            'quantily' => 'required|numeric',
        ];
    }
       public function messages()
    {
        return [
            'category_id.required' =>'vui lòng chọn loại sản phẩm',
            'brand_id.required' => 'vui lòng chọn nhãn hiệu sản phẩm',
            'size_id.required' => 'vui lòng chọn size cho sản phẩm',
            'product.required' => 'vui lòng nhập tên sản phẩm',
            'price.required' => 'vui lòng nhập giá sản phẩm',
            'avatar.required' => 'vui lòng chọn ảnh cho sản phẩm',
            'quantily.required' => 'vui lòng nhập số lượng sản phẩm',
            'product.min' => 'sản phẩm không được đặt tên nhỏ hơn 3 ký tự',
            'price.min' => 'số tiền không hợp lệ',
            'product.max' => 'sản phẩm không được đặt tên quá 50 ký tự',
            'price.max' => 'số tiền không hợp lệ',
            'image' => 'phải là hình ảnh',
            'mimes' => 'phải dịnh dạng như sau:jpeg,png,jpg,gif',
            'avatar.max' => 'Maximum file size to upload :max',
        ];
    }
}
