<?php

namespace App\Controller\Front\Vitrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConseillerController extends AbstractController
{
    #[Route('/conseillers', name: 'app_conseillers')]
    public function index(): Response
    {
        return $this->render('vitrine/conseillers/index.html.twig');
    }

    #[Route('/conseillers/presentation', name: 'app_conseillers_presentation')]
    public function presentation(): Response
    {
        return $this->render('vitrine/conseillers/presentation.html.twig');
    }

    #[Route('/conseillers/equipe', name: 'app_conseillers_equipe')]
    public function equipe(): Response
    {
        return $this->render('vitrine/conseillers/equipe.html.twig');
    }

    #[Route('/conseillers/{slug}', name: 'app_conseiller_show')]
    public function show(string $slug): Response
    {
        return $this->render('vitrine/conseillers/show.html.twig', [
            'slug' => $slug
        ]);
    }

    #[Route('/conseillers/specialite/{specialite}', name: 'app_conseillers_specialite')]
    public function specialite(string $specialite): Response
    {
        return $this->render('vitrine/conseillers/specialite.html.twig', [
            'specialite' => $specialite
        ]);
    }

    #[Route('/conseillers/rendez-vous', name: 'app_conseillers_rdv')]
    public function rendezVous(): Response
    {
        return $this->render('vitrine/conseillers/rendez_vous.html.twig');
    }
}
