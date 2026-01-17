<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Phone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'main_image',
        'views_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'views_count' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeMostViewed(Builder $query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    public function incrementView()
    {
        $sessionKey = 'viewed_phone_' . $this->id;
        if (!session()->has($sessionKey)) {
            $this->increment('views_count');
            session()->put($sessionKey, true);
        }
    }

    public function getViewFormattedAttribute()
    {
        $n = $this->views_count;
        if ($n < 1000) {
            return $n;
        }
        if ($n < 1000000) {
            return round($n / 1000, 1) . 'k';
        }
        return round($n / 1000000, 1) . 'M';
    }

    // --- Relationships ---
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function images()
    {
        return $this->hasMany(PhoneImage::class);
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function isFavorited()
    {
        if (auth()->check()) {
            return $this->favorites()
                ->where('user_id', auth()->id())
                ->exists();
        }
        $sessionFavs = session()->get('favorites', []);
        return isset($sessionFavs['phone_' . $this->id]);
    }
}
