<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractRecycloController
{
    /**
     * @Route("/equipement", name="equipement")
     */
    public function index(): Response
    {
        return $this->render('equipement/index.html.twig', $this->twigParams + [
            'controller_name' => 'EquipementController',
        ]);
    }
}
