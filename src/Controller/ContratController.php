<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratTypeForm;
use App\Repository\ContratRepository;
use App\Services\FileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContratController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private FileService $fileService)
    {
    }

    #[Route('/contrat/create', name: 'app_contrat_create')]
    public function create(Request $request): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratTypeForm::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            /** @todo change by the connected user */
            $client = $form->get('client')->getData();
            if ($file) {
                $fileName = $this->fileService->upload($file, $client->getId());
                $contrat->setFile($fileName);
            }
            $this->em->persist($contrat);
            $this->em->flush();
            $this->addFlash("success", "Contrat créé avec succès");
            return $this->redirectToRoute("app_contrat");
        }

        return $this->render('contrat/create.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/contrat/edit/{contrat}', name: 'app_contrat_edit')]
    public function edit(Request $request, Contrat $contrat): Response
    {
        $form = $this->createForm(ContratTypeForm::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contrat);
            $this->em->flush();
            $this->addFlash("success", "Contrat modifié avec succès");
            return $this->redirectToRoute("app_contrat");
        }

        return $this->render('contrat/create.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/contrat/show/{contrat}', name: 'app_contrat_show')]
    public function show(Contrat $contrat): Response
    {
        return $this->render('contrat/show.html.twig', [
            "contrat" => $contrat,
        ]);
    }

    #[Route('/contrat/delete/{contrat}', name: 'app_contrat_delete')]
    public function delete(Contrat $contrat,Filesystem $filesystem): Response
    {
        $this->em->remove($contrat);
        $this->em->flush();
        $this->fileService->delete($contrat->getFile(),$contrat->getClient()->getId());
        $this->addFlash("success", "Contrat supprimé avec succès");

        return $this->redirectToRoute("app_contrat");
    }

    #[Route('/contrat', name: 'app_contrat')]
    public function index(ContratRepository $contratRepository): Response
    {
        $contrats = $contratRepository->findAll();

        return $this->render('contrat/index.html.twig', [
            "contrats" => $contrats,
        ]);
    }
}
