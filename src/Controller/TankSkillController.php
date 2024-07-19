<?php

namespace App\Controller;

use App\Entity\TankSkill;
use App\Form\TankSkillType;
use App\Repository\TankSkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/tank_skill')]
class TankSkillController extends AbstractController
{
    #[Route('/', name: 'app_tank_skill_index', methods: ['GET'])]
    public function index(TankSkillRepository $tankSkillRepository, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the index page with the list of tank skills and user information
        return $this->render('tank_skill/index.html.twig', [
            'tank_skills' => $tankSkillRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_tank_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create a new TankSkill entity and set the creator to the logged-in user
        $tankSkill = new TankSkill();
        $tankSkill->setCreatedBy($user);

        // Create and handle the tank skill form
        $form = $this->createForm(TankSkillType::class, $tankSkill);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then save the new tank skill
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tankSkill);
            $entityManager->flush();

            // Redirect to the tank skill index page after saving
            return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new tank skill form
        return $this->render('tank_skill/new.html.twig', [
            'tank_skill' => $tankSkill,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_skill_show', methods: ['GET'])]
    public function show(TankSkill $tankSkill, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the tank skill details page
        return $this->render('tank_skill/show.html.twig', [
            'tank_skill' => $tankSkill,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tank_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TankSkill $tankSkill, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create and handle the edit form for the tank skill
        $form = $this->createForm(TankSkillType::class, $tankSkill);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then update the tank skill
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirect to the tank skill index page after updating
            return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit tank skill form
        return $this->render('tank_skill/edit.html.twig', [
            'tank_skill' => $tankSkill,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_skill_delete', methods: ['POST'])]
    public function delete(Request $request, TankSkill $tankSkill, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid before deleting the tank skill
        if ($this->isCsrfTokenValid('delete'.$tankSkill->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tankSkill);
            $entityManager->flush();
        }

        // Redirect to the tank skill index page after deletion
        return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
    }
}
