<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:brands,name,' . $this->route('brand'), // Kiểm tra tên thương hiệu duy nhất (ngoại trừ thương hiệu đang được cập nhật)
            'description' => 'nullable|string|max:1000', // Mô tả không bắt buộc
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thương hiệu là bắt buộc.',
            'name.unique' => 'Tên thương hiệu đã tồn tại.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ];
    }
}
