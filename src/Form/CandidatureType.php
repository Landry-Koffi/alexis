<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CandidatureType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cv = $this->security->getUser()->getCv('cv');
        $builder
            ->add('cv', ChoiceType::class, [
                'label' => 'Inclure le CV du profil ?',
                'choices' => [
                    'Oui' => $cv,
                    'Non' => ''
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Lettre de motivation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
