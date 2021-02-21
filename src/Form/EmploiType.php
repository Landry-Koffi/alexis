<?php

namespace App\Form;

use App\Entity\Emploi;
use App\Entity\CategoryEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class EmploiType extends AbstractType
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
                'class' => CategoryEmploi::class,
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
            ->add('typedecontrat', TextType::class, [
                'label' => 'Type de contrat'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée'
            ])
            ->add('salaire', IntegerType::class, [
                'label' => 'Salaire',
            ])
            ->add('mission', TextareaType::class, [
                'label' => 'Mission'
            ])
            ->add('prerequis', TextareaType::class, [
                'label' => 'Prérequis'
            ])
            ->add('organisme', TextType::class, [
                'label' => 'Organisme'
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Image'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emploi::class,
        ]);
    }
}
