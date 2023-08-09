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
        Schema::create('part_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->default(0);
            $table->string('order_id')->nullable();
            $table->timestamps();
        });

        Schema::table('part_entries', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\User::class)
                ->after('id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(\Selvah\Models\Part::class)
                ->after('id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_entries');

        Schema::table('part_entries', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\User::class);
            $table->dropForeignIdFor(\Selvah\Models\Part::class);
        });
    }
};
