<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'hex_code'];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    /**
     * Scope để tìm kiếm nhanh
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%$keyword%")->orWhere('hex_code', 'like', "%$keyword%");
    }
}
