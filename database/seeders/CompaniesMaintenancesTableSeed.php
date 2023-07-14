<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompaniesMaintenancesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $companies_maintenances = [
            [
                'company_id' => 4,
                'maintenance_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'company_id' => 5,
                'maintenance_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'company_id' => 6,
                'maintenance_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'company_id' => 12,
                'maintenance_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'company_id' => 13,
                'maintenance_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('company_maintenance')->insert($companies_maintenances);
    }
}
