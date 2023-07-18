<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompaniesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $companies = [
            [
                'name' => 'Toy',
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Denis',
                'description' => 'Entreprise spécialisé dans le matériel de nettoyage de graine intervenant sur le nettoyeur/séparateur NS1.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Kongskilde',
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Olexa',
                'description' => 'Entreprise intervenant sur les presses, conditionneur, système hydraulique des presses et pompe d\'huile.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bourgogne du Sud Maintenance',
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'SGN Élec',
                'description' => 'Entreprise spécialisée dans l\'électricité industrielle.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Clextral',
                'description' => 'Entreprise intervenant sur le doseur, pré-conditionneur, l\'extrudeur, sécheur et refroidisseur.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Orreca',
                'description' => 'Entreprise spécialisée dans les process d\'ensachages et de palettisations automatisés.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'AFCE',
                'description' => 'Entreprise spécialisée dans la réalisation de salle blanche et dans les Centrale de Traitement d\'Air (CTA).',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'SoluFood',
                'description' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Vit Élec',
                'description' => 'Entreprise spécialisée dans l\'électricité industrielle.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Dégottex',
                'description' => 'Entreprise spécialisé dans la maintenance mécanique, intervenant pour la maintenance des élévateurs, transporteurs à chaînes, vis etc',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bourgogne Automatisme',
                'description' => 'Entreprise spécialisée dans la conception, réalisation de logiciel d\'automatisation pour les process industriels.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Viessmann',
                'description' => 'ENtreprise spécialisé dans les chaufferies, intervenant sur les Chaudières.',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('companies')->insert($companies);
    }
}
