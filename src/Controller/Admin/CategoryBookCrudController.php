<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\CategoryBook;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CategoryBookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryBook::class;
    }

    public function __construct(

    )
    {
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Категории')
            ->setPageTitle('detail', fn (CategoryBook $categoryBook) => (string) $categoryBook->getName())
            ->setPageTitle('edit', fn (CategoryBook $categoryBook) => (string) $categoryBook->getName())
            ->setPageTitle('new', 'Добавление Категории')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Название'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
