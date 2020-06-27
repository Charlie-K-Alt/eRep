<?php

namespace App\Controller;

use App\Entity\Apprenants;
use App\Form\ApprenantsType;
use App\Repository\ApprenantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/apprenants")
 */
class ApprenantsController extends AbstractController
{
    /**
     * @Route("/", name="apprenants_index", methods={"GET"})
     */
    public function index(ApprenantsRepository $apprenantsRepository): Response
    {
        return $this->render('apprenants/index.html.twig', [
            'apprenants' => $apprenantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="apprenants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $apprenant = new Apprenants();
        $form = $this->createForm(ApprenantsType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apprenant);
            $entityManager->flush();

            return $this->redirectToRoute('apprenants_index');
        }

        return $this->render('apprenants/new.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="apprenants_show", methods={"GET"})
     */
    public function show(Apprenants $apprenant): Response
    {
        return $this->render('apprenants/show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="apprenants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Apprenants $apprenant): Response
    {
        $form = $this->createForm(ApprenantsType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apprenants_index');
        }

        return $this->render('apprenants/edit.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="apprenants_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Apprenants $apprenant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apprenant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($apprenant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('apprenants_index');
    }
}
