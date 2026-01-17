<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ColorController extends Controller
{
    public function index()
    {
        // Lấy danh sách màu kèm theo số lượng biến thể đang sử dụng màu đó
        $colors = Color::withCount('variants')->latest()->paginate(10);
        return view('admin.variants.colors.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colors,name|max:50',
            'hex_code' => 'required|max:7',
        ], [
            'name.unique' => 'Tên màu này đã tồn tại.',
            'hex_code.required' => 'Vui lòng chọn mã màu.'
        ]);

        Color::create($request->all());
Alert::success('Thêm màu sắc thành công!');
        return redirect()->back();
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|max:50|unique:colors,name,' . $color->id,
            'hex_code' => 'required|max:7',
        ]);

        $color->update($request->all());
Alert::success('Câp nhật màu sắc thành công!');
        return redirect()->back();
    }

    public function destroy(Color $color)
    {
        if ($color->variants()->count() > 0) {
            Alert::error('Không thể xóa màu sắc đang sử dụng!');
            return redirect()->back();
        }
        $color->delete();
        Alert::success('Xóa màu sắc thành công!');
        return redirect()->back();
    }
}
