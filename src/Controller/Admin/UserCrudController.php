<?php

namespace App\Controller\Admin;

use App\Entity\Setting;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Пользователи')
            ->setPageTitle('detail', fn (User $user) => (string) $user->getEmail())
            ->setPageTitle('edit', fn (User $user) => (string) $user->getEmail())
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email', 'email'),
            TextField::new('password', 'Пароль')->onlyOnForms(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}