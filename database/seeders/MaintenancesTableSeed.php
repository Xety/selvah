<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'material_id' => 129,
                'description' => 'Révision mensuel de la CTA et enlevé le défaut présent.',
                'reason' => 'Révision mensuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'external',
                'realization_operators' => null,
                'started_at' => Carbon::createFromDate('2023', '07', '03'),
                'finished_at' => Carbon::createFromDate('2023', '07', '03'),
                'created_at' => Carbon::createFromDate('2023', '07', '03'),
                'updated_at' => Carbon::createFromDate('2023', '07', '03'),
            ],
            [
                'material_id' => 46,
                'description' => 'Installation du nouveau système de serrage avec les 8 vis BTR et la bague.',
                'reason' => 'Réparation de la presse suite à la casse de l\'écrou de serrage des profiles de vis.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'internal',
                'realization_operators' => 'Franck, Emeric',
                'started_at' => Carbon::createFromDate('2023', '05', '15'),
                'finished_at' => Carbon::createFromDate('2023', '05', '15'),
                'created_at' => Carbon::createFromDate('2023', '05', '15'),
                'updated_at' => Carbon::createFromDate('2023', '05', '15')
            ]
        ];

        DB::table('maintenances')->insert($maintenances);
    }
}
