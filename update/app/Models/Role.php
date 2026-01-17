<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    /**
     * Quan hệ: Một Role có nhiều Users
     */
    const ADMIN = 'Quản trị viên';
    const STAFF = 'Nhân viên';
    const USER = 'Khách hàng';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
