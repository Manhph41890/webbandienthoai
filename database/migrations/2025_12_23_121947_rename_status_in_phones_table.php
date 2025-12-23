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
        Schema::table('phones', function (Blueprint $table) {
            // Xóa cột status cũ và thêm cột is_active
            $table->dropColumn('status');
            $table->boolean('is_active')->default(true)->after('short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->enum('status', ['còn_hàng', 'hết_hàng', 'sắp_về', 'ngừng_bán'])->default('còn_hàng');
            $table->dropColumn('is_active');
        });
    }
};
