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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->text('description')->nullable()->comment('Si besoin d\'ajouter des précisions sur le lot');
            $table->integer('crushed_seeds')->comment('Graines Broyées');
            $table->integer('harvest')->comment('Année de la récolte');
            $table->timestamp('crushed_seeds_started_at')->comment('Trituration commencé le');
            $table->timestamp('crushed_seeds_finished_at')->comment('Trituration fini le');
            $table->integer('crude_oil_production')->comment('Production huile brute');
            $table->integer('soy_hull')->comment('Production coques');
            $table->timestamp('extrusion_started_at')->comment('Extrusion commencé le');
            $table->timestamp('extrusion_finished_at')->comment('Extrusion fini le');
            $table->integer('extruded_flour')->comment('Tonnage farine extrudée');
            $table->float('bagged_tvp', 8, 1)->comment('Tonnage ensaché');
            $table->float('compliant_bagged_tvp', 8, 1)->comment('Tonnage ensaché conforme');

            $table->timestamps();
        });

        Schema::table('lots', function (Blueprint $table) {
            $table->foreignIdFor(\Selvah\Models\User::class)->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
        Schema::table('lots', function (Blueprint $table) {
            $table->dropForeignIdFor(\Selvah\Models\User::class);
        });
    }
};
