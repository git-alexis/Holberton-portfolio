<?php

namespace App\Controller;

use App\Entity\SkillStrategy;
use App\Form\SkillStrategyType;
use App\Repository\SkillStrategyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/skill_strategy')]
class SkillStrategyController extends AbstractController
{
    #[Route('/', name: 'app_skill_strategy_index', methods: ['GET'])]
    public function index(SkillStrategyRepository $skillStrategyRepository, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the index page with the list of skill strategies and user information
        return $this->render('skill_strategy/index.html.twig', [
            'skill_strategies' => $skillStrategyRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_skill_strategy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create a new SkillStrategy entity and set the creator to the logged-in user
        $skillStrategy = new SkillStrategy();
        $skillStrategy->setCreatedBy($user);

        // Create and handle the skill strategy form
        $form = $this->createForm(SkillStrategyType::class, $skillStrategy);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then save the new skill strategy
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skillStrategy);
            $entityManager->flush();

            // Redirect to the skill strategy index page after saving
            return $this->redirectToRoute('app_skill_strategy_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new skill strategy form
        return $this->render('skill_strategy/new.html.twig', [
            'skill_strategy' => $skillStrategy,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_strategy_show', methods: ['GET'])]
    public function show(SkillStrategy $skillStrategy, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the skill strategy details page
        return $this->render('skill_strategy/show.html.twig', [
            'skill_strategy' => $skillStrategy,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_skill_strategy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SkillStrategy $skillStrategy, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create and handle the edit form for the skill strategy
        $form = $this->createForm(SkillStrategyType::class, $skillStrategy);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then update the skill strategy
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirect to the skill strategy index page after updating
            return $this->redirectToRoute('app_skill_strategy_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit skill strategy form
        return $this->render('skill_strategy/edit.html.twig', [
            'skill_strategy' => $skillStrategy,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_strategy_delete', methods: ['POST'])]
    public function delete(Request $request, SkillStrategy $skillStrategy, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid before deleting the skill strategy
        if ($this->isCsrfTokenValid('delete'.$skillStrategy->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($skillStrategy);
            $entityManager->flush();
        }

        // Redirect to the skill strategy index page after deletion
        return $this->redirectToRoute('app_skill_strategy_index', [], Response::HTTP_SEE_OTHER);
    }
}
