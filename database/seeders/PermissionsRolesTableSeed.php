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
            // Role
            'viewAny role',
            'view role',
            'create role',
            'update role',
            'delete role',

            // Permission
            'viewAny permission',
            'view permission',
            'create permission',
            'update permission',
            'delete permission',

            // User
            'viewAny user',
            'view user',
            'create user',
            'update user',
            'delete user',
            'restore user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',
            'generateQrCode part',
            'scanQrCode part',

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
            'generateQrCode material',
            'scanQrCode material',

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

            // Calendar
            'viewAny calendar',
            'view calendar',
            'export calendar',
            'create calendar',
            'update calendar',
            'delete calendar',

            // Cleaning
            'viewAny cleaning',
            'view cleaning',
            'export cleaning',
            'create cleaning',
            'update cleaning',
            'delete cleaning',
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
            'restore user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',
            'generateQrCode part',
            'scanQrCode part',

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
            'generateQrCode material',
            'scanQrCode material',

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

            // Calendar
            'viewAny calendar',
            'view calendar',
            'export calendar',
            'create calendar',
            'update calendar',
            'delete calendar',

            // Cleaning
            'viewAny cleaning',
            'view cleaning',
            'export cleaning',
            'create cleaning',
            'update cleaning',
            'delete cleaning',
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
            'restore user',

            // Part
            'viewAny part',
            'view part',
            'export part',
            'create part',
            'update part',
            'delete part',
            'generateQrCode part',
            'scanQrCode part',

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
            'generateQrCode material',
            'scanQrCode material',

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

            // Calendar
            'viewAny calendar',
            'view calendar',
            'export calendar',
            'create calendar',
            'update calendar',
            'delete calendar',

            // Cleaning
            'viewAny cleaning',
            'view cleaning',
            'export cleaning',
            'create cleaning',
            'update cleaning',
            'delete cleaning',
        ]);


        // Assistant(e) Qualité Role
        $role = Role::findByName('Assistant(e) Qualité');
        $role->syncPermissions([
            // Part
            'viewAny part',
            'view part',
            'export part',
            'generateQrCode part',
            'scanQrCode part',

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
            'generateQrCode material',
            'scanQrCode material',

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
            'viewAny lot',

            // Calendar
            'viewAny calendar',
            'export calendar',
            'create calendar',
            'update calendar',
            'delete calendar',

            // Cleaning
            'viewAny cleaning',
            'view cleaning',
            'export cleaning',
            'create cleaning',
            'update cleaning',
            'delete cleaning',
        ]);

        // Opérateur Role
        $role = Role::findByName('Opérateur');
        $role->syncPermissions([
            // Part
            'viewAny part',
            'view part',
            'scanQrCode part',

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
            'scanQrCode material',

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

            // Calendar
            'viewAny calendar',

            // Cleaning
            'viewAny cleaning',
            'view cleaning',
            'create cleaning',
            'update cleaning',
        ]);

        // Saisonnier Role
        $role = Role::findByName('Saisonnier');
        $role->syncPermissions([
            // Material
            'scanQrCode material',

            // Cleaning
            'viewAny cleaning',
            'create cleaning',
        ]);
    }
}
