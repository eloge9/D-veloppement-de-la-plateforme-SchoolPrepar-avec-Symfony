<?php

namespace App\Controller\Front\Eleve;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/eleve', name: 'app_eleve_home')]
    public function index(): Response
    {
        return $this->render('front/eleve/home.html.twig');
    }

    #[Route('/eleve/dashboard', name: 'app_eleve_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function dashboard(): Response
    {
        return $this->render('front/eleve/dashboard.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
