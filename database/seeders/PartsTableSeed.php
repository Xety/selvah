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
                'name' => 'Buse spéciale TR buse coudée Vario 0008',
                'slug' => Str::slug('Buse spéciale TR buse coudée Vario 0008'),
                'description' => 'Buse réglable pour le Karcher HP en salle blanche.',
                'user_id' => 1,
                'material_id' => 132,
                'reference' => '4.113-006.0',
                'supplier' => 'FITECH',
                'price' => 165,
                'part_entry_total' => 0,
                'part_exit_total' => 0,
                'number_warning_enabled' => 0,
                'number_warning_minimum' => 0,
                'number_critical_enabled' => 0,
                'number_critical_minimum' => 0,
                'part_entry_count' => 0,
                'part_exit_count' => 0,
                'created_at' => Carbon::createFromDate('2022', '06', '23'),
                'updated_at' => Carbon::createFromDate('2022', '06', '23')
            ],
        ];

        DB::table('parts')->insert($parts);
    }
}
