<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            // Trường lưu thông tin chung (áp dụng cho tất cả)
            // Cấu trúc dự kiến: {"storage": "256GB", "screen_size": "6.7 inch", "ram": "8GB"}
            $table->json('general_specs')->nullable()->after('id')->after('stock'); 

            // Trường lưu thông tin máy cũ (chỉ dùng khi là máy qua sử dụng)
            // Cấu trúc dự kiến: {"battery_health": 95, "charging_cycles": 120, "description": "Trầy nhẹ, màn đẹp"}
            $table->json('used_details')->nullable()->after('general_specs')->after('general_specs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropColumn(['general_specs', 'used_details']);
        });
    }
};
