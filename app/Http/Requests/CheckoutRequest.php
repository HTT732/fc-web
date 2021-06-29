<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'customer_name' => 'required|max:100',
            'customer_phone' => 'required|numeric',
            'customer_address' => 'min:6'
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Họ tên không dược để trống.',
            'customer_name.max' => 'Họ tên quá dài.',
            'customer_phone.required' => 'Số điện thoại không dược để trống.',
            'customer_phone.numeric' => 'Số điện thoại không được chứa kí tự.',
            'customer_address.min' => 'Địa chỉ không phù hợp.'
        ];
    }
}
