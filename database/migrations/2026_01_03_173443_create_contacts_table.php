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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('phone', 20); // Đổi 'number' thành 'phone' cho rõ nghĩa

            // Lấy tất cả giá trị từ Enum
            $table->enum('service', array_column(ContactService::cases(), 'value'))->default(ContactService::PHONE_CONSULT->value);

            $table->text('request');
            $table->timestamps();

            // Thêm index nếu cần tìm kiếm nhanh theo email/phone
            $table->index(['email', 'phone']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
