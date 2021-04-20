<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollecteController extends AbstractRecycloController
{
    /**
     * @Route("/collecte", name="collecte")
     */
    public function index(): Response
    {
        return $this->render('collecte/index.html.twig', $this->twigParams + [
            'controller_name' => 'CollecteController',
        ]);
    }
}
