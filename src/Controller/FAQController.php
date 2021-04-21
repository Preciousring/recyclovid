<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FAQController extends AbstractRecycloController
{
    /**
     * @Route("/faq", name="f_a_q")
     */
    public function index(): Response
    {
        return $this->render('faq/index.html.twig', $this->twigParams + [
            'controller_name' => 'FAQController',
        ]);
    }
}
