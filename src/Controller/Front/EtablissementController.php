<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissements')]
    public function index(): Response
    {
        // Données fictives des établissements
        $etablissements = [
            [
                'id' => 1,
                'nom' => 'École Supérieure d\'Informatique',
                'description' => 'Établissement d\'excellence spécialisé en informatique et nouvelles technologies. Laboratoires modernes et corps professoral qualifié.',
                'adresse' => '123 Avenue des Technologies, 75001 Paris',
                'telephone' => '01 42 53 67 89',
                'email' => 'contact@esi-paris.fr',
                'siteWeb' => 'https://www.esi-paris.fr',
                'active' => true,
                'filieres' => [
                    ['id' => 1, 'nom' => 'Informatique'],
                    ['id' => 4, 'nom' => 'Design Graphique']
                ]
            ],
            [
                'id' => 2,
                'nom' => 'Institut Technique de Programmation',
                'description' => 'Centre de formation technique spécialisé en programmation et développement d\'applications. Approche pratique et projets réels.',
                'adresse' => '45 Rue du Code, 69000 Lyon',
                'telephone' => '04 78 91 23 45',
                'email' => 'info@itp-lyon.fr',
                'siteWeb' => 'https://www.itp-lyon.fr',
                'active' => true,
                'filieres' => [
                    ['id' => 1, 'nom' => 'Informatique']
                ]
            ],
            [
                'id' => 3,
                'nom' => 'École de Commerce Internationale',
                'description' => 'Établissement prestigieux formant les futurs leaders du commerce international et de la gestion.',
                'adresse' => '200 Boulevard des Affaires, 69000 Lyon',
                'telephone' => '04 72 34 56 78',
                'email' => 'admission@eci-lyon.fr',
                'siteWeb' => 'https://www.eci-lyon.fr',
                'active' => true,
                'filieres' => [
                    ['id' => 2, 'nom' => 'Gestion des Entreprises'],
                    ['id' => 6, 'nom' => 'Commerce International']
                ]
            ],
            [
                'id' => 4,
                'nom' => 'Institut de Santé Paris',
                'description' => 'Centre de formation médicale reconnu pour la qualité de son enseignement et ses équipements modernes.',
                'adresse' => '78 Rue de la Santé, 75014 Paris',
                'telephone' => '01 44 32 10 20',
                'email' => 'contact@isp-paris.fr',
                'siteWeb' => 'https://www.isp-paris.fr',
                'active' => true,
                'filieres' => [
                    ['id' => 3, 'nom' => 'Sciences de la Santé']
                ]
            ],
            [
                'id' => 5,
                'nom' => 'Lycée Technique Industriel',
                'description' => 'Établissement public proposant des formations techniques industrielles avec des ateliers modernes et des partenariats entreprises.',
                'adresse' => '156 Avenue de l\'Industrie, 69000 Lyon',
                'telephone' => '04 78 23 45 67',
                'email' => 'secretariat@lti-lyon.fr',
                'siteWeb' => 'https://www.lti-lyon.fr',
                'active' => true,
                'filieres' => [
                    ['id' => 5, 'nom' => 'Électrotechnique'],
                    ['id' => 8, 'nom' => 'Mécanique Automobile']
                ]
            ],
            [
                'id' => 6,
                'nom' => 'Centre Formation Tourisme',
                'description' => 'Spécialisé dans l\'hôtellerie et le tourisme avec des stages dans des établissements partenaires en Europe.',
                'adresse' => '89 Rue du Tourisme, 69000 Lyon',
                'telephone' => '04 78 91 12 34',
                'email' => 'info@cft-lyon.fr',
                'siteWeb' => 'https://www.cft-lyon.fr',
                'active' => false,
                'filieres' => [
                    ['id' => 7, 'nom' => 'Tourisme et Hôtellerie']
                ]
            ]
        ];

        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/etablissements/{id}', name: 'app_etablissement_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // donner fictif par établissement que j'ai demander a ia de me générer
        $allEtablissements = [
            1 => [
                'id' => 1,
                'nom' => 'École Supérieure d\'Informatique',
                'description' => '...',
                'adresse' => '123 Avenue des Technologies, 75001 Paris',
                'telephone' => '01 42 53 67 89',
                'email' => 'contact@esi-paris.fr',
                'siteWeb' => 'https://www.esi-paris.fr',
                'active' => true,
                'directeur' => 'Dr. Marie Dubois',
                'dateCreation' => '1985-09-15',
                'image' => 'esi-paris.jpg', // <-- ajouter ici
                'filieres' => [
                    ['id' => 1, 'nom' => 'Informatique'],
                    ['id' => 4, 'nom' => 'Design Graphique']
                ]
            ],
            2 => [
                'id' => 2,
                'nom' => 'Institut Technique de Programmation',
                'description' => '...',
                'adresse' => '45 Rue du Code, 69000 Lyon',
                'telephone' => '04 78 91 23 45',
                'email' => 'info@itp-lyon.fr',
                'siteWeb' => 'https://www.itp-lyon.fr',
                'active' => true,
                'directeur' => 'M. Jean Martin',
                'dateCreation' => '1992-03-20',
                'image' => 'itp-lyon.jpg', // <-- ajouter ici
                'filieres' => [
                    ['id' => 1, 'nom' => 'Informatique']
                ]
            ]
        ];

        if (!isset($allEtablissements[$id])) {
            throw $this->createNotFoundException('Établissement non trouvé');
        }

        $etablissement = $allEtablissements[$id];

        return $this->render('front/etablissement/show.html.twig', [
            'etablissement' => $etablissement
        ]);
    }
}
