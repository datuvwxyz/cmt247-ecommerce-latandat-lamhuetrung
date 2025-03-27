<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku', // Kiểm tra sản phẩm đã tồn tại
            'barcode' => 'nullable|string|max:255',
            'unit' => 'required|string|max:50',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Kiểm tra hình ảnh
            'short_description' => 'nullable|string|max:1000',
            'detailed_description' => 'nullable|string',
        ];
    }
}

