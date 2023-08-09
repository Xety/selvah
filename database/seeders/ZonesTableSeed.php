<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZonesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $zones = [
            [
                'name' => 'Broyage',
                'material_count' => 21,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Trituration',
                'material_count' => 48,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Extrusion',
                'material_count' => 32,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Recyclage des fines',
                'material_count' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Ensachage',
                'material_count' => 15,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station vidange BigBag',
                'material_count' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station remplissage BigBag',
                'material_count' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Autre',
                'material_count' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('zones')->insert($zones);
    }
}
