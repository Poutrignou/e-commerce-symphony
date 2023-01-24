<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre prénom',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre nom de famille',
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre e-mail',
                ],
            ])
            ->add('password', RepeatedType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'le mot de passe et la confirmation doivent etre identiques',
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                ],
                'required' => true,
                'first_options' => ['label' => 'mot de passe',
                    'attr' => [
                        'placeholder' => 'Veuillez renseigner votre mot de passe',
                    ],
                ],
                'second_options' => ['label' => 'confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Veuillez confirmer votre mot de passe',
                    ],
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}