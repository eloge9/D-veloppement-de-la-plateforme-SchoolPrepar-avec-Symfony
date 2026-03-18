<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEtablissementController extends AbstractController
{
    #[Route('/admin/etablissements', name: 'admin_etablissement_index')]
    public function index(): Response
    {
        // Données fictives des établissements pour l'administration
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
                'directeur' => 'Dr. Marie Dubois',
                'dateCreation' => '1985-09-15',
                'filieresCount' => 2
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
                'directeur' => 'M. Jean Martin',
                'dateCreation' => '1992-03-20',
                'filieresCount' => 1
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
                'directeur' => 'Mme. Sophie Laurent',
                'dateCreation' => '1988-06-10',
                'filieresCount' => 2
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
                'directeur' => 'Dr. Pierre Durand',
                'dateCreation' => '1990-11-25',
                'filieresCount' => 1
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
                'directeur' => 'M. Robert Bernard',
                'dateCreation' => '1975-03-12',
                'filieresCount' => 2
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
                'directeur' => 'Mme. Claire Petit',
                'dateCreation' => '2005-02-18',
                'filieresCount' => 1
            ]
        ];

        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/admin/etablissements/new', name: 'admin_etablissement_new')]
    public function new(): Response
    {
        // Page de création d'un nouvel établissement
        return $this->render('admin/etablissement/new.html.twig');
    }

    #[Route('/admin/etablissements/{id}/edit', name: 'admin_etablissement_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id): Response
    {
        // Page d'édition d'un établissement existant
        return $this->render('admin/etablissement/edit.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/admin/etablissements/{id}', name: 'admin_etablissement_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        // Page de détail d'un établissement
        return $this->render('admin/etablissement/show.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/admin/etablissements/{id}/delete', name: 'admin_etablissement_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(int $id): Response
    {
        // Logique de suppression (simulation)
        // Dans un vrai projet, vous ajouteriez la logique de suppression ici

        $this->addFlash('success', 'L\'établissement a été supprimé avec succès.');

        return $this->redirectToRoute('admin_etablissement_index');
    }
}
