<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAuthController extends AbstractController
{
    #[Route('/login', name: 'user_auth')]
    public function index(): Response
    {
        return $this->render('user_auth/uauth.html.twig', []);
    }
}
