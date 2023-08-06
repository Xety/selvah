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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('incident_count')->default(0);
            $table->integer('part_count')->default(0);
            $table->integer('maintenance_count')->default(0);
            $table->integer('qrcode_flash_count')->default(0);
            $table->integer('cleaning_count')->default(0);
            $table->boolean('cleaning_alert')->default(false);
            $table->boolean('cleaning_alert_email')->default(false);
            $table->tinyInteger('cleaning_alert_frequency_repeatedly')->default(0);
            $table->enum('cleaning_alert_frequency_type', ['daily', 'weekly', 'monthly', 'annually'])
                ->default('weekly');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\User::class)->after('id');
            $table->foreignIdFor(\Selvah\Models\Zone::class)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\Zone::class);
        });
    }
};
