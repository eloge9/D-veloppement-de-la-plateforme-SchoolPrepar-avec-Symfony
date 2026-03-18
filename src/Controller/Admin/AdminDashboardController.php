<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // Données fictives pour le dashboard
        $stats = [
            'totalFilieres' => 8,
            'totalEtablissements' => 6,
            'totalUsers' => 1247,
            'nouvellesInscriptions' => 23,
            'nouvellesDemandes' => 15,
            'demandesApprouvees' => 42,
            'demandesEnAttente' => 8,
            'demandesRejetees' => 3
        ];

        $recentActivities = [
            [
                'description' => 'Nouvelle inscription en Informatique',
                'percentage' => 75,
                'color' => 'primary'
            ],
            [
                'description' => 'Mise à jour du programme de Gestion',
                'percentage' => 50,
                'color' => 'success'
            ],
            [
                'description' => 'Audit de qualité en cours',
                'percentage' => 30,
                'color' => 'warning'
            ],
            [
                'description' => 'Maintenance du système',
                'percentage' => 90,
                'color' => 'info'
            ]
        ];

        return $this->render('admin/dashboard.html.twig', [
            'stats' => $stats,
            'recentActivities' => $recentActivities
        ]);
    }
}
