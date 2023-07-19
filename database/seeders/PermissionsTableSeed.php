<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'viewAny role',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les rôles.'
            ],
            [
                'name' => 'view role',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un rôle.'
            ],
            [
                'name' => 'create role',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un rôle.'
            ],
            [
                'name' => 'update role',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un rôle.'
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un rôle.'
            ],
            [
                'name' => 'viewAny user',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les utilisateurs.'
            ],
            [
                'name' => 'view user',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un utilisateur.'
            ],
            [
                'name' => 'create user',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un utilisateur.'
            ],
            [
                'name' => 'update user',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un utilisateur.'
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un utilisateur.'
            ],
            [
                'name' => 'viewAny part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les pièces détachées.'
            ],
            [
                'name' => 'view part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir une pièce détachée.'
            ],
            [
                'name' => 'export part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des pièces détachées.'
            ],
            [
                'name' => 'create part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer une pièce détachée.'
            ],
            [
                'name' => 'update part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée.'
            ],
            [
                'name' => 'delete part',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée.'
            ],
            [
                'name' => 'viewAny partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les pièces détachées entrées.'
            ],
            [
                'name' => 'view partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir une pièce détachée entrée.'
            ],
            [
                'name' => 'export partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des pièces détachées entrées.'
            ],
            [
                'name' => 'create partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer une pièce détachée entrée.'
            ],
            [
                'name' => 'update partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée entrée.'
            ],
            [
                'name' => 'delete partEntry',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée entrée.'
            ],
            [
                'name' => 'viewAny partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les pièces détachées sorties.'
            ],
            [
                'name' => 'view partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir une pièce détachée sortie.'
            ],
            [
                'name' => 'export partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des pièces détachées sorties.'
            ],
            [
                'name' => 'create partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer une pièce détachée sortie.'
            ],
            [
                'name' => 'update partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour une pièce détachée sortie.'
            ],
            [
                'name' => 'delete partExit',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer une pièce détachée sortie.'
            ],
            [
                'name' => 'viewAny maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les maintenances.'
            ],
            [
                'name' => 'view maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un maintenance.'
            ],
            [
                'name' => 'export maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des maintenances.'
            ],
            [
                'name' => 'create maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un maintenance.'
            ],
            [
                'name' => 'update maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un maintenance.'
            ],
            [
                'name' => 'delete maintenance',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un maintenance.'
            ],
            [
                'name' => 'viewAny material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les matériels.'
            ],
            [
                'name' => 'view material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un matériel.'
            ],
            [
                'name' => 'export material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des matériels.'
            ],
            [
                'name' => 'create material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un matériel.'
            ],
            [
                'name' => 'update material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un matériel.'
            ],
            [
                'name' => 'delete material',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un matériel.'
            ],
            [
                'name' => 'viewAny company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les entreprises.'
            ],
            [
                'name' => 'view company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir une entreprise.'
            ],
            [
                'name' => 'export company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des entreprises.'
            ],
            [
                'name' => 'create company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer une entreprise.'
            ],
            [
                'name' => 'update company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour une entreprise.'
            ],
            [
                'name' => 'delete company',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer une entreprise.'
            ],
            [
                'name' => 'viewAny setting',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les paramètres.'
            ],
            [
                'name' => 'view setting',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un paramètre.'
            ],
            [
                'name' => 'create setting',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un paramètre.'
            ],
            [
                'name' => 'update setting',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un paramètre.'
            ],
            [
                'name' => 'delete setting',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un paramètre.'
            ],
            [
                'name' => 'viewAny incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les incidents.'
            ],
            [
                'name' => 'view incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un incident.'
            ],
            [
                'name' => 'export incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des incidents.'
            ],
            [
                'name' => 'create incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un incident.'
            ],
            [
                'name' => 'update incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un incident.'
            ],
            [
                'name' => 'delete incident',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un incident.'
            ],
            [
                'name' => 'viewAny zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les zones.'
            ],
            [
                'name' => 'view zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir une zone.'
            ],
            [
                'name' => 'export zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des zones.'
            ],
            [
                'name' => 'create zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer une zone.'
            ],
            [
                'name' => 'update zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour une zone.'
            ],
            [
                'name' => 'delete zone',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer une zone.'
            ],
            [
                'name' => 'viewAny lot',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir les lots.'
            ],
            [
                'name' => 'view lot',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut voir un lot.'
            ],
            [
                'name' => 'export lot',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut exporter des lots.'
            ],
            [
                'name' => 'create lot',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut créer un lot.'
            ],
            [
                'name' => 'update lot',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut mettre à jour un lot.'
            ],
            [
                'name' => 'delete lot',
                'guard_name' => 'web',
                'guard_name' => 'web',
                'description' => 'L\'utilisateur peut supprimer un lot.'
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
