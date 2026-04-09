<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AdminEtablissementController extends AbstractController
{
    #[Route('/admin/etablissements', name: 'admin_etablissement_index', methods: ['GET'])]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    #[Route('/admin/etablissements/new', name: 'admin_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etablissement);
            $entityManager->flush();

            $this->addFlash('success', 'Établissement créé avec succès.');
            return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/etablissement/new.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/admin/etablissements/{id}/edit', name: 'admin_etablissement_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Établissement modifié avec succès.');
            return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/etablissement/edit.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/admin/etablissements/{id}', name: 'admin_etablissement_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        // Page de détail d'un établissement
        return $this->render('admin/etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/admin/etablissements/{id}/delete', name: 'admin_etablissement_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $etablissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etablissement);
            $entityManager->flush();
            $this->addFlash('success', 'Établissement supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}