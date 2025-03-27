<?php
namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        // Sắp xếp thương hiệu theo thời gian tạo, mới nhất lên đầu
        $brands = Brand::orderBy('updated_at', 'desc')->get();

        return view('admin.pages.brand.list', compact('brands'));
    }


    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(StoreBrandRequest $request)
    {
        // Kiểm tra và thêm thương hiệu
        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('brands.create')->with('success', 'Thương hiệu đã được thêm thành công.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.pages.brand.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);

        // Kiểm tra xem tên thương hiệu  đã tồn tại hay chưa (trừ thương hiệu hiện tại đang sửa)
        if (Brand::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Thương hiệu đã tồn tại.');
        }

        // Kiểm tra và chỉ cập nhật giá trị nếu có thông tin mới
        $brand->name = $request->name ?: $brand->name; // Nếu không có giá trị mới thì giữ nguyên
        $brand->description = $request->description ?: $brand->description; // Nếu không có giá trị mới thì giữ nguyên

        // Cập nhật danh mục
        $brand->save();
        // Kiểm tra và cập nhật thương hiệu
        return redirect()->route('brands.edit', $id)->with('success', 'Thương hiệu đã được cập nhật.');
    }

    public function destroy(Brand $brand)
{
    // Kiểm tra xem thương hiệu có sản phẩm nào không
    if ($brand->products()->count() > 0) {
        // Nếu có sản phẩm, không cho phép xóa và hiển thị thông báo
        return redirect()->route('brands.index')->with('error', 'Không thể xóa thương hiệu này vì nó có sản phẩm.');
    }

    // Nếu không có sản phẩm, thực hiện xóa thương hiệu
    $brand->delete();

    return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa.');
}

}

