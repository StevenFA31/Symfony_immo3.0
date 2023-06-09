<?php

namespace App\Controller\Admin;

use App\Entity\PropertyTypes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PropertyTypesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PropertyTypes::class;
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
