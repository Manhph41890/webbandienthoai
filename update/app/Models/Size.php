<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'description'];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
     // Scope tìm kiếm
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%$keyword%");
    }
}
