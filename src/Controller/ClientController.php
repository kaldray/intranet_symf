<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientTypeForm;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    #[Route('/client/create', name: 'app_client_create')]
    public function create(Request $request): Response
    {
        $application = new Client();
        $form = $this->createForm(ClientTypeForm::class, $application);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($application);
            $this->em->flush();
            $this->addFlash("success", "Action réussi");
            return $this->redirectToRoute("app_client");
        }

        return $this->render('client/create.html.twig', [
                "form" => $form
            ]
        );
    }

    #[Route('/client/edit/{client}', name: 'app_client_edit')]
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientTypeForm::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash("success", "Action réussi");
            return $this->redirectToRoute("app_client");
        }

        return $this->render('client/create.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/client/show/{client}', name: 'app_client_show')]
    public function show(Request $request, Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            "client" => $client,
        ]);
    }

    #[Route('/client/delete/{client}', name: 'app_client_delete')]
    public function delete(Client $client): Response
    {
        $this->em->remove($client);
        $this->em->flush();
        $this->addFlash("success", "Action réussi");

        return $this->redirectToRoute("app_client");
    }

    #[Route('/client', name: 'app_client')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();

        return $this->render('client/index.html.twig', [
            "clients" => $clients,
        ]);
    }
}
