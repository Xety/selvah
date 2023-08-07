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
                'material_id' => 92,
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
                'material_id' => 118,
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
                'material_id' => 82,
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
                'material_id' => 56,
                'user_id' => 1,
                'description' => 'Défaut pressostat sécurité pompe, dû aux sédiments déposés sur la grille.',
                'started_at' => Carbon::createFromDate('2023', '07', '01'),
                'impact' => 'moyen',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '07', '01'),
                'created_at' => Carbon::createFromDate('2023', '07', '01'),
                'updated_at' => Carbon::createFromDate('2023', '07', '01')
            ],
            [
                'material_id' => 136,
                'user_id' => 1,
                'description' => 'Défaut température élevée dans les armoires électriques.',
                'started_at' => Carbon::createFromDate('2023', '07', '03'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '07', '03'),
                'created_at' => Carbon::createFromDate('2023', '07', '03'),
                'updated_at' => Carbon::createFromDate('2023', '07', '03')
            ],
            [
                'material_id' => 117,
                'user_id' => 1,
                'description' => 'Problème de blocage du bras d\'écartement du magasin.',
                'started_at' => Carbon::createFromDate('2023', '07', '10'),
                'impact' => 'mineur',
                'is_finished' => 0,
                'finished_at' => null,
                'created_at' => Carbon::createFromDate('2023', '07', '10'),
                'updated_at' => Carbon::createFromDate('2023', '07', '10')
            ],
            [
                'material_id' => 135,
                'user_id' => 1,
                'description' => 'Fuite d\'eau sous le karcher salle blanche.',
                'started_at' => Carbon::createFromDate('2023', '07', '15'),
                'impact' => 'mineur',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '07', '18'),
                'created_at' => Carbon::createFromDate('2023', '07', '15'),
                'updated_at' => Carbon::createFromDate('2023', '07', '15')
            ],
            [
                'material_id' => 56,
                'user_id' => 1,
                'description' => 'Bourrage conduit de la pompe à huile.',
                'started_at' => Carbon::createFromDate('2023', '07', '19'),
                'impact' => 'moyen',
                'is_finished' => 0,
                'finished_at' => null,
                'created_at' => Carbon::createFromDate('2023', '07', '19'),
                'updated_at' => Carbon::createFromDate('2023', '07', '19')
            ],
            [
                'material_id' => 42,
                'user_id' => 1,
                'description' => 'Défaut retour marche de rotation P1 : Défaut variateur erreur interne 22.',
                'started_at' => Carbon::createFromDate('2023', '07', '21'),
                'impact' => 'moyen',
                'is_finished' => 1,
                'finished_at' => Carbon::createFromDate('2023', '07', '21'),
                'created_at' => Carbon::createFromDate('2023', '07', '21'),
                'updated_at' => Carbon::createFromDate('2023', '07', '21')
            ],
            [
                'material_id' => 135,
                'user_id' => 1,
                'description' => 'Tuyau percé sur karcher de la station de lavage.',
                'started_at' => Carbon::createFromDate('2023', '07', '22'),
                'impact' => 'mineur',
                'is_finished' => 0,
                'finished_at' => null,
                'created_at' => Carbon::createFromDate('2023', '07', '22'),
                'updated_at' => Carbon::createFromDate('2023', '07', '22')
            ],
            [
                'material_id' => 136,
                'user_id' => 1,
                'description' => 'Coupure électrique.',
                'started_at' => Carbon::create('2023', '07', '24', '9', '45', '0'),
                'impact' => 'critique',
                'is_finished' => 1,
                'finished_at' => Carbon::create('2023', '07', '24', '9', '55', '0'),
                'created_at' => Carbon::create('2023', '07', '24', '9', '45', '0'),
                'updated_at' => Carbon::create('2023', '07', '24', '9', '55', '0')
            ],
        ];

        DB::table('incidents')->insert($incidents);
    }
}
