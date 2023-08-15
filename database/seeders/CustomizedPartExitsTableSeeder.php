<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedPartExitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('part_exits')->delete();
        
        \DB::table('part_exits')->insert(array (
            0 => 
            array (
                'id' => 1,
                'maintenance_id' => 2,
                'part_id' => 1,
                'user_id' => 1,
                'description' => NULL,
                'number' => 5,
                'created_at' => '2023-06-14 22:02:34',
                'updated_at' => '2023-06-14 22:02:34',
            ),
        ));
        
        
    }
}