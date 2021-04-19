<?php

namespace App\Controller;

use App\Entity\Deposit;
use App\Entity\DepositContent;
use App\Entity\MaskType;
use App\Form\GiveMaskFormType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiveMaskController extends AbstractRecycloController
{
    /**
     * @Route("/give-mask", name="give_mask")
     * @param Request $request
     * @return Response
     */
    public function testAction(Request $request): Response
    {
        $deposit = new Deposit();
        $form = $this->createForm(GiveMaskFormType::class, $deposit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deposit->setUser($this->security->getUser());
            $this->em->persist($deposit);

            $hasMaskTypeGiven = false;
            $maskTypes = $this->em->getRepository(MaskType::class)->findAll();
            /**
             * @var MaskType $maskType
             */
            foreach ($maskTypes as $maskType) {
                if (intval($qty = $form->get('depositContent' . $maskType->getId())->getData())) {
                    $depositContent = new DepositContent();
                    $depositContent->setMaskType($maskType);
                    $depositContent->setDeposit($deposit);
                    $depositContent->setQuantity($qty);
                    $this->em->persist($depositContent);
                    $hasMaskTypeGiven = true;
                }
            };

            if ($hasMaskTypeGiven) {
                $this->em->flush();
                return $this->redirectToRoute('thank-you');
            } else {
                $form->addError(new FormError('Vous devez indiquer au moins une quantité de masques.'));
            }
        }

        return $this->render('give_mask/index.html.twig', $this->twigParams + [
                'giveMaskForm' => $form->createView(),
            ]);
    }
}
