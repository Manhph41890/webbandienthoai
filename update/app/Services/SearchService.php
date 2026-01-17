<?php

namespace App\Services;

use App\Models\Phone;
use App\Models\Package;

class SearchService
{
    public function search($keyword)
    {
        if (empty($keyword)) {
            return [
                'phones' => collect(),
                'packages' => collect()
            ];
        }

        // 1. Tìm kiếm Điện thoại
        $phones = Phone::query()
            ->where('is_active', true)
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('short_description', 'LIKE', "%{$keyword}%")
                  ->orWhere('slug', 'LIKE', "%{$keyword}%");
            })
            ->with(['variants' => function($q) {
                $q->orderBy('price', 'asc'); // Lấy variant để hiển thị giá thấp nhất
            }])
            ->limit(20)
            ->get();

        // 2. Tìm kiếm Gói cước (Sim/Package)
        $packages = Package::query()
            ->where('is_active', true)
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%")
                  ->orWhere('carrier', 'LIKE', "%{$keyword}%")
                  ->orWhere('slug', 'LIKE', "%{$keyword}%");
            })
            ->limit(20)
            ->get();

        return [
            'phones'   => $phones,
            'packages' => $packages,
            'keyword'  => $keyword
        ];
    }
}