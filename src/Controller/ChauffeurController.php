<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Form\ChauffeurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/chauffeur')]
final class ChauffeurController extends AbstractController
{
    #############################  ADMIN  #################################################

    #[Route('/admin', name: 'app_chauffeur_indexad', methods: ['GET'])]
    public function indexad(EntityManagerInterface $entityManager): Response
    {
        $chauffeurs = $entityManager
            ->getRepository(Chauffeur::class)
            ->findAll();

        return $this->render('admin/chauffeur/index.html.twig', [
            'chauffeurs' => $chauffeurs,
        ]);
    }

    #[Route('/admin/new', name: 'app_chauffeur_newad', methods: ['GET', 'POST'])]
    public function newad(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chauffeur);
            $entityManager->flush();

            return $this->redirectToRoute('app_chauffeur_indexad', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/chauffeur/new.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{chauffeur_id}', name: 'app_chauffeur_showad', methods: ['GET'])]
    public function showad(Chauffeur $chauffeur): Response
    {
        return $this->render('admin/chauffeur/show.html.twig', [
            'chauffeur' => $chauffeur,
        ]);
    }

    #[Route('/admin/{chauffeur_id}/edit', name: 'app_chauffeur_editad', methods: ['GET', 'POST'])]
    public function editad(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chauffeur_indexad', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/chauffeur/edit.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{chauffeur_id}', name: 'app_chauffeur_deletead', methods: ['POST'])]
    public function deletead(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chauffeur->getChauffeurId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($chauffeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chauffeur_indexad', [], Response::HTTP_SEE_OTHER);
    }

    #############################  CLIENT  #################################################

    #[Route('', name: 'app_chauffeur_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $chauffeurs = $entityManager
            ->getRepository(Chauffeur::class)
            ->findAll();

        return $this->render('client/chauffeur/index.html.twig', [
            'chauffeurs' => $chauffeurs,
        ]);
    }

    #[Route('/new', name: 'app_chauffeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chauffeur);
            $entityManager->flush();

            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/chauffeur/new.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/{chauffeur_id}', name: 'app_chauffeur_show', methods: ['GET'])]
    public function show(Chauffeur $chauffeur): Response
    {
        return $this->render('client/chauffeur/show.html.twig', [
            'chauffeur' => $chauffeur,
        ]);
    }

    #[Route('/{chauffeur_id}/edit', name: 'app_chauffeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/chauffeur/edit.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/{chauffeur_id}', name: 'app_chauffeur_delete', methods: ['POST'])]
    public function delete(Request $request, Chauffeur $chauffeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chauffeur->getChauffeurId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($chauffeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
    }
}