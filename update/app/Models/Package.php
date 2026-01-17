<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id', 'slug', 'duration_days', 'price', 'carrier', 'payment_type', 'sim_type', 'status', 'is_active', 'specifications', 'description'];

    /**
     * Tự động cast dữ liệu về kiểu dữ liệu tương ứng trong PHP
     */
    protected $casts = [
        'duration_days' => 'integer',
        'price' => 'integer',
        'specifications' => 'array', // Cast JSON sang Array
        'is_active' => 'boolean', // Cast tinyint sang Boolean
    ];

    /**
     * Các hằng số (Constants) cho các giá trị Enum
     * Giúp tránh viết sai chính tả khi gọi trong Code
     */
    const CARRIER_SK = 'sk';
    const CARRIER_KT = 'kt';
    const CARRIER_LGU = 'lgu';

    const PAYMENT_PREPAID = 'tra_truoc';
    const PAYMENT_POSTPAID = 'tra_sau';

    const SIM_LEGAL = 'hop_phap';
    const SIM_ILLEGAL = 'bat_hop_phap';

    const STATUS_IN_STOCK = 'con_hang';
    const STATUS_OUT_OF_STOCK = 'het_hang';

    /**
     * Boot function để tự động tạo slug khi tạo mới package nếu chưa có slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Quan hệ: Một gói cước có thể được áp dụng cho nhiều SIM
     */
    public function sims()
    {
        return $this->hasMany(Sim::class, 'package_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function isFavorited()
    {
        if (auth()->check()) {
            return $this->favorites()
                ->where('user_id', auth()->id())
                ->exists();
        }

        $sessionFavs = session()->get('favorites', []);
        return isset($sessionFavs['package_' . $this->id]);
    }
    /**
     * Scope: Chỉ lấy các gói đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Lọc theo nhà mạng
     */
    public function scopeByCarrier($query, $carrier)
    {
        return $query->where('carrier', $carrier);
    }

    /**
     * Scope: Lọc gói cước theo giá (Ví dụ: dưới 100k)
     */
    public function scopeCheaperThan($query, $amount)
    {
        return $query->where('price', '<=', $amount);
    }

    /**
     * Scope: Sắp xếp theo giá tăng dần
     */
    public function scopeOrderByPrice($query, $direction = 'asc')
    {
        return $query->orderBy('price', $direction);
    }

    /**
     * Helper: Lấy tên hiển thị tiếng Việt cho trạng thái
     */
    public function getStatusLabelAttribute()
    {
        return [
            self::STATUS_IN_STOCK => 'Còn hàng',
            self::STATUS_OUT_OF_STOCK => 'Hết hàng',
        ][$this->status] ?? $this->status;
    }
}
