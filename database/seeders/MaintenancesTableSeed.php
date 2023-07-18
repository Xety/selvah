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
                'material_id' => 46,
                'description' => 'Démonté la presse (Franck et Alexis), changé les barreaux (OLEXA), puis remonté la presse (Franck, Emeric).',
                'reason' => 'Problème d\'écrou de serrage de la filière.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'both',
                'started_at' => Carbon::createFromDate('2023', '06', '08'),
                'finished_at' => Carbon::createFromDate('2023', '06', '15'),
                'created_at' => Carbon::createFromDate('2023', '06', '08'),
                'updated_at' => Carbon::createFromDate('2023', '06', '15')
            ],
            [
                'material_id' => 115,
                'description' => 'Changé 5 ventouses.',
                'reason' => 'Problème de prise de sac dans le magasin.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '06', '14'),
                'finished_at' => Carbon::createFromDate('2023', '06', '14'),
                'created_at' => Carbon::createFromDate('2023', '06', '14'),
                'updated_at' => Carbon::createFromDate('2023', '06', '14')
            ],
            [
                'material_id' => 75,
                'description' => 'Réparation de la pédale du pre-conditionneur.',
                'reason' => 'Pédale pre-con HS.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '06', '16'),
                'finished_at' => Carbon::createFromDate('2023', '06', '16'),
                'created_at' => Carbon::createFromDate('2023', '06', '16'),
                'updated_at' => Carbon::createFromDate('2023', '06', '16')
            ],
            [
                'material_id' => 130,
                'description' => 'Révision mensuel de la CTA et enlevé le défaut présent.',
                'reason' => 'Révision mensuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '06', '23'),
                'finished_at' => Carbon::createFromDate('2023', '06', '23'),
                'created_at' => Carbon::createFromDate('2023', '06', '23'),
                'updated_at' => Carbon::createFromDate('2023', '06', '23'),
            ],
            [
                'material_id' => 81,
                'description' => 'Démonté et changé le flexible.',
                'reason' => 'Flexible de vidange du réservoir percé.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '06', '23'),
                'finished_at' => Carbon::createFromDate('2023', '06', '23'),
                'created_at' => Carbon::createFromDate('2023', '06', '23'),
                'updated_at' => Carbon::createFromDate('2023', '06', '23')
            ],
            [
                'material_id' => 131,
                'description' => 'Démonté et changer les joints des robinets des chaudières 1 et 3.',
                'reason' => 'Fuite sur les contrôles de niveau d\'eau des chaudières 1 et 3.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '07', '06'),
                'finished_at' => Carbon::createFromDate('2023', '07', '06'),
                'created_at' => Carbon::createFromDate('2023', '07', '06'),
                'updated_at' => Carbon::createFromDate('2023', '07', '06')
            ],
        ];

        DB::table('maintenances')->insert($maintenances);
    }
}
