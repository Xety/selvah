<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CleaningsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('cleanings')->delete();

        \DB::table('cleanings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 3,
                'material_id' => 80,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 3,
                'material_id' => 83,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => 3,
                'material_id' => 84,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            3 =>
            array (
                'id' => 4,
                'user_id' => 3,
                'material_id' => 85,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            4 =>
            array (
                'id' => 5,
                'user_id' => 3,
                'material_id' => 87,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            5 =>
            array (
                'id' => 6,
                'user_id' => 3,
                'material_id' => 137,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 10:30:00',
                'updated_at' => '2023-07-25 10:30:00',
            ),
            6 =>
            array (
                'id' => 7,
                'user_id' => 4,
                'material_id' => 80,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            7 =>
            array (
                'id' => 8,
                'user_id' => 4,
                'material_id' => 83,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            8 =>
            array (
                'id' => 9,
                'user_id' => 4,
                'material_id' => 84,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            9 =>
            array (
                'id' => 10,
                'user_id' => 4,
                'material_id' => 85,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            10 =>
            array (
                'id' => 11,
                'user_id' => 4,
                'material_id' => 87,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            11 =>
            array (
                'id' => 12,
                'user_id' => 4,
                'material_id' => 137,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-25 22:30:00',
                'updated_at' => '2023-07-25 22:30:00',
            ),
            12 =>
            array (
                'id' => 13,
                'user_id' => 4,
                'material_id' => 80,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            13 =>
            array (
                'id' => 14,
                'user_id' => 4,
                'material_id' => 83,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            14 =>
            array (
                'id' => 15,
                'user_id' => 4,
                'material_id' => 84,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            15 =>
            array (
                'id' => 16,
                'user_id' => 4,
                'material_id' => 85,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            16 =>
            array (
                'id' => 17,
                'user_id' => 4,
                'material_id' => 87,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            17 =>
            array (
                'id' => 18,
                'user_id' => 4,
                'material_id' => 137,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            18 =>
            array (
                'id' => 19,
                'user_id' => 3,
                'material_id' => 80,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            19 =>
            array (
                'id' => 20,
                'user_id' => 3,
                'material_id' => 83,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            20 =>
            array (
                'id' => 21,
                'user_id' => 3,
                'material_id' => 84,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            21 =>
            array (
                'id' => 22,
                'user_id' => 3,
                'material_id' => 85,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            22 =>
            array (
                'id' => 23,
                'user_id' => 3,
                'material_id' => 87,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            23 =>
            array (
                'id' => 24,
                'user_id' => 3,
                'material_id' => 137,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 10:30:00',
                'updated_at' => '2023-07-27 10:30:00',
            ),
            24 =>
            array (
                'id' => 25,
                'user_id' => 1,
                'material_id' => 73,
                'description' => 'Aspiration du doseur pour changement de produit : Soja ->  Blé',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 22:02:34',
                'updated_at' => '2023-07-27 22:02:34',
            ),
            25 =>
            array (
                'id' => 26,
                'user_id' => 5,
                'material_id' => 101,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            26 =>
            array (
                'id' => 27,
                'user_id' => 1,
                'material_id' => 76,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            27 =>
            array (
                'id' => 28,
                'user_id' => 1,
                'material_id' => 75,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            28 =>
            array (
                'id' => 29,
                'user_id' => 1,
                'material_id' => 74,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            29 =>
            array (
                'id' => 30,
                'user_id' => 1,
                'material_id' => 80,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            30 =>
            array (
                'id' => 31,
                'user_id' => 1,
                'material_id' => 83,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            31 =>
            array (
                'id' => 32,
                'user_id' => 1,
                'material_id' => 84,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            32 =>
            array (
                'id' => 33,
                'user_id' => 1,
                'material_id' => 85,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            33 =>
            array (
                'id' => 34,
                'user_id' => 5,
                'material_id' => 102,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            34 =>
            array (
                'id' => 35,
                'user_id' => 1,
                'material_id' => 106,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            35 =>
            array (
                'id' => 36,
                'user_id' => 1,
                'material_id' => 87,
                'description' => '',
                'ph_test_water' => 7.0,
                'ph_test_water_after_cleaning' => 7.0,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-27 23:30:00',
                'updated_at' => '2023-07-27 23:30:00',
            ),
            36 =>
            array (
                'id' => 37,
                'user_id' => 5,
                'material_id' => 88,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            37 =>
            array (
                'id' => 38,
                'user_id' => 5,
                'material_id' => 93,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            38 =>
            array (
                'id' => 39,
                'user_id' => 5,
                'material_id' => 94,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            39 =>
            array (
                'id' => 40,
                'user_id' => 3,
                'material_id' => 95,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            40 =>
            array (
                'id' => 41,
                'user_id' => 5,
                'material_id' => 115,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            41 =>
            array (
                'id' => 42,
                'user_id' => 5,
                'material_id' => 137,
                'description' => '',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'weekly',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-28 22:02:34',
                'updated_at' => '2023-07-28 22:02:34',
            ),
            42 =>
            array (
                'id' => 43,
                'user_id' => 1,
                'material_id' => 56,
                'description' => 'Nettoyé l\'intégralité de la tuyauterie de la pompe.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-31 22:02:34',
                'updated_at' => '2023-07-31 22:02:34',
            ),
            43 =>
            array (
                'id' => 44,
                'user_id' => 3,
                'material_id' => 16,
                'description' => 'Nettoyé l\'intérieur des étages du conditionneur.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-07-31 22:02:34',
                'updated_at' => '2023-07-31 22:02:34',
            ),
            44 =>
            array (
                'id' => 45,
                'user_id' => 1,
                'material_id' => 59,
                'description' => 'Nettoyé tout les filtres au Karcher.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            45 =>
            array (
                'id' => 46,
                'user_id' => 3,
                'material_id' => 66,
                'description' => 'Démonté et nettoyé l\'écluse ainsi que le cyclone de l\'écluse.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            46 =>
            array (
                'id' => 47,
                'user_id' => 3,
                'material_id' => 17,
                'description' => 'Démonté et nettoyé l\'extracteur ainsi que le conduit de l\'extracteur.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-08-03 22:02:34',
                'updated_at' => '2023-08-03 22:02:34',
            ),
            47 =>
            array (
                'id' => 48,
                'user_id' => 1,
                'material_id' => 21,
                'description' => 'Démonté les plaques de plexiglass ainsi que les extrémités du TC puis aspiré.',
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'casual',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-08-03 22:02:34',
                'updated_at' => '2023-08-03 22:02:34',
            ),
            48 =>
            array (
                'id' => 49,
                'user_id' => 1,
                'material_id' => 86,
                'description' => NULL,
                'ph_test_water' => NULL,
                'ph_test_water_after_cleaning' => NULL,
                'type' => 'daily',
                'edit_count' => 0,
                'is_edited' => 0,
                'edited_user_id' => NULL,
                'created_at' => '2023-08-10 13:37:43',
                'updated_at' => '2023-08-10 13:37:43',
            ),
        ));


    }
}
