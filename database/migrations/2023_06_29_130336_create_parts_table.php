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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('reference')->nullable()->unique();
            $table->string('supplier')->nullable();
            $table->integer('price')->nullable();
            $table->integer('part_entry_total')->default(0);
            $table->integer('part_exit_total')->default(0);
            $table->boolean('number_warning_enabled')->default(false);
            $table->integer('number_warning_minimum')->default(0);
            $table->boolean('number_critical_enabled')->default(false);
            $table->integer('number_critical_minimum')->default(0);
            $table->integer('part_entry_count')->default(0);
            $table->integer('part_exit_count')->default(0);
            $table->integer('qrcode_flash_count')->default(0);
            $table->integer('edit_count')->default(0);
            $table->boolean('is_edited')->default(false);
            $table->bigInteger('edited_user_id')->unsigned()->nullable()->index();
            $table->timestamps();
        });

        Schema::table('parts', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Material::class)
                ->after('description')
                ->nullable();
            $table->foreignIdFor(\Selvah\Models\User::class)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
        Schema::table('parts', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\Material::class);
            $table->dropForeignIdFor(\Selvah\Models\User::class);
        });
    }
};
