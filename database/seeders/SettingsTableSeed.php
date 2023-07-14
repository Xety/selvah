<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $settings = [
            [
                'name' => 'user.login.enabled',
                'value_int' => null,
                'value_str' => null,
                'value_bool' => true,
                'description' => 'Active/Désactive le système de connexion',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'incident.create.enabled',
                'value_int' => null,
                'value_str' => null,
                'value_bool' => true,
                'description' => 'Active/Désactive le système de création d\'incident.',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('settings')->insert($settings);
    }
}
