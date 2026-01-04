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
            $table->string('name', 100);
            $table->string('email', 150)->index();
            $table->string('phone_number', 20); // Đổi tên từ 'number' thành 'phone_number' cho rõ nghĩa
            
            // Lưu enum dưới dạng string để dễ mở rộng sau này, 
            // hạn chế dùng $table->enum của MySQL vì khó thay đổi cấu trúc sau này
            $table->string('service')->index(); 
            
            $table->text('request');
            
            // Quản lý trạng thái xử lý (thường các cty lớn sẽ cần cái này)
            $table->string('status')->default('pending')->index(); 
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
