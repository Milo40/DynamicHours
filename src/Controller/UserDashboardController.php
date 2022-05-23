<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'user_dashboard')]
    public function index(): Response
    {
        $now = new \DateTime();
        $days = [[date('l', strtotime('-3 day')), date('d M', strtotime('-3 day'))], [date('l', strtotime('-2 day')), date('d M', strtotime('-2 day'))], [date('l', strtotime('-1 day')), date('d M', strtotime('-1 day'))], [date('l', strtotime('now')), date('d M', strtotime('now'))], [date('l', strtotime('+1 day')), date('d M', strtotime('+1 day'))], [date('l', strtotime('+2 day')), date('d M', strtotime('+2 day'))], [date('l', strtotime('+3 day')), date('d M', strtotime('+3 day'))]];

        return $this->render('user_dashboard/udashboard.html.twig', ['days' => $days]);
    }
}
