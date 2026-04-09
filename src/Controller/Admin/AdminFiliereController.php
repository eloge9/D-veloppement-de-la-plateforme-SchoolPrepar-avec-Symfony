<?php

namespace App\Controller\Admin;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminFiliereController extends AbstractController
{
    #[Route('/admin/filieres', name: 'admin_filiere_index', methods: ['GET'])]
    public function index(FiliereRepository $filiereRepository): Response
    {
        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filiereRepository->findAll(),
        ]);
    }

    #[Route('/admin/filieres/new', name: 'admin_filiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filiere);
            $entityManager->flush();

            $this->addFlash('success', 'Filière créée avec succès.');
            return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/admin/filieres/{id}/edit', name: 'admin_filiere_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Filière modifiée avec succès.');
            return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/filiere/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/admin/filieres/{id}', name: 'admin_filiere_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('admin/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/admin/filieres/{id}/delete', name: 'admin_filiere_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $filiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La filière a été supprimée avec succès.');

        return $this->redirectToRoute('admin_filiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
