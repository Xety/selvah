<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartEntriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('part_entries')->delete();

        \DB::table('part_entries')->insert(array (
            0 =>
            array (
                'id' => 1,
                'part_id' => 1,
                'user_id' => 1,
                'number' => 37,
                'order_id' => 'PR22-1403',
                'created_at' => '2022-06-23 22:02:34',
                'updated_at' => '2022-06-16 22:02:34',
            ),
            1 =>
            array (
                'id' => 2,
                'part_id' => 3,
                'user_id' => 1,
                'number' => 4,
                'order_id' => NULL,
                'created_at' => '2023-08-10 09:41:01',
                'updated_at' => '2023-08-10 09:41:01',
            ),
            2 =>
            array (
                'id' => 3,
                'part_id' => 4,
                'user_id' => 1,
                'number' => 4,
                'order_id' => NULL,
                'created_at' => '2023-08-10 09:42:47',
                'updated_at' => '2023-08-10 09:42:47',
            ),
            3 =>
            array (
                'id' => 4,
                'part_id' => 5,
                'user_id' => 1,
                'number' => 4,
                'order_id' => NULL,
                'created_at' => '2023-08-10 09:44:35',
                'updated_at' => '2023-08-10 09:44:35',
            ),
            4 =>
            array (
                'id' => 5,
                'part_id' => 6,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-10 09:47:13',
                'updated_at' => '2023-08-10 09:47:13',
            ),
            5 =>
            array (
                'id' => 6,
                'part_id' => 7,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-10 09:49:33',
                'updated_at' => '2023-08-10 09:49:33',
            ),
            6 =>
            array (
                'id' => 7,
                'part_id' => 8,
                'user_id' => 1,
                'number' => 16,
                'order_id' => NULL,
                'created_at' => '2023-08-10 10:04:34',
                'updated_at' => '2023-08-10 10:04:34',
            ),
            7 =>
            array (
                'id' => 8,
                'part_id' => 9,
                'user_id' => 1,
                'number' => 22,
                'order_id' => NULL,
                'created_at' => '2023-08-10 10:06:23',
                'updated_at' => '2023-08-10 10:06:23',
            ),
            8 =>
            array (
                'id' => 10,
                'part_id' => 12,
                'user_id' => 1,
                'number' => 1,
                'order_id' => 'BT 38612-1219',
                'created_at' => '2023-08-10 11:40:59',
                'updated_at' => '2023-08-10 11:40:59',
            ),
            9 =>
            array (
                'id' => 11,
                'part_id' => 14,
                'user_id' => 1,
                'number' => 2,
                'order_id' => 'BT 39519-1219',
                'created_at' => '2023-08-10 12:34:42',
                'updated_at' => '2023-08-10 12:34:42',
            ),
            10 =>
            array (
                'id' => 12,
                'part_id' => 15,
                'user_id' => 1,
                'number' => 2,
                'order_id' => 'BT 40714-1219',
                'created_at' => '2023-08-10 13:04:00',
                'updated_at' => '2023-08-10 13:04:21',
            ),
            11 =>
            array (
                'id' => 13,
                'part_id' => 16,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-10 14:42:25',
                'updated_at' => '2023-08-10 14:42:25',
            ),
            12 =>
            array (
                'id' => 14,
                'part_id' => 17,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-10 14:48:53',
                'updated_at' => '2023-08-10 14:48:53',
            ),
            13 =>
            array (
                'id' => 15,
                'part_id' => 11,
                'user_id' => 1,
                'number' => 86,
                'order_id' => NULL,
                'created_at' => '2023-08-10 15:00:36',
                'updated_at' => '2023-08-10 15:00:36',
            ),
            14 =>
            array (
                'id' => 17,
                'part_id' => 18,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:08:07',
                'updated_at' => '2023-08-14 10:08:07',
            ),
            15 =>
            array (
                'id' => 18,
                'part_id' => 19,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:09:17',
                'updated_at' => '2023-08-14 10:09:17',
            ),
            16 =>
            array (
                'id' => 19,
                'part_id' => 20,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:10:58',
                'updated_at' => '2023-08-14 10:10:58',
            ),
            17 =>
            array (
                'id' => 20,
                'part_id' => 21,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:12:34',
                'updated_at' => '2023-08-14 10:12:34',
            ),
            18 =>
            array (
                'id' => 21,
                'part_id' => 22,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:32:00',
                'updated_at' => '2023-08-14 10:32:00',
            ),
            19 =>
            array (
                'id' => 22,
                'part_id' => 23,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:33:39',
                'updated_at' => '2023-08-14 10:33:39',
            ),
            20 =>
            array (
                'id' => 23,
                'part_id' => 24,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:35:06',
                'updated_at' => '2023-08-14 10:35:06',
            ),
            21 =>
            array (
                'id' => 24,
                'part_id' => 25,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:36:23',
                'updated_at' => '2023-08-14 10:36:23',
            ),
            22 =>
            array (
                'id' => 25,
                'part_id' => 27,
                'user_id' => 1,
                'number' => 8,
                'order_id' => NULL,
                'created_at' => '2023-08-14 10:56:02',
                'updated_at' => '2023-08-14 10:56:02',
            ),
            23 =>
            array (
                'id' => 26,
                'part_id' => 28,
                'user_id' => 1,
                'number' => 8,
                'order_id' => NULL,
                'created_at' => '2023-08-14 11:05:00',
                'updated_at' => '2023-08-14 11:05:00',
            ),
            24 =>
            array (
                'id' => 27,
                'part_id' => 29,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 11:09:47',
                'updated_at' => '2023-08-14 11:09:47',
            ),
            25 =>
            array (
                'id' => 28,
                'part_id' => 30,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 11:50:06',
                'updated_at' => '2023-08-14 11:50:06',
            ),
            26 =>
            array (
                'id' => 29,
                'part_id' => 31,
                'user_id' => 1,
                'number' => 1,
                'order_id' => NULL,
                'created_at' => '2023-08-14 15:44:55',
                'updated_at' => '2023-08-14 15:44:55',
            ),
        ));


    }
}
