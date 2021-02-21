<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\CategoryFormation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;

class FormationType extends AbstractType
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
                'class' => CategoryFormation::class,
                'label' => 'Catégorie'
                ])
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu'
            ])
            ->add('date', DateType::class, [
                'label' => 'Date'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée'
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix',
            ])
            ->add('places', IntegerType::class, [
                'label' => 'Places'
            ])
            ->add('diplomes', TextType::class, [
                'label' => 'Diplômes'
            ])
            ->add('objectif', TextareaType::class, [
                'label' => 'Objectif'
            ])
            ->add('prerequis', TextareaType::class, [
                'label' => 'Prérequis'
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Contenu'
            ])
            ->add('organisme', TextType::class, [
                'label' => 'Organisme'
            ])
            ->add('eligible', CheckboxType::class, array(
                'required' => false,
                'label' => 'Éligible',
                'value' => 1,
            ))
            ->add('imageFile', VichFileType::class, [
                'label' => 'Image'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
