<?php

namespace App\Controller\Front\Etablissement;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/etablissement', name: 'app_etablissement_home')]
    public function index(): Response
    {
        return $this->render('front/etablissement/home.html.twig');
    }

    #[Route('/etablissement/dashboard', name: 'app_etablissement_dashboard')]
    #[IsGranted('ROLE_ETABLISSEMENT')]
    public function dashboard(): Response
    {
        return $this->render('front/etablissement/dashboard.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
