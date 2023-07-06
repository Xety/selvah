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
        $this->call(UsersTableSeed::class);

        // Permissions
        $this->call(RolesTableSeed::class);
        $this->call(PermissionsTableSeed::class);
        $this->call(PermissionsRolesTableSeed::class);
        $this->call(RoleUserTableSeed::class);

        // Settings
        $this->call(SettingsTableSeed::class);

        // Zones
        $this->call(ZonesTableSeed::class);

        // Materials
        $this->call(MaterialsTableSeed::class);

        // Compagnies
        $this->call(CompaniesTableSeed::class);

        // Incidents
        $this->call(IncidentsTableSeed::class);

        // Parts
        $this->call(PartsTableSeed::class);
        $this->call(PartEntriesTableSeed::class);
        $this->call(PartExistsTableSeed::class);
    }
}
