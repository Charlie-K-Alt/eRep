<?php

namespace App\Controller;

use App\Entity\Solutions;
use App\Form\SolutionsType;
use App\Repository\SolutionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/solutions")
 */
class SolutionsController extends AbstractController
{
    /**
     * @Route("/", name="solutions_index", methods={"GET"})
     */
    public function index(SolutionsRepository $solutionsRepository): Response
    {
        return $this->render('solutions/index.html.twig', [
            'solutions' => $solutionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="solutions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $solution = new Solutions();
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solution);
            $entityManager->flush();

            return $this->redirectToRoute('solutions_index');
        }

        return $this->render('solutions/new.html.twig', [
            'solution' => $solution,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solutions_show", methods={"GET"})
     */
    public function show(Solutions $solution): Response
    {
        return $this->render('solutions/show.html.twig', [
            'solution' => $solution,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solutions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Solutions $solution): Response
    {
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solutions_index');
        }

        return $this->render('solutions/edit.html.twig', [
            'solution' => $solution,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solutions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Solutions $solution): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solution->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solutions_index');
    }
}
