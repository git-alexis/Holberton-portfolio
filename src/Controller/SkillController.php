<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/skill')]
class SkillController extends AbstractController
{
    #[Route('/', name: 'app_skill_index', methods: ['GET'])]
    public function index(SkillRepository $skillRepository, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the index page with the list of skills and user information
        return $this->render('skill/index.html.twig', [
            'skills' => $skillRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create a new Skill entity and set the creator to the logged-in user
        $skill = new Skill();
        $skill->setCreatedBy($user);

        // Create and handle the skill form
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then save the new skill
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            // Redirect to the skill index page after saving
            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new skill form
        return $this->render('skill/new.html.twig', [
            'skill' => $skill,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_show', methods: ['GET'])]
    public function show(Skill $skill, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the skill details page
        return $this->render('skill/show.html.twig', [
            'skill' => $skill,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create and handle the edit form for the skill
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then update the skill
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirect to the skill index page after updating
            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit skill form
        return $this->render('skill/edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_delete', methods: ['POST'])]
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid before deleting the skill
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($skill);
            $entityManager->flush();
        }

        // Redirect to the skill index page after deletion
        return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
    }
}
