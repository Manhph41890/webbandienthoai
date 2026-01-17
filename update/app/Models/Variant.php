<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone_id',
        'color_id',
        'size_id',
        'price',
        'sku',
        'stock',
        'image_path',
        'status',      // Trạng thái kho hàng (còn hàng/hết hàng)
        'condition',   // Trạng thái máy (mới/cũ) - THÊM MỚI
        'general_specs', // Lưu: storage, screen_size, ram
        'used_details',  // Lưu: battery_health, charging_cycles, description
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'image_path' => 'string',
        'phone_id' => 'integer',
        'color_id' => 'integer',
        'size_id' => 'integer',
        'general_specs' => 'array', // Tự động convert JSON sang Array và ngược lại
        'used_details' => 'array',  // Tự động convert JSON sang Array và ngược lại
    ];

    /**
     * Quan hệ: Biến thể thuộc về 1 điện thoại
     */
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    /**
     * Quan hệ: Biến thể thuộc về 1 màu sắc
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Quan hệ: Biến thể thuộc về 1 kích thước/dung lượng
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    // Scope để lấy máy mới
    public function scopeNew($query)
    {
        return $query->where('condition', 'new');
    }

    // Scope để lấy máy cũ
    public function scopeUsed($query)
    {
        return $query->where('condition', 'used');
    }

    /**
     * Scope: Lọc theo khoảng giá
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Scope: Kiểm tra còn hàng trong kho
     */
    public function scopeInStock($query)
    {
        // Lưu ý: Nếu cột status lưu tiếng Việt, hãy đảm bảo đúng giá trị 'còn_hàng'
        return $query->where('stock', '>', 0)->where('status', 'còn_hàng');
    }

    /**
     * Gợi ý: Bạn có thể thêm các Accessor để lấy dữ liệu nhanh hơn (Không bắt buộc)
     */
    public function getScreenSizeAttribute()
    {
        return $this->general_specs['screen_size'] ?? 'N/A';
    }

    public function getBatteryHealthAttribute()
    {
        return $this->used_details['battery_health'] ?? null;
    }
}
