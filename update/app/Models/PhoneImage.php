<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_id',
        'image_path',
    ];


    /**
     * Get the phone that owns the image.
     */
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }
}
