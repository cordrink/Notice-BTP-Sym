<?php

namespace App\Form;

use App\Entity\Client;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prenom',
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Telephone',
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control',
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent etre identique',
                'label' => false,
                'required' => true,
                'first_options' => [
                    'label' => 'Entrez votre mot de passe',
                    'row_attr' => [
                        'class' => 'form-floating mb-3 mb-md-0'
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => ''
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'row_attr' => [
                        'class' => 'form-floating mb-3 mb-md-0'
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => ''
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Creer compte",
                'attr' => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
