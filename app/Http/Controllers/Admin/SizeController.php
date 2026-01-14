<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        // Lấy danh sách kèm số lượng biến thể đang sử dụng dung lượng này
        $sizes = Size::withCount('variants')->latest()->paginate(10);
        return view('admin.variants.sizes.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:sizes,name|max:50',
                'description' => 'nullable|max:255',
            ],
            [
                'name.unique' => 'Dung lượng này đã tồn tại.',
            ],
        );

        Size::create($request->all());
        return redirect()->back()->with('success', 'Thêm dung lượng mới thành công!');
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|max:50|unique:sizes,name,' . $size->id,
            'description' => 'nullable|max:255',
        ]);

        $size->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Size $size)
    {
        if ($size->variants()->count() > 0) {
            return redirect()->back()->with('error', 'Không thể xóa vì đã có sản phẩm thuộc dung lượng này!');
        }
        $size->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
