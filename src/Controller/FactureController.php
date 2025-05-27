<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Facture;
use App\Form\FactureTypeForm;
use App\Repository\FactureRepository;
use App\Services\FileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FactureController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private FileService $fileService)
    {
    }

    #[Route('/facture', name: 'app_facture')]
    public function index(FactureRepository $factureRepository): Response
    {
        $factures = $factureRepository->findAll();
        return $this->render('facture/index.html.twig', [
            'factures' => $factures,
        ]);
    }

    #[Route('/facture/create', name: 'app_facture_create')]
    public function create(Request $request): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureTypeForm::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            /** @todo change by the connected user */
            $client = $form->get('client')->getData();
            if ($file) {
                $fileName = $this->fileService->upload($file, $client->getId());
                $facture->setFile($fileName);
            }
            $this->em->persist($facture);
            $this->em->flush();
            $this->addFlash("success", "Contrat créé avec succès");
            return $this->redirectToRoute("app_facture");
        }

        return $this->render('facture/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/facture/edit/{facture}', name: 'app_facture_edit')]
    public function edit(Request $request, Facture $facture): Response
    {
        $form = $this->createForm(FactureTypeForm::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            /** @todo change by the connected user */
            $client = $form->get('client')->getData();
            if ($file) {
                $fileName = $this->fileService->upload($file, $client->getId());
                $facture->setFile($fileName);
            }
            $this->em->persist($facture);
            $this->em->flush();
            $this->addFlash("success", "Contrat modifié avec succès");
            return $this->redirectToRoute("app_facture");
        }

        return $this->render('facture/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/facture/delete/{facture}', name: 'app_facture_delete')]
    public function delete(Facture $facture): Response
    {
        $this->em->remove($facture);
        $this->em->flush();
        $this->addFlash("success", "Action réussi");

        return $this->redirectToRoute("app_facture");
    }


    #[Route('/facture/show/{facture}', name: 'app_facture_show')]
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            "facture" => $facture,
        ]);
    }
}
