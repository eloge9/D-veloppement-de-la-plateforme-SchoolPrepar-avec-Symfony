<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFiliereController extends AbstractController
{
    #[Route('/admin/filieres', name: 'admin_filiere_index')]
    public function index(): Response
    {
        // Données fictives des filières pour l'administration
        $filieres = [
            [
                'id' => 1,
                'nom' => 'Informatique',
                'description' => 'Formation complète en développement web, programmation et cybersécurité. Apprenez les langages les plus demandés du marché avec des projets concrets.',
                'duree' => '3 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Services Informatiques',
                'active' => true,
                'capacite' => '30 étudiants',
                'dateCreation' => '2020-09-01'
            ],
            [
                'id' => 2,
                'nom' => 'Gestion des Entreprises',
                'description' => 'Formation en management, finance, marketing et ressources humaines. Développez vos compétences en gestion avec des études de cas réels.',
                'duree' => '2 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Gestion',
                'active' => true,
                'capacite' => '25 étudiants',
                'dateCreation' => '2020-09-01'
            ],
            [
                'id' => 3,
                'nom' => 'Sciences de la Santé',
                'description' => 'Formation en soins infirmiers, biologie médicale et santé publique. Accédez aux métiers porteurs avec des stages pratiques.',
                'duree' => '4 ans',
                'niveau' => 'Bac+2',
                'diplome' => 'BTS Analyses Biologiques',
                'active' => true,
                'capacite' => '20 étudiants',
                'dateCreation' => '2021-01-15'
            ],
            [
                'id' => 4,
                'nom' => 'Design Graphique',
                'description' => 'Maîtrisez les outils de création graphique, web design et UX/UI. Formation créative et pratique avec portfolio professionnel.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Design Graphique',
                'active' => true,
                'capacite' => '15 étudiants',
                'dateCreation' => '2021-02-10'
            ],
            [
                'id' => 5,
                'nom' => 'Électrotechnique',
                'description' => 'Formation en installation, maintenance et dépannage électrique. Accréditation professionnelle reconnue et certifications validées.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'CAP Électricien',
                'active' => true,
                'capacite' => '18 étudiants',
                'dateCreation' => '2020-10-05'
            ],
            [
                'id' => 6,
                'nom' => 'Commerce International',
                'description' => 'Formation en commerce, logistique, import-export et commerce digital. Préparez-vous aux métiers du commerce international.',
                'duree' => '3 ans',
                'niveau' => 'Bac+1',
                'diplome' => 'BTS Commerce International',
                'active' => true,
                'capacite' => '22 étudiants',
                'dateCreation' => '2021-03-20'
            ],
            [
                'id' => 7,
                'nom' => 'Tourisme et Hôtellerie',
                'description' => 'Formation en gestion hôtelière, tourisme et restauration. Apprentissage pratique avec des partenaires de l\'industrie.',
                'duree' => '2 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Hôtellerie-Restauration',
                'active' => false,
                'capacite' => '25 étudiants',
                'dateCreation' => '2022-01-10'
            ],
            [
                'id' => 8,
                'nom' => 'Mécanique Automobile',
                'description' => 'Formation en maintenance et réparation automobile. Technologies modernes et certifications professionnelles reconnues.',
                'duree' => '3 ans',
                'niveau' => 'Bac',
                'diplome' => 'BTS Maintenance des Systèmes Mécaniques',
                'active' => true,
                'capacite' => '16 étudiants',
                'dateCreation' => '2021-09-15'
            ]
        ];

        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filieres
        ]);
    }

    #[Route('/admin/filieres/new', name: 'admin_filiere_new')]
    public function new(): Response
    {
        // Page de création d'une nouvelle filière
        return $this->render('admin/filiere/new.html.twig');
    }

    #[Route('/admin/filieres/{id}/edit', name: 'admin_filiere_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id): Response
    {
        // Page d'édition d'une filière existante
        return $this->render('admin/filiere/edit.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/admin/filieres/{id}', name: 'admin_filiere_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // Page de détail d'une filière
        return $this->render('admin/filiere/show.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/admin/filieres/{id}/delete', name: 'admin_filiere_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(int $id): Response
    {
        // Logique de suppression (simulation)
        // Dans un vrai projet, vous ajouteriez la logique de suppression ici

        $this->addFlash('success', 'La filière a été supprimée avec succès.');

        return $this->redirectToRoute('admin_filiere_index');
    }
}
