<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractRecycloController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function index(): Response
    {
        return $this->render('actualites/index.html.twig', $this->twigParams + [
            'controller_name' => 'ActualitesController',
        ]);
    }
}
