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
        $this->call(UsersTableSeeder::class);

        // Permissions
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);

        // Settings
        $this->call(SettingsTableSeeder::class);

        // Zones
        $this->call(ZonesTableSeeder::class);

        // Materials
        $this->call(MaterialsTableSeeder::class);

        // Compagnies
        $this->call(CompaniesTableSeeder::class);

        // Incidents
        $this->call(IncidentsTableSeeder::class);

        // Maintenances
        $this->call(MaintenancesTableSeeder::class);
        $this->call(CompanyMaintenanceTableSeeder::class);
        $this->call(MaintenanceUserTableSeeder::class);

        // Parts
        $this->call(PartsTableSeeder::class);
        $this->call(PartEntriesTableSeeder::class);
        $this->call(PartExitsTableSeeder::class);

        // Lots
        $this->call(LotsTableSeeder::class);

        // Calendars
        $this->call(CalendarsTableSeeder::class);

        // Cleanings
        $this->call(CleaningsTableSeeder::class);
    }
}
