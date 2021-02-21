<?php

namespace App\Controller\Admin;

use App\Entity\CategoryFormation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryFormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryFormation::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
