<?php

namespace Database\Seeders;

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
                'material_id' => 90,
                'user_id' => 1,
                'description' => 'Coupure aléatoire lors du démarrage ou avec la présence de la trappe extérieur.',
                'incident_at' => $now,
                'impact' => 'moyen',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'material_id' => 43,
                'user_id' => 1,
                'description' => 'Beaucoup de pieds de presses dù à l\'usure des barreaux.',
                'incident_at' => $now,
                'impact' => 'mineur',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'material_id' => 45,
                'user_id' => 1,
                'description' => 'Beaucoup de pieds de presses dù à l\'usure des barreaux.',
                'incident_at' => $now,
                'impact' => 'mineur',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('incidents')->insert($incidents);
    }
}
