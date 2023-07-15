<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartExistsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $parts = [
            [
                'maintenance_id' => 1,
                'part_id' => 2,
                'user_id' => 1,
                'number' => 1,
                'created_at' => Carbon::createFromDate('2023', '04', '15'),
                'updated_at' => Carbon::createFromDate('2023', '04', '15')
            ],
            [
                'maintenance_id' => 2,
                'part_id' => 1,
                'user_id' => 1,
                'number' => 5,
                'created_at' => Carbon::createFromDate('2023', '06', '14'),
                'updated_at' => Carbon::createFromDate('2023', '06', '14')
            ],
        ];

        DB::table('part_exits')->insert($parts);
    }
}
