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
                'name' => 'Ventouse 40mm',
                'slug' => Str::slug('Ventouse 40mm'),
                'description' => 'Ventouse 40mm utilisé dans le magasin pour la prise des sacs.',
                'user_id' => 1,
                'material_id' => 115,
                'reference' => 'DIA40VPA40NR',
                'supplier' => 'ORRECA',
                'price' => 10,
                'part_entry_total' => 37,
                'part_exit_total' => 5,
                'number_warning_enabled' => 1,
                'number_warning_minimum' => 18,
                'number_critical_enabled' => 1,
                'number_critical_minimum' => 9,
                'part_entry_count' => 1,
                'part_exit_count' => 1,
                'created_at' => Carbon::createFromDate('2022', '06', '23'),
                'updated_at' => Carbon::createFromDate('2022', '06', '23')
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
