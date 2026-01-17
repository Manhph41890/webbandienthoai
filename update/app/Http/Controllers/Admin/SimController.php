<?php

namespace App\Http\Controllers;

use App\Models\Sim;
use App\Http\Requests\StoreSimRequest;
use App\Http\Requests\UpdateSimRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class SimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sim::with('package');

        // Nếu có từ khóa tìm kiếm theo số SIM
        if ($search = $request->input('search')) {
            $query->where('sim_number', 'like', '%' . $search . '%');
        }

        $sims = $query->latest()->paginate(15);

        return view('admin.sims.index', compact('sims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all(); // Lấy danh sách gói cước để chọn
        return view('admin.sims.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSimRequest $request)
    {
        try {
            Sim::create($request->validated());
            return redirect()->route('admin.sims.index')
                ->with('success', 'Thêm SIM mới thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi hệ thống: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sim $sim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sim $sim)
    {
        $packages = Package::all();
        return view('admin.sims.edit', compact('sim', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSimRequest $request, Sim $sim)
    {
        try {
            $sim->update($request->validated());
            return redirect()->route('admin.sims.index')
                ->with('success', 'Cập nhật thông tin SIM thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Cập nhật thất bại: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Xóa mềm SIM (Đưa vào thùng rác)
     */
    public function destroy(Sim $sim)
    {
        $sim->delete();
        return redirect()->route('admin.sims.index')
            ->with('success', 'Đã chuyển SIM vào thùng rác.');
    }

    /**
     * Khôi phục SIM từ thùng rác
     */
    public function restore($id)
    {
        $sim = Sim::onlyTrashed()->findOrFail($id);
        $sim->restore();
        return redirect()->route('admin.sims.trash')
            ->with('success', 'Khôi phục SIM thành công!');
    }

    /**
     * Xóa vĩnh viễn SIM (Xóa cứng)
     */
    public function forceDelete($id)
    {
        $sim = Sim::onlyTrashed()->findOrFail($id);
        $sim->forceDelete();
        return redirect()->route('admin.sims.trash')
            ->with('success', 'Đã xóa vĩnh viễn SIM khỏi hệ thống.');
    }
}
