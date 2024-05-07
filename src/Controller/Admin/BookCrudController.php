<?php

namespace App\Controller\Admin;

use App\Entity\ApiToken;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function __construct(

    )
    {
        ini_set('max_input_time', 24000);
        ini_set('max_execution_time ', 24000);
        ini_set('memory_limit ', '12000M');
        ini_set('client_max_body_size ', '32000M');
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Книги')
            ->setPageTitle('detail', fn (Book $book) => (string) $book->getName())
            ->setPageTitle('edit', fn (Book $book) => (string) $book->getName())
            ->setPageTitle('new', 'Добавление Кинги')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Название'),
            TextField::new('avtor', 'Автор'),
            TextareaField::new('description', 'Описание')
                ->onlyOnForms()
                ->setFormType(CKEditorType::class),

            TextField::new('price', 'Цена'),

            AssociationField::new('category', 'Категория')
                ->setFormType(EntityType::class)
                ->setFormTypeOption('choice_label', function($choice) {
                    return $choice->getName();
                })
                ->setColumns(6),

            ImageField::new('cover', 'Обложка книги')
                ->setUploadDir('public/upload/book')
                ->setBasePath('/upload/book')
                ->setUploadedFileNamePattern('[timestamp]-[contenthash].[extension]')
                ->hideOnIndex(),

            ImageField::new('pdf', 'pdf Превью')
                ->setUploadDir('public/upload/book')
                ->setBasePath('/upload/book')
                ->setUploadedFileNamePattern('[timestamp]-[contenthash].[extension]')
                ->hideOnIndex(),

            CollectionField::new('imageBooks', 'Картинки для предварительного просмотра')
                ->useEntryCrudForm(ImageBookCrudController::class)
                ->setEntryIsComplex()
                ->onlyOnForms()
                ->setColumns(12),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
