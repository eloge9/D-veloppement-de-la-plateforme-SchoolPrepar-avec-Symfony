<?php

namespace App\Controller\Front\Vitrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class QuizController extends AbstractController
{
    #[Route('/tests-orientation', name: 'app_tests_orientation')]
    public function testsOrientation(): Response
    {
        return $this->redirectToRoute('app_quiz_orientation');
    }

    #[Route('/quiz', name: 'app_quiz')]
    public function index(): Response
    {
        return $this->render('vitrine/quiz/index.html.twig');
    }

    #[Route('/quiz/orientation', name: 'app_quiz_orientation')]
    public function orientation(): Response
    {
        return $this->render('vitrine/quiz/orientation.html.twig');
    }

    #[Route('/quiz/orientation/start', name: 'app_quiz_orientation_start')]
    public function startOrientation(): Response
    {
        return $this->render('vitrine/quiz/orientation_start.html.twig');
    }

    #[Route('/quiz/orientation/questions/{step}', name: 'app_quiz_orientation_questions', requirements: ['step' => '\d+'])]
    public function orientationQuestions(int $step): Response
    {
        return $this->render('vitrine/quiz/orientation_questions.html.twig', [
            'step' => $step
        ]);
    }

    #[Route('/quiz/orientation/result', name: 'app_quiz_orientation_result', methods: ['POST'])]
    public function orientationResult(Request $request): Response
    {
        $responses = $request->request->all();
        
        return $this->render('vitrine/quiz/orientation_result.html.twig', [
            'responses' => $responses
        ]);
    }

    #[Route('/quiz/personnalite', name: 'app_quiz_personnalite')]
    public function personnalite(): Response
    {
        return $this->render('vitrine/quiz/personnalite.html.twig');
    }

    #[Route('/quiz/metiers', name: 'app_quiz_metiers')]
    public function metiers(): Response
    {
        return $this->render('vitrine/quiz/metiers.html.twig');
    }

    #[Route('/quiz/save', name: 'app_quiz_save')]
    #[IsGranted('ROLE_USER')]
    public function save(Request $request): Response
    {
        $this->addFlash('success', 'Vos résultats du quiz ont été sauvegardés!');
        return $this->redirectToRoute('app_eleve_dashboard');
    }
}
