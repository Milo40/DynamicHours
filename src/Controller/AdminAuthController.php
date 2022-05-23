<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAuthController extends AbstractController
{
    #[Route('/admin/login', name: 'admin_auth')]
    public function index(): Response
    {
        return $this->render('admin_auth/aauth.html.twig', []);
    }
}
