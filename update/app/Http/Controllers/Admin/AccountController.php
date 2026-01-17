<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Sẽ làm sau)
     */
    public function index()
    {

        $accounts = User::with('role')
            ->whereHas('role', function ($query) {
                $query->whereIn('id', ['1', '2']);
            })
            ->latest() // Sắp xếp theo tài khoản mới nhất
            ->paginate(15);

        return view('admin.account.index', compact('accounts'));
    }

    public function indexUsers(Request $request)
    {
        // Lấy các tham số từ request để lọc
        $search = $request->input('search');
        $month = $request->input('month');

        // Bắt đầu query
        $query = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('id', '3');
            });

        // Lọc theo từ khóa tìm kiếm (tên hoặc email)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Lọc theo tháng đăng ký (định dạng YYYY-MM)
        if ($month) {
            $query->whereYear('created_at', '=', substr($month, 0, 4))
                ->whereMonth('created_at', '=', substr($month, 5, 2));
        }

        $users = $query->latest()->paginate(15);

        return view('admin.account.index_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::whereNotIn('id', ['1'])->get();
// dd($roles->toArray());
        return view('admin.account.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $validatedData = $request->validated();

        // Tạo tài khoản mới
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'role_id' => $validatedData['role_id'],
            'is_active' => true, // Mặc định kích hoạt tài khoản nhân viên
        ]);

        return redirect()->route('admin.accounts.index') // Tạm thời trỏ về index, sau này sẽ có trang danh sách
            ->with('success', 'Tạo tài khoản nhân viên thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $account) // Sử dụng Route Model Binding, đổi $user thành $account cho nhất quán
    {
        // Lấy danh sách các quyền dành cho nhân viên (Biên tập viên, Tác giả)
        $roles = Role::whereNotIn('name', ['admin', 'user'])->get();

        return view('admin.account.edit', compact('account', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, User $account)
    {
        $validatedData = $request->validated();

        // Xử lý upload avatar mới
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($account->avatar) {
                Storage::disk('public')->delete($account->avatar);
            }
            // Upload avatar mới
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        // Cập nhật mật khẩu nếu người dùng nhập mật khẩu mới
        // Nếu không nhập, bỏ qua không cập nhật
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Loại bỏ key 'password' khỏi mảng để không cập nhật mật khẩu thành rỗng
            unset($validatedData['password']);
        }

        // Cập nhật thông tin user
        $account->update($validatedData);

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Cập nhật tài khoản thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(User $account)
    {
        // Đảo ngược trạng thái is_active
        $account->is_active = !$account->is_active;
        $account->save();

        // Tạo thông báo động
        $message = $account->is_active
            ? 'Đã kích hoạt thành công tài khoản: ' . $account->name
            : 'Đã khóa thành công tài khoản: ' . $account->name;

        // Quay trở lại trang trước đó (có thể là trang nhân viên hoặc người dùng)
        return redirect()->back()->with('success', $message);
    }
}
