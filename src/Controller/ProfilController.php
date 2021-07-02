<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ImagProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/profil/upload", name="app_profil_uploade" ,methods="GET")
     */
    public function User(EntityManagerInterface $em, Security $security, Request $request)
    {
        $entity = new User();
        $form = $this->createForm(ImagProfilType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $security->getUser();
            $entity->setAuthor($user);

            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', 'Your __entity__ has been created successfully.');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('Form/Upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
