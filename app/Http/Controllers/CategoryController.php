<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        $trashedCount = Category::onlyTrashed()->count(); // Đếm số lượng bài trong thùng rác

        // Đếm số điện thoại trong mỗi danh mục
        // Nếu bạn muốn hiển thị tổng số điện thoại trong danh mục,
        // cần thêm `withCount('phones')` vào query
        // $query->withCount('phones');

        // Xử lý tìm kiếm
        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $categories = $query->latest()->paginate(10); // Phân trang và sắp xếp mới nhất

        return view('admin.categories.index', compact('categories', 'trashedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::ordered()->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        // Lấy dữ liệu đã được validate từ Form Request
        $validatedData = $request->validated();


        // Tự động tạo slug từ name nếu slug không được nhập
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['name']);
        }


        // Tạo mới category
        Category::create($validatedData);


        // Chuyển hướng về trang danh sách và gửi kèm một thông báo thành công
        return redirect()->route('admin.categories.index')
            ->with('success', 'Chuyên mục đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('id', '!=', $category->id)->ordered()->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['name']);
        }

        $category->update($validatedData);
        return redirect()->route('admin.categories.index')->with('success', 'Chuyên mục đã được cập nhật thành công.');
    }

    /**
     * 1. Xóa mềm (soft delete) chuyên mục
     * 2. Trả về trang danh sách chuyên mục với thông báo thành công
     */
    public function destroy(Category $category)
    {
        // Kiểm tra nếu category có ràng buộc (ví dụ có sản phẩm) thì có thể báo lỗi nếu muốn
        // if ($category->phones()->count() > 0) {
        //     return back()->with('error', 'Không thể xóa danh mục đang có sản phẩm!');
        // }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Danh mục đã được chuyển vào thùng rác!');
    }

    /**
     * 2. Hiển thị danh sách thùng rác (Trash)
     */
    public function trash()
    {
        // Lấy ra những danh mục đã bị xóa mềm
        $trashCategories = Category::onlyTrashed()->latest()->get();
        return view('admin.categories.trash', compact('trashCategories'));
    }

    /**
     * 3. Khôi phục danh mục (Restore)
     */
    public function restore($id)
    {
        // Tìm ID trong danh sách đã xóa mềm
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.trash')
            ->with('success', 'Khôi phục danh mục thành công!');
    }

    /**
     * 4. Xóa vĩnh viễn (Force Delete)
     */
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        // Xử lý thêm: nếu danh mục có ảnh đại diện thì xóa file vật lý tại đây
        // if ($category->image) { Storage::disk('public')->delete($category->image); }

        $category->forceDelete(); // Xóa hoàn toàn khỏi database

        return redirect()->route('admin.categories.trash')
            ->with('success', 'Danh mục đã được xóa vĩnh viễn!');
    }
}
