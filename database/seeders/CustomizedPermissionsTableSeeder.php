<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les rôles.',
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'viewAny role',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            1 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un rôle.',
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'view role',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            2 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un rôle.',
                'guard_name' => 'web',
                'id' => 3,
                'name' => 'create role',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            3 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un rôle.',
                'guard_name' => 'web',
                'id' => 4,
                'name' => 'update role',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            4 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un rôle.',
                'guard_name' => 'web',
                'id' => 5,
                'name' => 'delete role',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            5 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les permissions.',
                'guard_name' => 'web',
                'id' => 6,
                'name' => 'viewAny permission',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            6 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une permission.',
                'guard_name' => 'web',
                'id' => 7,
                'name' => 'view permission',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            7 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une permission.',
                'guard_name' => 'web',
                'id' => 8,
                'name' => 'create permission',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            8 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une permission.',
                'guard_name' => 'web',
                'id' => 9,
                'name' => 'update permission',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            9 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une permission.',
                'guard_name' => 'web',
                'id' => 10,
                'name' => 'delete permission',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            10 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les utilisateurs.',
                'guard_name' => 'web',
                'id' => 11,
                'name' => 'viewAny user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            11 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un utilisateur.',
                'guard_name' => 'web',
                'id' => 12,
                'name' => 'view user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            12 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un utilisateur.',
                'guard_name' => 'web',
                'id' => 13,
                'name' => 'create user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            13 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un utilisateur.',
                'guard_name' => 'web',
                'id' => 14,
                'name' => 'update user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            14 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un utilisateur.',
                'guard_name' => 'web',
                'id' => 15,
                'name' => 'delete user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            15 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut restaurer un utilisateur supprimé.',
                'guard_name' => 'web',
                'id' => 16,
                'name' => 'restore user',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            16 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les pièces détachées.',
                'guard_name' => 'web',
                'id' => 17,
                'name' => 'viewAny part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            17 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une pièce détachée.',
                'guard_name' => 'web',
                'id' => 18,
                'name' => 'view part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            18 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des pièces détachées.',
                'guard_name' => 'web',
                'id' => 19,
                'name' => 'export part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            19 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une pièce détachée.',
                'guard_name' => 'web',
                'id' => 20,
                'name' => 'create part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            20 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée.',
                'guard_name' => 'web',
                'id' => 21,
                'name' => 'update part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            21 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée.',
                'guard_name' => 'web',
                'id' => 22,
                'name' => 'delete part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            22 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut générer des QR Code pour les pièces détachées.',
                'guard_name' => 'web',
                'id' => 23,
                'name' => 'generateQrCode part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            23 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut scanner des QR Code pour les pièces détachées.',
                'guard_name' => 'web',
                'id' => 24,
                'name' => 'scanQrCode part',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            24 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les pièces détachées entrées.',
                'guard_name' => 'web',
                'id' => 25,
                'name' => 'viewAny partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            25 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une pièce détachée entrée.',
                'guard_name' => 'web',
                'id' => 26,
                'name' => 'view partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            26 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des pièces détachées entrées.',
                'guard_name' => 'web',
                'id' => 27,
                'name' => 'export partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            27 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une pièce détachée entrée.',
                'guard_name' => 'web',
                'id' => 28,
                'name' => 'create partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            28 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée entrée.',
                'guard_name' => 'web',
                'id' => 29,
                'name' => 'update partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            29 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée entrée.',
                'guard_name' => 'web',
                'id' => 30,
                'name' => 'delete partEntry',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            30 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les pièces détachées sorties.',
                'guard_name' => 'web',
                'id' => 31,
                'name' => 'viewAny partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            31 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une pièce détachée sortie.',
                'guard_name' => 'web',
                'id' => 32,
                'name' => 'view partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            32 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des pièces détachées sorties.',
                'guard_name' => 'web',
                'id' => 33,
                'name' => 'export partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            33 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une pièce détachée sortie.',
                'guard_name' => 'web',
                'id' => 34,
                'name' => 'create partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            34 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée sortie.',
                'guard_name' => 'web',
                'id' => 35,
                'name' => 'update partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            35 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée sortie.',
                'guard_name' => 'web',
                'id' => 36,
                'name' => 'delete partExit',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            36 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les maintenances.',
                'guard_name' => 'web',
                'id' => 37,
                'name' => 'viewAny maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            37 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un maintenance.',
                'guard_name' => 'web',
                'id' => 38,
                'name' => 'view maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            38 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des maintenances.',
                'guard_name' => 'web',
                'id' => 39,
                'name' => 'export maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            39 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un maintenance.',
                'guard_name' => 'web',
                'id' => 40,
                'name' => 'create maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            40 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un maintenance.',
                'guard_name' => 'web',
                'id' => 41,
                'name' => 'update maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            41 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un maintenance.',
                'guard_name' => 'web',
                'id' => 42,
                'name' => 'delete maintenance',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            42 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les matériels.',
                'guard_name' => 'web',
                'id' => 43,
                'name' => 'viewAny material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            43 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un matériel.',
                'guard_name' => 'web',
                'id' => 44,
                'name' => 'view material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            44 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des matériels.',
                'guard_name' => 'web',
                'id' => 45,
                'name' => 'export material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            45 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un matériel.',
                'guard_name' => 'web',
                'id' => 46,
                'name' => 'create material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            46 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un matériel.',
                'guard_name' => 'web',
                'id' => 47,
                'name' => 'update material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            47 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un matériel.',
                'guard_name' => 'web',
                'id' => 48,
                'name' => 'delete material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            48 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut générer des QRCode pour les matériels.',
                'guard_name' => 'web',
                'id' => 49,
                'name' => 'generateQrCode material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            49 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut scanner des QRCode pour les matériels.',
                'guard_name' => 'web',
                'id' => 50,
                'name' => 'scanQrCode material',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            50 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les entreprises.',
                'guard_name' => 'web',
                'id' => 51,
                'name' => 'viewAny company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            51 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une entreprise.',
                'guard_name' => 'web',
                'id' => 52,
                'name' => 'view company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            52 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des entreprises.',
                'guard_name' => 'web',
                'id' => 53,
                'name' => 'export company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            53 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une entreprise.',
                'guard_name' => 'web',
                'id' => 54,
                'name' => 'create company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            54 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une entreprise.',
                'guard_name' => 'web',
                'id' => 55,
                'name' => 'update company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            55 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une entreprise.',
                'guard_name' => 'web',
                'id' => 56,
                'name' => 'delete company',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            56 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les paramètres.',
                'guard_name' => 'web',
                'id' => 57,
                'name' => 'viewAny setting',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            57 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un paramètre.',
                'guard_name' => 'web',
                'id' => 58,
                'name' => 'view setting',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            58 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un paramètre.',
                'guard_name' => 'web',
                'id' => 59,
                'name' => 'create setting',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            59 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un paramètre.',
                'guard_name' => 'web',
                'id' => 60,
                'name' => 'update setting',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            60 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un paramètre.',
                'guard_name' => 'web',
                'id' => 61,
                'name' => 'delete setting',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            61 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les incidents.',
                'guard_name' => 'web',
                'id' => 62,
                'name' => 'viewAny incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            62 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un incident.',
                'guard_name' => 'web',
                'id' => 63,
                'name' => 'view incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            63 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des incidents.',
                'guard_name' => 'web',
                'id' => 64,
                'name' => 'export incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            64 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un incident.',
                'guard_name' => 'web',
                'id' => 65,
                'name' => 'create incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            65 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un incident.',
                'guard_name' => 'web',
                'id' => 66,
                'name' => 'update incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            66 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un incident.',
                'guard_name' => 'web',
                'id' => 67,
                'name' => 'delete incident',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            67 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les zones.',
                'guard_name' => 'web',
                'id' => 68,
                'name' => 'viewAny zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            68 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir une zone.',
                'guard_name' => 'web',
                'id' => 69,
                'name' => 'view zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            69 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des zones.',
                'guard_name' => 'web',
                'id' => 70,
                'name' => 'export zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            70 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer une zone.',
                'guard_name' => 'web',
                'id' => 71,
                'name' => 'create zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            71 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour une zone.',
                'guard_name' => 'web',
                'id' => 72,
                'name' => 'update zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            72 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer une zone.',
                'guard_name' => 'web',
                'id' => 73,
                'name' => 'delete zone',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            73 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les lots.',
                'guard_name' => 'web',
                'id' => 74,
                'name' => 'viewAny lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            74 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un lot.',
                'guard_name' => 'web',
                'id' => 75,
                'name' => 'view lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            75 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des lots.',
                'guard_name' => 'web',
                'id' => 76,
                'name' => 'export lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            76 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un lot.',
                'guard_name' => 'web',
                'id' => 77,
                'name' => 'create lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            77 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un lot.',
                'guard_name' => 'web',
                'id' => 78,
                'name' => 'update lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            78 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un lot.',
                'guard_name' => 'web',
                'id' => 79,
                'name' => 'delete lot',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            79 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les calendriers.',
                'guard_name' => 'web',
                'id' => 80,
                'name' => 'viewAny calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            80 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un calendrier.',
                'guard_name' => 'web',
                'id' => 81,
                'name' => 'view calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            81 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter des calendriers.',
                'guard_name' => 'web',
                'id' => 82,
                'name' => 'export calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            82 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un calendrier.',
                'guard_name' => 'web',
                'id' => 83,
                'name' => 'create calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            83 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un calendrier.',
                'guard_name' => 'web',
                'id' => 84,
                'name' => 'update calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            84 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un calendrier.',
                'guard_name' => 'web',
                'id' => 85,
                'name' => 'delete calendar',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            85 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir les nettoyages.',
                'guard_name' => 'web',
                'id' => 86,
                'name' => 'viewAny cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            86 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut voir un nettoyage.',
                'guard_name' => 'web',
                'id' => 87,
                'name' => 'view cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            87 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut exporter les nettoyages.',
                'guard_name' => 'web',
                'id' => 88,
                'name' => 'export cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            88 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut créer un nettoyage.',
                'guard_name' => 'web',
                'id' => 89,
                'name' => 'create cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            89 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut mettre à jour un nettoyage.',
                'guard_name' => 'web',
                'id' => 90,
                'name' => 'update cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
            90 => 
            array (
                'created_at' => '2023-08-15 09:46:14',
                'description' => 'L\'utilisateur peut supprimer un nettoyage.',
                'guard_name' => 'web',
                'id' => 91,
                'name' => 'delete cleaning',
                'updated_at' => '2023-08-15 09:46:14',
            ),
        ));
        
        
    }
}