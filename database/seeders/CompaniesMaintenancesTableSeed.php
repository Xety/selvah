<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'maintenance_id' => 1,
                'created_at' => Carbon::createFromDate('2023', '06', '13'),
                'updated_at' => Carbon::createFromDate('2023', '06', '13')
            ],
            [
                'company_id' => 5,
                'maintenance_id' => 3,
                'created_at' => Carbon::createFromDate('2023', '06', '16'),
                'updated_at' => Carbon::createFromDate('2023', '06', '16')
            ],
            [
                'company_id' => 9,
                'maintenance_id' => 4,
                'created_at' => Carbon::createFromDate('2023', '06', '23'),
                'updated_at' => Carbon::createFromDate('2023', '06', '23')
            ],
            [
                'company_id' => 14,
                'maintenance_id' => 6,
                'created_at' => Carbon::createFromDate('2023', '07', '06'),
                'updated_at' => Carbon::createFromDate('2023', '07', '06')
            ],
            [
                'company_id' => 15,
                'maintenance_id' => 7,
                'created_at' => Carbon::createFromDate('2023', '07', '06'),
                'updated_at' => Carbon::createFromDate('2023', '07', '06')
            ],
        ];

        DB::table('company_maintenance')->insert($companies_maintenances);
    }
}
