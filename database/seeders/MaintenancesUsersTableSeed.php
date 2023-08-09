<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaintenancesUsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $maintenances_users = [
            [
                'user_id' => 1,
                'maintenance_id' => 1,
                'created_at' => Carbon::createFromDate('2023', '06', '08'),
                'updated_at' => Carbon::createFromDate('2023', '06', '08')
            ],
            [
                'user_id' => 2,
                'maintenance_id' => 1,
                'created_at' => Carbon::createFromDate('2023', '06', '08'),
                'updated_at' => Carbon::createFromDate('2023', '06', '08')
            ],
            [
                'user_id' => 5,
                'maintenance_id' => 1,
                'created_at' => Carbon::createFromDate('2023', '06', '08'),
                'updated_at' => Carbon::createFromDate('2023', '06', '08')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 2,
                'created_at' => Carbon::createFromDate('2023', '06', '14'),
                'updated_at' => Carbon::createFromDate('2023', '06', '14')
            ],
            [
                'user_id' => 2,
                'maintenance_id' => 5,
                'created_at' => Carbon::createFromDate('2023', '06', '23'),
                'updated_at' => Carbon::createFromDate('2023', '06', '23')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 9,
                'created_at' => Carbon::createFromDate('2023', '07', '26'),
                'updated_at' => Carbon::createFromDate('2023', '07', '26')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 11,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 11,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 12,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 12,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 13,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 13,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 14,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 14,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 15,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 15,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 16,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 16,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 17,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 3,
                'maintenance_id' => 17,
                'created_at' => Carbon::createFromDate('2023', '08', '02'),
                'updated_at' => Carbon::createFromDate('2023', '08', '02')
            ],
            [
                'user_id' => 1,
                'maintenance_id' => 18,
                'created_at' => Carbon::createFromDate('2023', '08', '08'),
                'updated_at' => Carbon::createFromDate('2023', '08', '08')
            ],
        ];

        DB::table('maintenance_user')->insert($maintenances_users);
    }
}
