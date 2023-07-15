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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('gmao_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->text('reason')->nullable();
            $table->enum('type', ['curative', 'preventive'])->default('curative');
            $table->enum('realization', ['internal', 'external'])
                ->default('external')
                ->comment('Réalisé par SELVAH ou entreprise externe');
            $table->string('realization_operators')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('finished_at');
            $table->integer('edit_count')->default(0);
            $table->boolean('is_edited')->default(false);
            $table->bigInteger('edited_user_id')->unsigned()->nullable()->index();
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();
        });

        Schema::table('maintenances', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Material::class)->after('gmao_id')->nullable()->constrained();
            $table->foreignIdFor(\Selvah\Models\User::class)->after('reason')->constrained();
            //$table->foreign('edited_user_id')->references('id')->on('users');
        });

        // Pivot Table
        Schema::create('maintenance_part_exit', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Maintenance::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\Selvah\Models\PartExit::class)->constrained()->cascadeOnDelete();
            $table->primary(['maintenance_id', 'part_exit_id']);
            $table->timestamps();
        });

        Schema::create('company_maintenance', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Company::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\Selvah\Models\Maintenance::class)->constrained()->cascadeOnDelete();
            $table->primary(['maintenance_id', 'company_id']);
            $table->timestamps();
        });

        //
        Schema::table('part_exits', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\Maintenance::class)->after('id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('part_exits', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\Maintenance::class);
        });
        Schema::dropIfExists('maintenance_part_exit');
        Schema::dropIfExists('company_maintenance');
        Schema::dropIfExists('maintenances');
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\Material::class);
            $table->dropForeignIdFor(\Selvah\Models\User::class);
            //$table->dropForeign('edited_user_id');
        });
    }
};
