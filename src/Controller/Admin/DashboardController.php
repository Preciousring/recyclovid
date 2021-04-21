<?php

namespace App\Controller\Admin;

use App\Entity\DepositContent;
use App\Entity\MaskType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);

        $aMaskQty = [];
        $aMaskLabels = [];

        $depositContents = $em->getRepository(DepositContent::class)->findAll();
        /**
         * @var DepositContent $dc
         */
        foreach ($depositContents as $dc) {
            $mt = $dc->getMaskType();
            if (!isset($aMaskQty[$mt->getId()])) {
                $aMaskQty[$mt->getId()] = 0;
            }
            if (!isset($aMaskLabels[$mt->getId()])) {
                $aMaskLabels[$mt->getId()] = $mt->getLabel();
            }
            $aMaskQty[$mt->getId()]++;
        }


        return $this->render('admin/dashboard/dashboard.html.twig', [
            'userCount' => $userRepository->getUsersCount(),
            'aMaskQty' => '[' . implode(',', $aMaskQty) . ']',
//            'aMaskLabels' => '[' . implode(',', $aMaskLabels) . ']'
            'aMaskLabels' => '[\'FFP2\', \'Masques Tissus\']'
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recyclovid Administration');
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::subMenu('Blog', 'fas fa-blog')->setSubItems([
            MenuItem::linkToUrl('Articles', 'far fa-newspaper', '#'),
            MenuItem::linkToUrl('Catégories', 'fas fa-folder', '#'),
            MenuItem::linkToUrl('Nouvel Article', 'fas fa-pencil-alt', '#'),
        ]);
    }
}
