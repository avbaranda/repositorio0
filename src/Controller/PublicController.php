<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/public')]
class PublicController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function home()
    {
        return $this->render('public/home.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login()
    {
        return $this->render('public/login.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about()
    {
        return $this->render('public/about.html.twig');
    }
    
}