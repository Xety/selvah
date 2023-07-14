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
            ],
            [
                'material_id' => null,
                'description' => 'Installation des nouvelles Presses P8, P9, P10, VD8, VD9, VD10, T8TCM1, T9TCM1, T10TCM1.',
                'reason' => '',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'external',
                'realization_operators' => 'Nicolas Grand, Mario, Christian',
                'started_at' => $now,
                'finished_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('maintenances')->insert($maintenances);
    }
}
