<?php

namespace App\Controller;

use App\Entity\Application;
use App\Form\ApplicationTypeForm;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApplicationController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    #[Route('/application', name: 'app_application')]
    public function index(ApplicationRepository $applicationRepository): Response
    {
        $applications = $applicationRepository->findAll();

        return $this->render('application/index.html.twig', [
            'applications' => $applications,
        ]);
    }

    #[Route('/application/create', name: 'app_application_create')]
    public function create(Request $request): Response
    {
        $application = new Application();
        $form = $this->createForm(ApplicationTypeForm::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($application);
            $this->em->flush();
            $this->addFlash("success", "Action réussi");
            return $this->redirectToRoute("app_application");
        }

        return $this->render('application/create.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/application/edit/{application}', name: 'app_application_edit')]
    public function edit(Request $request, Application $application): Response
    {
        $form = $this->createForm(ApplicationTypeForm::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($application);
            $this->em->flush();
            $this->addFlash("success", "Action réussi");
            return $this->redirectToRoute("app_application");
        }

        return $this->render('application/create.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/application/delete/{application}', name: 'app_application_delete')]
    public function delete(Application $application): Response
    {
        $this->em->remove($application);
        $this->em->flush();
        $this->addFlash("success", "Action réussi");

        return $this->redirectToRoute("app_application");
    }
}
