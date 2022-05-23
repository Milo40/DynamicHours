<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserRegistrationController extends AbstractController
{
    #[Route('/register', name: 'user_registration')]
    public function index(): Response
    {
        return $this->render('user_registration/uregister.html.twig', []);
    }
}
