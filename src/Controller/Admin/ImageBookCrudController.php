<?php

namespace App\Controller\Admin;

use App\Entity\ImageBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageBookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageBook::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('name', 'Картинка')
                ->setUploadDir('public/upload/book')
                ->setBasePath('/upload/book')
                ->setUploadedFileNamePattern('[timestamp]-[contenthash].[extension]')
                ->hideOnIndex(),
        ];
    }
}
