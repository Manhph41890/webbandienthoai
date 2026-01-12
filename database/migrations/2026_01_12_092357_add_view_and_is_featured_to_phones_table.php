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
            // Thêm cột view sau cột main_image (hoặc cột nào bạn muốn)
            // $table->unsignedInteger('views_count')->default(0)->after('main_image');

            // Thêm cột is_featured sau cột view
            // $table->boolean('is_featured')->default(false)->after('views_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            // $table->dropColumn(['view', 'is_featured']);
        });
    }
};
