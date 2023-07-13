<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartsTableSeed extends Seeder
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
                'name' => 'Boulon 10x70',
                'slug' => Str::slug('FBoulon 10x70'),
                'description' => 'Boulon 10x70 utilisé pour serrer la filière.',
                'user_id' => 1,
                'material_id' => 81,
                'reference' => '123456',
                'supplier' => 'MAINTENANCE COOP',
                'price' => 10,
                'number' => 2,
                'number_warning_enabled' => 0,
                'number_warning_minimum' => 0,
                'number_critical_enabled' => 0,
                'number_critical_minimum' => 0,
                'part_entry_count' => 1,
                'part_exit_count' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Filière 2.75mm',
                'slug' => Str::slug('Filière 2.75mm'),
                'description' => 'Filière 2.75mm utilisé pour le XS.',
                'user_id' => 1,
                'material_id' => 81,
                'reference' => 'Z9847645A',
                'supplier' => 'CLEXTRAL',
                'price' => 2200,
                'number' => 0,
                'number_warning_enabled' => 0,
                'number_warning_minimum' => 0,
                'number_critical_enabled' => 0,
                'number_critical_minimum' => 0,
                'part_entry_count' => 0,
                'part_exit_count' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('parts')->insert($parts);
    }
}
