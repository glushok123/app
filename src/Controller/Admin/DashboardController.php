<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\CategoryBook;
use App\Entity\FeedBack;
use App\Entity\Setting;
use App\Entity\StaticText;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(FeedBackCrudController::class)->generateUrl());

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
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Пользователи', 'fas fa-list', User::class);
        //yield MenuItem::linkToCrud('Книги', 'fas fa-list', Book::class);
        //yield MenuItem::linkToCrud('Категории', 'fas fa-list', CategoryBook::class);
        yield MenuItem::linkToCrud('Обратная связь', 'fas fa-list', FeedBack::class);
        //yield MenuItem::linkToCrud('Статический текст', 'fas fa-list', StaticText::class);
        //yield MenuItem::linkToCrud('Настройки', 'fas fa-list', Setting::class);
    }
}
