<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'username' => 'Emeric.F',
                'first_name' => 'Emeric',
                'last_name' => 'Fevre',
                'email' => 'emeric@xetaravel.com',
                'password' => '$2y$10$E1vInYW6/gCbsHMafKTK6u2qGB2sOVg2YvBrZojH0ZXcvFe.Wo7Hy',
                'remember_token' => NULL,
                'incident_count' => 16,
                'maintenance_count' => 18,
                'part_exit_count' => 1,
                'cleaning_count' => 13,
                'last_login_ip' => '192.168.56.1',
                'last_login_date' => '2023-08-15 09:46:50',
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-15 09:46:50',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'username' => 'Franck.L',
                'first_name' => 'Franck',
                'last_name' => 'Lequeu',
                'email' => 'f.lequeu@bourgognedusud1.coop',
                'password' => '$2y$10$9507Lkd6kz/PgCII7JhBFulspAUPpnKKgoLT5oBKYTL8x.TkLK5K6',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 0,
                'part_exit_count' => 0,
                'cleaning_count' => 0,
                'last_login_ip' => NULL,
                'last_login_date' => NULL,
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-09 22:02:33',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'username' => 'Anthony.M',
                'first_name' => 'Anthony',
                'last_name' => 'Moindrot',
                'email' => 'anthony.moindrot@hotmail1.fr',
                'password' => '$2y$10$xeue8YHo0n8WBEPN6W/.EOVSU9z68BHW/acaQ03OpGowDW6HqnPRC',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 1,
                'part_exit_count' => 0,
                'cleaning_count' => 16,
                'last_login_ip' => NULL,
                'last_login_date' => NULL,
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-09 22:02:33',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'username' => 'JeanMichel.B',
                'first_name' => 'Jean Michel',
                'last_name' => 'Briset',
                'email' => 'jeanmichel.briset@sfr.fr',
                'password' => '$2y$10$QtJDk6C1dY3dxDnCFnCOOuMJ.kZ9sP3tx2NXf3i3wgRSqsjYl63By',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 0,
                'part_exit_count' => 0,
                'cleaning_count' => 12,
                'last_login_ip' => NULL,
                'last_login_date' => NULL,
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-09 22:02:33',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'username' => 'Alexis.B',
                'first_name' => 'Alexis',
                'last_name' => 'Bert',
                'email' => '123@sfr.fr',
                'password' => '$2y$10$HS/uJf67Jx/yg3Yf2aN2/OQt.QIq4uvVwsUCqMLu3OwmAo.7hlkP.',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 0,
                'part_exit_count' => 0,
                'cleaning_count' => 7,
                'last_login_ip' => NULL,
                'last_login_date' => NULL,
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-09 22:02:33',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'username' => 'Charline.B',
                'first_name' => 'Charline',
                'last_name' => 'Brocot',
                'email' => 'c.brocot@bourgognedusud1.coop',
                'password' => '$2y$10$MFpE3l9whR9svtwVqw..F.w/r45jRp9bAAN52hgl1vPpbErXdz9Jm',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 0,
                'part_exit_count' => 0,
                'cleaning_count' => 0,
                'last_login_ip' => NULL,
                'last_login_date' => NULL,
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-09 22:02:33',
                'updated_at' => '2023-08-09 22:02:33',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'username' => 'Marcel.F',
                'first_name' => 'Marcel',
                'last_name' => 'Fevr',
                'email' => 'marcel@xetaravel.com',
                'password' => '$2y$10$EVssY/8bkaDRVx2CCkrT/uh2qT/c0ZFzWVLwlF6oAZ.28/hZ40r7q',
                'remember_token' => NULL,
                'incident_count' => 0,
                'maintenance_count' => 0,
                'part_exit_count' => 0,
                'cleaning_count' => 0,
                'last_login_ip' => '37.166.150.14',
                'last_login_date' => '2023-08-10 14:06:12',
                'deleted_user_id' => NULL,
                'created_at' => '2023-08-10 14:03:17',
                'updated_at' => '2023-08-10 14:06:12',
                'deleted_at' => NULL,
            ),
        ));


    }
}
