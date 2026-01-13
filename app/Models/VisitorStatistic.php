<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorStatistic extends Model
{
    use HasFactory;

    protected $table = 'visitor_statistics';

    protected $fillable = [
        'date',
        'device_type',
        'hits',
        'uniques',
    ];


    public function scopeDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeDeviceType($query, $deviceType)
    {
        return $query->where('device_type', $deviceType);
    }

    public function scopeHits($query, $hits)
    {
        return $query->where('hits', $hits);
    }

    public function scopeUniques($query, $uniques)
    {
        return $query->where('uniques', $uniques);
    }


}
