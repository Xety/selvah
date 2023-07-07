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
                'slug' => 'broyage',
                'material_count' => 21,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Trituration',
                'slug' => 'trituration',
                'material_count' => 48,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Extrusion',
                'slug' => 'extrusion',
                'material_count' => 30,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Recyclage des fines',
                'slug' => Str::slug('Recyclage des fines'),
                'material_count' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Ensachage',
                'slug' => 'ensachage',
                'material_count' => 14,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station vidange BigBag',
                'slug' => Str::slug('Station vidange BigBag'),
                'material_count' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station remplissage BigBag',
                'slug' => Str::slug('Station remplissage BigBag'),
                'material_count' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('zones')->insert($zones);
    }
}
