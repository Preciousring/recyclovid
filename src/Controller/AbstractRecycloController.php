<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AbstractRecycloController extends AbstractController
{
    protected $em;

    protected $twigParams = [];

    protected $security;

    /**
     * AbstractRecycloController constructor.
     * @param AuthenticationUtils $authenticationUtils
     * @param EntityManagerInterface $em
     * @param Security $security
     */
    public function __construct(AuthenticationUtils $authenticationUtils, EntityManagerInterface $em, Security $security)
    {
        $this->twigParams = [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'email' => $authenticationUtils->getLastUsername(),
        ];
        $this->em = $em;
        $this->security = $security;
    }
}
