<?php

namespace App\Controller;

use App\Entity\Matieres;
use App\Form\MatieresType;
use App\Repository\MatieresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/matieres")
 */
class MatieresController extends AbstractController
{
    /**
     * @Route("/", name="matieres_index", methods={"GET"})
     */
    public function index(MatieresRepository $matieresRepository): Response
    {
        return $this->render('matieres/index.html.twig', [
            'matieres' => $matieresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="matieres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matiere = new Matieres();
        $form = $this->createForm(MatieresType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();

            return $this->redirectToRoute('matieres_index');
        }

        return $this->render('matieres/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matieres_show", methods={"GET"})
     */
    public function show(Matieres $matiere): Response
    {
        return $this->render('matieres/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="matieres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matieres $matiere): Response
    {
        $form = $this->createForm(MatieresType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matieres_index');
        }

        return $this->render('matieres/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matieres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matieres $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matieres_index');
    }
}
