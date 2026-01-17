<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sim extends Model
{
    use HasFactory, SoftDeletes;

      protected $fillable = [
        'sim_number',
        'serial',
        'carrier',//Nhà mạng: sk, kt, lgu
        'package_id',
        'status',
    ];

    protected $casts = [
        'package_id' => 'integer',
    ];

    /**
     * Quan hệ: Một SIM thuộc về một gói cước (Package)
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    
    /**
     * Scope: Lọc SIM theo nhà mạng (sk, kt, lgu)
     */
    public function scopeByCarrier($query, $carrier)
    {
        return $query->where('carrier', $carrier);
    }

    /**
     * Scope: Chỉ lấy SIM đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Hoạt_động');
    }
}
