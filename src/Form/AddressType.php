<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;


class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez-vous donner à votre adresse',
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Entrez prenom',
                'attr' => [
                    'placeholder' => 'Prenom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Entrez votre nom de famille',
                'attr' => [
                    'placeholder' => 'Nom de famille'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Entrez le nom de votre entreprise',
                'attr' => [
                    'placeholder' => "Nom de l'entreprise"
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Entrez votre adresse',
                'attr' => [
                    'placeholder' => "Adresse"
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'Entrez votre code postal',
                'attr' => [
                    'placeholder' => "Code postal (facultatif)"
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => "VIlle"
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Entrez le nom du pays',
                'attr' => [
                    'placeholder' => "Pays"
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Entrez votre numéro de télèphone',
                'attr' => [
                    'placeholder' => "Numero de télèphone"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter mon adresse',
                'attr' => [
                    'class' => 'btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}