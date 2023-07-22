<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LotsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lots = [
            [
                'user_id' => 1,
                'number' => '519-020',
                'description' => '',
                'crushed_seeds' => 87140,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '01', '02'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '01', '21'),
                'crude_oil_production' => 9130,
                'soy_hull' => 9000,
                'extrusion_started_at' => Carbon::createFromDate('2023', '01', '03'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '01', '24'),
                'extruded_flour' => 63829,
                'bagged_tvp' => 56443.5,
                'compliant_bagged_tvp' => 56273,
                'created_at' => Carbon::createFromDate('2023', '01', '24'),
                'updated_at' => Carbon::createFromDate('2023', '01', '24')
            ],
            [
                'user_id' => 1,
                'number' => '519-021',
                'description' => '',
                'crushed_seeds' => 86440,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '01', '24'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '02', '16'),
                'crude_oil_production' => 8940,
                'soy_hull' => 9000,
                'extrusion_started_at' => Carbon::createFromDate('2023', '01', '25'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '02', '17'),
                'extruded_flour' => 61334,
                'bagged_tvp' => 55143,
                'compliant_bagged_tvp' => 55097.5,
                'created_at' => Carbon::createFromDate('2023', '02', '17'),
                'updated_at' => Carbon::createFromDate('2023', '02', '17')
            ],
            [
                'user_id' => 1,
                'number' => '519-022',
                'description' => '',
                'crushed_seeds' => 86820,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '02', '21'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '03', '13'),
                'crude_oil_production' => 8732,
                'soy_hull' => 9000,
                'extrusion_started_at' => Carbon::createFromDate('2023', '02', '22'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '03', '14'),
                'extruded_flour' => 60423,
                'bagged_tvp' => 56010,
                'compliant_bagged_tvp' => 54875,
                'created_at' => Carbon::createFromDate('2023', '03', '14'),
                'updated_at' => Carbon::createFromDate('2023', '03', '14')
            ],
            [
                'user_id' => 1,
                'number' => '519-023',
                'description' => 'Franck : Régulation du stock, point 0 dans le boisseau de coques.',
                'crushed_seeds' => 85020,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '03', '14'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '04', '05'),
                'crude_oil_production' => 8756,
                'soy_hull' => 15500,
                'extrusion_started_at' => Carbon::createFromDate('2023', '03', '16'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '04', '06'),
                'extruded_flour' => 60072,
                'bagged_tvp' => 54021.5,
                'compliant_bagged_tvp' => 53948.5,
                'created_at' => Carbon::createFromDate('2023', '04', '06'),
                'updated_at' => Carbon::createFromDate('2023', '04', '06')
            ],
            [
                'user_id' => 1,
                'number' => '519-024',
                'description' => '',
                'crushed_seeds' => 86760,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '04', '06'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '05', '02'),
                'crude_oil_production' => 8846,
                'soy_hull' => 10760,
                'extrusion_started_at' => Carbon::createFromDate('2023', '04', '10'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '05', '03'),
                'extruded_flour' => 61014,
                'bagged_tvp' => 57554,
                'compliant_bagged_tvp' => 57473.5,
                'created_at' => Carbon::createFromDate('2023', '05', '03'),
                'updated_at' => Carbon::createFromDate('2023', '05', '03')
            ],
            [
                'user_id' => 1,
                'number' => '519-025',
                'description' => '',
                'crushed_seeds' => 86280,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '05', '04'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '06', '01'),
                'crude_oil_production' => 8830,
                'soy_hull' => 10680,
                'extrusion_started_at' => Carbon::createFromDate('2023', '05', '10'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '06', '02'),
                'extruded_flour' => 61187,
                'bagged_tvp' => 57106.5,
                'compliant_bagged_tvp' => 57049.5,
                'created_at' => Carbon::createFromDate('2023', '06', '02'),
                'updated_at' => Carbon::createFromDate('2023', '06', '02')
            ],
            [
                'user_id' => 1,
                'number' => '519-026',
                'description' => '',
                'crushed_seeds' => 86880,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '06', '02'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '06', '25'),
                'crude_oil_production' => 9270,
                'soy_hull' => 7230,
                'extrusion_started_at' => Carbon::createFromDate('2023', '06', '06'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '06', '27'),
                'extruded_flour' => 62917,
                'bagged_tvp' => 55860,
                'compliant_bagged_tvp' => 55670,
                'created_at' => Carbon::createFromDate('2023', '06', '27'),
                'updated_at' => Carbon::createFromDate('2023', '06', '27')
            ],
            [
                'user_id' => 1,
                'number' => '519-027',
                'description' => '',
                'crushed_seeds' => 85620,
                'harvest' => 2022,
                'crushed_seeds_started_at' => Carbon::createFromDate('2023', '06', '27'),
                'crushed_seeds_finished_at' => Carbon::createFromDate('2023', '07', '19'),
                'crude_oil_production' => 8908,
                'soy_hull' => 7220,
                'extrusion_started_at' => Carbon::createFromDate('2023', '06', '28'),
                'extrusion_finished_at' => Carbon::createFromDate('2023', '07', '19'),
                'extruded_flour' => 61346,
                'bagged_tvp' => 54753.5,
                'compliant_bagged_tvp' => 54363.5,
                'created_at' => Carbon::createFromDate('2023', '07', '19'),
                'updated_at' => Carbon::createFromDate('2023', '07', '19')
            ]
        ];

        DB::table('lots')->insert($lots);
    }
}
