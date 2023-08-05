<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrateur',
            'css' => 'font-weight: bold; color: #ef3c3c;',
        ]);

        Role::create([
            'name' => 'Responsable Prod',
            'css' => 'font-weight: bold; color: #14e8e1;',
        ]);

        Role::create([
            'name' => 'Responsable Prod Adjoint',
            'css' => 'font-weight: bold; color: #5ccc5c;',
        ]);

        Role::create([
            'name' => 'Assistant(e) Qualité',
            'css' => 'font-weight: bold; color: #ffca00;',
        ]);

        Role::create([
            'name' => 'Opérateur',
            'css' => 'font-weight: bold;',
        ]);

        Role::create([
            'name' => 'Saisonnier',
            'css' => 'font-weight: bold;',
        ]);
    }
}
