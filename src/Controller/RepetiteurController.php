<?php

namespace App\Controller;

use App\Entity\Repetiteur;
use App\Form\RepetiteurType;
use App\Repository\RepetiteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/repetiteur")
 */
class RepetiteurController extends AbstractController
{
    /**
     * @Route("/", name="repetiteur_index", methods={"GET"})
     */
    public function index(RepetiteurRepository $repetiteurRepository): Response
    {
        return $this->render('repetiteur/index.html.twig', [
            'repetiteurs' => $repetiteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="repetiteur_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $repetiteur = new Repetiteur();
        $form = $this->createForm(RepetiteurType::class, $repetiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($repetiteur, $repetiteur->getPassword());
            $repetiteur->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($repetiteur);
            $entityManager->flush();

            return $this->redirectToRoute('repetiteur_index');
        }

        return $this->render('repetiteur/new.html.twig', [
            'repetiteur' => $repetiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="repetiteur_show", methods={"GET"})
     */
    public function show(Repetiteur $repetiteur): Response
    {
        return $this->render('repetiteur/show.html.twig', [
            'repetiteur' => $repetiteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="repetiteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Repetiteur $repetiteur): Response
    {
        $form = $this->createForm(RepetiteurType::class, $repetiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('repetiteur_index');
        }

        return $this->render('repetiteur/edit.html.twig', [
            'repetiteur' => $repetiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="repetiteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Repetiteur $repetiteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repetiteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($repetiteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('repetiteur_index');
    }
}
