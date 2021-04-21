<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractRecycloController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', $this->twigParams + [
            'controller_name' => 'ContactController',
        ]);
    }
}
