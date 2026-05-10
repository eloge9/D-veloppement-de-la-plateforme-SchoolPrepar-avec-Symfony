<?php

namespace App\Controller\Front\Vitrine;

use App\Entity\Filiere;
use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'app_filieres')]
    public function index(FiliereRepository $filiereRepository): Response
    {
        $filieres = $filiereRepository->findAll();

        return $this->render('vitrine/orientation/filieres.html.twig', [
            'filieres' => $filieres
        ]);
    }

    #[Route('/filieres/{id}', name: 'app_filiere_show', requirements: ['id' => '\d+'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('vitrine/orientation/filiere_show.html.twig', [
            'filiere' => $filiere
        ]);
    }
}
