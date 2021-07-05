<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
