<?php

namespace App\Controller\Admin;

use App\Entity\CategoryBook;
use App\Entity\FeedBack;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FeedBackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FeedBack::class;
    }

    public function __construct(

    )
    {
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Обратная связь')
            ->setPageTitle('detail', fn (FeedBack $feedBack) => (string) $feedBack->getName())
            ->setPageTitle('edit', fn (FeedBack $feedBack) => (string) $feedBack->getName())
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'ФИО'),
            TextField::new('email', 'email'),
            TextField::new('phone', 'Телефон'),
            TextField::new('message', 'Сообщение'),
            TextField::new('book', 'Книга с которой поступило обращение'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
