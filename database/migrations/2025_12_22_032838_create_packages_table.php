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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            // Thông tin cơ bản
            // Tên gói cước (VD90, VD120...)
            $table->string('name')->unique();
            // Thời hạn sử dụng gói (đơn vị: ngày)
            // Ví dụ: 30
            $table->integer('duration_days');


            // Phí gói (đơn vị: VND)
            // Ví dụ: 90000
            $table->integer('price');


            /*
     |--------------------------------------------------------------------------
     | Thông số kỹ thuật của gói (JSON)
     |--------------------------------------------------------------------------
     | Dùng để lưu các thông tin linh hoạt, chủ yếu phục vụ hiển thị
     |
     | Cấu trúc đề xuất:
     | {
     |   "data": {
     |     "per_month": "30GB",
     |     "per_day": "1GB/ngày",
     |     "note": "Hết 1GB dừng truy cập"
     |   },
     |   "call": "Miễn phí nội mạng <10 phút/cuộc (tối đa 1.500 phút/tháng),
     |            ngoại mạng 30 phút/tháng"
     | }
     */
            $table->json('specifications')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
