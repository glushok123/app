<?php

namespace App\Controller\Admin;

use App\Entity\FeedBack;
use App\Entity\Setting;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SettingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Setting::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Настройки')
            ->setPageTitle('detail', fn (Setting $setting) => (string) $setting->getNameRu())
            ->setPageTitle('edit', fn (Setting $setting) => (string) $setting->getNameRu())
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Параметр в коде'),
            TextField::new('nameRu', 'Параметр'),
            TextField::new('value', 'Значение'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
