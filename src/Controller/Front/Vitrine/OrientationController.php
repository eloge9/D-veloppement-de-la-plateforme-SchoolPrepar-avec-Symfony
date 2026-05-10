<?php

namespace App\Controller\Front\Vitrine;

use App\Entity\Filiere;
use App\Repository\FiliereRepository;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrientationController extends AbstractController
{
    #[Route('/orientation', name: 'app_orientation')]
    public function index(FiliereRepository $filiereRepository, EtablissementRepository $etablissementRepository): Response
    {
        $filieres = $filiereRepository->findAll();
        $etablissements = $etablissementRepository->findAll();

        return $this->render('front/vitrine/orientation/index.html.twig', [
            'filieres' => $filieres,
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/orientation/filieres', name: 'app_orientation_filieres')]
    public function filieres(FiliereRepository $filiereRepository): Response
    {
        $filieres = $filiereRepository->findAll();

        return $this->render('front/vitrine/orientation/filieres.html.twig', [
            'filieres' => $filieres
        ]);
    }

    #[Route('/orientation/filieres/{id}', name: 'app_orientation_filiere_show', requirements: ['id' => '\d+'])]
    public function showFiliere(Filiere $filiere): Response
    {
        return $this->render('front/vitrine/orientation/filiere_show.html.twig', [
            'filiere' => $filiere
        ]);
    }

    #[Route('/orientation/etablissements', name: 'app_orientation_etablissements')]
    public function etablissements(EtablissementRepository $etablissementRepository): Response
    {
        $etablissements = $etablissementRepository->findAll();

        return $this->render('front/vitrine/orientation/etablissements.html.twig', [
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/orientation/conseils', name: 'app_orientation_conseils')]
    public function conseils(): Response
    {
        return $this->render('front/vitrine/orientation/conseils.html.twig');
    }

    #[Route('/orientation/methode', name: 'app_orientation_methode')]
    public function methode(): Response
    {
        return $this->render('front/vitrine/orientation/methode.html.twig');
    }
}
