<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $rules = [];

        if ($this->has('password')) {
            $rules['password'] = 'required|confirmed';
        } else {
            $rules = [
                'name' => 'bail|required',
                'email' => 'bail|required|email',
                'username' => 'required'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên quản trị viên',
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'email.email' => 'Email không đúng định dạng',
            'password.confirm' => 'Mật khẩu xác thực không khớp'
        ];
    }
}
