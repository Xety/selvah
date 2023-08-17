<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('zones')->delete();

        \DB::table('zones')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Broyage',
                'material_count' => 21,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Trituration',
                'material_count' => 48,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Extrusion',
                'material_count' => 32,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Recyclage des fines',
                'material_count' => 7,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Ensachage',
                'material_count' => 15,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Station vidange BigBag',
                'material_count' => 3,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Station remplissage BigBag',
                'material_count' => 6,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Autre',
                'material_count' => 5,
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
        ));


    }
}
