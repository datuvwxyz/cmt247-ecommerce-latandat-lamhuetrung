<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả các sản phẩm, sắp xếp theo thời gian tạo, mới nhất lên đầu
        $products = Product::orderBy('updated_at', 'desc')->get();
        return view('admin.pages.product.list', compact('products'));
    }

    // Phương thức show() hiển thị chi tiết sản phẩm
    public function show($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);  // Nếu không tìm thấy sản phẩm, sẽ trả về lỗi 404

        // Trả về view chi tiết sản phẩm với dữ liệu
        return view('admin.pages.product.show', compact('product'));
    }

    public function create()
    {
        // Lấy danh sách thương hiệu và danh mục để lựa chọn khi tạo sản phẩm
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.pages.product.create', compact('brands', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // Kiểm tra xem sản phẩm đã tồn tại chưa
        if (Product::where('sku', $request->sku)->exists()) {
            return redirect()->back()->with('error', 'Sản phẩm đã tồn tại với mã SKU này.');
        }

        // Kiểm tra và xử lý hình ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Lưu hình ảnh vào thư mục 'public/products' trong storage
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Tạo mới sản phẩm
        Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'unit' => $request->unit,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,  // Lưu đường dẫn của hình ảnh
            'short_description' => $request->short_description,
            'detailed_description' => $request->detailed_description,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }


    public function edit(Product $product)
    {
        // Lấy danh sách thương hiệu và danh mục, đồng thời truyền thông tin sản phẩm để chỉnh sửa
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.pages.product.edit', compact('product', 'brands', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // Kiểm tra xem SKU của sản phẩm đã tồn tại chưa (ngoại trừ sản phẩm hiện tại)
        if (Product::where('sku', $request->sku)->where('id', '!=', $product->id)->exists()) {
            return redirect()->back()->with('error', 'Sản phẩm với mã SKU này đã tồn tại.');
        }

        // Kiểm tra và xử lý hình ảnh mới
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Nếu có hình ảnh mới, xóa hình ảnh cũ và lưu hình ảnh mới
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $imagePath = $request->file('image')->store('public/products');
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'name' => $request->name ?: $product->name,
            'sku' => $request->sku ?: $product->sku,
            'barcode' => $request->barcode ?: $product->barcode,
            'unit' => $request->unit ?: $product->unit,
            'brand_id' => $request->brand_id ?: $product->brand_id,
            'category_id' => $request->category_id ?: $product->category_id,
            'price' => $request->price ?: $product->price,
            'quantity' => $request->quantity ?: $product->quantity,
            'image' => $imagePath,
            'short_description' => $request->short_description ?: $product->short_description,
            'detailed_description' => $request->detailed_description ?: $product->detailed_description,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    // Soft Delete
    public function softDelete(Product $product)
    {
        // Kiểm tra xem sản phẩm có mặt hàng trong giỏ hàng hoặc đơn hàng không
        if ($product->cartItems()->count() > 0 || $product->orderItems()->count() > 0) {
            return redirect()->route('products.index')->with('error', 'Không thể xóa sản phẩm này vì nó có mặt hàng trong giỏ hàng hoặc đơn hàng.');
        }

        // Xóa sản phẩm mềm
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa mềm.');
    }

    // Restore (khôi phục sản phẩm đã xóa mềm)
    public function restore($id)
    {
        // Tìm sản phẩm đã bị xóa mềm và phục hồi
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được khôi phục.');
    }

    // Hard Delete (xóa thật)
    public function hardDelete($id)
    {
        // Tìm sản phẩm đã bị xóa mềm và xóa thật
        $product = Product::withTrashed()->findOrFail($id);
        // Xóa hình ảnh nếu có
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->forceDelete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa vĩnh viễn.');
    }

    // Phương thức xử lý import dữ liệu từ file Excel
    public function import(Request $request)
    {
        // Kiểm tra tính hợp lệ của file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            // Xử lý file import
            Excel::import(new ProductImport, $request->file('file'));

            // Sau khi import thành công
            return redirect()->route('products.index')->with('success', 'Dữ liệu đã được nhập thành công!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Nếu có lỗi trong quá trình import (ví dụ: dữ liệu không hợp lệ)
            $errors = $e->getMessage();

            return redirect()->route('products.index')->with('error', 'Lỗi khi nhập dữ liệu: ' . $errors);
        } catch (\Exception $e) {
            // Xử lý các lỗi khác (ví dụ: file không hợp lệ, hoặc các lỗi khác)
            return redirect()->route('products.index')->with('error', 'Đã xảy ra lỗi khi nhập dữ liệu: ' . $e->getMessage());
        }
    }

}
