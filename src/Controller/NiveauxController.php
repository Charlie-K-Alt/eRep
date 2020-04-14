<?php

namespace App\Controller;

use App\Entity\Niveaux;
use App\Form\NiveauxType;
use App\Repository\NiveauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/niveaux")
 */
class NiveauxController extends AbstractController
{
    /**
     * @Route("/", name="niveaux_index", methods={"GET"})
     */
    public function index(NiveauxRepository $niveauxRepository): Response
    {
        return $this->render('niveaux/index.html.twig', [
            'niveauxes' => $niveauxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="niveaux_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $niveau = new Niveaux();
        $form = $this->createForm(NiveauxType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveau);
            $entityManager->flush();

            return $this->redirectToRoute('niveaux_index');
        }

        return $this->render('niveaux/new.html.twig', [
            'niveau' => $niveau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveaux_show", methods={"GET"})
     */
    public function show(Niveaux $niveau): Response
    {
        return $this->render('niveaux/show.html.twig', [
            'niveau' => $niveau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="niveaux_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Niveaux $niveau): Response
    {
        $form = $this->createForm(NiveauxType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveaux_index');
        }

        return $this->render('niveaux/edit.html.twig', [
            'niveau' => $niveau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveaux_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Niveaux $niveau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveaux_index');
    }
}
