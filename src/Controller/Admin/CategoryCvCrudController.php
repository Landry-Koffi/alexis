<?php

namespace App\Controller\Admin;

use App\Entity\CategoryCv;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCvCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryCv::class;
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
