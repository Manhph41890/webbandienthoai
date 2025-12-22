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
        Schema::create('sims', function (Blueprint $table) {
            $table->id();

            $table->string('sim_number')->unique(); // 098xxxxxxx

            $table->string('serial')->nullable(); // Số serial vật lý của SIM (in trên thẻ SIM)
            // Dùng khi đối soát, quản lý kho hoặc làm việc với nhà mạng

            /*
     |--------------------------------------------------------------------------
     | Nhà mạng
     |--------------------------------------------------------------------------
     | FIG CỨNG 3 nhà mạng chính:
     | - skt : SK Telecom
     | - kt  : KT Corporation
     | - lgu : LG U+
     */
            $table->enum('carrier', ['skt', 'kt', 'lgu']);


            $table->foreignId('package_id')
                ->nullable()
                ->constrained('packages')
                ->onDelete('cascade');
            $table->enum('status', [
                'Hoạt_động',
                'ngừng_bán'
            ])->default('Hoạt_động');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sims');
    }
};
