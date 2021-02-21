<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('lastname', TextType::class, [
            //     'disabled' => true,
            //     'label' => 'Nom'
            // ])
            // ->add('firstname', TextType::class, [
            //     'disabled' => true,
            //     'label' => 'Prénom'
            // ])
            // ->add('email', EmailType::class, [
            //     'disabled' => true,
            //     'label' => 'Adresse email'
            // ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Saisir le mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Mon nouveau mot de passe',
                    'constraints' => new Length([
                        'min' => 4,
                        'max' => 30
                    ]),
                    'attr' => [
                        'placeholder' => 'Saisir un mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                    'constraints' => new Length([
                        'min' => 4,
                        'max' => 30
                    ]),
                    'attr' => [
                        'placeholder' => 'Confirmer votre nouveau mot de passe'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
