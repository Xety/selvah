<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaterialsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $materials = [
            [
                'user_id' => 1,
                'name' => 'BMP1',
                'slug' => Str::slug('BMP1'),
                'description' => 'Boisseau de farine extérieur n°1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BMP2',
                'slug' => Str::slug('BMP2'),
                'description' => 'Boisseau de farine extérieur n°2.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VMP1',
                'slug' => Str::slug('VMP1'),
                'description' => 'Vis matière première sous boisseau BMP1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VMP2',
                'slug' => Str::slug('VMP2'),
                'description' => 'Vis matière première sous boisseau BMP2.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ELP1',
                'slug' => Str::slug('ELP1'),
                'description' => 'Élévateur à palle avant EMT1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'EMT1',
                'slug' => Str::slug('EMT1'),
                'description' => 'Émietteur servant à casser la graine de soja.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ASPNS1',
                'slug' => Str::slug('ASPNS1'),
                'description' => 'Aspiration du nettoyeur/séparateur de graines servant' .
                ' à aspirer les coques séparées de la graine.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'NS1B1',
                'slug' => Str::slug('NS1B1'),
                'description' => 'Vibrant n°1 du nettoyeur/séparateur servant à faire vibrer les grilles.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'NS1B2',
                'slug' => Str::slug('NS1B2'),
                'description' => 'Vibrant n°2 du nettoyeur/séparateur servant à faire vibrer les grilles.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'NS1V',
                'slug' => Str::slug('NS1V'),
                'description' => 'Vis du nettoyeur/séparateur servant à faire évacuer les coques aspirées.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL1',
                'slug' => Str::slug('ECL1'),
                'description' => 'Écluse servant pour l\'aspiration du NS1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BRC',
                'slug' => Str::slug('BRC'),
                'description' => 'Broyeur à coques servant à broyer les coques et les' .
                ' souffler dans le boisseau à coque BC1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BC1',
                'slug' => Str::slug('BC1'),
                'description' => 'Boisseau à coque servant à stocker les coques broyées.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'SO1',
                'slug' => Str::slug('SO1'),
                'description' => 'Souffleur servant à souffler la graine broyeur dans le conditionneur.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL2',
                'slug' => Str::slug('ECL2'),
                'description' => 'Écluse servant pour le souffleur n°1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CV1',
                'slug' => Str::slug('CV1'),
                'description' => 'Conditionneur servant à chauffer la graine de soja.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'EXT1',
                'slug' => Str::slug('EXT1'),
                'description' => 'Extracteur d\'air servant à ventiler les plateaux du conditionneur.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'PV1',
                'slug' => Str::slug('PV1'),
                'description' => 'Panoplie vapeur du conditionneur.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VM1',
                'slug' => Str::slug('VM1'),
                'description' => 'Vis sous conditionneur servant à transporter la graine chaude.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'EL2',
                'slug' => Str::slug('EL2'),
                'description' => 'Élévateur à godet servant à alimenter le transporteur à chaîne TCM1.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'TCM1',
                'slug' => Str::slug('TCM1'),
                'description' => 'Transporteur à chaîne servant à distribuer les presses.',
                'zone_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T1TCM1',
                'slug' => Str::slug('T1TCM1'),
                'description' => 'Trappe à air comprimé n°1 servant à remplir la trémie de la presse 1.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T2TCM1',
                'slug' => Str::slug('T2TCM1'),
                'description' => 'Trappe à air comprimé n°2 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T3TCM1',
                'slug' => Str::slug('T3TCM1'),
                'description' => 'Trappe à air comprimé n°3 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T4TCM1',
                'slug' => Str::slug('T4TCM1'),
                'description' => 'Trappe à air comprimé n°4 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T5TCM1',
                'slug' => Str::slug('T5TCM1'),
                'description' => 'Trappe à air comprimé n°5 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T6TCM1',
                'slug' => Str::slug('T6TCM1'),
                'description' => 'Trappe à air comprimé n°6 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T7TCM1',
                'slug' => Str::slug('T7TCM1'),
                'description' => 'Trappe à air comprimé n°7 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T8TCM1',
                'slug' => Str::slug('T8TCM1'),
                'description' => 'Trappe à air comprimé n°8 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T9TCM1',
                'slug' => Str::slug('T9TCM1'),
                'description' => 'Trappe à air comprimé n°9 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'T10TCM1',
                'slug' => Str::slug('T10TCM1'),
                'description' => 'Trappe à air comprimé n°10 servant à remplir la trémie de la presse 2.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD1',
                'slug' => Str::slug('VD1'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD2',
                'slug' => Str::slug('VD2'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD3',
                'slug' => Str::slug('VD3'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD4',
                'slug' => Str::slug('VD4'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD5',
                'slug' => Str::slug('VD5'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD6',
                'slug' => Str::slug('VD6'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD7',
                'slug' => Str::slug('VD7'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD8',
                'slug' => Str::slug('VD8'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD9',
                'slug' => Str::slug('VD9'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VD10',
                'slug' => Str::slug('VD10'),
                'description' => 'Vis distributrice servant à alimenter la presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P1',
                'slug' => Str::slug('P1'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P2',
                'slug' => Str::slug('P2'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P3',
                'slug' => Str::slug('P3'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P4',
                'slug' => Str::slug('P4'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P5',
                'slug' => Str::slug('P5'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P6',
                'slug' => Str::slug('P6'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P7',
                'slug' => Str::slug('P7'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P8',
                'slug' => Str::slug('P8'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P9',
                'slug' => Str::slug('P9'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'P10',
                'slug' => Str::slug('P10'),
                'description' => 'Presse.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CHY1',
                'slug' => Str::slug('CHY1'),
                'description' => 'Groupe hydraulique servant pour les nez de presse 1 à 7.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CHY2',
                'slug' => Str::slug('CHY2'),
                'description' => 'Groupe hydraulique servant pour les nez de presse 8 à 10.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VH1',
                'slug' => Str::slug('VH1'),
                'description' => 'Vis d\'huile servant à transporter l\'huile des presse 1 à 7 à la pompe.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VH2',
                'slug' => Str::slug('VH2'),
                'description' => 'Vis d\'huile servant à transporter l\'huile des presse 8 à 10 à la pompe.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'PPH1',
                'slug' => Str::slug('PPH1'),
                'description' => 'Pompe à huile servant à emmener l\'huile dans la cuve.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'AGT1',
                'slug' => Str::slug('AGT1'),
                'description' => 'Agitateur servant à homogénéiser l\'huile dans la cuve.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CHH',
                'slug' => Str::slug('CHH'),
                'description' => 'Cuve d\'huile.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'FP1',
                'slug' => Str::slug('FP1'),
                'description' => 'Filtres plateaux horizontaux servant à filtrer l\'huile.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'DEB1',
                'slug' => Str::slug('DEB1'),
                'description' => 'Débitmètre servant à mesurer la quantité d\'huile filtrée.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'TCI1',
                'slug' => Str::slug('TCI1'),
                'description' => 'Transporteur à chaîne incliné servant à transporter le tourteaux dans le concasseur.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'C1',
                'slug' => Str::slug('C1'),
                'description' => 'Concasseur servant à concasser les tourteaux en petits morceaux.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL4',
                'slug' => Str::slug('ECL4'),
                'description' => 'Écluse servant pour le concasseur.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'REF1',
                'slug' => Str::slug('REF1'),
                'description' => 'Ventilateur du refroidisseur servant à refroidir les tourteaux.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'EV REF1',
                'slug' => Str::slug('EV REF1'),
                'description' => 'Trappe à air comprimé servant à vidanger le refroidisseur.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL3',
                'slug' => Str::slug('ECL3'),
                'description' => 'Écluse servant pour le refroidisseur.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VT1',
                'slug' => Str::slug('VT1'),
                'description' => 'Vis servant à transporter le tourteaux au broyeur.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BRT1',
                'slug' => Str::slug('BRT1'),
                'description' => 'Broyeur à marteaux servant à broyer le tourteaux en farine.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ELP3',
                'slug' => Str::slug('ELP3'),
                'description' => 'Élévateur à palle servant à monter la farine dans le boisseau.',
                'zone_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BTF1',
                'slug' => Str::slug('BTF1'),
                'description' => 'Boisseau de farine de soja.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'FV1',
                'slug' => Str::slug('FV1'),
                'description' => 'Fond vibrant du boisseau BTF1',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VF1',
                'slug' => Str::slug('VF1'),
                'description' => 'Vis servant à transporter la farine dans le doseur de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P31 Doseur',
                'slug' => Str::slug('P31 Doseur'),
                'description' => 'Doseur de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P32 By-pass Pré-conditionneur',
                'slug' => Str::slug('P32 By-pass'),
                'description' => 'By-pass du pré-conditionneur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P33 Pré-conditionneur',
                'slug' => Str::slug('P33 Pré-conditionneur'),
                'description' => 'Pré-conditionneur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P34 Panoplie Vapeur',
                'slug' => Str::slug('P34 PanoplieVapeur'),
                'description' => 'Panoplie Vapeur du pré-conditionneur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P35 Pompe Eau Pré-conditionneur',
                'slug' => Str::slug('P35 PompeEau'),
                'description' => 'Pompe à eau du pré-conditionneur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P36 Pompe Eau Extrudeur',
                'slug' => Str::slug('P36 PompeEau'),
                'description' => 'Pompe à eau de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT Moteur vis',
                'slug' => Str::slug('Moteur vis extrudeur'),
                'description' => 'Moteur/vis de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT Fourreaux',
                'slug' => Str::slug('Fourreaux extrudeur'),
                'description' => 'Fourreaux de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P38 Couteau',
                'slug' => Str::slug('P38 Couteau'),
                'description' => 'Couteau de l\'extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P39 Convoyeur Pneumatique',
                'slug' => Str::slug('P39 Convoyeur Pneumatique'),
                'description' => 'Convoyeur pneumatique sortie extrudeur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P40 By-pass vibrant',
                'slug' => Str::slug('P40 By-pass'),
                'description' => 'By-pass entrée sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT P41 Tapis Vibrant',
                'slug' => Str::slug('P41 Tapis Vibrant'),
                'description' => 'By-pass entrée sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M11 Tapis',
                'slug' => Str::slug('M11 Tapis'),
                'description' => 'Tapis du sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT Z1 Chauffage',
                'slug' => Str::slug('Z1 Chauffage'),
                'description' => 'Chauffage du sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M31 Ventilateur',
                'slug' => Str::slug('M31 Ventilateur'),
                'description' => 'Ventilateur du sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M32 Ventilateur',
                'slug' => Str::slug('M32 Ventilateur'),
                'description' => 'Ventilateur du sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M41 Extracteur d\'Air',
                'slug' => Str::slug('M41 Extracteur air'),
                'description' => 'Extracteur d\'air du sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M51 Convoyeur',
                'slug' => Str::slug('M51 Convoyeur'),
                'description' => 'Convoyeur sortie sécheur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M52 Élévateur',
                'slug' => Str::slug('M52 Élévateur'),
                'description' => 'Élévateur sortie sécheur servant à emmener le produit dans le refroidisseur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M53A Convoyeur Refroidisseur',
                'slug' => Str::slug('M53A Convoyeur'),
                'description' => 'Convoyeur servant à transporter le produit à l\'intérieur du refroidisseur.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M53B Ventilateur Refroidisseur',
                'slug' => Str::slug('M53B Ventilateur'),
                'description' => 'Ventilateur servant à refroidir le produit.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'CXT M53C Ventilateur Refroidisseur',
                'slug' => Str::slug('M53C Ventilateur'),
                'description' => 'Ventilateur servant à refroidir le produit.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'SO2',
                'slug' => Str::slug('SO2'),
                'description' => 'Souffleur servant à emmener le produit sortie refroidisseur vers boisseaux.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BD2',
                'slug' => Str::slug('BD2'),
                'description' => 'Boite directionnelle servant à orienter le produit' .
                ' vers les boisseaux ou la station de remplissage Big-Bag.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BD1',
                'slug' => Str::slug('BD1'),
                'description' => 'Boite directionnelle servant à orienter le produit' .
                ' vers le boisseau BTF1 ou BTF2.',
                'zone_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Trémie Tampon',
                'slug' => Str::slug('Trémie Tampon'),
                'description' => 'Trémie tampon du recyclage des fines.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'M1A',
                'slug' => Str::slug('M1A'),
                'description' => 'Vis de vidange de la trémie tampon.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'M1B',
                'slug' => Str::slug('M1B'),
                'description' => 'Dévouteur de la trémie tampon.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'M1C',
                'slug' => Str::slug('M1C'),
                'description' => 'Vis de transfert entre les 2 trémies.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Trémie Doseuse',
                'slug' => Str::slug('Trémie Doseuse'),
                'description' => 'Trémie doseuse du recyclage des fines.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'M2A',
                'slug' => Str::slug('M2A'),
                'description' => 'Vis doseuse de la trémie doseuse.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'M2B',
                'slug' => Str::slug('M2B'),
                'description' => 'Dévouteur de la trémie doseuse.',
                'zone_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BPF1',
                'slug' => Str::slug('BPF1'),
                'description' => 'Boisseau de produit fini 1.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'BPF2',
                'slug' => Str::slug('BPF2'),
                'description' => 'Boisseau de produit fini 2.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'FV2',
                'slug' => Str::slug('FV2'),
                'description' => 'Fond vibrant du boisseau BPF1.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'FV3',
                'slug' => Str::slug('FV3'),
                'description' => 'Fond vibrant du boisseau BPF2.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VPF1',
                'slug' => Str::slug('VPF1'),
                'description' => 'Vis vidange du boisseau BPF1.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VPF2',
                'slug' => Str::slug('VPF2'),
                'description' => 'Vis vidange du boisseau BPF2.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'SO3',
                'slug' => Str::slug('SO3'),
                'description' => 'Souffleur servant à pousser le produit dans la trémie de l\'ensacheuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL5',
                'slug' => Str::slug('ECL5'),
                'description' => 'Écluse servant pour le souffleur SO3.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Ensacheuse',
                'slug' => Str::slug('Ensacheuse'),
                'description' => 'Ensacheuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Tricoteuse',
                'slug' => Str::slug('Tricoteuse'),
                'description' => 'Tricoteuse de l\'ensacheuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Détecteur aimant Ensacheuse',
                'slug' => Str::slug('détecteur Aimant Ensacheuse'),
                'description' => 'Détecteur aimant de l\'ensacheuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Étiqueteuse Ensacheuse',
                'slug' => Str::slug('Étiqueteuse Ensacheuse'),
                'description' => 'Détecteur aimant de l\'ensacheuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Palettiseur',
                'slug' => Str::slug('Palettiseur'),
                'description' => 'Palettiseur.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'Filmeuse',
                'slug' => Str::slug('Filmeuse'),
                'description' => 'Filmeuse.',
                'zone_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'DOS1',
                'slug' => Str::slug('DOS1'),
                'description' => 'Doseur de la station de vidange BB.',
                'zone_id' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'DV1',
                'slug' => Str::slug('DV1'),
                'description' => 'Dévouteur de la station de vidange BB.',
                'zone_id' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VBB1',
                'slug' => Str::slug('VBB1'),
                'description' => 'Vis de transfert de la station de vidange BB.',
                'zone_id' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'ECL6',
                'slug' => Str::slug('ECL6'),
                'description' => 'Écluse servant pour le SO2 lors de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'SEP1 Séparateur/Aimant',
                'slug' => Str::slug('SEP1'),
                'description' => 'Séparateur/Aimant de la station de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'FV4',
                'slug' => Str::slug('FV4'),
                'description' => 'Fond vibrant de la trémie de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VSO4',
                'slug' => Str::slug('VSO4'),
                'description' => 'Trappe du souffleur de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'SO4',
                'slug' => Str::slug('SO4'),
                'description' => 'Souffleur de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'name' => 'VG1',
                'slug' => Str::slug('VG1'),
                'description' => 'Trappe doseuse de trémie de remplissage BB.',
                'zone_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('materials')->insert($materials);
    }
}
