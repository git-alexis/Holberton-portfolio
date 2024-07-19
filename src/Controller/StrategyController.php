<?php

namespace App\Controller;

use App\Entity\Strategy;
use App\Form\StrategyType;
use App\Repository\StrategyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/strategy')]
class StrategyController extends AbstractController
{
    #[Route('/', name: 'app_strategy_index', methods: ['GET'])]
    public function index(StrategyRepository $strategyRepository, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the index page with the list of strategies and user information
        return $this->render('strategy/index.html.twig', [
            'strategies' => $strategyRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_strategy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create a new Strategy entity and set the creator to the logged-in user
        $strategy = new Strategy();
        $strategy->setCreatedBy($user);

        // Create and handle the strategy form
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then save the new strategy
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($strategy);
            $entityManager->flush();

            // Redirect to the strategy index page after saving
            return $this->redirectToRoute('app_strategy_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new strategy form
        return $this->render('strategy/new.html.twig', [
            'strategy' => $strategy,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_strategy_show', methods: ['GET'])]
    public function show(Strategy $strategy, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the strategy details page
        return $this->render('strategy/show.html.twig', [
            'strategy' => $strategy,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_strategy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Strategy $strategy, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create and handle the edit form for the strategy
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then update the strategy
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirect to the strategy index page after updating
            return $this->redirectToRoute('app_strategy_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit strategy form
        return $this->render('strategy/edit.html.twig', [
            'strategy' => $strategy,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_strategy_delete', methods: ['POST'])]
    public function delete(Request $request, Strategy $strategy, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid before deleting the strategy
        if ($this->isCsrfTokenValid('delete'.$strategy->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($strategy);
            $entityManager->flush();
        }

        // Redirect to the strategy index page after deletion
        return $this->redirectToRoute('app_strategy_index', [], Response::HTTP_SEE_OTHER);
    }
}
