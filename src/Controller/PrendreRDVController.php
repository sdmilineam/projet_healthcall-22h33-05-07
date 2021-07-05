<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrendreRDVController extends AbstractController
{
    /**
     * @Route("/prendre/r/d/v", name="prendre_r_d_v")
     */
    public function index(): Response
    {
        return $this->render('prendre_rdv/index.html.twig', [
            'controller_name' => 'PrendreRDVController',
        ]);
    }
}
