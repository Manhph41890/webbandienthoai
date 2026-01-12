<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Quan hệ: Một Role có nhiều Users
     */
    const ADMIN = 'admin';
    const STAFF = 'staff';
    const USER = 'user';

    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
