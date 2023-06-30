<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionsRolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrateur Role
        $role = Role::findByName('Administrateur');
        $role->syncPermissions([
            'Accéder au Site',
            'Gérer les Exports',
            'Gérer les Rôles',
            'Gérer les Utilisateurs',
            'Gérer les Pièces',
            'Gérer les Maintenances',
            'Gérer les Matériels',
            'Gérer les Entreprises',
            'Gérer les Paramètres'
        ]);

        // Responsable Prod Role
        $role = Role::findByName('Responsable Prod');
        $role->syncPermissions([
            'Accéder au Site',
            'Gérer les Exports',
            'Gérer les Utilisateurs',
            'Gérer les Pièces',
            'Gérer les Maintenances',
            'Gérer les Matériels',
            'Gérer les Entreprises',
        ]);

        // Responsable Prod Adjoint Role
        $role = Role::findByName('Responsable Prod Adjoint');
        $role->syncPermissions([
            'Accéder au Site',
            'Gérer les Exports',
            'Gérer les Utilisateurs',
            'Gérer les Pièces',
            'Gérer les Maintenances',
            'Gérer les Matériels',
            'Gérer les Entreprises',
        ]);


        // Assistante Qualité Role
        $role = Role::findByName('Assistante Qualité');
        $role->syncPermissions([
            'Accéder au Site',
            'Gérer les Exports',
        ]);

        // Opérateur Role
        $role = Role::findByName('Opérateur');
        $role->syncPermissions([
            'Accéder au Site',
        ]);
    }
}
