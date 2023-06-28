<?php
namespace Database\Seeders;

use Carbon\Carbon;
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
        $now = Carbon::now();

        $settings = [
            [
                'name' => 'user.login.enabled',
                'value_int' => null,
                'value_str' => null,
                'value_bool' => true,
                'description' => 'Active/Désactive le système de connexion',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('settings')->insert($settings);
    }
}
