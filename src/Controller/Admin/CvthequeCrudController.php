<?php

namespace App\Controller\Admin;

use App\Entity\Cvtheque;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CvthequeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cvtheque::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add('index', 'detail');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            AssociationField::new('category'),
            AssociationField::new('reference')->hideOnIndex(),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(true),
            ImageField::new('cv')->hideOnIndex()
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(true),
            TextField::new('lieu')->hideOnIndex(),
            IntegerField::new('experience')->hideOnIndex(),
            ChoiceField::new('contrat')->setChoices([
                'CDD' => 'CDD',
                'CDI' => 'CDI',
                'CTT' => 'CTT',
                'alternance' => 'alternance',
            ]),
            BooleanField::new('disponible')
        ];
    }
}
