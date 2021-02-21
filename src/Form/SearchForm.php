<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('min', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'min'
                ]
            ])
            ->add('max', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'max'
                ]
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('eligible', CheckboxType::class, [
                'label' => 'Oui',
                'required' => false,
            ])
            ->add('disponible', CheckboxType::class, [
                'label' => 'Oui',
                'required' => false,
            ])
            ->add('contrat', ChoiceType::class, [
                'choices' => [
                        'CDI' => 'CDI',
                        'CDD' => 'CDD',
                        'CTT' => 'CTT',
                        'alternance' => 'alternance',
                ],
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
