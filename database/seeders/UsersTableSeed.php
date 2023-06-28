<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'Emeric.F',
                'first_name' => 'Emeric',
                'last_name' => 'Fevre',
                'email' => 'emeric@xetaravel.com',
                'password' => bcrypt('password')
            ],
            [
                'username' => 'Franck.L',
                'first_name' => 'Franck',
                'last_name' => 'Lequeu',
                'email' => 'f.lequeu@bourgognedusud1.coop',
                'password' => bcrypt('password')
            ],
            [
                'username' => 'Anthony.M',
                'first_name' => 'Anthony',
                'last_name' => 'Moindrot',
                'email' => 'anthony.moindrot@hotmail1.fr',
                'password' => bcrypt('password')
            ],
            [
                'username' => 'JeanMichel.B',
                'first_name' => 'Jean Michel',
                'last_name' => 'Briset',
                'email' => 'jeanmichel.briset@sfr.fr',
                'password' => bcrypt('password')
            ],
            [
                'username' => 'Alexis.B',
                'first_name' => 'Alexis',
                'last_name' => 'Bert',
                'email' => '123@sfr.fr',
                'password' => bcrypt('password')
            ],
            [
                'username' => 'Charline.B',
                'first_name' => 'Charline',
                'last_name' => 'Brocot',
                'email' => 'c.brocot@bourgognedusud1.coop',
                'password' => bcrypt('password')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
