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
        'quantity',
        'battery_health',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'battery_health' => 'integer',
        'phone_id' => 'integer',
        'color_id' => 'integer',
        'size_id' => 'integer',
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
        return $query->where('quantity', '>', 0)->where('status', 'còn_hàng');
    }
}
