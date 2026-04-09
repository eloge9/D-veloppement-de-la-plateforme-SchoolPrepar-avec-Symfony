<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminUserController extends AbstractController
{
    #[Route('/admin/utilisateurs', name: 'admin_utilisateur_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('admin/utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
            'current_role' => null,
        ]);
    }

    #[Route('/admin/utilisateurs/role/{role}', name: 'admin_utilisateur_by_role', methods: ['GET'])]
    public function indexByRole(UtilisateurRepository $utilisateurRepository, string $role): Response
    {
        $utilisateurs = $utilisateurRepository->findBy(['role' => $role]);

        return $this->render('admin/utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
            'current_role' => $role,
        ]);
    }

    #[Route('/admin/utilisateurs/new', name: 'admin_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set date d'inscription automatiquement
            $utilisateur->setDateInscription(new \DateTime());
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $this->addFlash('success', 'Utilisateur créé avec succès.');
            return $this->redirectToRoute('admin_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/admin/utilisateurs/{id}', name: 'admin_utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('admin/utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/admin/utilisateurs/{id}/edit', name: 'admin_utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set date de modification automatiquement
            $utilisateur->setDateModification(new \DateTime());
            $entityManager->flush();

            $this->addFlash('success', 'Utilisateur modifié avec succès.');
            return $this->redirectToRoute('admin_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/admin/utilisateurs/{id}', name: 'admin_utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
