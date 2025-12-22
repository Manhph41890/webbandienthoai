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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phone_id')
                ->constrained('phones')
                ->onDelete('cascade');

            $table->foreignId('color_id')
                ->constrained('colors')
                ->onDelete('restrict');

            $table->foreignId('size_id')
                ->constrained('sizes')
                ->onDelete('restrict');

            $table->decimal('price', 12, 2);

            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedTinyInteger('battery_health')->nullable();

            $table->enum('status', [
                'còn_hàng',
                'hết_hàng',
                'sắp_về',
                'ngừng_bán'
            ])->default('còn_hàng');

            $table->softDeletes();
            $table->timestamps();

            // ❗ tránh trùng variant
            $table->unique(['phone_id', 'color_id', 'size_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
