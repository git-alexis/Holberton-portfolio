<?php

namespace App\Controller;

use App\Entity\Tank;
use App\Form\TankType;
use App\Repository\TankRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/tank')]
class TankController extends AbstractController
{
    #[Route('/', name: 'app_tank_index', methods: ['GET'])]
    public function index(TankRepository $tankRepository, Security $security): Response
    {

		$user = $security->getUser();

        return $this->render('tank/index.html.twig', [
            'tanks' => $tankRepository->findAll(),
			'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_tank_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {

		$user = $security->getUser();

        $tank = new Tank();

		$tank->setCreatedBy($user);

        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tank);
            $entityManager->flush();

            return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tank/new.html.twig', [
            'tank' => $tank,
            'form' => $form,
			'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_show', methods: ['GET'])]
    public function show(Tank $tank, Security $security): Response
    {

		$user = $security->getUser();

        return $this->render('tank/show.html.twig', [
            'tank' => $tank,
			'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tank_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tank $tank, EntityManagerInterface $entityManager, Security $security): Response
    {

		$user = $security->getUser();

        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tank/edit.html.twig', [
            'tank' => $tank,
            'form' => $form,
			'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_delete', methods: ['POST'])]
    public function delete(Request $request, Tank $tank, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tank->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tank);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
    }
}
