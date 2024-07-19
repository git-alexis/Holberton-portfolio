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
		$user = $security->getUser();

        $new_user = new User();
        $form = $this->createForm(RegisterFormType::class, $new_user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_user->setPassword(
                $passwordHasher->hashPassword(
                    $new_user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($new_user);
            $entityManager->flush();

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
