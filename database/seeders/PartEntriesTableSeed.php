<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartEntriesTableSeed extends Seeder
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
                'order_id' => '12345678',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('part_entries')->insert($parts);
    }
}
