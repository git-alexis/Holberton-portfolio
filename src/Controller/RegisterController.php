<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieval of the currently logged-in user, if any
        $user = $security->getUser();

        // Creation of a new User entity instance
        $new_user = new User();
        // Creation of the registration form and linking it with the User entity
        $form = $this->createForm(RegisterFormType::class, $new_user);
        // Handling the request for the form
        $form->handleRequest($request);

        // Checking if the form has been submitted and is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Hashing the user's password and setting it for the new User entity
            $new_user->setPassword(
                $passwordHasher->hashPassword(
                    $new_user,
                    $form->get('plainPassword')->getData() // Retrieving the plain password from the form
                )
            );

            // Persisting the new User entity in the database
            $entityManager->persist($new_user);
            // Saving changes in the database
            $entityManager->flush();

            // Redirect to the login page if the user comes from the login page
            $fromLogin = $request->query->get('from_login');
            if ($fromLogin) {
                return $this->redirectToRoute('app_login');
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('register/register.html.twig', [
            'registerForm' => $form->createView(),
			'user' => $user,
        ]);
    }
}
