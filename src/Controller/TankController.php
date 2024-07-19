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
/*use App\Service\TankApiClient;*/

#[Route('/tank')]
class TankController extends AbstractController
{
    /*private $tankApiClient;

    public function __construct(TankApiClient $tankApiClient)
    {
        $this->tankApiClient = $tankApiClient;
    }*/

    #[Route('/', name: 'app_tank_index', methods: ['GET'])]
    public function index(TankRepository $tankRepository, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the index page with the list of tanks and user information
        return $this->render('tank/index.html.twig', [
            'tanks' => $tankRepository->findAll(),
            'user' => $user,
        ]);
    }

	/*#[Route('/compare/{tankId1}/{tankId2}', name: 'app_tank_compare', methods: ['GET'])]
    public function compare(int $tankId1, int $tankId2, Security $security): Response
    {
        $user = $security->getUser();
        $tank1 = $this->tankApiClient->fetchTankDetails($tankId1);
        $tank2 = $this->tankApiClient->fetchTankDetails($tankId2);

        return $this->render('tank/compare.html.twig', [
            'tank1' => $tank1,
            'tank2' => $tank2,
            'user' => $user,
        ]);
    }*/

    #[Route('/new', name: 'app_tank_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create a new Tank entity and set the creator to the logged-in user
        $tank = new Tank();
        $tank->setCreatedBy($user);

        // Create and handle the tank form
        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then save the new tank
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tank);
            $entityManager->flush();

            // Redirect to the tank index page after saving
            return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new tank form
        return $this->render('tank/new.html.twig', [
            'tank' => $tank,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_show', methods: ['GET'])]
    public function show(Tank $tank, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Render the tank details page
        return $this->render('tank/show.html.twig', [
            'tank' => $tank,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tank_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tank $tank, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Retrieve the currently logged-in user
        $user = $security->getUser();

        // Create and handle the edit form for the tank
        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then update the tank
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirect to the tank index page after updating
            return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit tank form
        return $this->render('tank/edit.html.twig', [
            'tank' => $tank,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_tank_delete', methods: ['POST'])]
    public function delete(Request $request, Tank $tank, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid before deleting the tank
        if ($this->isCsrfTokenValid('delete'.$tank->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tank);
            $entityManager->flush();
        }

        // Redirect to the tank index page after deletion
        return $this->redirectToRoute('app_tank_index', [], Response::HTTP_SEE_OTHER);
    }
}
