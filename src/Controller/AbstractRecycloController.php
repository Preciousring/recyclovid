<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AbstractRecycloController extends AbstractController
{
    protected $twigParams = [];

    /**
     * AbstractRecycloController constructor.
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(AuthenticationUtils $authenticationUtils)
    {

        $this->twigParams = [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'email' => $authenticationUtils->getLastUsername(),
        ];

    }


}
