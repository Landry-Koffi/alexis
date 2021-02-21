<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => "Nom d'entreprise",
                'constraints' => new Length([
                    'min'=>4,
                    'max'=>30
                    ]),
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => '@mail.com'
                ]
            ])
            ->add('siret', TextType::class, [
                'label' => 'Numéro de SIRET',
                'constraints' => new Length([
                    'min'=>4,
                    'max'=>30
                    ]),
                'attr' => [
                    'placeholder' => 'N°---'
                ]
            ])
            ->add('compte', ChoiceType::class, [
                'choices' => [
                        'Formateur' => 'Formateur',
                        'Employeur' => 'Employeur',
                ],
                'label' => 'Compte'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                'constraints' => new Length([
                    'min'=>4,
                    'max'=>30
                    ]),
                    'attr' => [
                        'placeholder' => 'Saisir un mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                'constraints' => new Length([
                    'min'=>4,
                    'max'=>30
                    ]),
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
