<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedCompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Toy',
                'description' => '',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Denis',
                'description' => 'Entreprise spécialisé dans le matériel de nettoyage de graine intervenant sur le nettoyeur/séparateur NS1.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kongskilde',
                'description' => '',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Olexa',
                'description' => 'Entreprise intervenant sur les presses, conditionneur, système hydraulique des presses et pompe d\'huile.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Bourgogne du Sud Maintenance',
                'description' => '',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'SGN Élec',
                'description' => 'Entreprise spécialisée dans l\'électricité industrielle.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Clextral',
                'description' => 'Entreprise intervenant sur le doseur, pré-conditionneur, l\'extrudeur, sécheur et refroidisseur.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Orreca',
                'description' => 'Entreprise spécialisée dans les process d\'ensachages et de palettisations automatisés.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'AFCE',
            'description' => 'Entreprise spécialisée dans la réalisation de salle blanche et dans les Centrale de Traitement d\'Air (CTA).',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'SoluFood',
                'description' => '',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Vit Élec',
                'description' => 'Entreprise spécialisée dans l\'électricité industrielle.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Dégottex',
                'description' => 'Entreprise spécialisé dans la maintenance mécanique, intervenant pour la maintenance des élévateurs, transporteurs à chaînes, vis etc',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Bourgogne Automatisme',
                'description' => 'Entreprise spécialisée dans la conception, réalisation de logiciel d\'automatisation pour les process industriels.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Viessmann',
                'description' => 'Entreprise spécialisé dans les chaufferies, intervenant sur les Chaudières.',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Fitech',
                'description' => 'Entreprise spécialisé dans les nettoyeurs hautes pressions',
                'created_at' => '2023-08-09 22:02:34',
                'updated_at' => '2023-08-09 22:02:34',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}