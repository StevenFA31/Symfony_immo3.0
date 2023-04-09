<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Entity\PropertyTypes;
use App\Entity\TransactionTypes;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new ()
            ->setTitle('Immo 3.0');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Propriétés', 'fas fa-bars')->setsubItems([
            MenuItem::linkToCrud('Voir les propriétés', 'fas fa-eye', Property::class),
            MenuItem::linkToCrud('Ajouter un bien', 'fas fa-plus', Property::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Utilisateurs', 'fas fa-bars')->setsubItems([
            MenuItem::linkToCrud('Voir les propriétés', 'fas fa-eye', User::class),
            MenuItem::linkToCrud('Ajouter un bien', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Types de propriété', 'fas fa-bars')->setsubItems([
            MenuItem::linkToCrud('Aperçue', 'fas fa-eye', PropertyTypes::class),
            MenuItem::linkToCrud('Ajouter un types', 'fas fa-plus', PropertyTypes::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Types de transaction', 'fas fa-bars')->setsubItems([
            MenuItem::linkToCrud('Aperçue', 'fas fa-eye', TransactionTypes::class),
            MenuItem::linkToCrud('Ajouter un types', 'fas fa-plus', TransactionTypes::class)->setAction(Crud::PAGE_NEW)
        ]);

    }
}