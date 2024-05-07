<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\StaticText;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StaticTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StaticText::class;
    }

    public function __construct(

    )
    {
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Статический текст')
            ->setPageTitle('detail', fn (StaticText $staticText) => (string) $staticText->getNameRu())
            ->setPageTitle('edit', fn (StaticText $staticText) => (string) $staticText->getNameRu())
            ->setPageTitle('new', 'Добавление статического текста')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Название для кода'),
            TextField::new('nameRu', 'Название'),
            TextareaField::new('description', 'Описание')
                ->onlyOnForms()
                ->setFormType(CKEditorType::class),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
