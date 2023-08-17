<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('lots')->delete();

        \DB::table('lots')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'number' => '519-020',
                'description' => '',
                'crushed_seeds' => 87140,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-01-02 22:02:34',
                'crushed_seeds_finished_at' => '2023-01-21 22:02:34',
                'crude_oil_production' => 9130,
                'soy_hull' => 9000,
                'extrusion_started_at' => '2023-01-03 22:02:34',
                'extrusion_finished_at' => '2023-01-24 22:02:34',
                'extruded_flour' => 63829,
                'bagged_tvp' => 56443.5,
                'compliant_bagged_tvp' => 56273.0,
                'created_at' => '2023-01-24 22:02:34',
                'updated_at' => '2023-01-24 22:02:34',
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 1,
                'number' => '519-021',
                'description' => '',
                'crushed_seeds' => 86440,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-01-24 22:02:34',
                'crushed_seeds_finished_at' => '2023-02-16 22:02:34',
                'crude_oil_production' => 8940,
                'soy_hull' => 9000,
                'extrusion_started_at' => '2023-01-25 22:02:34',
                'extrusion_finished_at' => '2023-02-17 22:02:34',
                'extruded_flour' => 61334,
                'bagged_tvp' => 55143.0,
                'compliant_bagged_tvp' => 55097.5,
                'created_at' => '2023-02-17 22:02:34',
                'updated_at' => '2023-02-17 22:02:34',
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => 1,
                'number' => '519-022',
                'description' => '',
                'crushed_seeds' => 86820,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-02-21 22:02:34',
                'crushed_seeds_finished_at' => '2023-03-13 22:02:34',
                'crude_oil_production' => 8732,
                'soy_hull' => 9000,
                'extrusion_started_at' => '2023-02-22 22:02:34',
                'extrusion_finished_at' => '2023-03-14 22:02:34',
                'extruded_flour' => 60423,
                'bagged_tvp' => 56010.0,
                'compliant_bagged_tvp' => 54875.0,
                'created_at' => '2023-03-14 22:02:34',
                'updated_at' => '2023-03-14 22:02:34',
            ),
            3 =>
            array (
                'id' => 4,
                'user_id' => 1,
                'number' => '519-023',
                'description' => 'Franck : Régulation du stock, point 0 dans le boisseau de coques.',
                'crushed_seeds' => 85020,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-03-14 22:02:34',
                'crushed_seeds_finished_at' => '2023-04-05 22:02:34',
                'crude_oil_production' => 8756,
                'soy_hull' => 15500,
                'extrusion_started_at' => '2023-03-16 22:02:34',
                'extrusion_finished_at' => '2023-04-06 22:02:34',
                'extruded_flour' => 60072,
                'bagged_tvp' => 54021.5,
                'compliant_bagged_tvp' => 53948.5,
                'created_at' => '2023-04-06 22:02:34',
                'updated_at' => '2023-04-06 22:02:34',
            ),
            4 =>
            array (
                'id' => 5,
                'user_id' => 1,
                'number' => '519-024',
                'description' => '',
                'crushed_seeds' => 86760,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-04-06 22:02:34',
                'crushed_seeds_finished_at' => '2023-05-02 22:02:34',
                'crude_oil_production' => 8846,
                'soy_hull' => 10760,
                'extrusion_started_at' => '2023-04-10 22:02:34',
                'extrusion_finished_at' => '2023-05-03 22:02:34',
                'extruded_flour' => 61014,
                'bagged_tvp' => 57554.0,
                'compliant_bagged_tvp' => 57473.5,
                'created_at' => '2023-05-03 22:02:34',
                'updated_at' => '2023-05-03 22:02:34',
            ),
            5 =>
            array (
                'id' => 6,
                'user_id' => 1,
                'number' => '519-025',
                'description' => '',
                'crushed_seeds' => 86280,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-05-04 22:02:34',
                'crushed_seeds_finished_at' => '2023-06-01 22:02:34',
                'crude_oil_production' => 8830,
                'soy_hull' => 10680,
                'extrusion_started_at' => '2023-05-10 22:02:34',
                'extrusion_finished_at' => '2023-06-02 22:02:34',
                'extruded_flour' => 61187,
                'bagged_tvp' => 57106.5,
                'compliant_bagged_tvp' => 57049.5,
                'created_at' => '2023-06-02 22:02:34',
                'updated_at' => '2023-06-02 22:02:34',
            ),
            6 =>
            array (
                'id' => 7,
                'user_id' => 1,
                'number' => '519-026',
                'description' => '',
                'crushed_seeds' => 86880,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-06-02 22:02:34',
                'crushed_seeds_finished_at' => '2023-06-25 22:02:34',
                'crude_oil_production' => 9270,
                'soy_hull' => 7230,
                'extrusion_started_at' => '2023-06-06 22:02:34',
                'extrusion_finished_at' => '2023-06-27 22:02:34',
                'extruded_flour' => 62917,
                'bagged_tvp' => 55860.0,
                'compliant_bagged_tvp' => 55670.0,
                'created_at' => '2023-06-27 22:02:34',
                'updated_at' => '2023-06-27 22:02:34',
            ),
            7 =>
            array (
                'id' => 8,
                'user_id' => 1,
                'number' => '519-027',
                'description' => '',
                'crushed_seeds' => 85620,
                'harvest' => 2022,
                'crushed_seeds_started_at' => '2023-06-27 22:02:34',
                'crushed_seeds_finished_at' => '2023-07-19 22:02:34',
                'crude_oil_production' => 8908,
                'soy_hull' => 7220,
                'extrusion_started_at' => '2023-06-28 22:02:34',
                'extrusion_finished_at' => '2023-07-19 22:02:34',
                'extruded_flour' => 61346,
                'bagged_tvp' => 54753.5,
                'compliant_bagged_tvp' => 54363.5,
                'created_at' => '2023-07-19 22:02:34',
                'updated_at' => '2023-07-19 22:02:34',
            ),
        ));


    }
}
