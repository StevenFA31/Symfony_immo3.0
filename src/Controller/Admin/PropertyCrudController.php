<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield IntegerField::new ('id')->onlyOnIndex();
        yield TextField::new ('title');
        yield TextField::new ('summary');
        yield MoneyField::new ('price')->setCurrency('EUR');
        yield TextField::new ('address');
        yield TextField::new ('additional_address');
        yield IntegerField::new ('postcode');
        yield TextField::new ('city');
        yield TextField::new ('country');
        yield TextField::new ('place_displayed');
        yield IntegerField::new ('gps_coordinate');
        yield BooleanField::new ('status');
        yield IntegerField::new ('views')->onlyOnIndex();
        yield CollectionField::new ('pictures')->onlyOnDetail();
        yield AssociationField::new ('property_types');
        yield AssociationField::new ('owner');
        // yield TextField::new ('owner.lastname');
        yield AssociationField::new ('transaction_types');

    }
}