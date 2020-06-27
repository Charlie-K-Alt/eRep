<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Parents;
use App\Form\ParentsType;
use App\Entity\Repetiteur;
use App\Form\RepetiteurType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class HomeController extends AbstractController
{
    /**
     * @Route("/register", name="home", methods={"GET|POST"})
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
       // dd('ici le formulaire doit etre appeler');

        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($form);
            $hash = $encoder->encodePassword($parent, $parent->getPassword());
            $parent->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parent);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('home/index.html.twig', [
            'form_parent' => $form->createView()
        ]);
    }


    /**
     * @Route("/", name="app_register2")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator, AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //dd($lastUsername);
        
        $userparent = new Parents();
        $formparent = $this->createForm(ParentsType::class, $userparent);
        $formparent->handleRequest($request);
        
        $userrepetiteur = new Repetiteur();
        $formrepetiteur = $this->createForm(RepetiteurType::class, $userrepetiteur);
        $formrepetiteur->handleRequest($request);
        

        if($request->request->count()==3){
                
            // if ($this->getUser()) {
            //     return $this->redirectToRoute('home');
            // }

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            dd($lastUsername);
            return $this->render('home/index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }        
        if ($formparent->isSubmitted() && $formparent->isValid()) {
            $hash = $passwordEncoder->encodePassword($userparent, $userparent->getPassword());
            $userparent->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userparent);
            $entityManager->flush();

            // do anything else you need here, like send an email

            $this->addFlash('success', 'Inscrit effectuee avec succes!');
            return  $this->redirectToRoute('app_register2');
               
            
        }       
        if ($formrepetiteur->isSubmitted() && $formrepetiteur->isValid()) {
            $hash = $passwordEncoder->encodePassword($userrepetiteur, $userrepetiteur->getPassword());
            $userrepetiteur->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userrepetiteur);
            $entityManager->flush();

            // do anything else you need here, like send an email
            
            $this->addFlash('success','Inscrit effectuee avec succes!');
            return  $this->redirectToRoute('app_register2');
               
            
        }
       
        return $this->render('home/index.html.twig', [
            'registrationForm' => $formparent->createView(),
            'repetiteurForm' => $formrepetiteur->createView(),
            'last_username' => $lastUsername, 
            'error' => $error,
        ]);
    }

    // /**
    //  * @Route("/login", name="logform")
    //  */
    // public function login(AuthenticationUtils $authenticationUtils): Response
    // {
        
    //     // if ($this->getUser()) {
    //     //     return $this->redirectToRoute('home');
    //     // }

    //     // get the login error if there is one
    //     $error = $authenticationUtils->getLastAuthenticationError();
    //     // last username entered by the user
    //     $lastUsername = $authenticationUtils->getLastUsername();

    //     return $this->render('home/index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    // }
    
}
