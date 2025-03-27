<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Lấy danh sách brand và category để hiển thị (nếu cần)
        $brands = Brand::orderBy('updated_at', 'desc')->get();
        $categories = Category::orderBy('updated_at', 'desc')->get();

        // Tìm các sản phẩm có cùng brand_id và category_id, ngoại trừ chính sản phẩm đó
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->get();

        return view('pages.product', compact('product', 'brands', 'categories', 'relatedProducts'));
    }

}
