<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Form\AppartenirType;
use App\Repository\AppartenirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/appartenir")
 */
class AppartenirController extends AbstractController
{
    /**
     * @Route("/", name="appartenir_index", methods={"GET"})
     */
    public function index(AppartenirRepository $appartenirRepository): Response
    {
        return $this->render('appartenir/index.html.twig', [
            'appartenirs' => $appartenirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="appartenir_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $appartenir = new Appartenir();
        $form = $this->createForm(AppartenirType::class, $appartenir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appartenir);
            $entityManager->flush();

            return $this->redirectToRoute('appartenir_index');
        }

        return $this->render('appartenir/new.html.twig', [
            'appartenir' => $appartenir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appartenir_show", methods={"GET"})
     */
    public function show(Appartenir $appartenir): Response
    {
        return $this->render('appartenir/show.html.twig', [
            'appartenir' => $appartenir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="appartenir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Appartenir $appartenir): Response
    {
        $form = $this->createForm(AppartenirType::class, $appartenir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appartenir_index');
        }

        return $this->render('appartenir/edit.html.twig', [
            'appartenir' => $appartenir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appartenir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Appartenir $appartenir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appartenir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appartenir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('appartenir_index');
    }
}
