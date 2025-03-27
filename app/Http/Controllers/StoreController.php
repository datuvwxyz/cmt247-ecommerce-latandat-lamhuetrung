<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục, sắp xếp theo thời gian cập nhật (mới nhất lên đầu)
        $categories = Category::orderBy('updated_at', 'desc')->get();
        $brands = Brand::orderBy('updated_at', 'desc')->get();
        $products = Product::orderBy('updated_at', 'desc')->paginate(9);

        // Đếm số lượng sản phẩm trong mỗi danh mục
        foreach ($categories as $category) {
            // Lưu số lượng sản phẩm trong mỗi danh mục vào một thuộc tính
            $category->product_count = $category->products()->count();
        }

        // Đếm số lượng sản phẩm trong mỗi thương hiệu
        foreach ($brands as $brand) {
            // Lưu số lượng sản phẩm trong mỗi thương hiệu vào một thuộc tính
            $brand->product_count = $brand->products()->count();
        }
        return view('pages.store', compact('categories', 'brands', 'products'));
    }
}
