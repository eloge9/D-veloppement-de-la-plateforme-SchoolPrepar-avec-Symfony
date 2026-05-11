<?php

namespace App\Controller\Front\Vitrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('vitrine/contact/index.html.twig');
    }

    #[Route('/contact/nous', name: 'app_contact_nous')]
    public function nous(): Response
    {
        return $this->render('vitrine/contact/nous.html.twig');
    }

    #[Route('/contact/formulaire', name: 'app_contact_formulaire')]
    public function formulaire(): Response
    {
        return $this->render('vitrine/contact/formulaire.html.twig');
    }

    #[Route('/contact/send', name: 'app_contact_send', methods: ['POST'])]
    public function send(Request $request): Response
    {
        $data = $request->request->all();
        
        // Logique d'envoi du message
        
        $this->addFlash('success', 'Votre message a été envoyé avec succès!');
        return $this->redirectToRoute('app_contact');
    }

    #[Route('/contact/rendez-vous', name: 'app_contact_rdv')]
    public function rendezVous(): Response
    {
        return $this->render('vitrine/contact/rendez_vous.html.twig');
    }

    #[Route('/contact/rendez-vous/submit', name: 'app_contact_rdv_submit', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function submitRdv(Request $request): Response
    {
        $this->addFlash('success', 'Votre demande de rendez-vous a été envoyée!');
        return $this->redirectToRoute('app_eleve_dashboard');
    }

    #[Route('/contact/urgence', name: 'app_contact_urgence')]
    public function urgence(): Response
    {
        return $this->render('vitrine/contact/urgence.html.twig');
    }

    #[Route('/contact/faq', name: 'app_contact_faq')]
    public function faq(): Response
    {
        return $this->render('vitrine/contact/faq.html.twig');
    }
}
