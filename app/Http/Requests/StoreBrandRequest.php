<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:brands,name', // Kiểm tra tên thương hiệu duy nhất
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
