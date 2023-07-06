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
                'name' => 'Filière 2.35mm',
                'slug' => Str::slug('Filière 2.35mm'),
                'description' => 'Filière 2.35mm utilisé pour le XS.',
                'material_id' => 81,
                'reference' => 'Z984764A',
                'supplier' => 'CLEXTRAL',
                'price' => 2200,
                'number' => 0,
                'number_warning_enabled' => 0,
                'number_warning_minimum' => 0,
                'number_critical_enabled' => 0,
                'number_critical_minimum' => 0,
                'part_entry_count' => 1,
                'part_exit_count' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('parts')->insert($parts);
    }
}
