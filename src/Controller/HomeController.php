<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

// Definition of the HomeController class inheriting from AbstractController
class HomeController extends AbstractController
{
    // Annotation for the route of the homepage
    #[Route('/', name: 'home')]
    public function index(Security $security): Response
    {
        // Retrieval of the currently logged-in user
        $user = $security->getUser();

        // Rendering the view for the homepage with data to pass
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
        ]);
    }
}
