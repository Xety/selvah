<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Selvah\Models\User;

class RoleUserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('username', 'Emeric.F')->first();
        $user->assignRole('Opérateur', 'Administrateur');

        $user = User::where('username', 'Franck.L')->first();
        $user->assignRole('Responsable Prod');

        $user = User::where('username', 'Anthony.M')->first();
        $user->assignRole('Opérateur');

        $user = User::where('username', 'JeanMichel.B')->first();
        $user->assignRole('Opérateur');

        $user = User::where('username', 'Alexis.B')->first();
        $user->assignRole('Opérateur');

        $user = User::where('username', 'Charline.B')->first();
        $user->assignRole('Assistant(e) Qualité');
    }
}
