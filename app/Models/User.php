<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['role_id', 'facebook_id', 'google_id', 'name', 'email', 'password', 'avatar', 'address', 'phone_number', 'is_active', 'last_seen_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /**
     * Kiểu dữ liệu tự động cast
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'role_id' => 'integer',
        'password' => 'hashed', // Tự động hash pass khi lưu (Laravel 10+)
    ];

    /**
     * Quan hệ: User thuộc về một Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function isRole($roleIds)
    {
        // $roleIds có thể là 1 số (ví dụ: 1) hoặc 1 mảng (ví dụ: [1, 2])
        return in_array($this->role_id, (array) $roleIds);
    }

    /**
     * Kiểm tra xem user có phải Admin không (Helper mẫu)
     */
    // public function isAdmin()
    // {
    //     return $this->role && $this->role->name === 'admin';
    // }

    /**
     * Scope: Chỉ lấy người dùng đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
