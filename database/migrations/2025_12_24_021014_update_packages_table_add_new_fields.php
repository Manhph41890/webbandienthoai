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
        Schema::table('packages', function (Blueprint $table) {
            // Thêm các cột mới sau cột Name
            $table->string('slug')->unique()->after('name');
            $table->enum('carrier', ['sk', 'kt', 'lgu'])->default('sk')->after('slug');

            // Thêm Enum tiếng Việt
            $table->enum('payment_type', ['tra_truoc', 'tra_sau'])->default('tra_truoc')->after('carrier');
            $table->enum('sim_type', ['hop_phap', 'bat_hop_phap'])->default('hop_phap')->after('payment_type');
            $table->enum('status', ['con_hang', 'het_hang'])->default('con_hang')->after('sim_type');

            $table->boolean('is_active')->default(true)->after('status');
            $table->text('description')->nullable()->after('specifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // Xóa các cột đã thêm nếu rollback
            $table->dropColumn([
                'slug',
                'carrier',
                'payment_type',
                'sim_type',
                'status',
                'is_active',
                'description'
            ]);
        });
    }
};
