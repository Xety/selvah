<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompaniesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $companies = [
            [
                'name' => 'Toy',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Denis',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Kongskilde',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Olexa',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bourgogne du Sub Maintenance',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'SGN Élec',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Clextral',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Orreca',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'AFCE',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'SoluFood',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('companies')->insert($companies);
    }
}
