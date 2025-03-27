<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Lấy các quy tắc xác thực cho yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('category'), // Tránh kiểm tra trùng lặp với chính danh mục đang sửa
            'description' => 'nullable|string|max:1000',
        ];
    }


    /**
     * Các thông báo lỗi tùy chỉnh.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.unique' => 'Danh mục này đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 500 ký tự.',
        ];
    }
}

