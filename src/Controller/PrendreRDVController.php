<?php

namespace App\Controller;

use App\Form\CreatPostRDVType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\User;

class PrendreRDVController extends AbstractController
{
    /**
     * @Route("/Rdv", name="app_PrendreRDV")
     */
    public function index(): Response
    {
        return $this->render('prendre_rdv/index.html.twig', [
            'controller_name' => 'PrendreRDVController',
        ]);
    }

    /**
     * @Route("/CreatRDV", name="app_CreatRDV")
     */
    public function User(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(CreatPostRDVType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            $post->setAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('prendre_rdv/CreatRDV.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
