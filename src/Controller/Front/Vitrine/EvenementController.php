<?php

namespace App\Controller\Front\Vitrine;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EvenementController extends AbstractController
{
    #[Route('/evenements', name: 'app_evenements')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findAll();

        return $this->render('vitrine/evenements/index.html.twig', [
            'evenements' => $evenements
        ]);
    }

    #[Route('/evenements/avenir', name: 'app_evenements_avenir')]
    public function avenir(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findUpcoming();

        return $this->render('vitrine/evenements/avenir.html.twig', [
            'evenements' => $evenements
        ]);
    }

    #[Route('/evenements/passes', name: 'app_evenements_passes')]
    public function passes(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findPast();

        return $this->render('vitrine/evenements/passes.html.twig', [
            'evenements' => $evenements
        ]);
    }

    #[Route('/evenements/{id}', name: 'app_evenement_show', requirements: ['id' => '\d+'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('vitrine/evenements/show.html.twig', [
            'evenement' => $evenement
        ]);
    }

    #[Route('/evenements/categorie/{categorie}', name: 'app_evenements_categorie')]
    public function categorie(string $categorie, EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findByCategory($categorie);

        return $this->render('vitrine/evenements/categorie.html.twig', [
            'categorie' => $categorie,
            'evenements' => $evenements
        ]);
    }

    #[Route('/evenements/inscription/{id}', name: 'app_evenement_inscription')]
    #[IsGranted('ROLE_USER')]
    public function inscription(Evenement $evenement): Response
    {
        return $this->render('vitrine/evenements/inscription.html.twig', [
            'evenement' => $evenement
        ]);
    }

    #[Route('/evenements/inscription/submit/{id}', name: 'app_evenement_inscription_submit', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function submitInscription(Evenement $evenement, Request $request): Response
    {
        $this->addFlash('success', 'Votre inscription à l\'événement a été confirmée!');
        return $this->redirectToRoute('app_evenement_show', ['id' => $evenement->getId()]);
    }
}
