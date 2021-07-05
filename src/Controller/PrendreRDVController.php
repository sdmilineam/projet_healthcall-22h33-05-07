<?php

namespace App\Controller;


use App\Entity\ImageProfil;
use App\Form\CreatPostRDVType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function ImageProfil(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $RDV = $this->getUser();
        $form = $this->createForm(CreatPostRDVType::class, $RDV);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $RDV = $security->getUser();
            $em->flush();

            return $this->redirectToRoute('app_PrendreRDV');
        }

        return $this->render('prendre_rdv/index.html.twig', [
            'user' => $RDV,
            'form' => $form->createView(),
        ]);
    }
}
