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
                'material_id' => 73,
                'user_id' => 1,
                'description' => 'Aspiration du doseur pour changement de produit : Soja ->  Blé',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '07', '27'),
                'updated_at' => Carbon::createFromDate('2023', '07', '27')
            ],
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

            // Week 31
            [
                'material_id' => 56,
                'user_id' => 1,
                'description' => 'Nettoyé l\'intégralité de la tuyauterie de la pompe.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '07', '31'),
                'updated_at' => Carbon::createFromDate('2023', '07', '31')
            ],
            [
                'material_id' => 16,
                'user_id' => 3,
                'description' => 'Nettoyé l\'intérieur des étages du conditionneur.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '07', '31'),
                'updated_at' => Carbon::createFromDate('2023', '07', '31')
            ],
            [
                'material_id' => 59,
                'user_id' => 1,
                'description' => 'Nettoyé tout les filtres au Karcher.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 66,
                'user_id' => 3,
                'description' => 'Démonté et nettoyé l\'écluse ainsi que le cyclone de l\'écluse.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'material_id' => 17,
                'user_id' => 3,
                'description' => 'Démonté et nettoyé l\'extracteur ainsi que le conduit de l\'extracteur.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '08', '03'),
                'updated_at' => Carbon::createFromDate('2023', '08', '03')
            ],
            [
                'material_id' => 21,
                'user_id' => 1,
                'description' => 'Démonté les plaques de plexiglass ainsi que les extrémités du TC puis aspiré.',
                'ph_test_water' => null,
                'ph_test_water_after_cleaning' => null,
                'type' => 'casual',
                'created_at' => Carbon::createFromDate('2023', '08', '03'),
                'updated_at' => Carbon::createFromDate('2023', '08', '03')
            ],
        ];

        DB::table('cleanings')->insert($cleanings);
    }
}
