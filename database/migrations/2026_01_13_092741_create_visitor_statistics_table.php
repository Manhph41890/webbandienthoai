<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Lưu theo ngày
            $table->string('device_type'); // 'mobile' hoặc 'desktop'
            $table->unsignedBigInteger('hits')->default(0); // Tổng số lượt truy cập (page views)
            $table->unsignedBigInteger('uniques')->default(0); // Số khách truy cập duy nhất (tùy chọn)
            $table->timestamps();

            // Đảm bảo mỗi ngày chỉ có 1 dòng cho mỗi loại thiết bị
            $table->unique(['date', 'device_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_statistics');
    }
};
