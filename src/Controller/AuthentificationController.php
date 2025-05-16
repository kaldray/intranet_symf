<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthentificationController extends AbstractController
{
    #[Route('/', name: 'app_authentification')]
    public function index(): Response
    {
        return $this->render('authentification/index.html.twig');
    }
}
