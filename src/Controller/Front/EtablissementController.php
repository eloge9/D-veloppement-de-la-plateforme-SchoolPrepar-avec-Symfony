<?php

namespace App\Controller\Front;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissements')]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        $etablissements = $etablissementRepository->findAll();

        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/etablissements/{id}', name: 'app_etablissement_show', requirements: ['id' => '\d+'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('front/etablissement/show.html.twig', [
            'etablissement' => $etablissement
        ]);
    }
}
