<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Accéder au Site',
            'slug' => 'access.site',
            'description' => 'L\'utilisateur peut accéder au site.'
        ]);

        Permission::create([
            'name' => 'Gérer les Exports',
            'slug' => 'manage.exports',
            'description' => 'L\'utilisateur peut gérer les exports.'
        ]);

        Permission::create([
            'name' => 'Gérer les Rôles',
            'slug' => 'manage.roles',
            'description' => 'L\'utilisateur peut gérer les rôles.'
        ]);

        Permission::create([
            'name' => 'Gérer les Utilisateurs',
            'slug' => 'manage.users',
            'description' => 'L\'utilisateur peut gérer les utilisateurs.'
        ]);

        Permission::create([
            'name' => 'Gérer les Pièces',
            'slug' => 'manage.parts',
            'description' => 'L\'utilisateur peut gérer les pièces.'
        ]);

        Permission::create([
            'name' => 'Gérer les Maintenances',
            'slug' => 'manage.maintenances',
            'description' => 'L\'utilisateur peut gérer les maintenances.'
        ]);

        Permission::create([
            'name' => 'Gérer les Matériels',
            'slug' => 'manage.materials',
            'description' => 'L\'utilisateur peut gérer les matériels.'
        ]);

        Permission::create([
            'name' => 'Gérer les Entreprises',
            'slug' => 'manage.companies',
            'description' => 'L\'utilisateur peut gérer les entreprises.'
        ]);

        Permission::create([
            'name' => 'Gérer les Paramètres',
            'slug' => 'manage.settings',
            'description' => 'L\'utilisateur peut gérer les paramètres.'
        ]);
    }
}
