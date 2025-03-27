<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProductStatisticsExport;

class ExportController extends Controller
{
    public function exportStatistics(Request $request)
    {
        $type = $request->input('type', 'pdf');

        // Lấy dữ liệu thống kê
        $statistics = [
            'total_products' => Product::count(),
            'total_active_products' => Product::where('quantity', '>', 0)->count(),
            'total_out_of_stock' => Product::where('quantity', 0)->count(),
            'product_by_category' => Category::withCount('products')
                ->with('products')
                ->get()
                ->map(function ($category) {
                    $category->total_quantity = $category->products->sum('quantity');
                    return $category;
                }),
            'product_by_brand' => Brand::withCount('products')
                ->with('products')
                ->get()
                ->map(function ($brand) {
                    $brand->total_quantity = $brand->products->sum('quantity');
                    return $brand;
                }),
            'top_selling_products' => OrderItem::with('product')
                ->select('product_id')
                ->selectRaw('SUM(quantity) as total_quantity')
                ->selectRaw('SUM(quantity * price) as total_revenue')
                ->groupBy('product_id')
                ->orderBy('total_quantity', 'desc')
                ->limit(10)
                ->get()
        ];

        // Xử lý xuất file theo từng loại
        switch ($type) {
            case 'excel':
                return $this->exportExcel($statistics);
            case 'pdf':
            default:
                return $this->exportPdf($statistics);
        }
    }

    // Phương thức xuất Excel
    protected function exportExcel($statistics)
    {
        return Excel::download(new ProductStatisticsExport($statistics), 'Thống kê sản phẩm.xlsx');
    }

    // Phương thức xuất PDF

    protected function exportPdf($statistics)
    {
        $pdf = Pdf::loadView('admin.pages.exports.statisticsProductsPDF', compact('statistics'))
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'dpi' => 150,
                'chroot' => base_path(),
                'isPhpEnabled' => true, // Cho phép PHP trong Blade nếu cần
            ]);

        return $pdf->download('Thống kê sản phẩm.pdf');
    }
}
