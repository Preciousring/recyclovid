<?php

namespace App\Controller;

use App\Entity\Deposit;
use App\Form\GiveMaskFormType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiveMaskController extends AbstractRecycloController
{
    /**
     * @Route("/give-mask", name="give_mask")
     */
    public function index(): Response
    {
        $deposit = new Deposit();
        $form = $this->createForm(GiveMaskFormType::class, $deposit);

        return $this->render('give_mask/index.html.twig',$this->twigParams +[
                'giveMaskForm' => $form->createView(),
        ]);
    }
}
