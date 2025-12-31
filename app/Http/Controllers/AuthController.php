<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;    // Import LoginRequest
use App\Http\Requests\RegisterRequest; // Import RegisterRequest
use App\Models\User;
use Exception;
use GrahamCampbell\ResultType\Success;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException; // Đã import
use Laravel\Socialite\Socialite;

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
        return view('auth.login');
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
        return view('auth.register');
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
     * Chuyển hướng người dùng sang trang login của Facebook
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Xử lý dữ liệu trả về từ Facebook
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Kiểm tra xem user này đã tồn tại trong DB chưa
            $user = User::where('facebook_id', $facebookUser->getId())
                ->orWhere('email', $facebookUser->getEmail())
                ->first();

            if ($user) {
                // Nếu đã có user, cập nhật facebook_id nếu chưa có và đăng nhập
                if (!$user->facebook_id) {
                    $user->update(['facebook_id' => $facebookUser->getId()]);
                }
                Auth::login($user);
            } else {
                // Nếu chưa có, tạo user mới
                $newUser = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => null, // Đăng nhập MXH không cần pass
                    'role_id' => 3,     // Mặc định là Customer như bạn quy định
                    'is_active' => true,
                ]);

                Auth::login($newUser);
            }
            Alert::Success('Đăng nhập với facebook thành công !');
            return redirect('/');
        } catch (Exception $e) {
            Alert::error($e->getMessage());
            return redirect('/auth/login')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * GOOGLE LOGIN
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Tìm user theo google_id hoặc email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Cập nhật google_id nếu chưa có
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                Auth::login($user);
            } else {
                // Tạo mới
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)),
                    'role_id' => 3,
                    'is_active' => true,
                ]);
                Auth::login($newUser);
            }
            
            Alert::success('Thành công', 'Đăng nhập Google thành công!');
            return redirect('/');
        } catch (Exception $e) {
            return redirect('/auth/login')->with('error', 'Lỗi Google: ' . $e->getMessage());
        }
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
