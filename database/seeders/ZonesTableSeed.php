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
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Trituration',
                'slug' => 'trituration',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Extrusion',
                'slug' => 'extrusion',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Recyclage des fines',
                'slug' => Str::slug('Recyclage des fines'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Ensachage',
                'slug' => 'ensachage',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station vidange BigBag',
                'slug' => Str::slug('Station vidange BigBag'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Station remplissage BigBag',
                'slug' => Str::slug('Station remplissage BigBag'),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('zones')->insert($zones);
    }
}
