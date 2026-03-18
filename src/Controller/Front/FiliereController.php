<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'app_filieres')]
    public function index(): Response
    {
        // Données fictives des filières
        $filieres = [
            [
                'id' => 1,
                'nom' => 'Informatique',
                'description' => 'Formation complète en développement web, programmation et cybersécurité. Apprenez les langages les plus demandés du marché avec des projets concrets.',
                'duree' => '3 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Services Informatiques',
                'active' => true,
                'capacite' => '30 étudiants'
            ],
            [
                'id' => 2,
                'nom' => 'Gestion des Entreprises',
                'description' => 'Formation en management, finance, marketing et ressources humaines. Développez vos compétences en gestion avec des études de cas réels.',
                'duree' => '2 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Gestion',
                'active' => true,
                'capacite' => '25 étudiants'
            ],
            [
                'id' => 3,
                'nom' => 'Sciences de la Santé',
                'description' => 'Formation en soins infirmiers, biologie médicale et santé publique. Accédez aux métiers porteurs avec des stages pratiques.',
                'duree' => '4 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Analyses Biologiques',
                'active' => true,
                'capacite' => '20 étudiants'
            ],
            [
                'id' => 4,
                'nom' => 'Design Graphique',
                'description' => 'Maîtrisez les outils de création graphique, web design et UX/UI. Formation créative et pratique avec portfolio professionnel.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Design Graphique',
                'active' => true,
                'capacite' => '15 étudiants'
            ],
            [
                'id' => 5,
                'nom' => 'Électrotechnique',
                'description' => 'Formation en installation, maintenance et dépannage électrique. Accréditation professionnelle reconnue et certifications validées.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'CAP Électricien',
                'active' => true,
                'capacite' => '18 étudiants'
            ],
            [
                'id' => 6,
                'nom' => 'Commerce International',
                'description' => 'Formation en commerce, logistique, import-export et commerce digital. Préparez-vous aux métiers du commerce international.',
                'duree' => '3 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Commerce International',
                'active' => true,
                'capacite' => '22 étudiants'
            ],
            [
                'id' => 7,
                'nom' => 'Tourisme et Hôtellerie',
                'description' => 'Formation en gestion hôtelière, tourisme et restauration. Apprentissage pratique avec des partenaires de l\'industrie.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Hôtellerie-Restauration',
                'active' => false,
                'capacite' => '25 étudiants'
            ],
            [
                'id' => 8,
                'nom' => 'Mécanique Automobile',
                'description' => 'Formation en maintenance et réparation automobile. Technologies modernes et certifications professionnelles reconnues.',
                'duree' => '3 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Maintenance des Systèmes Mécaniques',
                'active' => true,
                'capacite' => '16 étudiants'
            ]
        ];

        return $this->render('front/filiere/index.html.twig', [
            'filieres' => $filieres
        ]);
    }

    #[Route('/filieres/{id}', name: 'app_filiere_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // Données fictives des filières avec leurs détails
        $allFilieres = [
            1 => [
                'id' => 1,
                'nom' => 'Informatique',
                'description' => 'Formation complète en développement web, programmation et cybersécurité. Apprenez les langages les plus demandés du marché avec des projets concrets et des stages en entreprise.',
                'duree' => '3 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Services Informatiques',
                'active' => true,
                'capacite' => '30 étudiants',
                'etablissements' => [
                    [
                        'id' => 1,
                        'nom' => 'École Supérieure d\'Informatique',
                        'adresse' => '123 Avenue des Technologies, 75001 Paris',
                        'telephone' => '01 42 53 67 89'
                    ],
                    [
                        'id' => 2,
                        'nom' => 'Institut Technique de Programmation',
                        'adresse' => '45 Rue du Code, 69000 Lyon',
                        'telephone' => '04 78 91 23 45'
                    ]
                ]
            ],
            2 => [
                'id' => 2,
                'nom' => 'Gestion des Entreprises',
                'description' => 'Formation en management, finance, marketing et ressources humaines. Développez vos compétences en gestion avec des études de cas réels et des missions en entreprise.',
                'duree' => '2 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Gestion',
                'active' => true,
                'capacite' => '25 étudiants',
                'etablissements' => [
                    [
                        'id' => 3,
                        'nom' => 'École de Commerce Internationale',
                        'adresse' => '200 Boulevard des Affaires, 69000 Lyon',
                        'telephone' => '04 72 34 56 78'
                    ]
                ]
            ],
            3 => [
                'id' => 3,
                'nom' => 'Sciences de la Santé',
                'description' => 'Formation en soins infirmiers, biologie médicale et santé publique. Accédez aux métiers porteurs avec des stages pratiques en milieu hospitalier.',
                'duree' => '4 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Analyses Biologiques',
                'active' => true,
                'capacite' => '20 étudiants',
                'etablissements' => [
                    [
                        'id' => 4,
                        'nom' => 'Institut de Santé Paris',
                        'adresse' => '78 Rue de la Santé, 75014 Paris',
                        'telephone' => '01 44 32 10 20'
                    ]
                ]
            ]
        ];

        // Vérifier si la filière existe
        if (!isset($allFilieres[$id])) {
            throw $this->createNotFoundException('Filière non trouvée');
        }

        $filiere = $allFilieres[$id];

        return $this->render('front/filiere/show.html.twig', [
            'filiere' => $filiere
        ]);
    }
}
