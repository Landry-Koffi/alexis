<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            ChoiceField::new('roles')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_SIMPLE' => 'ROLE_SIMPLE',
                'ROLE_FORMATEUR' => 'ROLE_FORMATEUR',
                'ROLE_EMPLOYEUR' => 'ROLE_EMPLOYEUR',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
            ])->allowMultipleChoices(),
            BooleanField::new('cvonline')
        ];
    }
    
}
