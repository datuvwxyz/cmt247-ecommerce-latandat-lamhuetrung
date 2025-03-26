<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Tìm thương hiệu theo tên trong cột 'brand_name'
        $brand = Brand::where('name', $row['brand_name'])->first();
        $category = Category::where('name', $row['category_name'])->first();

        // Nếu không tìm thấy thương hiệu hoặc danh mục, có thể tạo mới hoặc xử lý theo yêu cầu
        if (!$brand) {
            // Nếu cần tạo mới thương hiệu, bỏ qua hoặc xử lý lỗi
            $brand = Brand::create(['name' => $row['brand_name']]);
        }

        if (!$category) {
            // Nếu cần tạo mới danh mục, bỏ qua hoặc xử lý lỗi
            $category = Category::create(['name' => $row['category_name']]);
        }

        // Xử lý hình ảnh (giả sử cột 'image' chứa URL của hình ảnh)
        $imagePath = null;
        if (isset($row['image']) && $row['image']) {
            // Giả sử cột 'image' trong Excel chứa URL của hình ảnh hoặc đường dẫn tương đối
            $imageUrl = $row['image'];
            $imageName = Str::random(10) . '.jpg';  // Tạo tên ngẫu nhiên cho hình ảnh
            $imagePath = 'products/' . $imageName;

            // Tải hình ảnh về thư mục public (public/storage)
            file_put_contents(storage_path('app/public/' . $imagePath), file_get_contents($imageUrl));
        }

        // Tạo và lưu sản phẩm
        return new Product([
            'name'               => $row['name'],
            'sku'                => $row['sku'],
            'barcode'            => $row['barcode'],
            'unit'               => $row['unit'],
            'brand_id'           => $brand->id,  // Sử dụng ID của thương hiệu
            'category_id'        => $category->id,  // Sử dụng ID của danh mục
            'price'              => $row['price'],
            'quantity'           => $row['quantity'],
            'image'              => $imagePath,  // Lưu đường dẫn của hình ảnh
            'short_description'  => $row['short_description'],
            'detailed_description'=> $row['detailed_description'],
        ]);
    }

    // Chỉ định số dòng đọc mỗi lần
    public function chunkSize(): int
    {
        return 1000;  // Điều chỉnh tùy vào dung lượng file
    }
}

