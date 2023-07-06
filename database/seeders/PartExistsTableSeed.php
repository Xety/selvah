<?php

namespace Database\Seeders;

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
                'part_id' => 1,
                'user_id' => 1,
                'number' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('part_exits')->insert($parts);
    }
}
