<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'files' => 'required',
            'files.*' => 'image',
            'files.*' => 'mimes:jpeg,jpg,png,gif,svg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'files.*.image' => 'File tải lên phải là hình ảnh.',
            'files.required' => 'Chưa chọn hình ảnh tải lên.',
            'files.*.mimes' => ':attribute định dạng không phù hợp.',
            'files.*.max' => ':attribute vượt quá kích thước cho phép (> 5Mb)'
        ];
    }
}
