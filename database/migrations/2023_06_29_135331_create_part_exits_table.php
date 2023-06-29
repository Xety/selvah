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
        Schema::create('part_exits', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('number')->default(0);
            $table->timestamps();
        });

        Schema::table('part_exits', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\User::class)->after('id')->constrained();
            $table->foreignIdFor(\Selvah\Models\Part::class)->after('id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_exits');
        Schema::table('part_exits', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\User::class);
            $table->dropForeignIdFor(\Selvah\Models\Part::class);
        });
    }
};
