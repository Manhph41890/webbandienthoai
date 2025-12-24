<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;    // Import LoginRequest
use App\Http\Requests\RegisterRequest; // Import RegisterRequest
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; // Đã import

class AuthController extends Controller
{
    /**
     * Bảo vệ các route chỉ dành cho khách (guest).
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Hiển thị form đăng nhập.
     */
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    /**
     * Xử lý yêu cầu đăng nhập.
     */
    public function login(LoginRequest $request)
    {
        // Lấy dữ liệu đã được validate từ LoginRequest
        $credentials = $request->validated();

        // Laravel Auth::attempt sẽ tự động hash mật khẩu và kiểm tra.
        // Thêm điều kiện kiểm tra tài khoản có bị khóa không (cột 'is_active' trong DB)
        $credentials['is_active'] = true; // Chỉ cho phép đăng nhập nếu tài khoản đang hoạt động

        // Thử đăng nhập
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // CHỨC NĂNG ĐẶC BIỆT: Chuyển hướng dựa trên vai trò (role)
            $user = Auth::user();


            // Nếu không phải admin, chuyển hướng đến trang chủ
            return redirect()->intended('/'); // <--- Đã sửa ở đây: Chuyển đến trang chủ

        }

        // Nếu đăng nhập thất bại
        throw ValidationException::withMessages([
            'email' => ['Thông tin đăng nhập không chính xác hoặc tài khoản đã bị khóa.'],
        ]);
    }

    /**
     * Hiển thị form đăng ký.
     */
    public function showRegistrationForm()
    {
        return view('client.auth.register');
    }

    /**
     * Xử lý yêu cầu đăng ký.
     */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        // Tạo người dùng mới
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash mật khẩu
            'role_id' => 3, // Gán role_id = 3 (Customer) mặc định cho tài khoản mới (Cần đảm bảo role 3 tồn tại trong bảng roles)
            'is_active' => true, // Kích hoạt tài khoản ngay lập tức
            // Các trường khác như address, avatar, phone sẽ được điền sau qua profile
            // nếu bạn muốn thêm vào form đăng ký, cần bổ sung vào RegisterRequest và $fillable của User Model
        ]);

        // Tự động đăng nhập cho người dùng sau khi đăng ký thành công
        Auth::login($user);

        // Chuyển hướng về trang chủ
        return redirect('/')->with('success', 'Đăng ký tài khoản thành công!');
    }

    /**
     * Đăng xuất người dùng.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Chuyển hướng về trang chủ sau khi logout
    }
}
