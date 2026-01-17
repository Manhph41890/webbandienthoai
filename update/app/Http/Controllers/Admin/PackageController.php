<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Category;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Danh sách gói cước
     */
    public function index(Request $request)
    {
        $query = Package::query()->with('category');
        $trashedCount = Package::onlyTrashed()->count();

        // 1. Tìm kiếm theo tên hoặc nhà mạng
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")->orWhere('carrier', 'like', "%$search%");
            });
        }

        // 2. Lọc theo Nhà mạng (SK, KT, LGU)
        if ($request->filled('carrier')) {
            $query->where('carrier', $request->carrier);
        }

        // 3. Lọc theo Loại thanh toán (Trả trước/Trả sau)
        if ($request->filled('payment_type')) {
            $query->where('payment_type', $request->payment_type);
        }

        // 4. Lọc theo Tình trạng SIM (Hợp pháp/Bất hợp pháp)
        if ($request->filled('sim_type')) {
            $query->where('sim_type', $request->sim_type);
        }

        // 5. Lọc theo Trạng thái kho (Còn hàng/Hết hàng)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 6. Lọc theo Danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 7. Khoảng giá
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 8. Sắp xếp
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $packages = $query->paginate($request->get('per_page', 10))->withQueryString();

        // Lấy danh mục để lọc (Chỉ lấy các danh mục có chứa từ "gói cước" hoặc liên quan)
        $categories = Category::where('name', 'like', '%gói cước%')->get();

        return view('admin.packages.index', compact('packages', 'trashedCount', 'categories'));
    }

    /**
     * Form tạo mới
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.packages.create', compact('categories'));
    }

    /**
     * Lưu gói cước mới
     */
    public function store(StorePackageRequest $request)
    {
        try {
            // 1. Lấy dữ liệu ĐÃ VALIDATE (Bây giờ sẽ bao gồm cả specifications)
            $validatedData = $request->validated();

            // 2. Xử lý is_active (vì checkbox/switch có thể gửi "1" hoặc không gửi gì)
            // Nếu input có 'is_active', gán true (1), nếu không có gán false (0)
            $validatedData['is_active'] = $request->has('is_active') ? true : false;

            // 3. Xử lý Slug (nếu Model boot chưa xử lý hoặc bạn muốn can thiệp)
            if (empty($validatedData['slug'])) {
                $validatedData['slug'] = Str::slug($validatedData['name']);
            }

            // 4. Tạo mới Package
            // Model sẽ tự động chuyển mảng specifications thành JSON nhờ vào $casts=['specifications' => 'array']
            Package::create($validatedData);
            Alert::success('Thành công', 'Gói cước đã được tạo thành công!');
            return redirect()->route('admin.packages.index');
        } catch (Exception $e) {
            // Ghi log lỗi nếu cần: \Log::error($e->getMessage());
            Alert::error('Lỗi', 'Không thể tạo gói cước: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Form chỉnh sửa
     */
    public function edit(Package $package)
    {
        $categories = Category::all();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    /**
     * Cập nhật gói cước
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        // dd($request->toArray());
        try {
            $validatedData = $request->validated();

            if (empty($validatedData['slug'])) {
                $validatedData['slug'] = Str::slug($validatedData['name']);
            }

            $validatedData['is_active'] = $request->has('is_active');

            $package->update($validatedData);

            Alert::success('Thành công', 'Gói cước đã được cập nhật thành công.');
            return redirect()->route('admin.packages.index');
        } catch (Exception $e) {
            Alert::error('Lỗi', 'Lỗi khi cập nhật gói cước: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Bật tắt trạng thái hoạt động (is_active) nhanh
     */
    public function toggleActive(Package $package)
    {
        try {
            $package->is_active = !$package->is_active;
            $package->save();

            return back()->with('success', 'Cập nhật trạng thái thành công.');
        } catch (Exception $e) {
            return back()->with('error', 'Không thể cập nhật trạng thái: ' . $e->getMessage());
        }
    }

    /**
     * Xóa mềm
     */
    public function destroy(Package $package)
    {
        try {
            $package->delete();
            return redirect()->route('admin.packages.index')->with('success', 'Gói cước đã được chuyển vào thùng rác.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi khi xóa: ' . $e->getMessage());
        }
    }

    /**
     * Danh sách thùng rác
     */
    public function trash()
    {
        $trashPackages = Package::onlyTrashed()->latest()->get();
        return view('admin.packages.trash', compact('trashPackages'));
    }

    /**
     * Khôi phục
     */
    public function restore($id)
    {
        try {
            $package = Package::onlyTrashed()->findOrFail($id);
            $package->restore();
            return redirect()->route('admin.packages.trash')->with('success', 'Khôi phục gói cước thành công.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi khi khôi phục: ' . $e->getMessage());
        }
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete($id)
    {
        try {
            $package = Package::onlyTrashed()->findOrFail($id);
            $package->forceDelete();
            return redirect()->route('admin.packages.trash')->with('success', 'Đã xóa vĩnh viễn gói cước.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi khi xóa vĩnh viễn: ' . $e->getMessage());
        }
    }
}
