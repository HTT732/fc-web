<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'bail|required|exists:categories,id',
            'price' => 'bail|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên sản phẩm',
            'category_id.required' => 'Hãy chọn một danh mục sản phẩm',
            'price.required' => 'Chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'category_id.exists' => 'Danh mục không tồn tại'
        ];
    }
}
