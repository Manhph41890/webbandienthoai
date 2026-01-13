<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessengerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type', // 'phone' hoặc 'package'
        'product_id',
        'variant_id',
        'product_name',
        'product_slug',
        'variant_info',
        'price',
        'ip_address',
    ];

    // Ép kiểu dữ liệu
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Biến thể (chỉ dành cho điện thoại)
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * Quan hệ động: Trả về Phone hoặc Package tùy theo cột 'type'
     * Đây là cách xử lý thông minh để bạn không bị lỗi khi gọi $order->product
     */
    public function getProductAttribute()
    {
        if ($this->type === 'phone') {
            return Phone::find($this->product_id);
        } else {
            return Package::find($this->product_id);
        }
    }

    // --- SCOPES (Giữ lại những cái thực sự cần thiết để lọc thống kê) ---

    public function scopePhones($query)
    {
        return $query->where('type', 'phone');
    }

    public function scopePackages($query)
    {
        return $query->where('type', 'package');
    }

    // Scope lọc theo khoảng thời gian (rất hữu ích cho Dashboard)
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }
}
