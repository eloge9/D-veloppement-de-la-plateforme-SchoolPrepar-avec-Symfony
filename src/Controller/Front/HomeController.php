<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Données fictives pour la démonstration
        $filieres = [
            [
                'id' => 1,
                'nom' => 'Informatique',
                'description' => 'Formation complète en développement web, programmation et cybersécurité. Apprenez les langages les plus demandés du marché.',
                'duree' => '3 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Services Informatiques',
                'active' => true
            ],
            [
                'id' => 2,
                'nom' => 'Gestion des Entreprises',
                'description' => 'Formation en management, finance, marketing et ressources humaines. Développez vos compétences en gestion.',
                'duree' => '2 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Gestion',
                'active' => true
            ],
            [
                'id' => 3,
                'nom' => 'Sciences de la Santé',
                'description' => 'Formation en soins infirmiers, biologie médicale et santé publique. Accédez aux métiers de la santé.',
                'duree' => '4 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Analyses Biologiques',
                'active' => true
            ],
            [
                'id' => 4,
                'nom' => 'Design Graphique',
                'description' => 'Maîtrisez les outils de création graphique, web design et UX/UI. Formation créative et pratique.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Design Graphique',
                'active' => true
            ],
            [
                'id' => 5,
                'nom' => 'Électrotechnique',
                'description' => 'Formation en installation, maintenance et dépannage électrique. Accréditation professionnelle reconnue.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'CAP Électricien',
                'active' => true
            ],
            [
                'id' => 6,
                'nom' => 'Commerce International',
                'description' => 'Formation en commerce, logistique, import-export et commerce digital. Préparez-vous aux métiers du commerce.',
                'duree' => '3 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Commerce International',
                'active' => true
            ]
        ];

        return $this->render('front/home.html.twig', [
            'filieres' => $filieres
        ]);
    }
}
