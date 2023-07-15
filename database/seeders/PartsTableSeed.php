<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'slug' => Str::slug('Boulon 10x70'),
                'description' => 'Boulon 10x70 utilisé pour serrer la filière.',
                'user_id' => 1,
                'material_id' => 81,
                'reference' => '123456',
                'supplier' => 'MAINTENANCE COOP',
                'price' => 10,
                'part_entry_total' => 4,
                'part_exit_total' => 2,
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
                'name' => 'Système de serrage complet de presse',
                'slug' => Str::slug('Système de serrage complet de presse'),
                'description' => 'Nouveau système de serrage complet des profils de presse avec les 8 vis BTR.',
                'user_id' => 1,
                'material_id' => 46,
                'reference' => '1234567',
                'supplier' => 'OLEXA',
                'price' => 10,
                'part_entry_total' => 1,
                'part_exit_total' => 1,
                'number_warning_enabled' => 0,
                'number_warning_minimum' => 0,
                'number_critical_enabled' => 0,
                'number_critical_minimum' => 0,
                'part_entry_count' => 1,
                'part_exit_count' => 1,
                'created_at' => Carbon::createFromDate('2023', '04', '15'),
                'updated_at' => Carbon::createFromDate('2023', '04', '15')
            ]
        ];

        DB::table('parts')->insert($parts);
    }
}
