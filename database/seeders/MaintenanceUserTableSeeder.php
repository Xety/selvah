<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaintenanceUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('maintenance_user')->delete();

        \DB::table('maintenance_user')->insert(array (
            0 =>
            array (
                'maintenance_id' => 1,
                'user_id' => 1,
                'created_at' => '2023-06-08 22:02:34',
                'updated_at' => '2023-06-08 22:02:34',
            ),
            1 =>
            array (
                'maintenance_id' => 1,
                'user_id' => 2,
                'created_at' => '2023-06-08 22:02:34',
                'updated_at' => '2023-06-08 22:02:34',
            ),
            2 =>
            array (
                'maintenance_id' => 1,
                'user_id' => 5,
                'created_at' => '2023-06-08 22:02:34',
                'updated_at' => '2023-06-08 22:02:34',
            ),
            3 =>
            array (
                'maintenance_id' => 2,
                'user_id' => 1,
                'created_at' => '2023-06-14 22:02:34',
                'updated_at' => '2023-06-14 22:02:34',
            ),
            4 =>
            array (
                'maintenance_id' => 5,
                'user_id' => 2,
                'created_at' => '2023-06-23 22:02:34',
                'updated_at' => '2023-06-23 22:02:34',
            ),
            5 =>
            array (
                'maintenance_id' => 9,
                'user_id' => 1,
                'created_at' => '2023-07-26 22:02:34',
                'updated_at' => '2023-07-26 22:02:34',
            ),
            6 =>
            array (
                'maintenance_id' => 11,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            7 =>
            array (
                'maintenance_id' => 11,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            8 =>
            array (
                'maintenance_id' => 12,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            9 =>
            array (
                'maintenance_id' => 12,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            10 =>
            array (
                'maintenance_id' => 13,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            11 =>
            array (
                'maintenance_id' => 13,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            12 =>
            array (
                'maintenance_id' => 14,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            13 =>
            array (
                'maintenance_id' => 14,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            14 =>
            array (
                'maintenance_id' => 15,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            15 =>
            array (
                'maintenance_id' => 15,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            16 =>
            array (
                'maintenance_id' => 16,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            17 =>
            array (
                'maintenance_id' => 16,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            18 =>
            array (
                'maintenance_id' => 17,
                'user_id' => 1,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            19 =>
            array (
                'maintenance_id' => 17,
                'user_id' => 3,
                'created_at' => '2023-08-02 22:02:34',
                'updated_at' => '2023-08-02 22:02:34',
            ),
            20 =>
            array (
                'maintenance_id' => 18,
                'user_id' => 1,
                'created_at' => '2023-08-08 22:02:34',
                'updated_at' => '2023-08-08 22:02:34',
            ),
            21 =>
            array (
                'maintenance_id' => 19,
                'user_id' => 1,
                'created_at' => '2023-08-14 08:10:53',
                'updated_at' => '2023-08-14 08:10:53',
            ),
        ));


    }
}
