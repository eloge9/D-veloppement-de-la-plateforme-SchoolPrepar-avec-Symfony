<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function dashboard(): Response
    {
        return $this->render('dashboard/student.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/conseiller', name: 'app_conseiller')]
    #[IsGranted('ROLE_CONSEILLER')]
    public function conseiller(): Response
    {
        return $this->render('dashboard/conseiller.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function admin(): Response
    {
        return $this->render('dashboard/admin.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
