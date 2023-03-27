<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre du header'),
            TextareaField::new('content', 'Contenu du header'),
            TextField::new('btnTitle', 'Titre de notre bouton'),
            TextField::new('btnUrl', 'Url de destination de notre bouton'),
            //La ligne "ImageField::new('illustration')" crée le champ d'image avec le nom "illustration".
            ImageField::new('illustration')
            //Ensuite, la méthode "setUploadDir('public/uploads/images/products')" définit le répertoire où les fichiers téléchargés seront stockés sur le serveur.
            ->setUploadDir('public/uploads/images/products')
            //La méthode "setBasePath('uploads/images/products')" définit le chemin d'accès relatif au fichier dans l'application.
            ->setBasePath('uploads/images/products')
            //La méthode "setFormTypeOptions(['required' => false])" définit que ce champ n'est pas obligatoire.
            ->setFormTypeOptions(['required' => false])
            //setUploadedFileNamePattern('[contenthash].[extension]')" définit le nom du fichier téléchargé. Dans ce cas, le nom du fichier sera un hachage du contenu du fichier suivi de son extension.
            ->setUploadedFileNamePattern('[contenthash].[extension]'),
            //
        ];
    }
    
}
