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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/etablissements')]
#[IsGranted('ROLE_ADMIN')]
class EtablissementController extends AbstractController
{
    #[Route('', name: 'admin_etablissement_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        // Récupérer uniquement les utilisateurs avec le rôle ROLE_ETABLISSEMENT
        $etablissements = $utilisateurRepository->findBy(['role' => 'ROLE_ETABLISSEMENT']);

        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }

    #[Route('/new', name: 'admin_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Forcer le rôle ROLE_ETABLISSEMENT
            $utilisateur->setRole('ROLE_ETABLISSEMENT');
            
            // Hasher le mot de passe avant de le sauvegarder
            $plainPassword = $utilisateur->getMotDePasse();
            $hashedPassword = $passwordHasher->hashPassword($utilisateur, $plainPassword);
            $utilisateur->setMotDePasse($hashedPassword);
            
            // Set date d'inscription automatiquement
            $utilisateur->setDateInscription(new \DateTime());
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $this->addFlash('success', 'Établissement créé avec succès.');
            return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/etablissement/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_etablissement_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        // Vérifier que l'utilisateur a bien le rôle ROLE_ETABLISSEMENT
        if ($utilisateur->getRole() !== 'ROLE_ETABLISSEMENT') {
            throw $this->createAccessDeniedException('Cet utilisateur n\'est pas un établissement.');
        }

        return $this->render('admin/etablissement/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Vérifier que l'utilisateur a bien le rôle ROLE_ETABLISSEMENT
        if ($utilisateur->getRole() !== 'ROLE_ETABLISSEMENT') {
            throw $this->createAccessDeniedException('Cet utilisateur n\'est pas un établissement.');
        }

        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe s'il a été modifié (non vide)
            $plainPassword = $utilisateur->getMotDePasse();
            if ($plainPassword && !empty($plainPassword)) {
                $hashedPassword = $passwordHasher->hashPassword($utilisateur, $plainPassword);
                $utilisateur->setMotDePasse($hashedPassword);
            }
            
            // Set date de modification automatiquement
            $utilisateur->setDateModification(new \DateTime());
            $entityManager->flush();

            $this->addFlash('success', 'Établissement modifié avec succès.');
            return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/etablissement/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur a bien le rôle ROLE_ETABLISSEMENT
        if ($utilisateur->getRole() !== 'ROLE_ETABLISSEMENT') {
            throw $this->createAccessDeniedException('Cet utilisateur n\'est pas un établissement.');
        }

        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
            $this->addFlash('success', 'Établissement supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
