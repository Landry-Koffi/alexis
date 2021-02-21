<?php

namespace App\Form;

use App\Entity\Emploi;
use App\Entity\Cvtheque;
use App\Entity\CategoryCv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class CvthequeType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;

    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => CategoryCv::class,
                'label' => 'Catégorie'
                ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu'
            ])
            ->add('experience', IntegerType::class, [
                'label' => "Années d'expériences"
            ])
            ->add('contrat', ChoiceType::class, [
                'choices' => [
                        'CDI' => 'CDI',
                        'CDD' => 'CDD',
                        'CTT' => 'CTT',
                        'alternance' => 'alternance',
                ],
            ])
            ->add('disponible', CheckboxType::class, array(
                'required' => false,
                'label' => 'Disponible',
                'value' => 1,
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cvtheque::class,
        ]);
    }
}
