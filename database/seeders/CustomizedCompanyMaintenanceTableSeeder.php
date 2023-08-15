<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedCompanyMaintenanceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_maintenance')->delete();
        
        \DB::table('company_maintenance')->insert(array (
            0 => 
            array (
                'company_id' => 4,
                'maintenance_id' => 1,
                'created_at' => '2023-06-13 22:02:34',
                'updated_at' => '2023-06-13 22:02:34',
            ),
            1 => 
            array (
                'company_id' => 5,
                'maintenance_id' => 3,
                'created_at' => '2023-06-16 22:02:34',
                'updated_at' => '2023-06-16 22:02:34',
            ),
            2 => 
            array (
                'company_id' => 9,
                'maintenance_id' => 4,
                'created_at' => '2023-06-23 22:02:34',
                'updated_at' => '2023-06-23 22:02:34',
            ),
            3 => 
            array (
                'company_id' => 14,
                'maintenance_id' => 6,
                'created_at' => '2023-07-06 22:02:34',
                'updated_at' => '2023-07-06 22:02:34',
            ),
            4 => 
            array (
                'company_id' => 15,
                'maintenance_id' => 7,
                'created_at' => '2023-07-06 22:02:34',
                'updated_at' => '2023-07-06 22:02:34',
            ),
            5 => 
            array (
                'company_id' => 9,
                'maintenance_id' => 8,
                'created_at' => '2023-07-25 22:02:34',
                'updated_at' => '2023-07-25 22:02:34',
            ),
            6 => 
            array (
                'company_id' => 15,
                'maintenance_id' => 10,
                'created_at' => '2023-07-22 22:02:34',
                'updated_at' => '2023-07-22 22:02:34',
            ),
            7 => 
            array (
                'company_id' => 5,
                'maintenance_id' => 19,
                'created_at' => '2023-08-14 08:10:53',
                'updated_at' => '2023-08-14 08:10:53',
            ),
        ));
        
        
    }
}