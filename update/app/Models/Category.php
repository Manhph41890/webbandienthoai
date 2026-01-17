<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'is_active', 'order'];

    /**
     * Kiểu dữ liệu tự động casts
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // 1 category có nhiều phones
    public function phones()
    {
        return $this->hasMany(Phone::class, 'category_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    /**
     * Quan hệ: Category con → Category cha.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Quan hệ: Category cha → nhiều Category con.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getAllChildIds()
    {
        $ids = [$this->id];
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllChildIds());
        }
        return $ids;
    }

    /**
     * Scope: chỉ lấy category đang active.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: sắp xếp theo order ASC.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
