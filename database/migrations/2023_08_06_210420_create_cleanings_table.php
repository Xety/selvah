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
        Schema::create('cleanings', function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->nullable();
            $table->float('ph_test_water', 2, 1)->nullable()->default(null);
            $table->float('ph_test_water_after_cleaning', 2, 1)->nullable()->default(null);
            $table->enum('type', ['daily', 'weekly', 'bimonthly', 'monthly', 'quarterly', 'biannual', 'annual'])
                ->default('daily');
            $table->integer('edit_count')->default(0);
            $table->boolean('is_edited')->default(false);
            $table->timestamps();
        });

        Schema::table('cleanings', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Material::class)->after('id')->nullable();
            $table->foreignIdFor(\Selvah\Models\User::class)->after('id');
            $table->foreignIdFor(\Selvah\Models\User::class, 'edited_user_id')->after('is_edited')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleanings');

        Schema::table('cleanings', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\Material::class);
            $table->dropForeignIdFor(\Selvah\Models\User::class);
            $table->dropForeignIdFor(\Selvah\Models\User::class, 'edited_user_id');
        });
    }
};
