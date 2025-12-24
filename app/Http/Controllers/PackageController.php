<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
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
        $query = Package::query();
        $trashedCount = Package::onlyTrashed()->count();

        // Tìm kiếm theo tên hoặc nhà mạng
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('carrier', 'like', '%' . $search . '%');
            });
        }

        $packages = $query->latest()->paginate(10);

        return view('admin.packages.index', compact('packages', 'trashedCount'));
    }

    /**
     * Form tạo mới
     */
    public function create()
    {
        return view('admin.packages.create');
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
        return view('admin.packages.edit', compact('package'));
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
            return redirect()->route('admin.packages.index')
                ->with('success', 'Gói cước đã được chuyển vào thùng rác.');
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
            return redirect()->route('admin.packages.trash')
                ->with('success', 'Khôi phục gói cước thành công.');
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
            return redirect()->route('admin.packages.trash')
                ->with('success', 'Đã xóa vĩnh viễn gói cước.');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi khi xóa vĩnh viễn: ' . $e->getMessage());
        }
    }
}
