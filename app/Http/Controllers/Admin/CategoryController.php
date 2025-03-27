<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục, sắp xếp theo thời gian tạo (mới nhất lên đầu)
        $categories = Category::orderBy('updated_at', 'desc')->get();

        return view('admin.pages.category.list', compact('categories'));
    }


    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        // Kiểm tra nếu danh mục đã tồn tại
        if (Category::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'Danh mục đã tồn tại.');
        }

        // Tạo danh mục mới
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.create')->with('success', 'Danh mục đã được thêm thành công.');
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra xem tên danh mục đã tồn tại hay chưa (trừ danh mục hiện tại đang sửa)
        if (Category::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Danh mục đã tồn tại.');
        }

        // Kiểm tra và chỉ cập nhật giá trị nếu có thông tin mới
        $category->name = $request->name ?: $category->name; // Nếu không có giá trị mới thì giữ nguyên
        $category->description = $request->description ?: $category->description; // Nếu không có giá trị mới thì giữ nguyên

        // Cập nhật danh mục
        $category->save();

        return redirect()->route('categories.edit', $id)->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra xem danh mục có sản phẩm hay không
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Danh mục này có sản phẩm, không thể xóa.');
        }

        // Xóa danh mục nếu không có sản phẩm
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
