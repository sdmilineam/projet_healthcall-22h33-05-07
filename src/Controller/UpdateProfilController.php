<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UpdateProfilController extends AbstractController
{
    /**
     * @Route("/profil/update", name="app_update_profil",)
     */
    public function User(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $Profil = $this->getUser();
        $form = $this->createForm(UpdateProfilType::class, $Profil);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Profil = $security->getUser();
            $em->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('update_profil/index.html.twig', [
            'user' => $Profil,
            'form' => $form->createView(),
        ]);
    }
}
