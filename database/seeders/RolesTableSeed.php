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
            'slug' => 'administrateur'
        ]);

        Role::create([
            'name' => 'Responsable Prod',
            'slug' => 'responsable.prod'
        ]);

        Role::create([
            'name' => 'Responsable Prod Adjoint',
            'slug' => 'responsable.prod.adjoint'
        ]);

        Role::create([
            'name' => 'Assistante Qualité',
            'slug' => 'assistante.qualite'
        ]);

        Role::create([
            'name' => 'Opérateur',
            'slug' => 'operateur'
        ]);
    }
}
