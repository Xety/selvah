<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CalendarsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $calendars = [
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Paradis Canin',
                'allDay' => true,
                'started' => Carbon::create('2023', '07', '25', '0', '00', '0'),
                'ended' => Carbon::create('2023', '07', '26', '0', '00', '0'),
                'color' => '#f8d20d'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'CJ Mainfrost Foods',
                'allDay' => true,
                'started' => Carbon::create('2023', '07', '28', '0', '00', '0'),
                'ended' => Carbon::create('2023', '07', '29', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Lambey',
                'allDay' => true,
                'started' => Carbon::create('2023', '07', '28', '0', '00', '0'),
                'ended' => Carbon::create('2023', '07', '29', '0', '00', '0'),
                'color' => '#f87272'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Agis Tarare',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '03', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '04', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Agis Herbignac',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '10', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '11', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Triballat Noyal',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '16', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '17', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Gelae',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '21', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '22', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'CJ Mainfrost Foods',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '30', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '31', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Agis Tarare',
                'allDay' => true,
                'started' => Carbon::create('2023', '09', '12', '0', '00', '0'),
                'ended' => Carbon::create('2023', '09', '13', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Triballat Noyal',
                'allDay' => true,
                'started' => Carbon::create('2023', '09', '13', '0', '00', '0'),
                'ended' => Carbon::create('2023', '09', '14', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Gelae',
                'allDay' => true,
                'started' => Carbon::create('2023', '09', '18', '0', '00', '0'),
                'ended' => Carbon::create('2023', '09', '19', '0', '00', '0'),
                'color' => '#33aec1'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Extrusion de Blé',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '21', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '24', '0', '00', '0'),
                'color' => '#7839ff'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Visio CLEXTRAL',
                'allDay' => true,
                'started' => Carbon::create('2023', '08', '17', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '18', '0', '00', '0'),
                'color' => '#48f15e'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Lambey',
                'allDay' => true,
                'started' => Carbon::create('2023', '07', '31', '0', '00', '0'),
                'ended' => Carbon::create('2023', '08', '1', '0', '00', '0'),
                'color' => '#f87272'
            ],
            [
                'id' => Str::uuid(),
                'user_id' => 1,
                'title' => 'Réunion avec Yann',
                'allDay' => false,
                'started' => Carbon::create('2023', '07', '31', '13', '30', '0'),
                'ended' => Carbon::create('2023', '07', '31', '14', '30', '0'),
                'color' => '#ddf148'
            ],
        ];

        DB::table('calendars')->insert($calendars);
    }
}
