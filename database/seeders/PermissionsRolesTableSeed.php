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
            //Role
            'viewAny role',
            'view role',
            'create role',
            'update role',
            'delete role',

            // User
            'viewAny user',
            'view user',
            'create user',
            'update user',
            'delete user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',

            // PartEntry
            'viewAny partEntry',
            'view partEntry',
            'export partEntry',
            'create partEntry',
            'update partEntry',
            'delete partEntry',

            // PartExit
            'viewAny partExit',
            'view partExit',
            'export partExit',
            'create partExit',
            'update partExit',
            'delete partExit',

            // Maintenance
            'viewAny maintenance',
            'view maintenance',
            'export maintenance',
            'create maintenance',
            'update maintenance',
            'delete maintenance',

            // Material
            'viewAny material',
            'view material',
            'export material',
            'create material',
            'update material',
            'delete material',

            //Company
            'viewAny company',
            'view company',
            'export company',
            'create company',
            'update company',
            'delete company',

            // Setting
            'viewAny setting',
            'view setting',
            'create setting',
            'update setting',
            'delete setting',

            // Incident
            'viewAny incident',
            'view incident',
            'export incident',
            'create incident',
            'update incident',
            'delete incident',

            // Zone
            'viewAny zone',
            'view zone',
            'export zone',
            'create zone',
            'update zone',
            'delete zone',

            // Lot
            'viewAny lot',
            'view lot',
            'export lot',
            'create lot',
            'update lot',
            'delete lot',
        ]);

        // Responsable Prod Role
        $role = Role::findByName('Responsable Prod');
        $role->syncPermissions([
            // User
            'viewAny user',
            'view user',
            'create user',
            'update user',
            'delete user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',

            // PartEntry
            'viewAny partEntry',
            'view partEntry',
            'export partEntry',
            'create partEntry',
            'update partEntry',
            'delete partEntry',

            // PartExit
            'viewAny partExit',
            'view partExit',
            'export partExit',
            'create partExit',
            'update partExit',
            'delete partExit',

            // Maintenance
            'viewAny maintenance',
            'view maintenance',
            'export maintenance',
            'create maintenance',
            'update maintenance',
            'delete maintenance',

            // Material
            'viewAny material',
            'view material',
            'export material',
            'create material',
            'update material',
            'delete material',

            //Company
            'viewAny company',
            'view company',
            'export company',
            'create company',
            'update company',
            'delete company',

            // Incident
            'viewAny incident',
            'view incident',
            'export incident',
            'create incident',
            'update incident',
            'delete incident',

            // Zone
            'viewAny zone',
            'view zone',
            'export zone',
            'create zone',
            'update zone',
            'delete zone',

            // Lot
            'viewAny lot',
            'view lot',
            'export lot',
            'create lot',
            'update lot',
            'delete lot',
        ]);

        // Responsable Prod Adjoint Role
        $role = Role::findByName('Responsable Prod Adjoint');
        $role->syncPermissions([
            // User
            'viewAny user',
            'view user',
            'create user',
            'update user',
            'delete user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',

            // PartEntry
            'viewAny partEntry',
            'view partEntry',
            'export partEntry',
            'create partEntry',
            'update partEntry',
            'delete partEntry',

            // PartExit
            'viewAny partExit',
            'view partExit',
            'export partExit',
            'create partExit',
            'update partExit',
            'delete partExit',

            // Maintenance
            'viewAny maintenance',
            'view maintenance',
            'export maintenance',
            'create maintenance',
            'update maintenance',
            'delete maintenance',

            // Material
            'viewAny material',
            'view material',
            'export material',
            'create material',
            'update material',
            'delete material',

            //Company
            'viewAny company',
            'view company',
            'export company',
            'create company',
            'update company',
            'delete company',

            // Incident
            'viewAny incident',
            'view incident',
            'export incident',
            'create incident',
            'update incident',
            'delete incident',

            // Zone
            'viewAny zone',
            'view zone',
            'export zone',
            'create zone',
            'update zone',
            'delete zone',

            // Lot
            'viewAny lot',
            'view lot',
            'export lot',
            'create lot',
            'update lot',
            'delete lot',
        ]);


        // Assistant(e) Qualité Role
        $role = Role::findByName('Assistant(e) Qualité');
        $role->syncPermissions([
            // Part
            'viewAny part',
            'view part',
            'export part',

            // PartEntry
            'viewAny partEntry',
            'view partEntry',
            'export partEntry',

            // PartExit
            'viewAny partExit',
            'view partExit',
            'export partExit',

            // Maintenance
            'viewAny maintenance',
            'view maintenance',
            'export maintenance',

            // Material
            'viewAny material',
            'view material',
            'export material',

            //Company
            'viewAny company',
            'view company',
            'export company',

            // Incident
            'viewAny incident',
            'view incident',
            'export incident',

            // Zone
            'viewAny zone',

            // Lot
            'viewAny lot'
        ]);

        // Opérateur Role
        $role = Role::findByName('Opérateur');
        $role->syncPermissions([
            // Part
            'viewAny part',
            'view part',

            // PartEntry
            'viewAny partEntry',
            'view partEntry',

            // PartExit
            'viewAny partExit',
            'view partExit',
            'create partExit',

            // Maintenance
            'viewAny maintenance',
            'view maintenance',
            'create maintenance',
            'update maintenance',

            // Material
            'viewAny material',
            'view material',

            //Company
            'viewAny company',
            'view company',
            'create company',

            // Incident
            'viewAny incident',
            'view incident',
            'create incident',
            'update incident',

            // Zone
            'viewAny zone',
            'view zone',

            // Lot
            'viewAny lot',
            'view lot',
        ]);
    }
}
