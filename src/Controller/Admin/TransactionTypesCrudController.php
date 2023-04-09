<?php

namespace App\Controller\Admin;

use App\Entity\TransactionTypes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TransactionTypesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TransactionTypes::class;
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
