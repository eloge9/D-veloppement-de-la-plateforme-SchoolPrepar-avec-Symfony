<?php

namespace App\Controller\Front\Vitrine;

use App\Entity\Filiere;
use App\Entity\Etablissement;
use App\Repository\FiliereRepository;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FiliereRepository $filiereRepository, EtablissementRepository $etablissementRepository): Response
    {
        $filieres = $filiereRepository->findAll();
        $etablissements = $etablissementRepository->findAll();

        return $this->render('front/home.html.twig', [
            'filieres' => $filieres,
            'etablissements' => $etablissements
        ]);
    }
}
