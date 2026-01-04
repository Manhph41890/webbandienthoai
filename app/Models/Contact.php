<?php

namespace App\Models;

use App\Enums\ContactService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property ContactService $service
 * @property string $request
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 */
class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Tối ưu hóa việc fill dữ liệu.
     * Đối với dự án lớn, đôi khi người ta dùng $guarded = [] 
     * nhưng $fillable vẫn an toàn và minh bạch hơn.
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'service',
        'request',
        'status',
    ];

    /**
     * Ép kiểu dữ liệu (Casting).
     * Laravel sẽ tự convert string dưới DB thành Enum object khi bạn gọi $contact->service
     */
    protected $casts = [
        'service' => ContactService::class,
        'email_verified_at' => 'datetime',
    ];

    // --- Scopes (Giúp viết query ngắn gọn và chuyên nghiệp) ---

    public function scopeByService(Builder $query, ContactService $service): void
    {
        $query->where('service', $service->value);
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    // --- Accessors & Mutators (Chuẩn hóa dữ liệu) ---

    /**
     * Đảm bảo email luôn lưu ở dạng chữ thường
     */
    protected function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower($value);
    }
}