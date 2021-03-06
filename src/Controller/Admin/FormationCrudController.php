<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add('index', 'detail');
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            AssociationField::new('auteur'),
            TextField::new('nom'),
            TextField::new('lieu'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(true),
            TextField::new('diplomes')->hideOnIndex(),
            DateField::new('date')->hideOnIndex(),
            IntegerField::new('prix')->hideOnIndex(),
            BooleanField::new('eligible'),
            AssociationField::new('category'),
            IntegerField::new('duree')->hideOnIndex(),
            IntegerField::new('places')->hideOnIndex(),
            TextField::new('organisme')->hideOnIndex(),
            TextareaField::new('objectif')->hideOnIndex(),
            TextareaField::new('contenu')->hideOnIndex(),
            TextareaField::new('prerequis')->hideOnIndex()
        ];
    }
    
}
