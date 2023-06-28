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
            'name' => 'Access Site',
            'slug' => 'access.site',
            'description' => 'L\'utilisateur peut accéder au site.'
        ]);

        Permission::create([
            'name' => 'Manage Exports',
            'slug' => 'manage.exports',
            'description' => 'L\'utilisateur peut gérer les exports.'
        ]);

        Permission::create([
            'name' => 'Manage Roles',
            'slug' => 'manage.roles',
            'description' => 'L\'utilisateur peut gérer les rôles.'
        ]);

        Permission::create([
            'name' => 'Manage Users',
            'slug' => 'manage.users',
            'description' => 'L\'utilisateur peut gérer les utilisateurs.'
        ]);

        Permission::create([
            'name' => 'Manage Stock',
            'slug' => 'manage.stock',
            'description' => 'L\'utilisateur peut gérer le stock.'
        ]);

        Permission::create([
            'name' => 'Manage Settings',
            'slug' => 'manage.settings',
            'description' => 'L\'utilisateur peut gérer les paramètres.'
        ]);
    }
}
