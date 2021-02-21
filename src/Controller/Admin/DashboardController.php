<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Abonnement;
use App\Entity\CategoryCv;
use App\Entity\CategoryEmploi;
use App\Entity\CategoryFormation;
use App\Entity\Cvtheque;
use App\Entity\Emploi;
use App\Entity\Formation;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jobissim Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Abonnements', 'fab fa-product-hunt', Abonnement::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Catégories formations', 'fas fa-list', CategoryFormation::class);
        yield MenuItem::linkToCrud('Catégories emplois', 'fas fa-list-alt', CategoryEmploi::class);
        yield MenuItem::linkToCrud('Catégories cv', 'fas fa-list', CategoryCv::class);
        yield MenuItem::linkToCrud('Formations', 'fas fa-school', Formation::class);
        yield MenuItem::linkToCrud('Emplois', 'fas fa-briefcase', Emploi::class);
        yield MenuItem::linkToCrud('CvThèque', 'fab fa-leanpub', Cvtheque::class);
    }
}
