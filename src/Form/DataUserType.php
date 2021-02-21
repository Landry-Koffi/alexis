<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class DataUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone', TextType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse postale'
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('postale', TextType::class, [
                'label' => 'Code postale'
            ])
            ->add('about', TextareaType::class, [
                'label' => 'À propos'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'AJOUTER'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
