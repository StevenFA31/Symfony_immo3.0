<?php

namespace App\Controller\Admin;

use App\Entity\Boss;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BossCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boss::class;
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
