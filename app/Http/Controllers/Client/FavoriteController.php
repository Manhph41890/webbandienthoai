<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Package;
use App\Models\Favorite;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    // Thêm hoặc xóa yêu thích
    public function toggle(Request $request)
    {
        $id = $request->id;
        $type = $request->type; // 'phone' hoặc 'package'
        $modelClass = $type == 'phone' ? Phone::class : Package::class;

        if (auth()->check()) {
            // Logic cho người dùng đã đăng nhập
            $exists = Favorite::where('user_id', auth()->id())
                ->where('favoritable_id', $id)
                ->where('favoritable_type', $modelClass)
                ->first();

            if ($exists) {
                $exists->delete();
                $status = 'removed';
            } else {
                Favorite::create([
                    'user_id' => auth()->id(),
                    'favoritable_id' => $id,
                    'favoritable_type' => $modelClass,
                ]);
                $status = 'added';
            }
        } else {
            // Logic cho khách (Session)
            $favorites = Session::get('favorites', []);
            $key = $type . '_' . $id;

            if (isset($favorites[$key])) {
                unset($favorites[$key]);
                $status = 'removed';
            } else {
                $favorites[$key] = [
                    'id' => $id,
                    'type' => $type,
                ];
                $status = 'added';
            }
            Session::put('favorites', $favorites);
        }

        return response()->json([
            'status' => $status,
            'count' => $this->getCount(),
        ]);
    }

    // Lấy số lượng để hiển thị lên icon trái tim
    private function getCount()
    {
        if (auth()->check()) {
            return Favorite::where('user_id', auth()->id())->count();
        }
        return count(Session::get('favorites', []));
    }

    // Trang danh sách yêu thích
    public function index()
    {
        $items = collect();

        if (auth()->check()) {
            $favorites = Favorite::where('user_id', auth()->id())
                ->with('favoritable')
                ->get();
            foreach ($favorites as $fav) {
                $items->push($fav->favoritable);
            }
        } else {
            $sessionFavs = Session::get('favorites', []);
            foreach ($sessionFavs as $fav) {
                if ($fav['type'] == 'phone') {
                    $item = Phone::find($fav['id']);
                } else {
                    $item = Package::find($fav['id']);
                }
                if ($item) {
                    $items->push($item);
                }
            }
        }

        return view('client.desktop.pages.favorite', compact('items'));
    }
}
