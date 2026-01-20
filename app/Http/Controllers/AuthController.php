<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest; // Import LoginRequest
use App\Http\Requests\RegisterRequest; // Import RegisterRequest
use App\Models\User;
use Exception;
// use Google_Client;
use Google\Client as Google_Client;
use GrahamCampbell\ResultType\Success;
use Log;
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
            $user = User::where('facebook_id', $facebookUser->getId())->orWhere('email', $facebookUser->getEmail())->first();

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
                    'role_id' => 3, // Mặc định là Customer như bạn quy định
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
            $user = User::where('google_id', $googleUser->getId())->orWhere('email', $googleUser->getEmail())->first();

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
    public function deleteFacebookData(Request $request)
    {
        $signed_request = $request->input('signed_request');

        if (!$signed_request) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = $this->parseSignedRequest($signed_request);
        $user_id = $data['user_id'] ?? null;

        // Logic: Tại đây bạn có thể đánh dấu user này sẽ bị xóa hoặc xóa dữ liệu liên quan
        // Ví dụ: User::where('facebook_id', $user_id)->delete();

        Log::info('Facebook deletion requested for user: ' . $user_id);

        // Trả về response theo chuẩn của Facebook
        return response()->json([
            'url' => route('home'), // Đường dẫn người dùng xem trạng thái xóa (có thể trỏ về trang chủ)
            'confirmation_code' => 'del_' . time(), // Mã xác nhận bất kỳ
        ]);
    }



public function handleGoogleOneTap(Request $request)
{
    $idToken = $request->input('credential');
    
    if (!$idToken) {
        return redirect('/auth/login')->with('error', 'Không nhận được thông tin từ Google');
    }

    // Khởi tạo Client với ID của bạn
    $client = new Google_Client(['client_id' => '479761304566-i84psbv35dri5jrsg7brlp2hnh7mpq49.apps.googleusercontent.com']);
    
    // Xác thực ID Token
    $payload = $client->verifyIdToken($idToken);

    if ($payload) {
        $googleId = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'];

        // Tìm hoặc tạo User
        $user = User::where('google_id', $googleId)->orWhere('email', $email)->first();

        if ($user) {
            if (empty($user->google_id)) {
                $user->update(['google_id' => $googleId]);
            }
        } else {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'google_id' => $googleId,
                'password' => \Hash::make(\Str::random(16)),
                'role_id' => 3,
                'is_active' => true,
            ]);
        }

        \Auth::login($user);
        
        // Quan trọng: Phải dùng return redirect() vì đây là request POST từ Google
        return redirect()->intended('/'); 
    } else {
        return redirect('/auth/login')->with('error', 'Xác thực Google thất bại');
    }
}

    private function parseSignedRequest($signed_request)
    {
        [$encoded_sig, $payload] = explode('.', $signed_request, 2);

        $secret = config('services.facebook.client_secret'); // Đảm bảo bạn đã cấu hình client_secret trong config/services.php

        $sig = $this->base64UrlDecode($encoded_sig);
        $data = json_decode($this->base64UrlDecode($payload), true);

        // Xác thực chữ ký để đảm bảo request đến từ Facebook
        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            return null;
        }

        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            return null;
        }

        return $data;
    }

    private function base64UrlDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}