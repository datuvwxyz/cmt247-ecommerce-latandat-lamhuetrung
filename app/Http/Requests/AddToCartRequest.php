<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class AddToCartRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng đã đăng nhập
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity'   => ['required', 'integer', 'min:1', function ($attribute, $value, $fail) {
                $product = Product::find($this->product_id);
                if ($product && $value > $product->quantity) {
                    $fail("Chỉ còn {$product->quantity} sản phẩm trong kho.");
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'product_id.exists'   => 'Sản phẩm không tồn tại.',
            'quantity.required'   => 'Vui lòng nhập số lượng.',
            'quantity.integer'    => 'Số lượng phải là số nguyên.',
            'quantity.min'        => 'Số lượng tối thiểu là 1.',
        ];
    }
}
