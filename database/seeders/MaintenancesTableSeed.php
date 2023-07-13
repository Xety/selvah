<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaintenancesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $maintenances = [
            [
                'material_id' => 81,
                'description' => '.',
                'reason' => 'Problème d\'écrou de serrage de la filière.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'realization_operators' => 'Emeric',
                'started_at' => $now,
                'finished_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('maintenances')->insert($maintenances);
    }
}
