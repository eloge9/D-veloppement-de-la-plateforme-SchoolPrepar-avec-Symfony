<?php

namespace App\Controller\Front\Vitrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(): Response
    {
        return $this->render('front/vitrine/avis/index.html.twig');
    }

    #[Route('/avis/eleves', name: 'app_avis_eleves')]
    public function eleves(): Response
    {
        return $this->render('front/vitrine/avis/eleves.html.twig');
    }

    #[Route('/avis/conseillers', name: 'app_avis_conseillers')]
    public function conseillers(): Response
    {
        return $this->render('front/vitrine/avis/conseillers.html.twig');
    }

    #[Route('/avis/etablissements', name: 'app_avis_etablissements')]
    public function etablissements(): Response
    {
        return $this->render('front/vitrine/avis/etablissements.html.twig');
    }

    #[Route('/avis/filieres/{id}', name: 'app_avis_filiere', requirements: ['id' => '\d+'])]
    public function filiere(int $id): Response
    {
        return $this->render('front/vitrine/avis/filiere.html.twig', [
            'filiereId' => $id
        ]);
    }

    #[Route('/avis/ajouter', name: 'app_avis_ajouter')]
    #[IsGranted('ROLE_USER')]
    public function ajouter(): Response
    {
        return $this->render('front/vitrine/avis/ajouter.html.twig');
    }

    #[Route('/avis/ajouter/submit', name: 'app_avis_ajouter_submit', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function submit(Request $request): Response
    {
        $this->addFlash('success', 'Votre avis a été ajouté avec succès!');
        return $this->redirectToRoute('app_avis');
    }

    #[Route('/avis/{slug}', name: 'app_avis_show')]
    public function show(string $slug): Response
    {
        return $this->render('front/vitrine/avis/show.html.twig', [
            'slug' => $slug
        ]);
    }
}
