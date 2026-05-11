<?php

namespace App\Controller\Front\Vitrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RessourceController extends AbstractController
{
    #[Route('/ressources', name: 'app_ressources')]
    public function index(): Response
    {
        return $this->render('vitrine/ressources/index.html.twig');
    }

    #[Route('/ressources/blog', name: 'app_ressources_blog')]
    public function blog(): Response
    {
        return $this->render('vitrine/ressources/blog.html.twig');
    }

    #[Route('/ressources/blog/{slug}', name: 'app_ressources_blog_show')]
    public function blogShow(string $slug): Response
    {
        return $this->render('vitrine/ressources/blog_show.html.twig', [
            'slug' => $slug
        ]);
    }

    #[Route('/ressources/guides', name: 'app_ressources_guides')]
    public function guides(): Response
    {
        return $this->render('vitrine/ressources/guides.html.twig');
    }

    #[Route('/ressources/guides/{slug}', name: 'app_ressources_guide_show')]
    public function guideShow(string $slug): Response
    {
        return $this->render('vitrine/ressources/guide_show.html.twig', [
            'slug' => $slug
        ]);
    }

    #[Route('/ressources/forum', name: 'app_ressources_forum')]
    public function forum(): Response
    {
        return $this->render('vitrine/ressources/forum.html.twig');
    }

    #[Route('/ressources/forum/categorie/{categorie}', name: 'app_ressources_forum_categorie')]
    public function forumCategorie(string $categorie): Response
    {
        return $this->render('vitrine/ressources/forum_categorie.html.twig', [
            'categorie' => $categorie
        ]);
    }

    #[Route('/ressources/videos', name: 'app_ressources_videos')]
    public function videos(): Response
    {
        return $this->render('vitrine/ressources/videos.html.twig');
    }

    #[Route('/ressources/documents', name: 'app_ressources_documents')]
    public function documents(): Response
    {
        return $this->render('vitrine/ressources/documents.html.twig');
    }

    #[Route('/ressources/telechargement/{id}', name: 'app_ressources_telechargement')]
    public function telechargement(int $id): Response
    {
        return $this->render('vitrine/ressources/telechargement.html.twig', [
            'documentId' => $id
        ]);
    }

    #[Route('/ressources/favoris', name: 'app_ressources_favoris')]
    #[IsGranted('ROLE_USER')]
    public function favoris(): Response
    {
        return $this->render('vitrine/ressources/favoris.html.twig');
    }
}
