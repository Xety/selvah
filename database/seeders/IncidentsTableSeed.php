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
                'material_id' => 89,
                'user_id' => 1,
                'description' => 'Coupure lors du démarrage aléatoirement ou avec trappe extérieur.',
                'incident_at' => $now,
                'impact' => 'moyen',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('incidents')->insert($incidents);
    }
}
