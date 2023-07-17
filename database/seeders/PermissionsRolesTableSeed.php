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
            'Gérer les Paramètres',
            'Gérer les Incidents',
            'Gérer les Zones',
            'Gérer les Lots'
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
            'Gérer les Incidents',
            'Gérer les Zones',
            'Gérer les Lots'
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
            'Gérer les Incidents',
            'Gérer les Zones',
            'Gérer les Lots'
        ]);


        // Assistant(e) Qualité Role
        $role = Role::findByName('Assistant(e) Qualité');
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
