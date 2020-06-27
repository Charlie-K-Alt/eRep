<?php

namespace App\Controller;

use App\Entity\Exercices;
use App\Form\ExercicesType;
use App\Repository\ExercicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/exercices")
 */
class ExercicesController extends AbstractController
{
    /**
     * @Route("/", name="exercices_index", methods={"GET"})
     */
    public function index(ExercicesRepository $exercicesRepository): Response
    {
        return $this->render('exercices/index.html.twig', [
            'exercices' => $exercicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="exercices_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exercice = new Exercices();
        $form = $this->createForm(ExercicesType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exercice);
            $entityManager->flush();

            return $this->redirectToRoute('exercices_index');
        }

        return $this->render('exercices/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exercices_show", methods={"GET"})
     */
    public function show(Exercices $exercice): Response
    {
        return $this->render('exercices/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exercices_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exercices $exercice): Response
    {
        $form = $this->createForm(ExercicesType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exercices_index');
        }

        return $this->render('exercices/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exercices_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Exercices $exercice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exercices_index');
    }
}
