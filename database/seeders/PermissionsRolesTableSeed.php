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
        $role->syncPermissions(['Access Site', 'Manage Exports', 'Manage Roles', 'Manage Users', 'Manage Stock', 'Manage Settings']);

        // Responsable Prod Role
        $role = Role::findByName('Responsable Prod');
        $role->syncPermissions(['Access Site', 'Manage Exports', 'Manage Stock', 'Manage Users']);

        // Responsable Prod Adjoint Role
        $role = Role::findByName('Responsable Prod Adjoint');
        $role->syncPermissions(['Access Site', 'Manage Exports', 'Manage Stock', 'Manage Users']);

        // Assistante Qualité Role
        $role = Role::findByName('Assistante Qualité');
        $role->syncPermissions(['Access Site', 'Manage Exports']);

        // Opérateur Role
        $role = Role::findByName('Opérateur');
        $role->syncPermissions(['Access Site']);
    }
}
