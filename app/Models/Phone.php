<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'slug', 'short_description', 'is_active', 'main_image'];

    protected $casts = [
        'category_id' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Quan hệ: Phone thuộc về một Category
     */
    public function category()
    {
        // return $this->belongsTo(Category::class, 'category_id');
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Quan hệ: Một phone có nhiều biến thể (variants)
     */
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    /**
     * Quan hệ: Một phone có nhiều người yêu thích
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function images()
    {
        return $this->hasMany(PhoneImage::class);
    }

    // Nếu bạn muốn lấy giá/trạng thái mặc định từ một biến thể nào đó
    public function defaultVariant()
    {
        return $this->hasOne(Variant::class)->where('is_default', true);
    }

    // Hoặc nếu bạn muốn lấy giá thấp nhất từ các biến thể
    public function lowestPriceVariant()
    {
        return $this->hasOne(Variant::class)->orderBy('price', 'asc');
    }

    /**
     * Lấy danh sách màu sắc duy nhất của phone này thông qua bảng variants
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'variants', 'phone_id', 'color_id')->distinct();
    }

    /**
     * Lấy danh sách kích thước duy nhất của phone này thông qua bảng variants
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'variants', 'phone_id', 'size_id')->distinct();
    }

    /**
     * Scope: Lọc theo trạng thái
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Chỉ lấy các sản phẩm còn hàng
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'còn_hàng');
    }
}
