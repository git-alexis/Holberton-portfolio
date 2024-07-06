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

#[Route('/tank_skill')]
class TankSkillController extends AbstractController
{
    #[Route('/', name: 'app_tank_skill_index', methods: ['GET'])]
    public function index(TankSkillRepository $tankSkillRepository): Response
    {
        return $this->render('tank_skill/index.html.twig', [
            'tank_skills' => $tankSkillRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tank_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tankSkill = new TankSkill();
        $form = $this->createForm(TankSkillType::class, $tankSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tankSkill);
            $entityManager->flush();

            return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tank_skill/new.html.twig', [
            'tank_skill' => $tankSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_skill_show', methods: ['GET'])]
    public function show(TankSkill $tankSkill): Response
    {
        return $this->render('tank_skill/show.html.twig', [
            'tank_skill' => $tankSkill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tank_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TankSkill $tankSkill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TankSkillType::class, $tankSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tank_skill/edit.html.twig', [
            'tank_skill' => $tankSkill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_skill_delete', methods: ['POST'])]
    public function delete(Request $request, TankSkill $tankSkill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tankSkill->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tankSkill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tank_skill_index', [], Response::HTTP_SEE_OTHER);
    }
}
