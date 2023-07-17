<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IncidentsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $incidents = [
            [
                'material_id' => 46,
                'user_id' => 1,
                'description' => 'Rupture de l\'écrou de serrage des profils de vis.',
                'started_at' => Carbon::createFromDate('2023', '02', '22'),
                'impact' => 'critique',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '15'),
                'created_at' => Carbon::createFromDate('2023', '02', '22'),
                'updated_at' => Carbon::createFromDate('2023', '06', '15')
            ],
            [
                'material_id' => 59,
                'user_id' => 1,
                'description' => '1 filtre inversé.',
                'started_at' => Carbon::createFromDate('2023', '06', '01'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '02'),
                'created_at' => Carbon::createFromDate('2023', '06', '01'),
                'updated_at' => Carbon::createFromDate('2023', '06', '02')
            ],
            [
                'material_id' => 73,
                'user_id' => 1,
                'description' => 'Doseur arrêté par BRABENDER (interne). Corrigé en modifiant le paramètre "Al basse 10 -> 0"',
                'started_at' => Carbon::createFromDate('2023', '06', '05'),
                'impact' => 'critique',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '06'),
                'created_at' => Carbon::createFromDate('2023', '06', '05'),
                'updated_at' => Carbon::createFromDate('2023', '06', '06')
            ],
            [
                'material_id' => 17,
                'user_id' => 1,
                'description' => 'Défaut retour marche variateur. Démonté, nettoyé et aspiré avec Franck.',
                'started_at' => Carbon::createFromDate('2023', '06', '07'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '07'),
                'created_at' => Carbon::createFromDate('2023', '06', '07'),
                'updated_at' => Carbon::createFromDate('2023', '06', '07')
            ],
            [
                'material_id' => 91,
                'user_id' => 1,
                'description' => 'Coupure aléatoire lors du démarrage ou avec la présence de la trappe extérieure.',
                'started_at' => Carbon::createFromDate('2023', '06', '07'),
                'impact' => 'moyen',
                'is_finished' => 0,
                'finished_at' => null,
                'created_at' => Carbon::createFromDate('2023', '06', '07'),
                'updated_at' => Carbon::createFromDate('2023', '06', '07')
            ],
            [
                'material_id' => 115,
                'user_id' => 1,
                'description' => 'Problème de prise de sac sur les ventouses, certaines ventouses sont défectueuses.',
                'started_at' => Carbon::createFromDate('2023', '06', '14'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '14'),
                'created_at' => Carbon::createFromDate('2023', '06', '14'),
                'updated_at' => Carbon::createFromDate('2023', '06', '14')
            ],
            [
                'material_id' => 75,
                'user_id' => 1,
                'description' => 'Pédale du pre-conditionneur HS.',
                'started_at' => Carbon::createFromDate('2023', '06', '16'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '15'),
                'created_at' => Carbon::createFromDate('2023', '06', '16'),
                'updated_at' => Carbon::createFromDate('2023', '06', '15')
            ],
            [
                'material_id' => 81,
                'user_id' => 1,
                'description' => 'Flexible de vidange du réservoir percé.',
                'started_at' => Carbon::createFromDate('2023', '06', '19'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '06', '23'),
                'created_at' => Carbon::createFromDate('2023', '06', '19'),
                'updated_at' => Carbon::createFromDate('2023', '06', '23')
            ],
            [
                'material_id' => 132,
                'user_id' => 1,
                'description' => 'Fuite d\'eau sous le karcher.',
                'started_at' => Carbon::createFromDate('2023', '07', '15'),
                'impact' => 'mineur',
                'is_finished' => 0,
                'finished_at' => null,
                'created_at' => Carbon::createFromDate('2023', '07', '15'),
                'updated_at' => Carbon::createFromDate('2023', '07', '15')
            ],
        ];

        DB::table('incidents')->insert($incidents);
    }
}
