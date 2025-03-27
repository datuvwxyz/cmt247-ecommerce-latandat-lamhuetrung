<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductStatisticsExport implements FromArray, WithStyles, WithColumnWidths
{
    protected $statistics;

    public function __construct($statistics)
    {
        $this->statistics = $statistics;
    }

    public function array(): array
    {
        $data = [
            ['Thống kê sản phẩm', '', ''],
            ['Tổng số sản phẩm', $this->statistics['total_products'], ''],
            ['Sản phẩm còn hàng', $this->statistics['total_active_products'], ''],
            ['Sản phẩm hết hàng', $this->statistics['total_out_of_stock'], ''],
            ['', '', ''],
            ['Sản phẩm theo danh mục', '', ''],
            ['Tên danh mục', 'Số lượng sản phẩm', 'Tổng số lượng tồn'],
        ];

        foreach ($this->statistics['product_by_category'] as $category) {
            $data[] = [$category->name, $category->products_count, $category->total_quantity];
        }

        $data[] = ['', '', ''];
        $data[] = ['Sản phẩm theo thương hiệu', '', ''];
        $data[] = ['Tên thương hiệu', 'Số lượng sản phẩm', 'Tổng số lượng tồn'];

        foreach ($this->statistics['product_by_brand'] as $brand) {
            $data[] = [$brand->name, $brand->products_count, $brand->total_quantity];
        }

        $data[] = ['', '', ''];
        $data[] = ['Top 10 sản phẩm bán chạy', '', ''];
        $data[] = ['Tên sản phẩm', 'Số lượng bán', 'Doanh thu'];

        foreach ($this->statistics['top_selling_products'] as $item) {
            $data[] = [
                $item->product->name ?? 'N/A',
                $item->total_quantity,
                number_format($item->total_revenue, 2)
            ];
        }

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Tiêu đề chính in đậm, font lớn
            1 => ['font' => ['bold' => true, 'size' => 14]],
            // Tiêu đề các phần in đậm
            6 => ['font' => ['bold' => true]], // "Sản phẩm theo danh mục"
            7 => ['font' => ['bold' => true]], // Tiêu đề bảng danh mục
            // Tiêu đề "Sản phẩm theo thương hiệu"
            '10' => ['font' => ['bold' => true]], // Điều chỉnh số dòng tùy theo dữ liệu
            '11' => ['font' => ['bold' => true]], // Tiêu đề bảng thương hiệu
            // Tiêu đề "Top 10 sản phẩm bán chạy"
            '14' => ['font' => ['bold' => true]], // Điều chỉnh số dòng tùy theo dữ liệu
            '15' => ['font' => ['bold' => true]], // Tiêu đề bảng top 10
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40, // Cột tên danh mục/thương hiệu/sản phẩm
            'B' => 20, // Cột số lượng
            'C' => 20, // Cột tổng số lượng tồn/doanh thu
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}
