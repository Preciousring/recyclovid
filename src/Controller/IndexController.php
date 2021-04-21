<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractRecycloController
{

    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {

        return $this->render('index/index.html.twig', $this->twigParams + [
            'controller_name' => 'IndexController'
        ]);
    }


}
