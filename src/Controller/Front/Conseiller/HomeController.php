<?php

namespace App\Controller\Front\Conseiller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/conseiller', name: 'app_conseiller_home')]
    public function index(): Response
    {
        return $this->render('front/conseiller/home.html.twig');
    }

    #[Route('/conseiller/dashboard', name: 'app_conseiller_dashboard')]
    #[IsGranted('ROLE_CONSEILLER')]
    public function dashboard(): Response
    {
        return $this->render('dashboard/conseiller.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
