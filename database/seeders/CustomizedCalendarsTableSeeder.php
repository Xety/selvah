<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedCalendarsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('calendars')->delete();
        
        \DB::table('calendars')->insert(array (
            0 => 
            array (
                'id' => '08bd11a0-9275-4885-98d4-1ed92ef18190',
                'user_id' => 1,
                'title' => 'Trituration',
                'color' => '#3abff8',
                'allDay' => 0,
                'started' => '2023-08-23 06:00:00',
                'ended' => '2023-08-26 03:00:00',
            ),
            1 => 
            array (
                'id' => '0c866a48-f11e-4e8a-8779-22d53560a7a6',
                'user_id' => 1,
                'title' => 'Triballat Noyal',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-09-13 00:00:00',
                'ended' => '2023-09-14 00:00:00',
            ),
            2 => 
            array (
                'id' => '0de8a473-7aee-4f92-8ff7-01343f4fccb0',
                'user_id' => 1,
                'title' => 'Lambey',
                'color' => '#f87272',
                'allDay' => 1,
                'started' => '2023-07-31 00:00:00',
                'ended' => '2023-08-01 00:00:00',
            ),
            3 => 
            array (
                'id' => '15b14d57-b159-4a0f-95bc-7513cf4ddf0d',
                'user_id' => 1,
                'title' => 'Extrusion de Blé',
                'color' => '#7839ff',
                'allDay' => 1,
                'started' => '2023-08-21 00:00:00',
                'ended' => '2023-08-24 00:00:00',
            ),
            4 => 
            array (
                'id' => '42ea12ea-5295-4171-84fa-c30d0877caca',
                'user_id' => 1,
                'title' => 'Triballat Noyal',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-08-16 00:00:00',
                'ended' => '2023-08-17 00:00:00',
            ),
            5 => 
            array (
                'id' => '47328904-6ec5-49a6-8c8b-6db6d4e6f5f4',
                'user_id' => 1,
                'title' => 'Gelae',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-08-21 00:00:00',
                'ended' => '2023-08-22 00:00:00',
            ),
            6 => 
            array (
                'id' => '70354a1f-6025-49d9-94f8-57116a2f660f',
                'user_id' => 1,
                'title' => 'Réunion avec Yann',
                'color' => '#ddf148',
                'allDay' => 0,
                'started' => '2023-07-31 11:00:00',
                'ended' => '2023-07-31 12:00:00',
            ),
            7 => 
            array (
                'id' => '87dc6e81-6011-4fb1-a3b9-1d88d0c0c7ff',
                'user_id' => 1,
                'title' => 'CJ Mainfrost Foods',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-08-30 00:00:00',
                'ended' => '2023-08-31 00:00:00',
            ),
            8 => 
            array (
                'id' => '8ea767c8-a617-44d3-a391-30f776157774',
                'user_id' => 1,
                'title' => 'Agis Tarare',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-08-03 00:00:00',
                'ended' => '2023-08-04 00:00:00',
            ),
            9 => 
            array (
                'id' => '957dd199-37e9-484d-9df3-8408e23632ce',
                'user_id' => 1,
                'title' => 'Paradis Canin',
                'color' => '#f8d20d',
                'allDay' => 1,
                'started' => '2023-07-25 00:00:00',
                'ended' => '2023-07-26 00:00:00',
            ),
            10 => 
            array (
                'id' => '962e1d2a-4b38-4bde-b86a-580ea3bb535d',
                'user_id' => 1,
                'title' => 'Visio CLEXTRAL',
                'color' => '#48f15e',
                'allDay' => 1,
                'started' => '2023-08-17 00:00:00',
                'ended' => '2023-08-18 00:00:00',
            ),
            11 => 
            array (
                'id' => 'a53609d0-2d60-4510-b68f-e5344fd3b8e6',
                'user_id' => 1,
                'title' => 'Lambey',
                'color' => '#f87272',
                'allDay' => 1,
                'started' => '2023-07-28 00:00:00',
                'ended' => '2023-07-29 00:00:00',
            ),
            12 => 
            array (
                'id' => 'aacbea1f-db77-4bd4-9688-5ebd4cd1e7e6',
                'user_id' => 1,
                'title' => 'Gelae',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-09-18 00:00:00',
                'ended' => '2023-09-19 00:00:00',
            ),
            13 => 
            array (
                'id' => 'ab3f1a50-3df9-44f1-a611-e32be689febd',
                'user_id' => 1,
                'title' => 'Agis Tarare',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-09-12 00:00:00',
                'ended' => '2023-09-13 00:00:00',
            ),
            14 => 
            array (
                'id' => 'bfb2cfdc-fa27-4cc9-9b30-f6446e0f2bf0',
                'user_id' => 1,
                'title' => 'CJ Mainfrost Foods',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-07-28 00:00:00',
                'ended' => '2023-07-29 00:00:00',
            ),
            15 => 
            array (
                'id' => 'e6ea323d-5a46-4db2-bc4b-eb5f20db9399',
                'user_id' => 1,
                'title' => 'Chargement 28 IBC pour Extrusel',
                'color' => '#f8d20d',
                'allDay' => 1,
                'started' => '2023-08-14 00:00:00',
                'ended' => '2023-08-15 00:00:00',
            ),
            16 => 
            array (
                'id' => 'e7b0e2cc-83b8-4465-85e2-8fc704ddf14a',
                'user_id' => 1,
                'title' => 'Agis Herbignac',
                'color' => '#33aec1',
                'allDay' => 1,
                'started' => '2023-08-10 00:00:00',
                'ended' => '2023-08-11 00:00:00',
            ),
        ));
        
        
    }
}