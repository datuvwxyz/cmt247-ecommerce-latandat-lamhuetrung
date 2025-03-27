<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductStatisticsController extends Controller
{
    /**
     * Trang tổng quan thống kê sản phẩm
     */
    public function index()
    {
        // Thống kê tổng quan
        $totalProducts = Product::count();
        $totalActiveProducts = Product::where('quantity', '>', 0)->count();
        $totalOutOfStockProducts = Product::where('quantity', 0)->count();

        // Top sản phẩm bán chạy nhất
        $topSellingProducts = OrderItem::with('product')
            ->select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(quantity * price) as total_revenue')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();

        // Thống kê theo danh mục
        $productsByCategory = Category::withCount('products')
            ->with('products')
            ->get()
            ->map(function($category) {
                // Tính tổng số lượng sản phẩm theo từng danh mục
                $category->total_quantity = $category->products->sum('quantity');
                return $category;
            });

        // Thống kê theo thương hiệu
        $productsByBrand = Brand::withCount('products')
            ->with('products')
            ->get()
            ->map(function($brand) {
                // Tính tổng số lượng sản phẩm theo từng thương hiệu
                $brand->total_quantity = $brand->products->sum('quantity');
                return $brand;
            });

        // Sản phẩm sắp hết hàng (dưới 10 sản phẩm)
        $lowStockProducts = Product::where('quantity', '<=', 10)
            ->orderBy('quantity', 'asc')
            ->get();

        return view('admin.pages.statistics.statisticsProducts', compact(
            'totalProducts', 
            'totalActiveProducts', 
            'totalOutOfStockProducts', 
            'topSellingProducts', 
            'productsByCategory', 
            'productsByBrand', 
            'lowStockProducts'
        ));
    }
}