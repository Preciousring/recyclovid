<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecyclageController extends AbstractRecycloController
{
    /**
     * @Route("/recyclage", name="recyclage")
     */
    public function index(): Response
    {
        return $this->render('recyclage/index.html.twig', $this->twigParams + [
            'controller_name' => 'RecyclageController',
        ]);
    }
}
