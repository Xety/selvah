<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CleaningsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cleanings = [
            // Daily
            [
                'material_id' => 80,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],
            [
                'material_id' => 83,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],
            [
                'material_id' => 84,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],
            [
                'material_id' => 85,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],
            [
                'material_id' => 87,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],
            [
                'material_id' => 137,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '10', '30')
            ],

            // Daily
            [
                'material_id' => 80,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],
            [
                'material_id' => 83,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],
            [
                'material_id' => 84,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],
            [
                'material_id' => 85,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],
            [
                'material_id' => 87,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],
            [
                'material_id' => 137,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '25', '22', '30'),
                'updated_at' => Carbon::create('2023', '07', '25', '22', '30')
            ],

            // Daily
            [
                'material_id' => 80,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'material_id' => 83,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'material_id' => 84,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'material_id' => 85,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'material_id' => 87,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'material_id' => 137,
                'user_id' => 4,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],

            // Daily
            [
                'material_id' => 80,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],
            [
                'material_id' => 83,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],
            [
                'material_id' => 84,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],
            [
                'material_id' => 85,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],
            [
                'material_id' => 87,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],
            [
                'material_id' => 137,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'daily',
                'created_at' => Carbon::create('2023', '07', '27', '10', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '10', '30')
            ],


            // Weekly
            [
                'material_id' => 101,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 76,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 75,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 74,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 80,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 83,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 84,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 85,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 102,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 106,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 87,
                'user_id' => 1,
                'description' => '',
                'ph_test_water' => 7,
                'ph_test_water_after_cleaning' => 7,
                'type' => 'weekly',
                'created_at' => Carbon::create('2023', '07', '27', '23', '30'),
                'updated_at' => Carbon::create('2023', '07', '27', '23', '30')
            ],
            [
                'material_id' => 88,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 93,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 94,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 95,
                'user_id' => 3,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 115,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
            [
                'material_id' => 137,
                'user_id' => 5,
                'description' => '',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'weekly',
                'created_at' => Carbon::createFromDate('2023', '07', '28'),
                'updated_at' => Carbon::createFromDate('2023', '07', '28')
            ],
        ];

        DB::table('cleanings')->insert($cleanings);
    }
}
