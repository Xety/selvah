<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold; color: #ef3c3c;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'Administrateur',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            1 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold; color: #14e8e1;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'Responsable Prod',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            2 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold; color: #5ccc5c;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'Responsable Prod Adjoint',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            3 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold; color: #ffca00;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 4,
            'name' => 'Assistant(e) Qualité',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            4 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'Opérateur',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            5 =>
            array (
                'created_at' => '2023-08-15 09:46:14',
                'css' => 'font-weight: bold;',
                'description' => NULL,
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'Saisonnier',
                'updated_at' => '2023-08-15 09:46:14',
            ),
        ));


    }
}
