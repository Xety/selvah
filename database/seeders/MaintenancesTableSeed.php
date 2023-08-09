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
                'reason' => 'Problème d\'écrou de serrage des profils de vis.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'both',
                'started_at' => Carbon::createFromDate('2023', '06', '08'),
                'finished_at' => Carbon::createFromDate('2023', '06', '15'),
                'created_at' => Carbon::createFromDate('2023', '06', '08'),
                'updated_at' => Carbon::createFromDate('2023', '06', '15')
            ],
            [
                'material_id' => 118,
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
                'material_id' => 133,
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
                'material_id' => 82,
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
                'material_id' => 134,
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
            [
                'material_id' => 135,
                'description' => 'Démonté et changer les joints pour réparer la fuite d\'eau.',
                'reason' => 'Fuite d\'eau sous le karcher eau chaude.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '07', '18'),
                'finished_at' => Carbon::createFromDate('2023', '07', '18'),
                'created_at' => Carbon::createFromDate('2023', '07', '18'),
                'updated_at' => Carbon::createFromDate('2023', '07', '18')
            ],
            [
                'material_id' => 133,
                'description' => 'Révision mensuel de la CTA.',
                'reason' => 'Révision mensuel.',
                'user_id' => 3,
                'type' => 'preventive',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '07', '25'),
                'finished_at' => Carbon::createFromDate('2023', '07', '25'),
                'created_at' => Carbon::createFromDate('2023', '07', '25'),
                'updated_at' => Carbon::createFromDate('2023', '07', '25'),
            ],
            [
                'material_id' => 56,
                'description' => 'Démonté, nettoyé au Karcher et eau chaude l\'ensemble de la tuyauterie puis remonté.',
                'reason' => 'Bourrage de la tuyauterie de la PPH1.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '07', '26'),
                'finished_at' => Carbon::createFromDate('2023', '07', '31'),
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '31'),
            ],
            [
                'material_id' => 135,
                'description' => 'Emmené en réparation chez Fitech.',
                'reason' => 'Fuite d\'eau sur le tuyau du Karcher station de lavage.',
                'user_id' => 1,
                'type' => 'curative',
                'realization' => 'external',
                'started_at' => Carbon::createFromDate('2023', '07', '22'),
                'finished_at' => Carbon::createFromDate('2023', '07', '28'),
                'created_at' => Carbon::createFromDate('2023', '07', '22'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 42,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 43,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 44,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 45,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 46,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 47,
                'description' => 'Vidangé l\'huile du motoréducteur de la Presse.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '02'),
                'finished_at' => Carbon::createFromDate('2023', '08', '02'),
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 16,
                'description' => 'Vidangé l\'huile du motoréducteur du conditionneur.',
                'reason' => 'Renouvellement de l\'huile du motoréducteur annuel.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '03'),
                'finished_at' => Carbon::createFromDate('2023', '08', '03'),
                'created_at' => Carbon::createFromDate('2023', '08', '03'),
                'updated_at' => Carbon::createFromDate('2023', '08', '03')
            ],
            [
                'material_id' => 68,
                'description' => 'Ouvert et vérifié l\'intégrité des grilles.',
                'reason' => 'Vérification annuel des 2 grilles du broyeur.',
                'user_id' => 1,
                'type' => 'preventive',
                'realization' => 'internal',
                'started_at' => Carbon::createFromDate('2023', '08', '08'),
                'finished_at' => Carbon::createFromDate('2023', '08', '08'),
                'created_at' => Carbon::createFromDate('2023', '08', '08'),
                'updated_at' => Carbon::createFromDate('2023', '08', '08')
            ],
        ];

        DB::table('maintenances')->insert($maintenances);
    }
}
