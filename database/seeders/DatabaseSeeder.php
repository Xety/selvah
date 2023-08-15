<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        //$this->call(UsersTableSeed::class);
        $this->call(CustomizedUsersTableSeeder::class);

        // Permissions
        //$this->call(RolesTableSeed::class);
        //$this->call(PermissionsTableSeed::class);
        //$this->call(PermissionsRolesTableSeed::class);
        //$this->call(RoleUserTableSeed::class);
        $this->call(CustomizedRolesTableSeeder::class);
        $this->call(CustomizedPermissionsTableSeeder::class);
        $this->call(CustomizedModelHasRolesTableSeeder::class);
        $this->call(CustomizedRoleHasPermissionsTableSeeder::class);

        // Settings
        //$this->call(SettingsTableSeed::class);
        $this->call(CustomizedSettingsTableSeeder::class);

        // Zones
        //$this->call(ZonesTableSeed::class);
        $this->call(CustomizedZonesTableSeeder::class);

        // Materials
        //$this->call(MaterialsTableSeed::class);
        $this->call(CustomizedMaterialsTableSeeder::class);

        // Compagnies
        //$this->call(CompaniesTableSeed::class);
        $this->call(CustomizedCompaniesTableSeeder::class);

        // Incidents
        //$this->call(IncidentsTableSeed::class);
        $this->call(CustomizedIncidentsTableSeeder::class);

        // Maintenances
        //$this->call(MaintenancesTableSeed::class);
        //$this->call(CompaniesMaintenancesTableSeed::class);
        //$this->call(MaintenancesUsersTableSeed::class);
        $this->call(CustomizedMaintenancesTableSeeder::class);
        $this->call(CustomizedCompanyMaintenanceTableSeeder::class);
        $this->call(CustomizedMaintenanceUserTableSeeder::class);

        // Parts
        //$this->call(PartsTableSeed::class);
        //$this->call(PartEntriesTableSeed::class);
        //$this->call(PartExistsTableSeed::class);
        $this->call(CustomizedPartsTableSeeder::class);
        $this->call(CustomizedPartEntriesTableSeeder::class);
        $this->call(CustomizedPartExitsTableSeeder::class);

        // Lots
        //$this->call(LotsTableSeed::class);
        $this->call(CustomizedLotsTableSeeder::class);

        // Calendars
        //$this->call(CalendarsTableSeed::class);
        $this->call(CustomizedCalendarsTableSeeder::class);

        // Cleanings
        //$this->call(CleaningsTableSeed::class);
        $this->call(CustomizedCleaningsTableSeeder::class);
    }
}
